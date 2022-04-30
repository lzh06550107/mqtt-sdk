<?php
/**
 * 文件描述
 * Created on 2022/2/14 17:21
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetSysTimeResponse extends AbstractResponse
{
    /**
     * @var NTPServer 通过时间服务器更新
     */
    private $NTPServer;

    /**
     * @var string 本地时间(手动设置模式可用) 格式：yyyy-MM-dd hh:mm:ss
     */
    private $LocalTime;

    /**
     * @var int RTC开关 0:关闭；1:开启
     */
    private $RTCEnabled;

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

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param['NTPServer'])) {
            $ntpServer = new NTPServer();
            $ntpServer->deserialize($param['NTPServer']);
            $this->NTPServer = $ntpServer;
        }

        if (isset($param['LocalTime'])) {
            $this->LocalTime = $param['LocalTime'];
        }

        if (isset($param['RTCEnabled'])) {
            $this->RTCEnabled = $param['RTCEnabled'];
        }

    }
}