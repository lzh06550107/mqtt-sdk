<?php
/**
 * 文件描述
 * Created on 2022/2/12 16:14
 * Create by LZH
 */

declare(strict_types=1);

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
    private $LightControl;

    /**
     * @var string 转白天 格式：hh:mm:ss，LightControl为1时有效
     */
    private $DaytimeStart;

    /**
     * @var string 转夜晚 格式：hh:mm:ss，LightControl为1时有效
     */
    private $NightStart;

    /**
     * @var int 屏幕显示模式 0：一直显示；1：无人后关闭
     */
    private $ScreenDisplayMode;

    /**
     * @var int 人脸检测分辨率 0:1080*1920；1:720*1280；2:540*960；3:432*768；4:360*640，切换分辨率设备将重启
     */
    private $FaceDetecRatio;

    /**
     * @var int 名单相似度
     */
    private $ListSimilarity;

    /**
     * @var int 身份证相似度
     */
    private $IDCardSimilarity;

    /**
     * @var int 同人过滤(单位秒)
     */
    private $SameFilter;

    /**
     * @var int 时间显示 0：不显示 1：显示
     */
    private $TimeDisplay;

    /**
     * @var int IP显示 0：不显示；1：显示
     */
    private $IPDisplay;

    /**
     * @var int UUID显示 0：不显示；1：显示
     */
    private $UUIDDisplay;

    /**
     * @var int 日期格式 0：YYYY-MM-DD；1：MM-DD-YYYY；2：DD-MM-YYYY
     */
    private $DateFormat;

    /**
     * @var int 脱敏显示 0：关；1：开
     */
    private $LeakDisplay;

    /**
     * @var int 比对记录存储 0：全部记录；1：高温异常记录；2：关闭
     */
    private $ComparisonRecord;

    /**
     * @var int 未戴口罩 0：不开门；1：开门，CheckMode为2、3时有效
     */
    private $NoMaskIO;

    /**
     * @var int 比对模式（开门条件） 0：无；1：白名单+人脸验证开门；2：身份证+人脸验证开门；3：白名单+身份证+人脸验证开门；4：白名单或身份证+人脸验证开门；5：IC卡识别；6：IC卡或人脸识别；7：IC卡+人脸识别；8：二维码识别；9：二维码或人脸识别或身份证；10：二维码+人脸+身份证；11：访客模式；13：健康码或身份证
     */
    private $CompareMode;

    /**
     * @var int 健康码类型 0：国康码；1：粤康码；2：湖南码，健康码设备专有
     */
    private $HealthCodeType;

    /**
     * @var int 在线 0：关闭；1：开启
     */
    private $HealthCodeOnlineEnabled;

    /**
     * @var int 认证对比 0：关闭；1：开启
     */
    private $FaceWitnessCompare;

    /**
     * @var int 优先测温 0：关闭；1：开启
     */
    private $PriorityTemperature;

    /**
     * @var int 人脸识别开关 0：关闭；1：开启
     */
    private $FaceDetectEnabled;

    /**
     * @var int 语音播报开关 0：关闭；1：开启
     */
    private $VoiceEnabled;

    /**
     * @var int 温度异常设置 0：关闭；1：温度异常开门；2：温度异常报警
     */
    private $TempAbnormal;

    /**
     * @var int IC刷卡模块 0：USB接入；1：WG接入；2：串口接入
     */
    private $RFIDModule;

    /**
     * @var int 报警声音开关 0：关；1：开
     */
    private $AlarmSoundEnabled;

    /**
     * @var int 开机logo 0：关；1：开
     */
    private $StartUpLogo;

    /**
     * @var int 对次比对
     */
    private $MultipleCompare;

    /**
     * @return int
     */
    public function getLightControl(): int
    {
        return $this->LightControl;
    }

    /**
     * @param int $LightControl
     */
    public function setLightControl(int $LightControl): void
    {
        $this->LightControl = $LightControl;
    }

    /**
     * @return string
     */
    public function getDaytimeStart(): string
    {
        return $this->DaytimeStart;
    }

    /**
     * @param string $DaytimeStart
     */
    public function setDaytimeStart(string $DaytimeStart): void
    {
        $this->DaytimeStart = $DaytimeStart;
    }

    /**
     * @return string
     */
    public function getNightStart(): string
    {
        return $this->NightStart;
    }

    /**
     * @param string $NightStart
     */
    public function setNightStart(string $NightStart): void
    {
        $this->NightStart = $NightStart;
    }

    /**
     * @return int
     */
    public function getScreenDisplayMode(): int
    {
        return $this->ScreenDisplayMode;
    }

    /**
     * @param int $ScreenDisplayMode
     */
    public function setScreenDisplayMode(int $ScreenDisplayMode): void
    {
        $this->ScreenDisplayMode = $ScreenDisplayMode;
    }

    /**
     * @return int
     */
    public function getFaceDetecRatio(): int
    {
        return $this->FaceDetecRatio;
    }

    /**
     * @param int $FaceDetecRatio
     */
    public function setFaceDetecRatio(int $FaceDetecRatio): void
    {
        $this->FaceDetecRatio = $FaceDetecRatio;
    }

    /**
     * @return int
     */
    public function getListSimilarity(): int
    {
        return $this->ListSimilarity;
    }

    /**
     * @param int $ListSimilarity
     */
    public function setListSimilarity(int $ListSimilarity): void
    {
        $this->ListSimilarity = $ListSimilarity;
    }

    /**
     * @return int
     */
    public function getIDCardSimilarity(): int
    {
        return $this->IDCardSimilarity;
    }

    /**
     * @param int $IDCardSimilarity
     */
    public function setIDCardSimilarity(int $IDCardSimilarity): void
    {
        $this->IDCardSimilarity = $IDCardSimilarity;
    }

    /**
     * @return int
     */
    public function getSameFilter(): int
    {
        return $this->SameFilter;
    }

    /**
     * @param int $SameFilter
     */
    public function setSameFilter(int $SameFilter): void
    {
        $this->SameFilter = $SameFilter;
    }

    /**
     * @return int
     */
    public function getTimeDisplay(): int
    {
        return $this->TimeDisplay;
    }

    /**
     * @param int $TimeDisplay
     */
    public function setTimeDisplay(int $TimeDisplay): void
    {
        $this->TimeDisplay = $TimeDisplay;
    }

    /**
     * @return int
     */
    public function getIPDisplay(): int
    {
        return $this->IPDisplay;
    }

    /**
     * @param int $IPDisplay
     */
    public function setIPDisplay(int $IPDisplay): void
    {
        $this->IPDisplay = $IPDisplay;
    }

    /**
     * @return int
     */
    public function getUUIDDisplay(): int
    {
        return $this->UUIDDisplay;
    }

    /**
     * @param int $UUIDDisplay
     */
    public function setUUIDDisplay(int $UUIDDisplay): void
    {
        $this->UUIDDisplay = $UUIDDisplay;
    }

    /**
     * @return int
     */
    public function getDateFormat(): int
    {
        return $this->DateFormat;
    }

    /**
     * @param int $DateFormat
     */
    public function setDateFormat(int $DateFormat): void
    {
        $this->DateFormat = $DateFormat;
    }

    /**
     * @return int
     */
    public function getLeakDisplay(): int
    {
        return $this->LeakDisplay;
    }

    /**
     * @param int $LeakDisplay
     */
    public function setLeakDisplay(int $LeakDisplay): void
    {
        $this->LeakDisplay = $LeakDisplay;
    }

    /**
     * @return int
     */
    public function getComparisonRecord(): int
    {
        return $this->ComparisonRecord;
    }

    /**
     * @param int $ComparisonRecord
     */
    public function setComparisonRecord(int $ComparisonRecord): void
    {
        $this->ComparisonRecord = $ComparisonRecord;
    }

    /**
     * @return int
     */
    public function getNoMaskIO(): int
    {
        return $this->NoMaskIO;
    }

    /**
     * @param int $NoMaskIO
     */
    public function setNoMaskIO(int $NoMaskIO): void
    {
        $this->NoMaskIO = $NoMaskIO;
    }

    /**
     * @return int
     */
    public function getCompareMode(): int
    {
        return $this->CompareMode;
    }

    /**
     * @param int $CompareMode
     */
    public function setCompareMode(int $CompareMode): void
    {
        $this->CompareMode = $CompareMode;
    }

    /**
     * @return int
     */
    public function getHealthCodeType(): int
    {
        return $this->HealthCodeType;
    }

    /**
     * @param int $HealthCodeType
     */
    public function setHealthCodeType(int $HealthCodeType): void
    {
        $this->HealthCodeType = $HealthCodeType;
    }

    /**
     * @return int
     */
    public function getHealthCodeOnlineEnabled(): int
    {
        return $this->HealthCodeOnlineEnabled;
    }

    /**
     * @param int $HealthCodeOnlineEnabled
     */
    public function setHealthCodeOnlineEnabled(int $HealthCodeOnlineEnabled): void
    {
        $this->HealthCodeOnlineEnabled = $HealthCodeOnlineEnabled;
    }

    /**
     * @return int
     */
    public function getFaceWitnessCompare(): int
    {
        return $this->FaceWitnessCompare;
    }

    /**
     * @param int $FaceWitnessCompare
     */
    public function setFaceWitnessCompare(int $FaceWitnessCompare): void
    {
        $this->FaceWitnessCompare = $FaceWitnessCompare;
    }

    /**
     * @return int
     */
    public function getPriorityTemperature(): int
    {
        return $this->PriorityTemperature;
    }

    /**
     * @param int $PriorityTemperature
     */
    public function setPriorityTemperature(int $PriorityTemperature): void
    {
        $this->PriorityTemperature = $PriorityTemperature;
    }

    /**
     * @return int
     */
    public function getFaceDetectEnabled(): int
    {
        return $this->FaceDetectEnabled;
    }

    /**
     * @param int $FaceDetectEnabled
     */
    public function setFaceDetectEnabled(int $FaceDetectEnabled): void
    {
        $this->FaceDetectEnabled = $FaceDetectEnabled;
    }

    /**
     * @return int
     */
    public function getVoiceEnabled(): int
    {
        return $this->VoiceEnabled;
    }

    /**
     * @param int $VoiceEnabled
     */
    public function setVoiceEnabled(int $VoiceEnabled): void
    {
        $this->VoiceEnabled = $VoiceEnabled;
    }

    /**
     * @return int
     */
    public function getTempAbnormal(): int
    {
        return $this->TempAbnormal;
    }

    /**
     * @param int $TempAbnormal
     */
    public function setTempAbnormal(int $TempAbnormal): void
    {
        $this->TempAbnormal = $TempAbnormal;
    }

    /**
     * @return int
     */
    public function getRFIDModule(): int
    {
        return $this->RFIDModule;
    }

    /**
     * @param int $RFIDModule
     */
    public function setRFIDModule(int $RFIDModule): void
    {
        $this->RFIDModule = $RFIDModule;
    }

    /**
     * @return int
     */
    public function getAlarmSoundEnabled(): int
    {
        return $this->AlarmSoundEnabled;
    }

    /**
     * @param int $AlarmSoundEnabled
     */
    public function setAlarmSoundEnabled(int $AlarmSoundEnabled): void
    {
        $this->AlarmSoundEnabled = $AlarmSoundEnabled;
    }

    /**
     * @return int
     */
    public function getStartUpLogo(): int
    {
        return $this->StartUpLogo;
    }

    /**
     * @param int $StartUpLogo
     */
    public function setStartUpLogo(int $StartUpLogo): void
    {
        $this->StartUpLogo = $StartUpLogo;
    }

    /**
     * @return int
     */
    public function getMultipleCompare(): int
    {
        return $this->MultipleCompare;
    }

    /**
     * @param int $MultipleCompare
     */
    public function setMultipleCompare(int $MultipleCompare): void
    {
        $this->MultipleCompare = $MultipleCompare;
    }

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