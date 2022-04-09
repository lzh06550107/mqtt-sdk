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

/**
 * 人脸管理客户端
 * Created on 2022/1/20 16:06
 * Create by LZH
 */
class FaceManageMqttClient extends AbstractMqttClient
{

    /**
     * @var string
     */
    protected $service = "faceManage";

    /**
     * 向指定的主题发布消息
     * @param string $uuidOrTopic uuid或topic
     * @param AbstractRequest $message 消息内容
     * @param int $qos
     * @param int $dup
     * @param int $retain
     * @param array $properties
     * @return array|bool|void
     * @author LZH
     * @since 2022/01/21
     */
    public function publish(string $uuidOrTopic, AbstractRequest $message , $qos = 0, $dup = 0, $retain = 0, $properties = [])
    {
        $this->connect();
        $topic = new SmartFaceTopic($uuidOrTopic);
        $result = parent::_publish($topic, $message, $qos = 0, $dup = 0, $retain = 0, $properties = []);
        $this->disconnect();
        return $result;
    }

    /**
     * 订阅指定的主题
     *      指定设备：mqtt/Ack/设备UUID
     *      批量设备：mqtt/Ack/topic
     * @param string $uuidOrTopic uuid或topic
     * @param callable $callback 处理接收到的消息
     * @throws \Throwable
     * @author LZH
     * @since 2022/01/21
     */
    public function subscribe(string $uuidOrTopic, callable $callback)
    {
        $this->connect();
        $topic = new AckTopic($uuidOrTopic);
        $result = parent::_subscribe([$topic], $callback);
        $this->disconnect();
        return $result;
    }


}