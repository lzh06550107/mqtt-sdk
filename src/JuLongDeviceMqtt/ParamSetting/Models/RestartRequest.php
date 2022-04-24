<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:12
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 重启设备
 * Created on 2022/2/15 11:12
 * Create by LZH
 */
class RestartRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::RESTART; // 初始化动作名称
    }
}