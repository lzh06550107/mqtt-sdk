<?php
/**
 * 文件描述
 * Created on 2022/2/15 9:56
 * Create by LZH
 */

declare(strict_types=1);

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
    private $AudioCfg;

    /**
     * @return AudioCfg
     */
    public function getAudioCfg(): AudioCfg
    {
        return $this->AudioCfg;
    }

    /**
     * @param AudioCfg $AudioCfg
     */
    public function setAudioCfg(AudioCfg $AudioCfg): void
    {
        $this->AudioCfg = $AudioCfg;
    }

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