<?php
/**
 * 文件描述
 * Created on 2022/4/11 17:14
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

use JuLongDeviceMqtt\AckTopic;
use JuLongDeviceMqtt\FaceManage\SmartFaceTopic;

/**
 * 用户使用的同步客户端基类
 * Created on 2022/4/11 17:14
 * Create by LZH
 */
class SyncUserMqttClient
{
    /**
     * @var SyncMqttClient mqtt不同客户端操作对象
     */
    protected $syncMqttClient;

    /**
     * @var string
     */
    protected $service;

    /**
     * 同步请求
     * @param $uuidOrTopic
     * @param AbstractRequest $request
     * @return string
     * @throws \Throwable
     * @author LZH
     * @since 2022/04/11
     */
    public function request($uuidOrTopic, AbstractRequest $request): string
    {
        $publishTopicInfo['topic'] = (string)new SmartFaceTopic($uuidOrTopic);
        $publishTopicInfo['message'] = (string)$request;

        if (!isset($publishTopicInfo['qos'])) {
            $publishTopicInfo['qos'] = MQTT_QOS_0;
        }

        if (!isset($publishTopicInfo['dup'])) {
            $publishTopicInfo['dup'] = 0;
        }

        if (!isset($publishTopicInfo['retain'])) {
            $publishTopicInfo['retain'] = 0;
        }

        if (!isset($publishTopicInfo['properties'])) {
            $publishTopicInfo['properties'] = [];
        }

        $subscribeTopicInfo['topic'] = (string)new AckTopic($uuidOrTopic);

        if (!isset($subscribeTopicInfo['qos'])) {
            $subscribeTopicInfo['qos'] = 0;
        }

        return $this->syncMqttClient->request($publishTopicInfo, $subscribeTopicInfo);
    }
}