<?php
/**
 * 文件描述
 * Created on 2022/2/14 17:21
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetSysTimeResponse extends AbstractResponse
{
    /**
     * @var NTPServer 通过时间服务器更新
     */
    public $NTPServer;

    /**
     * @var string 本地时间(手动设置模式可用) 格式：yyyy-MM-dd hh:mm:ss
     */
    public $LocalTime;

    /**
     * @var int RTC开关 0:关闭；1:开启
     */
    public $RTCEnabled;

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