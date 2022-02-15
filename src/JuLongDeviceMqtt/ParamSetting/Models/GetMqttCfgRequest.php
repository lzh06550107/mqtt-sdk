<?php
/**
 * 文件描述
 * Created on 2022/2/14 18:26
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * MQTT参数获取
 * Created on 2022/2/14 18:27
 * Create by LZH
 */
class GetMqttCfgRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_MQTT_CFG; // 初始化动作名称
    }
}