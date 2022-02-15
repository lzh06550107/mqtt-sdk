<?php
/**
 * 文件描述
 * Created on 2022/2/14 9:51
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * HTTP上传参数获取
 * Created on 2022/2/14 9:51
 * Create by LZH
 */
class GetHttpCfgRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_HTTP_CFG; // 初始化动作名称
    }
}