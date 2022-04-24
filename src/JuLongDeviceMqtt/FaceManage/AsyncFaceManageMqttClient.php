<?php
/**
 * 文件描述
 * Created on 2022/1/20 15:59
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage;

use JuLongDeviceMqtt\AckTopic;
use JuLongDeviceMqtt\Common\AbstractMqttClient;
use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\Common\AbstractResponse;
use JuLongDeviceMqtt\Common\AsyncMqttClient;
use JuLongDeviceMqtt\Contracts\MqttClient;

/**
 * 人脸管理异步客户端
 * Created on 2022/1/20 16:06
 * Create by LZH
 *
 * @method void loop(bool $allowSleep = true, bool $exitWhenQueuesEmpty = false, int $queueWaitLimit = null)
 * @method void interruptedLoop()
 * @method void disconnect()
 * @method MqttClient registerLoopEventHandler(\Closure $callback)
 */
class AsyncFaceManageMqttClient
{

    /**
     * @var AsyncMqttClient mqtt异步客户端操作对象
     */
    private $asyncMqttClient;

    /**
     * @var string
     */
    protected $service;

    /**
     * @param AsyncMqttClient $mqttClient
     * @param string $service
     */
    public function __construct(AsyncMqttClient $mqttClient, string $service = "faceManage")
    {
        $this->asyncMqttClient = $mqttClient;
        $this->service = $service;
    }

    /**
     * 向指定的主题发布消息
     * @param string $uuidOrTopic
     * @param AbstractRequest $message
     * @param int $qos
     * @param bool $dup
     * @param bool $retain
     * @param array $properties
     * @throws \JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException
     * @throws \JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function publish(string $uuidOrTopic, AbstractRequest $message , int $qualityOfService = MQTT_QOS_0, bool $dup = false, bool $retain = false, array $properties = []): void
    {
        if ($this->asyncMqttClient->connect()) {
            $topic = new SmartFaceTopic($uuidOrTopic);
            $this->asyncMqttClient->publish((string)$topic, (string)$message, $qualityOfService, $dup, $retain, $properties);
            $this->asyncMqttClient->disconnect();
        }
    }

    /**
     * 订阅指定的主题
     *      指定设备：mqtt/Ack/设备UUID
     *      批量设备：mqtt/Ack/topic
     * @param string $uuidOrTopic uuid或topic
     * @param callable $callback 处理接收到的消息
     * @param int $qualityOfService
     * @throws \JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException
     * @throws \JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function subscribe(string $uuidOrTopic, callable $callback, int $qualityOfService = MQTT_QOS_0): void
    {
        $this->asyncMqttClient->connect();
        $topic = new AckTopic($uuidOrTopic);
        $this->asyncMqttClient->subscribe((string)$topic, $callback, $qualityOfService);
//        $this->mqttClient->disconnect(); 不能关闭，需要开启循环

    }

    public function __call($name, $arguments) {

        if (method_exists($this->asyncMqttClient, $name)) {
            call_user_func_array([$this->asyncMqttClient, $name],$arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }

}