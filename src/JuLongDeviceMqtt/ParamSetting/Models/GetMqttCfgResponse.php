<?php
/**
 * 文件描述
 * Created on 2022/2/14 18:28
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetMqttCfgResponse extends AbstractResponse
{
    /**
     * @var MqttCfg $MqttCfg mqtt参数配置类
     */
    private $MqttCfg;

    /**
     * @return MqttCfg
     */
    public function getMqttCfg(): MqttCfg
    {
        return $this->MqttCfg;
    }

    /**
     * @param MqttCfg $MqttCfg
     */
    public function setMqttCfg(MqttCfg $MqttCfg): void
    {
        $this->MqttCfg = $MqttCfg;
    }

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