<?php
/**
 * 文件描述
 * Created on 2022/2/15 9:54
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 音频参数获取
 * Created on 2022/2/15 9:55
 * Create by LZH
 */
class GetAudioCfgRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_AUDIO_CFG; // 初始化动作名称
    }
}