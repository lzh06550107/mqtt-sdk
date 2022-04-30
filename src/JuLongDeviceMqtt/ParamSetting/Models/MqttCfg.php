<?php
/**
 * 文件描述
 * Created on 2022/2/14 18:30
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * mqttCfg配置类
 * Created on 2022/2/14 18:30
 * Create by LZH
 */
class MqttCfg extends AbstractModel
{
    /**
     * @var int Mqtt开关 0：关闭；1：打开
     */
    private $MqttEnabled;

    /**
     * @var string Mqtt服务地址
     */
    private $MqttAddress;

    /**
     * @var int Mqtt服务端口
     */
    private $MqttPort;

    /**
     * @var string Mqtt服务用户名
     */
    private $MqttUsername;

    /**
     * @var string Mqtt服务密码
     */
    private $MqttPassword;

    /**
     * @var int 对应主题mqtt/register 0：不需要发送注册主题，直接发送心跳；1：注册成功之后才发心跳
     */
    private $RegisterEnabled;

    /**
     * @var int 注册间隔时间(秒为单位)
     */
    private $RegisterInterval;

    /**
     * @var string 需要处理相同请求的设备Topic应相同，不同请求Topic不能相同。格式：随机字符0-9大小写a-z
     */
    private $Topic;

    /**
     * @var int 心跳时间间隔(秒为单位)
     */
    private $Interval;

    /**
     * @var int 重传（默认关闭） 0：关闭，只管往平台传比对记录不管有没有应答；1：开启，比对记录上传必须有应答，否则会重传
     */
    private $Retransmission;

    /**
     * @var int 0：无限重传，只要对端没给应答就一直重传；大于0：重传次数
     */
    private $ReSendSum;

    /**
     * @var int 上传人脸图 0：不上传；1：上传
     */
    private $FacePicture;

    /**
     * @var int 上传原图 0：不上传；1：上传
     */
    private $BackgroundPicture;

    /**
     * @var int 上传名单库照片 0：不上传；1：上传
     */
    private $PersonPhoto;

    /**
     * @var int 比对记录重传时间间隔(单位秒)
     */
    private $Resendtime;

    /**
     * @return int
     */
    public function getMqttEnabled(): int
    {
        return $this->MqttEnabled;
    }

    /**
     * @param int $MqttEnabled
     */
    public function setMqttEnabled(int $MqttEnabled): void
    {
        $this->MqttEnabled = $MqttEnabled;
    }

    /**
     * @return string
     */
    public function getMqttAddress(): string
    {
        return $this->MqttAddress;
    }

    /**
     * @param string $MqttAddress
     */
    public function setMqttAddress(string $MqttAddress): void
    {
        $this->MqttAddress = $MqttAddress;
    }

    /**
     * @return int
     */
    public function getMqttPort(): int
    {
        return $this->MqttPort;
    }

    /**
     * @param int $MqttPort
     */
    public function setMqttPort(int $MqttPort): void
    {
        $this->MqttPort = $MqttPort;
    }

    /**
     * @return string
     */
    public function getMqttUsername(): string
    {
        return $this->MqttUsername;
    }

    /**
     * @param string $MqttUsername
     */
    public function setMqttUsername(string $MqttUsername): void
    {
        $this->MqttUsername = $MqttUsername;
    }

    /**
     * @return string
     */
    public function getMqttPassword(): string
    {
        return $this->MqttPassword;
    }

    /**
     * @param string $MqttPassword
     */
    public function setMqttPassword(string $MqttPassword): void
    {
        $this->MqttPassword = $MqttPassword;
    }

    /**
     * @return int
     */
    public function getRegisterEnabled(): int
    {
        return $this->RegisterEnabled;
    }

    /**
     * @param int $RegisterEnabled
     */
    public function setRegisterEnabled(int $RegisterEnabled): void
    {
        $this->RegisterEnabled = $RegisterEnabled;
    }

    /**
     * @return int
     */
    public function getRegisterInterval(): int
    {
        return $this->RegisterInterval;
    }

    /**
     * @param int $RegisterInterval
     */
    public function setRegisterInterval(int $RegisterInterval): void
    {
        $this->RegisterInterval = $RegisterInterval;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->Topic;
    }

    /**
     * @param string $Topic
     */
    public function setTopic(string $Topic): void
    {
        $this->Topic = $Topic;
    }

    /**
     * @return int
     */
    public function getInterval(): int
    {
        return $this->Interval;
    }

    /**
     * @param int $Interval
     */
    public function setInterval(int $Interval): void
    {
        $this->Interval = $Interval;
    }

    /**
     * @return int
     */
    public function getRetransmission(): int
    {
        return $this->Retransmission;
    }

    /**
     * @param int $Retransmission
     */
    public function setRetransmission(int $Retransmission): void
    {
        $this->Retransmission = $Retransmission;
    }

    /**
     * @return int
     */
    public function getReSendSum(): int
    {
        return $this->ReSendSum;
    }

    /**
     * @param int $ReSendSum
     */
    public function setReSendSum(int $ReSendSum): void
    {
        $this->ReSendSum = $ReSendSum;
    }

    /**
     * @return int
     */
    public function getFacePicture(): int
    {
        return $this->FacePicture;
    }

    /**
     * @param int $FacePicture
     */
    public function setFacePicture(int $FacePicture): void
    {
        $this->FacePicture = $FacePicture;
    }

    /**
     * @return int
     */
    public function getBackgroundPicture(): int
    {
        return $this->BackgroundPicture;
    }

    /**
     * @param int $BackgroundPicture
     */
    public function setBackgroundPicture(int $BackgroundPicture): void
    {
        $this->BackgroundPicture = $BackgroundPicture;
    }

    /**
     * @return int
     */
    public function getPersonPhoto(): int
    {
        return $this->PersonPhoto;
    }

    /**
     * @param int $PersonPhoto
     */
    public function setPersonPhoto(int $PersonPhoto): void
    {
        $this->PersonPhoto = $PersonPhoto;
    }

    /**
     * @return int
     */
    public function getResendtime(): int
    {
        return $this->Resendtime;
    }

    /**
     * @param int $Resendtime
     */
    public function setResendtime(int $Resendtime): void
    {
        $this->Resendtime = $Resendtime;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["MqttEnabled"])) {
            $this->MqttEnabled = $param["MqttEnabled"];
        }

        if (isset($param["MqttAddress"])) {
            $this->MqttAddress = $param["MqttAddress"];
        }

        if (isset($param["MqttPort"])) {
            $this->MqttPort = $param["MqttPort"];
        }

        if (isset($param["MqttUsername"])) {
            $this->MqttUsername = $param["MqttUsername"];
        }

        if (isset($param["MqttPassword"])) {
            $this->MqttPassword = $param["MqttPassword"];
        }

        if (isset($param["RegisterEnabled"])) {
            $this->RegisterEnabled = $param["RegisterEnabled"];
        }

        if (isset($param["RegisterInterval"])) {
            $this->RegisterInterval = $param["RegisterInterval"];
        }

        if (isset($param["Topic"])) {
            $this->Topic = $param["Topic"];
        }

        if (isset($param["Interval"])) {
            $this->Interval = $param["Interval"];
        }

        if (isset($param["Retransmission"])) {
            $this->Retransmission = $param["Retransmission"];
        }

        if (isset($param["ReSendSum"])) {
            $this->ReSendSum = $param["ReSendSum"];
        }

        if (isset($param["FacePicture"])) {
            $this->FacePicture = $param["FacePicture"];
        }

        if (isset($param["BackgroundPicture"])) {
            $this->BackgroundPicture = $param["BackgroundPicture"];
        }

        if (isset($param["PersonPhoto"])) {
            $this->PersonPhoto = $param["PersonPhoto"];
        }

        if (isset($param["Resendtime"])) {
            $this->Resendtime = $param["Resendtime"];
        }

    }

}