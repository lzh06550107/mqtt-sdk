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
    public $MqttEnabled;

    /**
     * @var string Mqtt服务地址
     */
    public $MqttAddress;

    /**
     * @var int Mqtt服务端口
     */
    public $MqttPort;

    /**
     * @var string Mqtt服务用户名
     */
    public $MqttUsername;

    /**
     * @var string Mqtt服务密码
     */
    public $MqttPassword;

    /**
     * @var int 对应主题mqtt/register 0：不需要发送注册主题，直接发送心跳；1：注册成功之后才发心跳
     */
    public $RegisterEnabled;

    /**
     * @var int 注册间隔时间(秒为单位)
     */
    public $RegisterInterval;

    /**
     * @var string 需要处理相同请求的设备Topic应相同，不同请求Topic不能相同。格式：随机字符0-9大小写a-z
     */
    public $Topic;

    /**
     * @var int 心跳时间间隔(秒为单位)
     */
    public $Interval;

    /**
     * @var int 重传（默认关闭） 0：关闭，只管往平台传比对记录不管有没有应答；1：开启，比对记录上传必须有应答，否则会重传
     */
    public $Retransmission;

    /**
     * @var int 0：无限重传，只要对端没给应答就一直重传；大于0：重传次数
     */
    public $ReSendSum;

    /**
     * @var int 上传人脸图 0：不上传；1：上传
     */
    public $FacePicture;

    /**
     * @var int 上传原图 0：不上传；1：上传
     */
    public $BackgroundPicture;

    /**
     * @var int 上传名单库照片 0：不上传；1：上传
     */
    public $PersonPhoto;

    /**
     * @var int 比对记录重传时间间隔(单位秒)
     */
    public $Resendtime;

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