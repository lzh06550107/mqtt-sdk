<?php
/**
 * 文件描述
 * Created on 2022/2/15 9:56
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * 音频参数获取
 * Created on 2022/2/15 9:56
 * Create by LZH
 */
class GetAudioCfgResponse extends AbstractResponse
{
    /**
     * @var AudioCfg 音频参数配置类
     */
    public $AudioCfg;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $audioCfg = new AudioCfg();
        $audioCfg->deserialize($param);
        $this->AudioCfg = $audioCfg;

    }
}