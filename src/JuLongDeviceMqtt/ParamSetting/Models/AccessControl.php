<?php
/**
 * 文件描述
 * Created on 2022/2/12 16:14
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 门禁控制配置类
 * Created on 2022/2/12 16:15
 * Create by LZH
 */
class AccessControl extends AbstractModel
{
    /**
     * @var int 白光灯控制 0：白光灯常亮；1：白光灯时间控制；2：白光灯长灭；3：无人后关闭
     */
    public $LightControl;

    /**
     * @var string 转白天 格式：hh:mm:ss，LightControl为1时有效
     */
    public $DaytimeStart;

    /**
     * @var string 转夜晚 格式：hh:mm:ss，LightControl为1时有效
     */
    public $NightStart;

    /**
     * @var int 屏幕显示模式 0：一直显示；1：无人后关闭
     */
    public $ScreenDisplayMode;

    /**
     * @var int 人脸检测分辨率 0:1080*1920；1:720*1280；2:540*960；3:432*768；4:360*640，切换分辨率设备将重启
     */
    public $FaceDetecRatio;

    /**
     * @var int 名单相似度
     */
    public $ListSimilarity;

    /**
     * @var int 身份证相似度
     */
    public $IDCardSimilarity;

    /**
     * @var int 同人过滤(单位秒)
     */
    public $SameFilter;

    /**
     * @var int 时间显示 0：不显示 1：显示
     */
    public $TimeDisplay;

    /**
     * @var int IP显示 0：不显示；1：显示
     */
    public $IPDisplay;

    /**
     * @var int UUID显示 0：不显示；1：显示
     */
    public $UUIDDisplay;

    /**
     * @var int 日期格式 0：YYYY-MM-DD；1：MM-DD-YYYY；2：DD-MM-YYYY
     */
    public $DateFormat;

    /**
     * @var int 脱敏显示 0：关；1：开
     */
    public $LeakDisplay;

    /**
     * @var int 比对记录存储 0：全部记录；1：高温异常记录；2：关闭
     */
    public $ComparisonRecord;

    /**
     * @var int 未戴口罩 0：不开门；1：开门，CheckMode为2、3时有效
     */
    public $NoMaskIO;

    /**
     * @var int 比对模式（开门条件） 0：无；1：白名单+人脸验证开门；2：身份证+人脸验证开门；3：白名单+身份证+人脸验证开门；4：白名单或身份证+人脸验证开门；5：IC卡识别；6：IC卡或人脸识别；7：IC卡+人脸识别；8：二维码识别；9：二维码或人脸识别或身份证；10：二维码+人脸+身份证；11：访客模式；13：健康码或身份证
     */
    public $CompareMode;

    /**
     * @var int 健康码类型 0：国康码；1：粤康码；2：湖南码，健康码设备专有
     */
    public $HealthCodeType;

    /**
     * @var int 在线 0：关闭；1：开启
     */
    public $HealthCodeOnlineEnabled;

    /**
     * @var int 认证对比 0：关闭；1：开启
     */
    public $FaceWitnessCompare;

    /**
     * @var int 优先测温 0：关闭；1：开启
     */
    public $PriorityTemperature;

    /**
     * @var int 人脸识别开关 0：关闭；1：开启
     */
    public $FaceDetectEnabled;

    /**
     * @var int 语音播报开关 0：关闭；1：开启
     */
    public $VoiceEnabled;

    /**
     * @var int 温度异常设置 0：关闭；1：温度异常开门；2：温度异常报警
     */
    public $TempAbnormal;

    /**
     * @var int IC刷卡模块 0：USB接入；1：WG接入；2：串口接入
     */
    public $RFIDModule;

    /**
     * @var int 报警声音开关 0：关；1：开
     */
    public $AlarmSoundEnabled;

    /**
     * @var int 开机logo 0：关；1：开
     */
    public $StartUpLogo;

    /**
     * @var int 对次比对
     */
    public $MultipleCompare;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["LightControl"])) {
            $this->LightControl = $param["LightControl"];
        }

        if (isset($param["DaytimeStart"])) {
            $this->DaytimeStart = $param["DaytimeStart"];
        }

        if (isset($param["NightStart"])) {
            $this->NightStart = $param["NightStart"];
        }

        if (isset($param["ScreenDisplayMode"])) {
            $this->ScreenDisplayMode = $param["ScreenDisplayMode"];
        }

        if (isset($param["FaceDetecRatio"])) {
            $this->FaceDetecRatio = $param["FaceDetecRatio"];
        }

        if (isset($param["ListSimilarity"])) {
            $this->ListSimilarity = $param["ListSimilarity"];
        }

        if (isset($param["IDCardSimilarity"])) {
            $this->IDCardSimilarity = $param["IDCardSimilarity"];
        }

        if (isset($param["SameFilter"])) {
            $this->SameFilter = $param["SameFilter"];
        }

        if (isset($param["TimeDisplay"])) {
            $this->TimeDisplay = $param["TimeDisplay"];
        }

        if (isset($param["IPDisplay"])) {
            $this->IPDisplay = $param["IPDisplay"];
        }

        if (isset($param["UUIDDisplay"])) {
            $this->UUIDDisplay = $param["UUIDDisplay"];
        }

        if (isset($param["DateFormat"])) {
            $this->DateFormat = $param["DateFormat"];
        }

        if (isset($param["LeakDisplay"])) {
            $this->LeakDisplay = $param["LeakDisplay"];
        }

        if (isset($param["ComparisonRecord"])) {
            $this->ComparisonRecord = $param["ComparisonRecord"];
        }

        if (isset($param["NoMaskIO"])) {
            $this->NoMaskIO = $param["NoMaskIO"];
        }

        if (isset($param["CompareMode"])) {
            $this->CompareMode = $param["CompareMode"];
        }

        if (isset($param["HealthCodeType"])) {
            $this->HealthCodeType = $param["HealthCodeType"];
        }

        if (isset($param["HealthCodeOnlineEnabled"])) {
            $this->HealthCodeOnlineEnabled = $param["HealthCodeOnlineEnabled"];
        }

        if (isset($param["FaceWitnessCompare"])) {
            $this->FaceWitnessCompare = $param["FaceWitnessCompare"];
        }

        if (isset($param["PriorityTemperature"])) {
            $this->PriorityTemperature = $param["PriorityTemperature"];
        }

        if (isset($param["FaceDetectEnabled"])) {
            $this->FaceDetectEnabled = $param["FaceDetectEnabled"];
        }

        if (isset($param["VoiceEnabled"])) {
            $this->VoiceEnabled = $param["VoiceEnabled"];
        }

        if (isset($param["TempAbnormal"])) {
            $this->TempAbnormal = $param["TempAbnormal"];
        }

        if (isset($param["RFIDModule"])) {
            $this->RFIDModule = $param["RFIDModule"];
        }

        if (isset($param["AlarmSoundEnabled"])) {
            $this->AlarmSoundEnabled = $param["AlarmSoundEnabled"];
        }

        if (isset($param["StartUpLogo"])) {
            $this->StartUpLogo = $param["StartUpLogo"];
        }

        if (isset($param["MultipleCompare"])) {
            $this->MultipleCompare = $param["MultipleCompare"];
        }

    }
}