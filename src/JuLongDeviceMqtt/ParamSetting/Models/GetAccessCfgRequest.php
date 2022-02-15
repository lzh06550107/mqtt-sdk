<?php
/**
 * 文件描述
 * Created on 2022/2/12 15:29
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 测温机门禁控制参数获取(门禁机支持)
 * Created on 2022/2/12 15:29
 * Create by LZH
 */
class GetAccessCfgRequest extends AbstractRequest
{

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_ACCESS_CFG; // 初始化动作名称
    }
}