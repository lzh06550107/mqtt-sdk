<?php
/**
 * 文件描述
 * Created on 2022/2/15 10:29
 * Create by LZH
 */

declare(strict_types=1);

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
    private $DeviceId;

    /**
     * @var string 设备mac地址
     */
    private $DeviceMac;

    /**
     * @var string 设备IP地址
     */
    private $DeviceIp;

    /**
     * @var string 设备内核版本
     */
    private $CoreVersion;

    /**
     * @var string 版本日期 格式：Aug 09 2020 18:12:01
     */
    private $VersionDate;

    /**
     * @var string 设备页面版本
     */
    private $WebVersion;

    /**
     * @var string 设备HTTP版本
     */
    private $HttpVersion;

    /**
     * @var string MQTT版本
     */
    private $MQTTVersion;

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->DeviceId;
    }

    /**
     * @param string $DeviceId
     */
    public function setDeviceId(string $DeviceId): void
    {
        $this->DeviceId = $DeviceId;
    }

    /**
     * @return string
     */
    public function getDeviceMac(): string
    {
        return $this->DeviceMac;
    }

    /**
     * @param string $DeviceMac
     */
    public function setDeviceMac(string $DeviceMac): void
    {
        $this->DeviceMac = $DeviceMac;
    }

    /**
     * @return string
     */
    public function getDeviceIp(): string
    {
        return $this->DeviceIp;
    }

    /**
     * @param string $DeviceIp
     */
    public function setDeviceIp(string $DeviceIp): void
    {
        $this->DeviceIp = $DeviceIp;
    }

    /**
     * @return string
     */
    public function getCoreVersion(): string
    {
        return $this->CoreVersion;
    }

    /**
     * @param string $CoreVersion
     */
    public function setCoreVersion(string $CoreVersion): void
    {
        $this->CoreVersion = $CoreVersion;
    }

    /**
     * @return string
     */
    public function getVersionDate(): string
    {
        return $this->VersionDate;
    }

    /**
     * @param string $VersionDate
     */
    public function setVersionDate(string $VersionDate): void
    {
        $this->VersionDate = $VersionDate;
    }

    /**
     * @return string
     */
    public function getWebVersion(): string
    {
        return $this->WebVersion;
    }

    /**
     * @param string $WebVersion
     */
    public function setWebVersion(string $WebVersion): void
    {
        $this->WebVersion = $WebVersion;
    }

    /**
     * @return string
     */
    public function getHttpVersion(): string
    {
        return $this->HttpVersion;
    }

    /**
     * @param string $HttpVersion
     */
    public function setHttpVersion(string $HttpVersion): void
    {
        $this->HttpVersion = $HttpVersion;
    }

    /**
     * @return string
     */
    public function getMQTTVersion(): string
    {
        return $this->MQTTVersion;
    }

    /**
     * @param string $MQTTVersion
     */
    public function setMQTTVersion(string $MQTTVersion): void
    {
        $this->MQTTVersion = $MQTTVersion;
    }

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