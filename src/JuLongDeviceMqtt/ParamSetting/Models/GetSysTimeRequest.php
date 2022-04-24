<?php
/**
 * 文件描述
 * Created on 2022/2/14 17:20
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 系统时间获取
 * Created on 2022/2/14 17:21
 * Create by LZH
 */
class GetSysTimeRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_SYS_TIME; // 初始化动作名称
    }
}