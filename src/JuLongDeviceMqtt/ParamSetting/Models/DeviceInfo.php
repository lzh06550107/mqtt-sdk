<?php
/**
 * 文件描述
 * Created on 2022/2/15 10:29
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

/**
 * 设备信息，用来接收查询信息
 * Created on 2022/2/15 10:30
 * Create by LZH
 */
class DeviceInfo extends DeviceCfg
{
    /**
     * @var string 设备ID(出厂自带)
     */
    public $DeviceId;

    /**
     * @var string 设备mac地址
     */
    public $DeviceMac;

    /**
     * @var string 设备IP地址
     */
    public $DeviceIp;

    /**
     * @var string 设备内核版本
     */
    public $CoreVersion;

    /**
     * @var string 版本日期 格式：Aug 09 2020 18:12:01
     */
    public $VersionDate;

    /**
     * @var string 设备页面版本
     */
    public $WebVersion;

    /**
     * @var string 设备HTTP版本
     */
    public $HttpVersion;

    /**
     * @var string MQTT版本
     */
    public $MQTTVersion;

    public function deserialize($param)
    {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["DeviceId"])) {
            $this->DeviceId = $param["DeviceId"];
        }

        if (isset($param["DeviceMac"])) {
            $this->DeviceMac = $param["DeviceMac"];
        }

        if (isset($param["DeviceIp"])) {
            $this->DeviceIp = $param["DeviceIp"];
        }

        if (isset($param["CoreVersion"])) {
            $this->CoreVersion = $param["CoreVersion"];
        }

        if (isset($param["VersionDate"])) {
            $this->VersionDate = $param["VersionDate"];
        }

        if (isset($param["WebVersion"])) {
            $this->WebVersion = $param["WebVersion"];
        }

        if (isset($param["HttpVersion"])) {
            $this->HttpVersion = $param["HttpVersion"];
        }

        if (isset($param["MQTTVersion"])) {
            $this->MQTTVersion = $param["MQTTVersion"];
        }
    }
}