<?php
/**
 * 文件描述
 * Created on 2022/2/15 10:19
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 设备信息获取
 * Created on 2022/2/15 10:19
 * Create by LZH
 */
class DeviceInfoRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::GET_DEVICE_INFO); // 初始化动作名称
    }
}