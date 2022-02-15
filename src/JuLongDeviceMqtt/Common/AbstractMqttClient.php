<?php
/**
 * 文件描述
 * Created on 2022/1/20 15:59
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

use Closure;
use Psr\Log\LoggerInterface;
use Simps\MQTT\Client;
use Simps\MQTT\Config\ClientConfig;
use Simps\MQTT\Exception\ProtocolException;
use Simps\MQTT\Protocol\Types;

/**
 * mqtt客户端抽象类
 * Created on 2022/1/20 16:04
 * Create by LZH
 */
abstract class AbstractMqttClient extends ClientConfig
{
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


    public function __construct(
        Client $client = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct();
        $this->client = $client;
        $this->logger = $logger ?: new Logger();
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
     * @author LZH
     * @since 2022/01/20
     */
    protected function _subscribe(array $topics, Closure $callback): void
    {
        // 初始化客户端，必须在协程中初始化
        if (empty($this->client)) {
            $this->client = new Client($this->getBrokerHost(), $this->getBrokerPort(), $this);
        }

        // 主题对象数组转换为配置
        $config = $this->convertTopicToConfig($topics);

        // 如果是订阅的话，需要启动一个进程或者协程来循环接收消息
        \Swoole\Coroutine\go(function () use ($config, $callback){

            $this->client->connect(true); // TODO 需要传入遗嘱消息
            try {
                $this->client->subscribe($config); // 发出订阅消息
            } catch (\Throwable $exception) {
                $this->logger->alert(
                    sprintf('Subscribe failed on Broker "%s"', $this->client->getHost()),
                    ['exception' => $exception]
                );
            }

            $timeSincePing = time();

            while (true) {
                try {

                    $resp = $this->client->recv();

                    if ($resp && $resp !== true) { // 只有接收到有效数据才进入该流程
                        var_dump($resp);

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

                        call_user_func($callback, $this->client, $this->parseResponse($message)); // 传入接收的数据

                    }

                    // mqtt协议层的心跳
                    if ($timeSincePing <= (time() - $this->client->getConfig()->getKeepAlive())) {
                        $buffer = $this->client->ping();
                        if ($buffer) {
                            echo 'send ping success' . PHP_EOL;
                            $timeSincePing = time();
                        }
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
     * 发布
     * @param Topic $topic 发布主题实例对象
     * @param AbstractRequest $request 发布到主题的请求对象，即消息
     * @param int $qos 发布质量
     * @param int $dup 是否重复发送
     * @param int $retain 消息是否持久保存并发送
     * @param array $properties 额外消息属性
     * @return array|bool|void
     * @author LZH
     * @since 2022/01/20
     */
    protected function _publish(Topic $topic, AbstractRequest $request, $qos = 0, $dup = 0, $retain = 0, $properties = [])
    {
        $responseData = null;

        $this->connect();

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

    private function connect(): void
    {
        // 初始化客户端
        if (empty($this->client)) {
            $this->client = new Client($this->getBrokerHost(), $this->getBrokerPort(), $this);
        }

        try {
            $this->client->connect(true); // TODO 需要填写 will 遗嘱配置
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

    private function close(): void
    {
        if (empty($this->client)) {
            return; // 客户端没有初始化，则立即返回
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
        $this->close();
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

}