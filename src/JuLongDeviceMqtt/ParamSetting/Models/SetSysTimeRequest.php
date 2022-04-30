<?php
/**
 * 文件描述
 * Created on 2022/2/14 17:58
 * Create by LZH
 */

declare(strict_types=1);

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
    private $TimeMode;

    /**
     * @var NTPServer $NTPServer
     */
    private $NTPServer;

    /**
     * @var string 本地时间(手动设置模式可用) 格式：yyyy-MM-dd hh:mm:ss，TimeMode为1时有效
     */
    private $LocalTime;

    /**
     * @var int RTC开关，0：关闭；1：开启
     */
    private $RTCEnabled;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::SET_SYS_TIME); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getTimeMode(): int
    {
        return $this->TimeMode;
    }

    /**
     * @param int $TimeMode
     */
    public function setTimeMode(int $TimeMode): void
    {
        $this->TimeMode = $TimeMode;
    }

    /**
     * @return NTPServer
     */
    public function getNTPServer(): NTPServer
    {
        return $this->NTPServer;
    }

    /**
     * @param NTPServer $NTPServer
     */
    public function setNTPServer(NTPServer $NTPServer): void
    {
        $this->NTPServer = $NTPServer;
    }

    /**
     * @return string
     */
    public function getLocalTime(): string
    {
        return $this->LocalTime;
    }

    /**
     * @param string $LocalTime
     */
    public function setLocalTime(string $LocalTime): void
    {
        $this->LocalTime = $LocalTime;
    }

    /**
     * @return int
     */
    public function getRTCEnabled(): int
    {
        return $this->RTCEnabled;
    }

    /**
     * @param int $RTCEnabled
     */
    public function setRTCEnabled(int $RTCEnabled): void
    {
        $this->RTCEnabled = $RTCEnabled;
    }

}