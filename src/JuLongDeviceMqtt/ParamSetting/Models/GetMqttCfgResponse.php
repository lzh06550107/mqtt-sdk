<?php
/**
 * 文件描述
 * Created on 2022/2/14 18:28
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetMqttCfgResponse extends AbstractResponse
{
    /**
     * @var MqttCfg $MqttCfg mqtt参数配置类
     */
    public $MqttCfg;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $mqttCfg = new MqttCfg();
        $mqttCfg->deserialize($param);
        $this->MqttCfg = $mqttCfg;

    }
}