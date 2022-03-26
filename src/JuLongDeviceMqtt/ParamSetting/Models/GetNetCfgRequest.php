<?php
/**
 * 文件描述
 * Created on 2022/2/14 16:16
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 网络参数获取
 * Created on 2022/2/14 16:17
 * Create by LZH
 */
class GetNetCfgRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_NET_CFG; // 初始化动作名称
    }
}