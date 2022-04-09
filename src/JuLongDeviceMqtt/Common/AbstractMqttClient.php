<?php
/**
 * 文件描述
 * Created on 2022/1/20 15:59
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

use Closure;
use JuLongDeviceMqtt\Contracts\MqttClient;
use JuLongDeviceMqtt\Contracts\Repository;
use JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException;
use JuLongDeviceMqtt\Exception\DisconnectedException;
use JuLongDeviceMqtt\Exception\PendingMessageNotFoundException;
use JuLongDeviceMqtt\Exception\ProtocolViolationException;
use PhpMqtt\Client\Exceptions\PendingMessageAlreadyExistsException;
use Psr\Log\LoggerInterface;
use Simps\MQTT\Client;
use Simps\MQTT\Config\ClientConfig;
use Simps\MQTT\Exception\ProtocolException;
use Simps\MQTT\Protocol\Types;
use Swoole\Coroutine\Channel;

/**
 * mqtt客户端抽象类
 *
 $swooleConfig = [
    'open_mqtt_protocol' => true, // 开启mqtt协议
    'package_max_length' => 2 * 1024 * 1024, // 包最大长度
    'ssl_allow_self_signed' => true, // 允许自签名
    'ssl_verify_peer' => true, // 双方都需要验证
    'ssl_cafile' => SSL_CERTS_DIR . '/mosquitto.org.crt', // https://test.mosquitto.org/ssl/mosquitto.org.crt
    'ssl_key_file' => SSL_CERTS_DIR . '/client.key', // Please go to https://test.mosquitto.org/ssl to generate.
    'ssl_cert_file' => SSL_CERTS_DIR . '/client.crt', // Please go to https://test.mosquitto.org/ssl to generate.
 ];
 * Created on 2022/1/20 16:04
 * Create by LZH
 */
abstract class AbstractMqttClient extends ClientConfig implements MqttClient
{

    use OffersHooks;

    /**
     * @var string 中间件主机地址
     */
    private $brokerHost;

    /**
     * @var int 中间件服务端口
     */
    private $brokerPort;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Client 客户端
     */
    private $client;

    /**
     * @var Channel 中断循环通道
     */
    private $interruptedChannel;

    /**
     * @var Repository 消息暂存库
     */
    private Repository $repository;


    public function __construct(
        Client $client = null,
        Repository $repository = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct();
        $this->client = $client;
        $this->logger = $logger ?: new DefaultLogger();
        $this->repository = $repository ?: new MemoryRepository();
        $this->interruptedChannel = new Channel(1);
    }

    /**
     * @return string
     */
    public function getBrokerHost(): string
    {
        return $this->brokerHost;
    }

    /**
     * @param string $brokerHost
     */
    public function setBrokerHost(string $brokerHost): void
    {
        $this->brokerHost = $brokerHost;
    }

    /**
     * @return int
     */
    public function getBrokerPort(): int
    {
        return $this->brokerPort;
    }

    /**
     * @param int $brokerPort
     */
    public function setBrokerPort(int $brokerPort): void
    {
        $this->brokerPort = $brokerPort;
    }

    /**
     * 订阅
     * @param array $topics Topics数组
     * @param Closure $callback 回调函数
     * @throws ClientNotConnectedToBrokerException
     * @since 2022/01/20
     * @author LZH
     */
    protected function _subscribe(array $topics, Closure $callback)
    {
        // 初始化客户端，必须在协程中初始化
        if (empty($this->client)) {
            $this->client = new Client($this->getBrokerHost(), $this->getBrokerPort(), $this);
        }

        if (!$this->isConnected()) {
            throw new ClientNotConnectedToBrokerException();
        }

        // 主题对象数组转换为配置
        $config = $this->convertTopicToConfig($topics);

//        $this->client->connect(true); // TODO 需要传入遗嘱消息
        try {
            return $this->client->subscribe($config); // 发出订阅消息
        } catch (\Throwable $exception) {
            $this->logger->alert(
                sprintf('Subscribe failed on Broker "%s"', $this->client->getHost()),
                ['exception' => $exception]
            );
        }
    }

    /**
     * 事件循环
     */
    protected function _loop(bool $allowSleep = true, bool $exitWhenQueuesEmpty = false, int $queueWaitLimit = null): void
    {
        // 如果是订阅的话，需要启动一个进程或者协程来循环接收消息
        \Swoole\Coroutine\go(function () use ($queueWaitLimit, $exitWhenQueuesEmpty, $allowSleep) {

            $this->logger->debug('Starting client loop to process incoming messages and the resend queue.');

            $loopStartedAt = microtime(true);

            $timeSincePing = time();

            while (true) {

                if ($this->interruptedChannel->pop(0.05)) { // 等待50ms，协程切换
                    break; // 跳出循环
                }

                $elapsedTime = microtime(true) - $loopStartedAt;
                $this->runLoopEventHandlers($elapsedTime); // 处理事件循环处理器

                try {

                    $resp = $this->client->recv();

                    if ($resp && $resp !== true) { // 只有接收到有效数据才进入该流程

                        /**
                        array(7) {
                        ["type"]=>
                        int(3)
                        ["dup"]=>
                        int(0)
                        ["qos"]=>
                        int(1)
                        ["retain"]=>
                        int(0)
                        ["topic"]=>
                        string(25) "mqtt/Ack/fwSkNfgI4JKljlkM"
                        ["message"]=>
                        string(149) "{"Action":"addPerson","TaskID":"","PersonId":"","FacePosition":{"left":59,"top":78,"right":143,"bottom":160},"DeviceUUID":"fwSkNfgI4JKljlkM","ret":0}"
                        ["message_id"]=>
                        int(1)
                        }
                         */

                        // 处理消息
                        $this->handleMessage($resp);

                        // 重新发送过期未确认的消息，这包括已经发布的消息，订阅或取消订阅请求
                        $this->resendPendingMessages();

                        // mqtt协议层的心跳
                        if ($timeSincePing <= (time() - $this->client->getConfig()->getKeepAlive())) {
                            $buffer = $this->client->ping();
                            if ($buffer) {
                                echo 'send ping success' . PHP_EOL;
                                $timeSincePing = time();
                            }
                        }

                        // 如果配置，队列为空且没有活跃的订阅，则退出循环
                        if ($exitWhenQueuesEmpty && $this->repository->countSubscriptions() === 0) {
                            if ($this->allQueuesAreEmpty()) {
                                break;
                            }

                            // 等待时间到了。这很可能意味着发送队列无法及时清空。 可能服务器没有响应确认。
                            if ($queueWaitLimit !== null && (microtime(true) - $loopStartedAt) > $queueWaitLimit) {
                                break;
                            }
                        }


                        // 请求返回成功，不同类型的mqtt消息进行不同的处理
                        switch ($resp['type']) {
                            case Types::PUBLISH :
                                if($resp['qos'] === 1) { // QoS1 PUBACK
                                    $this->client->send(
                                        [
                                            'type' => Types::PUBACK,
                                            'message_id' => $resp['message_id'],
                                        ],
                                        false
                                    );
                                }
                                break;
                            case Types::DISCONNECT :
                                echo "Broker is disconnected\n";
                                $this->client->close();
                                throw new DisconnectedException(); // 通过抛出异常来关闭订阅循环

                        }

                        $message = json_decode($resp['message'], true); // 对消息体进行json解码

                        // 请求返回错误码，返回1表示设备重启；2表示升级开始，1表示升级成功
                        if (isset($message['ret']) && $message['ret'] != 0 && $message['ret'] != 1 && $message['ret'] != 2) {
                            throw $this->errorCodeConvertToException($message);
                        }

//                        call_user_func($callback, $this->client, $this->parseResponse($message)); // 传入接收的数据

                    } elseif($allowSleep) {
                        usleep(100000); // 100ms
                    }



                } catch (\Throwable $e) {
                    if ($e instanceof DisconnectedException) {
                        break; // 断线，则跳出循环
                    }
                    throw $e;
                }
            }
        });
    }

    /**
     * 中断订阅循环
     */
    protected function _interruptedLoop()
    {
        if ($this->interruptedChannel) {
            return $this->interruptedChannel->push(1); // 中断订阅循环
        }
        return false;
    }

    /**
     * 发布
     * @param Topic $topic 发布主题实例对象
     * @param AbstractRequest $request 发布到主题的请求对象，即消息
     * @param int $qos 发布质量
     * @param int $dup 是否重复发送
     * @param int $retain 消息是否持久保存并发送
     * @param array $properties 额外消息属性
     * @return array|bool|void
     * @throws ClientNotConnectedToBrokerException
     * @author LZH
     * @since 2022/01/20
     */
    protected function _publish(Topic $topic, AbstractRequest $request, $qos = 0, $dup = 0, $retain = 0, $properties = [])
    {
        $responseData = null;

        // 初始化客户端，必须在协程中初始化
        if (empty($this->client)) {
            $this->client = new Client($this->getBrokerHost(), $this->getBrokerPort(), $this);
        }

        if (!$this->isConnected()) {
            throw new ClientNotConnectedToBrokerException();
        }

        if (empty($request->TaskID)) {
            $request->TaskID = strval($this->client->buildMessageId()); // 给请求设置消息id
        }

        $message = $request->toJsonString(); // 请求对象序列化并转换为json字符串

//        print_r(json_decode($message, true));
        print_r($message);

        try {
            return $this->client->publish($topic, $message, $qos = 0, $dup = 0, $retain = 0, $properties = []);
        } catch (\Throwable $exception) {
            if ($exception instanceof ProtocolException) {
                $this->logger->critical(
                    sprintf('Publish to Broker "%s" protocol error', $this->client->getHost()),
                    ['exception' => $exception]
                );
            } else {
                $this->logger->alert(
                    sprintf('Publishing failed on Broker "%s"', $this->client->getHost()),
                    ['exception' => $exception]
                );
            }

        }
    }

    /**
     * 子类实现
     * @param string $uuidOrTopic
     * @param AbstractRequest $message
     * @param $qualityOfService
     * @param $dup
     * @param $retain
     * @param $properties
     * @author LZH
     * @since 2022/04/08
     */
    public function publish(string $uuidOrTopic, AbstractRequest $message, $qualityOfService = 0, $dup = 0, $retain = 0, $properties = []): void
    {
        // TODO: Implement publish() method.
    }

    /**
     * 连接服务器
     */
    public function connect(bool $clean = true, array $will = []): void
    {
        // 初始化客户端
        if (empty($this->client)) {
            $this->client = new Client($this->getBrokerHost(), $this->getBrokerPort(), $this);
        }

        try {
            $connectResult = $this->client->connect($clean, $will);
        } catch (\Throwable $exception) {
            if ($exception instanceof ProtocolException) {
                $this->logger->critical(
                    sprintf('Connection to Broker "%s" protocol error', $this->client->getHost()),
                    ['exception' => $exception]
                );
            } else {
                $this->logger->critical(
                    sprintf('Connection to Broker "%s" failed', $this->client->getHost()),
                    ['exception' => $exception]
                );
            }

        }
    }

    /**
     * 关闭连接
     * @throws ClientNotConnectedToBrokerException
     */
    public function disconnect(): void
    {
        if (empty($this->client)) {
            return; // 客户端没有初始化，则立即返回
        }

        if (!$this->isConnected()) {
            throw new ClientNotConnectedToBrokerException();
        }

        try {
            $this->client->close();
        } catch (\Throwable $exception) {
            $this->logger->alert(
                sprintf('Closing failed on Broker "%s"', $this->client->getHost()),
                ['exception' => $exception]
            );
        }
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * 判断是否客户端是否连接
     * @return false|mixed
     * @author LZH
     * @since 2022/04/07
     */
    public function isConnected(): bool
    {
        if (empty($this->client)) {
            return false; // 客户端没有初始化，则立即返回
        }

        return $this->client->getClient()->isConnected();
    }

    /**
     * 错误码转换为异常类
     * @param mixed $Resp
     * @author LZH
     * @since 2022/01/24
     */
    private function errorCodeConvertToException($Resp)
    {
        return new \Exception(implode(',', $Resp)); // TODO 这里需要初始化
    }

    /**
     * 主题对象数组转换为配置
     * @param array $topics 主题对象数组
     * @author LZH
     * @since 2022/01/25
     */
    private function convertTopicToConfig(array $topics): array
    {
        if (empty($topics)) { // TODO 需要兼容mqtt5协议
            return [];
        }

        $config = [];
        foreach ($topics as $topic) {
            /* @var Topic $topic */
            $config[strval($topic)] = 1; // 转换为字符串
        }
        return $config;
    }

    protected function parseResponse($resp) : ?AbstractResponse
    {
        $respClass = "JuLongDeviceMqtt"."\\".ucfirst($this->service)."\\"."Models"."\\".ucfirst($resp['Action'])."Response";
        if (!class_exists($respClass)) {
            $respClass = "JuLongDeviceMqtt"."\\".ucfirst($this->service)."\\"."Models"."\\".ucfirst($resp['Action']);
        }
        $obj = new $respClass();
        $obj->deserialize($resp);
        return $obj;
    }

    /**
     * 根据返回内容来处理消息
     *
        array(7) {
            ["type"]=>
            int(3)
            ["dup"]=>
            int(0)
            ["qos"]=>
            int(1)
            ["retain"]=>
            int(0)
            ["topic"]=>
            string(25) "mqtt/Ack/fwSkNfgI4JKljlkM"
            ["message"]=>
            string(149) "{"Action":"addPerson","TaskID":"","PersonId":"","FacePosition":{"left":59,"top":78,"right":143,"bottom":160},"DeviceUUID":"fwSkNfgI4JKljlkM","ret":0}"
            ["message_id"]=>
            int(1)
        }
     *
     * CONNECT (客户端 -> 服务端) 客户端请求与服务端建立连接
     * CONNACK (服务端 -> 客户端) 连接成功建立
     * PUBLISH (客户端 -> 服务端 / 服务端 -> 客户端) 发布消息
     * PUBACK (客户端 -> 服务端 / 服务端 -> 客户端) 收到发布消息的确认
     * PUBREC (客户端 -> 服务端 / 服务端 -> 客户端) 收到发布消息（Qos 2 的第二次握手）
     * PUBREL (客户端 -> 服务端 / 服务端 -> 客户端) 不再发布消息（Qos 2 的第三次握手）
     * PUBCOMP (客户端 -> 服务端 / 服务端 -> 客户端) 消息发布的完结（Qos 2 的第四次握手）
     * SUBSCRIBE (客户端 -> 服务端) 客户端请求订阅某主题
     * SUBACK (服务端 -> 客户端) 订阅操作成功
     * UNSCBSCRIBE (客户端 -> 服务端) 客户端请求取消订阅某主题
     * UNSCBACK (服务端 -> 客户端) 取消订阅操作成功
     * PINGREQ (客户端 -> 服务端) PING 请求
     * PINGRESP (服务端 -> 客户端) PING 响应
     * DISCONNECT (客户端 -> 服务端) 客户端断开了与服务端的连接
     *
     * @param array $message
     * @author LZH
     * @since 2022/04/08
     */
    protected function handleMessage(array $message): void
    {
        // PUBLISH (incoming)，客户端收到发布消息
        if ($message['type'] == Types::PUBLISH) {
            if ($message['qos'] === MQTT_QOS_1) { // QoS 1. 对于至少发送一次服务质量，需要客户端发送确认指令
                $this->sendPublishAcknowledgement($message['message_id']);
            }

            if ($message['qos'] === MQTT_QOS_2) { // QoS 2, part 1. 对于只发送一次服务质量，需要客户端发送确认指令
                try {
                    $pendingMessage = new PublishedMessage(
                        $message['message_id'],
                        $message['topic'],
                        $message['message'],
                        2,
                        false
                    );
                    $this->repository->addPendingIncomingMessage($pendingMessage);
                } catch (PendingMessageAlreadyExistsException $e) {
                    // 已经接收并处理了该消息
                }

                // 客户端收到多次发布包，则需要确认多次
                $this->sendPublishReceived($message['message_id']);

                // 只有收到public complete 包客户端才能投递发布消息，这里中断执行流
                return;
            }

            // 客户端收到服务质量为0或者1的消息，则立即投递
            $this->deliverPublishedMessage($message['topic'], $message['message'], $message['qos']);
            return;
        }

        // PUBACK (outgoing, QoS 1)，对于服务质量为1的消息，客户端接收到服务端发送的确认指令包
        // 接收到一个确认包，则可以从重试队列中移除发布消息
        if ($message['type'] == Types::PUBACK) {
            $result = $this->repository->removePendingOutgoingMessage($message['message_id']);
            if ($result === false) {
                $this->logger->notice('Received publish acknowledgement from the broker for already acknowledged message.', [
                    'messageId' => $message['message_id']
                ]);
            }
            return;
        }

        // PUBREC (outgoing, QoS 2, part 1)，对于服务质量为1的消息，客户端接收到 PUBREC 指令
        // 接收回执允许我们将发布的消息标记为已接收。
        if ($message['type'] == Types::PUBREC) {
            try {
                $result = $this->repository->markPendingOutgoingPublishedMessageAsReceived($message['message_id']);
            } catch (PendingMessageNotFoundException $e) {
                // This should never happen as we should have received all PUBREC messages before we see the first
                // PUBCOMP which actually remove the message. So we do this for safety only.
                $result = false;
            }

            if ($result === false) {
                $this->logger->notice('Received publish receipt from the broker for already acknowledged message.', [
                    'messageId' => $message['message_id']
                ]);
            }

            // 客户端发布 PUBREL 指令
            $this->sendPublishRelease($message['message_id']);
            return;
        }

        // PUBREL (incoming, QoS 2, part 2)，客户端接收到PUBREL指令
        // 当客户端接收到PUBREL指令时，客户端立即投递消息到订阅回调函数。
        if ($message['type'] == Types::PUBREL) {
            $pendingMessage = $this->repository->getPendingIncomingMessage($message['message_id']);
            if (!$pendingMessage || !$pendingMessage instanceof PublishedMessage) {
                $this->logger->notice('Received publish release from the broker for already released message.', [
                    'messageId' => $message['message_id'],
                ]);
            } else {
                $this->deliverPublishedMessage(
                    $pendingMessage->getTopicName(),
                    $pendingMessage->getMessage(),
                    $pendingMessage->getQualityOfServiceLevel()
                );

                $this->repository->removePendingIncomingMessage($message['message_id']);
            }

            // 客户端回复 PUBCOMP 包，阻止重发
            $this->sendPublishComplete($message['message_id']);
            return;
        }

        // PUBCOMP (outgoing, QoS 2 part 3)，客户端接收到PUBCOMP指令
        // 接收到该包，则从重试队列中删除一个发布消息。
        if ($message['type'] == Types::PUBCOMP) {
            $result = $this->repository->removePendingOutgoingMessage($message['message_id']);
            if ($result === false) {
                $this->logger->notice('Received publish completion from the broker for already acknowledged message.', [
                    'messageId' => $message['message_id'],
                ]);
            }
            return;
        }

        // SUBACK，客户端接收到订阅确认指令
        if ($message['type'] == Types::SUBACK) {
            $pendingMessage = $this->repository->getPendingOutgoingMessage($message['message_id']);
            if (!$pendingMessage || !$pendingMessage instanceof SubscribeRequest) {
                $this->logger->notice('Received subscribe acknowledgement from the broker for already acknowledged request.', [
                    'messageId' => $message['message_id'],
                ]);
                return;
            }

            $acknowledgedSubscriptions = $pendingMessage->getSubscriptions();
            if (count($acknowledgedSubscriptions) != count($message['codes'])) { // 订阅确认指令包含多个服务质量
                throw new ProtocolViolationException(sprintf(
                    'The MQTT broker responded with a different amount of QoS acknowledgements (%d) than we expected (%d).',
                    count($message['codes']),
                    count($acknowledgedSubscriptions)
                ));
            }

            foreach ($message['codes'] as $index => $qualityOfService) {
                // It may happen that the server registers our subscription
                // with a lower quality of service than requested, in this
                // case this is the one that we will record.
                $acknowledgedSubscriptions[$index]->setQualityOfServiceLevel($qualityOfService); // 返回的服务质量可能会变

                $this->repository->addSubscription($acknowledgedSubscriptions[$index]);
            }

            $this->repository->removePendingOutgoingMessage($message['message_id']);
            return;
        }

        // UNSUBACK
        if ($message['type'] == Types::UNSUBACK) {
            $pendingMessage = $this->repository->getPendingOutgoingMessage($message['message_id']);
            if (!$pendingMessage || !$pendingMessage instanceof UnsubscribeRequest) {
                $this->logger->notice('Received unsubscribe acknowledgement from the broker for already acknowledged request.', [
                    'messageId' => $message['message_id'],
                ]);
                return;
            }

            foreach ($pendingMessage->getTopicFilters() as $topicFilter) {
                $this->repository->removeSubscription($topicFilter);
            }

            $this->repository->removePendingOutgoingMessage($message['message_id']);
            return;
        }

        // PINGREQ，服务端收到心跳包
        if ($message['type'] == Types::PINGREQ) {
            // Respond with PINGRESP.
            $this->client->send(['type' => Types::PINGRESP], false);
            return;
        }
    }

    /**
     * 客户端为给定的消息发送一个发布确认指令包
     * @param int $messageId
     * @author LZH
     * @since 2022/04/08
     */
    protected function sendPublishAcknowledgement(int $messageId): void
    {
        $this->logger->debug('Sending publish acknowledgement to the broker (message id: {messageId}).', ['messageId' => $messageId]);

        $this->client->send([
            'type' => Types::PUBACK,
            'message_id' => $messageId ?? 0,
        ], false);
    }

    /**
     * 发布 PUBREC 指令
     * @param int $messageId
     * @author LZH
     * @since 2022/04/08
     */
    protected function sendPublishReceived(int $messageId): void
    {
        $this->logger->debug('Sending publish received message to the broker (message id: {messageId}).', ['messageId' => $messageId]);

        $this->client->send([
            'type' => Types::PUBREC,
            'message_id' => $messageId ?? 0,
        ], false);

    }

    /**
     * 投递一个发布的消息给订阅者回调
     * @param string $topic
     * @param string $message
     * @param int $qualityOfServiceLevel
     * @param bool $retained
     * @author LZH
     * @since 2022/04/08
     */
    protected function deliverPublishedMessage(string $topic, string $message, int $qualityOfServiceLevel, bool $retained = false): void
    {
        $subscribers = $this->repository->getSubscriptionsMatchingTopic($topic);

        $this->logger->debug('Delivering message received on topic [{topic}] with QoS [{qos}] from the broker to [{subscribers}] subscribers.', [
            'topic' => $topic,
            'message' => $message,
            'qos' => $qualityOfServiceLevel,
            'subscribers' => count($subscribers),
        ]);

        foreach ($subscribers as $subscriber) {
            if ($subscriber->getCallback() === null) {
                continue;
            }

            try {
                call_user_func($subscriber->getCallback(), $topic, $message, $retained);
            } catch (\Throwable $e) {
                $this->logger->error('Subscriber callback threw exception for published message on topic [{topic}].', [
                    'topic' => $topic,
                    'message' => $message,
                    'exception' => $e,
                ]);
            }
        }

        $this->runMessageReceivedEventHandlers($topic, $message, $qualityOfServiceLevel, $retained);
    }

    /**
     * 发布 PUBREL 指令
     * @param int $messageId
     * @author LZH
     * @since 2022/04/08
     */
    protected function sendPublishRelease(int $messageId): void
    {
        $this->logger->debug('Sending publish release message to the broker (message id: {messageId}).', ['messageId' => $messageId]);

        $this->client->send([
            'type' => Types::PUBREL,
            'message_id' => $messageId ?? 0,
        ], false);
    }

    /**
     * 发布 PUBCOMP 指令
     * @param int $messageId
     * @author LZH
     * @since 2022/04/08
     */
    protected function sendPublishComplete(int $messageId): void
    {
        $this->logger->debug('Sending publish complete message to the broker (message id: {messageId}).', ['messageId' => $messageId]);

        $this->client->send([
            'type' => Types::PUBCOMP,
            'message_id' => $messageId ?? 0,
        ], false);
    }

}