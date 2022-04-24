<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:00
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 设备信息设置
 * Created on 2022/2/15 11:01
 * Create by LZH
 *
 * @property DeviceCfg $DeviceCfg 设备参数配置类
 */
class SetDeviceInfoRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_DEVICE_INFO; // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["DeviceCfg"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}