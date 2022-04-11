<?php
/**
 * 文件描述
 * Created on 2022/2/11 18:17
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting;

use JuLongDeviceMqtt\Common\SyncMqttClient;
use JuLongDeviceMqtt\Common\SyncUserMqttClient;

/**
 * 设备配置同步客户端
 * Created on 2022/2/11 18:18
 * Create by LZH
 */
class SyncParamSettingMqttClient extends SyncUserMqttClient
{

    /**
     * @param SyncMqttClient $asyncMqttClient
     * @param string $service
     */
    public function __construct(SyncMqttClient $asyncMqttClient, string $service = "ParamSetting")
    {
        $this->syncMqttClient = $asyncMqttClient;
        $this->service = $service;
    }

}