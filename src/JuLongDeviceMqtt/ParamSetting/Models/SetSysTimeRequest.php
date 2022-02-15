<?php
/**
 * 文件描述
 * Created on 2022/2/14 17:58
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 系统时间设置
 * Created on 2022/2/14 17:59
 * Create by LZH
 */
class SetSysTimeRequest extends AbstractRequest
{
    /**
     * @var int 时间同步模式 0：NTP校时；1：手动设置
     */
    public $TimeMode;

    /**
     * @var NTPServer $NTPServer
     */
    public $NTPServer;

    /**
     * @var string 本地时间(手动设置模式可用) 格式：yyyy-MM-dd hh:mm:ss，TimeMode为1时有效
     */
    public $LocalTime;

    /**
     * @var int RTC开关，0：关闭；1：开启
     */
    public $RTCEnabled;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_SYS_TIME; // 初始化动作名称
    }
}