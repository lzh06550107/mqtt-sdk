<?php
/**
 * 文件描述
 * Created on 2022/1/20 15:59
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use JuLongDeviceMqtt\Contracts\MqttClient;
use JuLongDeviceMqtt\Contracts\Repository;
use JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException;
use JuLongDeviceMqtt\Exception\InvalidMessageException;
use JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException;
use JuLongDeviceMqtt\Exception\PendingMessageNotFoundException;
use JuLongDeviceMqtt\Exception\ProtocolViolationException;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use Simps\MQTT\Client;
use Simps\MQTT\Config\ClientConfig;
use Simps\MQTT\Exception\ProtocolException;
use Simps\MQTT\Protocol\Types;
use Swoole\Coroutine;
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
    private $repository;

    public function __construct(
        CommonClient $client = null,
        LoggerInterface $logger = null,
        Repository $repository = null
    ) {
        parent::__construct();
        $this->client = $client;
        $this->logger = $logger ?: new DefaultLogger();
        $this->repository = $repository ?: new MemoryRepository();
        $this->interruptedChannel = new Channel(1);

        $this->initializeEventHandlers();
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
     * @param string $topicFilter 主题
     * @param callable|null $callback 订阅主题回调函数
     * @param int $qualityOfService 服务质量
     * @throws ClientNotConnectedToBrokerException
     * @throws PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function subscribe(string $topicFilter, callable $callback = null, int $qualityOfService = MQTT_QOS_0) : void
    {
        $this->ensureConnected();

        $this->logger->debug('Subscribing to topic [{topicFilter}] with maximum QoS [{qos}].', [
            'topicFilter' => $topicFilter,
            'qos' => $qualityOfService,
        ]);

        $messageId = $this->repository->newMessageId();

        // 创建订阅表示，只有在服务端确认后才变成实际的订阅
        $subscriptions = [new Subscription($topicFilter, $qualityOfService, $callback)];

        $pendingMessage = new SubscribeRequest($messageId, $subscriptions);
        $this->repository->addPendingOutgoingMessage($pendingMessage);

        try {
            $this->client->subscribe([$topicFilter => $qualityOfService]);
        } catch (\Throwable $exception) {
            $this->logger->alert(
                sprintf('Subscribe failed on Broker "%s"', $this->client->getHost()),
                ['exception' => $exception]
            );
        }
    }

    /**
     * 取消订阅
     * @param string $topicFilter
     * @param array $properties
     * @throws ClientNotConnectedToBrokerException
     * @throws PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function unsubscribe(string $topicFilter, array $properties = []) : void
    {
        $this->ensureConnected();

        $this->logger->debug('Unsubscribing from topic [{topicFilter}].', ['topicFilter' => $topicFilter]);

        $messageId    = $this->repository->newMessageId();
        $topicFilters = [$topicFilter];

        $pendingMessage = new UnsubscribeRequest($messageId, $topicFilters);
        $this->repository->addPendingOutgoingMessage($pendingMessage);

        try {
            $this->client->unSubscribe([$topicFilter], $properties);
        } catch (\Throwable $exception) {
            $this->logger->alert(
                sprintf('Subscribe failed on Broker "%s"', $this->client->getHost()),
                ['exception' => $exception]
            );
        }

    }

    /**
     * 订阅后的事件循环，用来监听订阅主题
     * @param bool $allowSleep 是否允许休眠时间
     * @param bool $exitWhenQueuesEmpty 当队列为空时，是否允许退出循环
     * @param int|null $queueWaitLimit 当超过队列等待时间，是否退出循环
     * @author LZH
     * @since 2022/04/11
     */
    public function loop(bool $allowSleep = true, bool $exitWhenQueuesEmpty = false, int $queueWaitLimit = null) : void
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

                    $resp = $this->client->recv(); // 等待数据的时候，协程切换

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
                            $buffer = $this->client->ping(); // TODO 同步调用
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

                    } elseif($allowSleep) {
                        Coroutine::sleep(1); // 睡眠1s，协程切换
                    }

                } catch (\Throwable $e) {
                    throw $e;
                }
            }
        });
    }

    /**
     * 中断订阅循环
     */
    public function interruptedLoop() : void
    {
        if ($this->interruptedChannel) {
            $this->interruptedChannel->push(1); // 中断订阅循环
        }
    }

    /**
     * 发布
     * @param string $uuidOrTopic
     * @param string $message
     * @param int $qualityOfService
     * @param bool $dup
     * @param false $retain
     * @param array $properties
     * @throws ClientNotConnectedToBrokerException
     * @throws PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function publish(string $uuidOrTopic, string $message , int $qualityOfService = MQTT_QOS_0, bool $dup = false, bool $retain = false, array $properties = []) : void
    {
        $this->ensureConnected();

        $messageId = null;

        if ($qualityOfService > MQTT_QOS_0) { // 消息质量大于0 ，则需要确认
            $messageId = $this->repository->newMessageId();

            $pendingMessage = new PublishedMessage($messageId, $uuidOrTopic, $message, $qualityOfService, $retain);
            $this->repository->addPendingOutgoingMessage($pendingMessage);
        }

        print_r('---------发送消息内容----------' . PHP_EOL);
        print_r($message);
        print_r(PHP_EOL);
        file_put_contents("test.json", $message);

        $this->publishMessage($uuidOrTopic, $message, $qualityOfService, $retain, $messageId);
    }

    /**
     * 实际发布消息
     *
     * @param string $topic
     * @param string $message
     * @param int $qualityOfService
     * @param bool $retain
     * @param int|null $messageId
     * @param bool $isDuplicate
     * @author LZH
     * @since 2022/04/11
     */
    protected function publishMessage(
        string $topic,
        string $message,
        int $qualityOfService,
        bool $retain,
        int $messageId = null,
        bool $isDuplicate = false
    ) : void
    {
        $this->logger->debug('Publishing a message on topic [{topic}]: {message}', [
            'topic' => $topic,
            'message' => $message,
            'qos' => $qualityOfService,
            'retain' => $retain,
            'messageId' => $messageId,
            'isDuplicate' => $isDuplicate,
        ]);

        // 运行发布消息事件处理器
        $this->runPublishEventHandlers($topic, $message, $messageId, $qualityOfService, $retain);

        if ($isDuplicate) {
            $duplicateTag = 1;
        } else {
            $duplicateTag = 0;
        }

        if ($retain) {
            $retainTag = 1;
        } else {
            $retainTag = 0;
        }

        try {
            $this->client->publish($topic, $message, $qualityOfService, $duplicateTag, $retainTag);
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
     * 连接服务器
     *
     * @param bool $clean
     * @param array $will
     * @return array|bool|void
     * @author LZH
     * @since 2022/04/11
     */
    public function connect(bool $clean = true, array $will = [])
    {
        // 初始化客户端
        if (empty($this->client)) {
            $this->client = new CommonClient($this->getBrokerHost(), $this->getBrokerPort(), $this);
        }

        try {
            return $this->client->connect($clean, $will); // Types::CONNACK 这里会返回连接确认包
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
        $this->ensureConnected();

        $result = false;
        try {
            $result = $this->client->close(); // 这里不会返回 Types::DISCONNECT 包，而是swoole客户端关闭连接返回bool值
        } catch (\Throwable $exception) {
            $this->logger->alert(
                sprintf('Closing failed on Broker "%s"', $this->client->getHost()),
                ['exception' => $exception]
            );
        } finally {
            if (!$result) {
                $this->logger->alert(
                    sprintf('Closing failed on Broker "%s"', $this->client->getHost()),
                    ['result' => false]
                );
            }
        }
    }

    public function __destruct()
    {
        if ($this->isConnected()) {
            $this->disconnect();
        }

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
                // 服务端发布的消息比订阅的消息质量低，在这种情况下我们需要记录。
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

        // 业务消息的异常转换
        $message = json_decode($message, true); // 对消息体进行json解码

        print_r('---------打印响应消息------------' . PHP_EOL);
        print_r($message);

        // 请求返回错误码，返回1表示设备重启；2表示升级开始，1表示升级成功
        $responseObj = null;
        if (isset($message['ret']) && $message['ret'] != 0 && $message['ret'] != 1 && $message['ret'] != 2) {
            throw $this->errorCodeConvertToException($message);
        } else {
            $responseObj = $this->returnResponse($message['Action'], $message); // 初始化响应对象
        }

        print_r('----------打印响应对象------------' . PHP_EOL);
        print_r($responseObj);

        $subscribers = $this->repository->getSubscriptionsMatchingTopic($topic);

        $this->logger->debug('Delivering message received on topic [{topic}] with QoS [{qos}] from the broker to [{subscribers}] subscribers.', [
            'topic' => $topic,
            'message' => $responseObj,
            'qos' => $qualityOfServiceLevel,
            'subscribers' => count($subscribers),
        ]);

        foreach ($subscribers as $subscriber) {
            if ($subscriber->getCallback() === null) {
                continue;
            }

            try {
                call_user_func($subscriber->getCallback(), $topic, $responseObj, $retained);
            } catch (\Throwable $e) {
                $this->logger->error('Subscriber callback threw exception for published message on topic [{topic}].', [
                    'topic' => $topic,
                    'message' => $responseObj,
                    'exception' => $e,
                ]);
            }
        }

        $this->runMessageReceivedEventHandlers($topic, $responseObj, $qualityOfServiceLevel, $retained);
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

    /**
     * 重新发布待处理消息，即没有确认的消息
     *
     * @throws \Exception
     * @author LZH
     * @since 2022/04/11
     */
    protected function resendPendingMessages(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $dateTime = (new \DateTime())->sub(new \DateInterval('PT' . $this->getResendTimeout() . 'S'));
        $messages = $this->repository->getPendingOutgoingMessagesLastSentBefore($dateTime);

        // 对于超过重发时间的待处理消息进行处理
        foreach ($messages as $pendingMessage) {
            if ($pendingMessage instanceof PublishedMessage) { // 对于待确认的发布消息，如果指定的时间没有确认，则重新发送
                $this->logger->debug('Re-publishing pending message to the broker.', [
                    'messageId' => $pendingMessage->getMessageId(),
                ]);

                $this->publishMessage(
                    $pendingMessage->getTopicName(),
                    $pendingMessage->getMessage(),
                    $pendingMessage->getQualityOfServiceLevel(),
                    $pendingMessage->wantsToBeRetained(),
                    $pendingMessage->getMessageId(),
                    true
                );

            } elseif ($pendingMessage instanceof SubscribeRequest) { // 对于订阅请求，如果没有确认，则重发
                $this->logger->debug('Re-sending pending subscribe request to the broker.', [
                    'messageId' => $pendingMessage->getMessageId(),
                ]);

                // 订阅消息
                $data = $this->buildSubscribeMessage($pendingMessage->getMessageId(), $pendingMessage->getSubscriptions(), [], true);
                $this->client->send($data, false);
            } elseif ($pendingMessage instanceof UnsubscribeRequest) { // 对于取消订阅请求，如果没有确认，则重发
                $this->logger->debug('Re-sending pending unsubscribe request to the broker.', [
                    'messageId' => $pendingMessage->getMessageId(),
                ]);

                $data = $this->buildUnsubscribeMessage($pendingMessage->getMessageId(), $pendingMessage->getTopicFilters(), true);
                $this->client->send($data, false);
            } else {
                throw new InvalidMessageException('Unexpected message type encountered while resending pending messages.');
            }

            $pendingMessage->setLastSentAt(new \DateTime());
            $pendingMessage->incrementSendingAttempts();
        }
    }


    /**
     * 确保客户端连接到中间件
     * @throws ClientNotConnectedToBrokerException
     * @author LZH
     * @since 2022/04/11
     */
    protected function ensureConnected(): void
    {
        if (!$this->isConnected()) {
            throw new ClientNotConnectedToBrokerException(
                'The client is not connected to a broker. The requested operation is impossible at this point.'
            );
        }
    }

    /**
     * 构建订阅消息
     * @param int $messageId
     * @param array $subscriptions
     * @param $properties
     * @param bool $isDuplicate
     * @return array
     * @author LZH
     * @since 2022/04/11
     */
    private function buildSubscribeMessage(int $messageId, array $subscriptions, $properties = [], bool $isDuplicate = false)
    {
        $topics = [];
        foreach ($subscriptions as $subscription) {
            $topics[$subscription->getTopicFilter()] = $subscription->getQualityOfServiceLevel();
        }

        return [
            'type' => Types::SUBSCRIBE,
            'message_id' => $messageId,
            'properties' => $properties,
            'topics' => $topics,
        ];
    }

    /**
     * 构建取消订阅消息
     * @param int $messageId
     * @param array $topics
     * @param bool $isDuplicate
     * @return array
     * @author LZH
     * @since 2022/04/11
     */
    public function buildUnsubscribeMessage(int $messageId, array $topics, $properties = [], bool $isDuplicate = false)
    {

        return [
            'type' => Types::UNSUBSCRIBE,
            'message_id' => $messageId,
            'properties' => $properties,
            'topics' => $topics,
        ];

    }

    /**
     * 判断所有的队列是否为空
     * @return bool
     * @author LZH
     * @since 2022/04/11
     */
    protected function allQueuesAreEmpty(): bool
    {
        return $this->repository->countPendingOutgoingMessages() === 0 &&
            $this->repository->countPendingIncomingMessages() === 0;
    }

    /**
     * 生成响应对象
     * @param $action
     * @param $response
     * @return mixed
     * @throws ReflectionException
     * @since 2022/04/24
     * @author LZH
     */
    private function returnResponse($action, $response)
    {

        // 反射对应的类
        // 获取到对应的控制器
        $reflectionClassObj =  null;
        foreach (['FaceManage', 'ParamSetting', 'DataStream'] as $service) {
            try {
                $respClass = "JuLongDeviceMqtt"."\\".ucfirst($service)."\\"."Models"."\\".ucfirst($action)."Response";
                $reflectionClassObj = new ReflectionClass($respClass); // 第一个参数对象
                break;
            } catch (ReflectionException $e) {
                // 路径错误
            }
        }

        if (!$reflectionClassObj) {
            throw new ReflectionException('找不到该类');
        }

        /**
         * @var AbstractResponse $responseObj
         */
        $responseObj = $reflectionClassObj->newInstance();
        $responseObj->deserialize($response);

        return $responseObj;

    }


}