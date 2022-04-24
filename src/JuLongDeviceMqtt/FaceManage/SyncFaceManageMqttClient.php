<?php
/**
 * 文件描述
 * Created on 2022/1/20 15:59
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage;

use JuLongDeviceMqtt\Common\SyncMqttClient;
use JuLongDeviceMqtt\Common\SyncUserMqttClient;

/**
 * 人脸管理同步客户端
 * Created on 2022/1/20 16:06
 * Create by LZH
 *
 *
 */
class SyncFaceManageMqttClient extends SyncUserMqttClient
{

    /**
     * @param SyncMqttClient $mqttClient
     * @param string $service
     */
    public function __construct(SyncMqttClient $mqttClient, string $service = "faceManage")
    {
        $this->syncMqttClient = $mqttClient;
        $this->service = $service;
    }

}