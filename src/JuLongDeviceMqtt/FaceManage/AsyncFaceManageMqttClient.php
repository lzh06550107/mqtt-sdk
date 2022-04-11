<?php
/**
 * 文件描述
 * Created on 2022/1/20 15:59
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage;

use JuLongDeviceMqtt\AckTopic;
use JuLongDeviceMqtt\Common\AbstractMqttClient;
use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\Common\AbstractResponse;
use JuLongDeviceMqtt\Common\AsyncMqttClient;

/**
 * 人脸管理异步客户端
 * Created on 2022/1/20 16:06
 * Create by LZH
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
     * @param $qos
     * @param $dup
     * @param $retain
     * @param $properties
     * @return array|bool|void
     * @throws \JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException
     * @throws \JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function publish(string $uuidOrTopic, AbstractRequest $message , $qos = 0, $dup = 0, $retain = 0, $properties = [])
    {
        $this->asyncMqttClient->connect();
        $topic = new SmartFaceTopic($uuidOrTopic);
        $result = $this->asyncMqttClient->publish((string)$topic, (string)$message, $qos, $dup, $retain, $properties);
        $this->asyncMqttClient->disconnect();
        return $result;
    }

    /**
     * 订阅指定的主题
     *      指定设备：mqtt/Ack/设备UUID
     *      批量设备：mqtt/Ack/topic
     * @param string $uuidOrTopic uuid或topic
     * @param callable $callback 处理接收到的消息
     * @param int $qualityOfService
     * @return array|bool|void
     * @throws \JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException
     * @throws \JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/04/11
     */
    public function subscribe(string $uuidOrTopic, callable $callback, int $qualityOfService = MQTT_QOS_0)
    {
        $this->asyncMqttClient->connect();
        $topic = new AckTopic($uuidOrTopic);
        $result = $this->asyncMqttClient->subscribe((string)$topic, $callback, $qualityOfService);
//        $this->mqttClient->disconnect(); 不能关闭，需要开启循环
        return $result;
    }

    public function __call($name, $arguments) {

        if (method_exists($this->asyncMqttClient, $name)) {
            call_user_func_array([$this->asyncMqttClient, $name],$arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }

}