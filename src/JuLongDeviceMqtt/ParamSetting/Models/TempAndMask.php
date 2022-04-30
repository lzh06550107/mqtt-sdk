<?php
/**
 * 文件描述
 * Created on 2022/2/12 15:44
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 温度和口罩设置
 * Created on 2022/2/12 15:45
 * Create by LZH
 */
class TempAndMask extends AbstractModel
{
    /**
     * @var int 口罩温度检测 0：无；1：体温检测；2：口罩检测；3：体温+口罩检测
     */
    private $CheckMode;

    /**
     * @var int 实时测温 0：关闭；1：开启
     */
    private $RealTimeTempDetection;

    /**
     * @var int 持续测温 0：关闭；1：开启
     */
    private $ContinuedTempDetection;

    /**
     * @var int 未戴口罩 0：不开门；1：开门
     */
    private $NoMaskOperate1;

    /**
     * @var int 未戴口罩 0：比对测温；1：不比对测温
     */
    private $NoMaskOperate2;

    /**
     * @var int 测温模式 0：精准模式；1：快速模式；2：极速模式
     */
    private $TempDetectionMode;

    /**
     * @var string 温度阈值(保留一位小数点)
     */
    private $TempThreshold;

    /**
     * @var int 温度单位 0：摄氏度；1：华氏度
     */
    private $TempUnit;

    /**
     * @var int 温度校正 0：智能模式；1：常规模式
     */
    private $TempCorrection;

    /**
     * @var int 智能时段 0：关闭；1：开启
     */
    private $SmartTime;

    /**
     * @var TimePeriod[] 智能时段设置，SmartTime为1时有效
     */
    private $SmartTimePeriod;

    /**
     * @var int 高温修正 0：关闭；1：打开
     */
    private $HightTempCorrection;

    /**
     * @var int 低温修正 0：关闭；1：打开
     */
    private $LowTempCorrection;

    /**
     * @var int 测温筛选模式 0：自动；1：手动，T5测温模块才有
     */
    private $TempFilterMode;

    /**
     * @var float 测温筛选上限，T5测温模块才有
     */
    private $TempFilterMax;

    /**
     * @var float 测温筛选下限，T5测温模块才有
     */
    private $TempFilterMin;

    /**
     * @var int 体温数据 0：不显示；1：显示
     */
    private $TempDisplay;

    /**
     * @var TimePeriod 不测温时间段
     */
    private $NotTempDetectionPeriod;

    /**
     * @return int
     */
    public function getCheckMode(): int
    {
        return $this->CheckMode;
    }

    /**
     * @param int $CheckMode
     */
    public function setCheckMode(int $CheckMode): void
    {
        $this->CheckMode = $CheckMode;
    }

    /**
     * @return int
     */
    public function getRealTimeTempDetection(): int
    {
        return $this->RealTimeTempDetection;
    }

    /**
     * @param int $RealTimeTempDetection
     */
    public function setRealTimeTempDetection(int $RealTimeTempDetection): void
    {
        $this->RealTimeTempDetection = $RealTimeTempDetection;
    }

    /**
     * @return int
     */
    public function getContinuedTempDetection(): int
    {
        return $this->ContinuedTempDetection;
    }

    /**
     * @param int $ContinuedTempDetection
     */
    public function setContinuedTempDetection(int $ContinuedTempDetection): void
    {
        $this->ContinuedTempDetection = $ContinuedTempDetection;
    }

    /**
     * @return int
     */
    public function getNoMaskOperate1(): int
    {
        return $this->NoMaskOperate1;
    }

    /**
     * @param int $NoMaskOperate1
     */
    public function setNoMaskOperate1(int $NoMaskOperate1): void
    {
        $this->NoMaskOperate1 = $NoMaskOperate1;
    }

    /**
     * @return int
     */
    public function getNoMaskOperate2(): int
    {
        return $this->NoMaskOperate2;
    }

    /**
     * @param int $NoMaskOperate2
     */
    public function setNoMaskOperate2(int $NoMaskOperate2): void
    {
        $this->NoMaskOperate2 = $NoMaskOperate2;
    }

    /**
     * @return int
     */
    public function getTempDetectionMode(): int
    {
        return $this->TempDetectionMode;
    }

    /**
     * @param int $TempDetectionMode
     */
    public function setTempDetectionMode(int $TempDetectionMode): void
    {
        $this->TempDetectionMode = $TempDetectionMode;
    }

    /**
     * @return string
     */
    public function getTempThreshold(): string
    {
        return $this->TempThreshold;
    }

    /**
     * @param string $TempThreshold
     */
    public function setTempThreshold(string $TempThreshold): void
    {
        $this->TempThreshold = $TempThreshold;
    }

    /**
     * @return int
     */
    public function getTempUnit(): int
    {
        return $this->TempUnit;
    }

    /**
     * @param int $TempUnit
     */
    public function setTempUnit(int $TempUnit): void
    {
        $this->TempUnit = $TempUnit;
    }

    /**
     * @return int
     */
    public function getTempCorrection(): int
    {
        return $this->TempCorrection;
    }

    /**
     * @param int $TempCorrection
     */
    public function setTempCorrection(int $TempCorrection): void
    {
        $this->TempCorrection = $TempCorrection;
    }

    /**
     * @return int
     */
    public function getSmartTime(): int
    {
        return $this->SmartTime;
    }

    /**
     * @param int $SmartTime
     */
    public function setSmartTime(int $SmartTime): void
    {
        $this->SmartTime = $SmartTime;
    }

    /**
     * @return TimePeriod[]
     */
    public function getSmartTimePeriod(): array
    {
        return $this->SmartTimePeriod;
    }

    /**
     * @param TimePeriod[] $SmartTimePeriod
     */
    public function setSmartTimePeriod(array $SmartTimePeriod): void
    {
        $this->SmartTimePeriod = $SmartTimePeriod;
    }

    /**
     * @return int
     */
    public function getHightTempCorrection(): int
    {
        return $this->HightTempCorrection;
    }

    /**
     * @param int $HightTempCorrection
     */
    public function setHightTempCorrection(int $HightTempCorrection): void
    {
        $this->HightTempCorrection = $HightTempCorrection;
    }

    /**
     * @return int
     */
    public function getLowTempCorrection(): int
    {
        return $this->LowTempCorrection;
    }

    /**
     * @param int $LowTempCorrection
     */
    public function setLowTempCorrection(int $LowTempCorrection): void
    {
        $this->LowTempCorrection = $LowTempCorrection;
    }

    /**
     * @return int
     */
    public function getTempFilterMode(): int
    {
        return $this->TempFilterMode;
    }

    /**
     * @param int $TempFilterMode
     */
    public function setTempFilterMode(int $TempFilterMode): void
    {
        $this->TempFilterMode = $TempFilterMode;
    }

    /**
     * @return float
     */
    public function getTempFilterMax(): float
    {
        return $this->TempFilterMax;
    }

    /**
     * @param float $TempFilterMax
     */
    public function setTempFilterMax(float $TempFilterMax): void
    {
        $this->TempFilterMax = $TempFilterMax;
    }

    /**
     * @return float
     */
    public function getTempFilterMin(): float
    {
        return $this->TempFilterMin;
    }

    /**
     * @param float $TempFilterMin
     */
    public function setTempFilterMin(float $TempFilterMin): void
    {
        $this->TempFilterMin = $TempFilterMin;
    }

    /**
     * @return int
     */
    public function getTempDisplay(): int
    {
        return $this->TempDisplay;
    }

    /**
     * @param int $TempDisplay
     */
    public function setTempDisplay(int $TempDisplay): void
    {
        $this->TempDisplay = $TempDisplay;
    }

    /**
     * @return TimePeriod
     */
    public function getNotTempDetectionPeriod(): TimePeriod
    {
        return $this->NotTempDetectionPeriod;
    }

    /**
     * @param TimePeriod $NotTempDetectionPeriod
     */
    public function setNotTempDetectionPeriod(TimePeriod $NotTempDetectionPeriod): void
    {
        $this->NotTempDetectionPeriod = $NotTempDetectionPeriod;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["CheckMode"])) {
            $this->CheckMode = $param["CheckMode"];
        }

        if (isset($param["RealTimeTempDetection"])) {
            $this->RealTimeTempDetection = $param["RealTimeTempDetection"];
        }

        if (isset($param["ContinuedTempDetection"])) {
            $this->ContinuedTempDetection = $param["ContinuedTempDetection"];
        }

        if (isset($param["NoMaskOperate1"])) {
            $this->NoMaskOperate1 = $param["NoMaskOperate1"];
        }

        if (isset($param["NoMaskOperate2"])) {
            $this->NoMaskOperate2 = $param["NoMaskOperate2"];
        }

        if (isset($param["TempDetectionMode"])) {
            $this->TempDetectionMode = $param["TempDetectionMode"];
        }

        if (isset($param["TempThreshold"])) {
            $this->TempThreshold = $param["TempThreshold"];
        }

        if (isset($param["TempUnit"])) {
            $this->TempUnit = $param["TempUnit"];
        }

        if (isset($param["TempCorrection"])) {
            $this->TempCorrection = $param["TempCorrection"];
        }

        if (isset($param["SmartTime"])) {
            $this->SmartTime = $param["SmartTime"];
        }

        if (isset($param["SmartTimePeriod"])) {
            $this->SmartTimePeriod = $param["SmartTimePeriod"];
        }

        if (isset($param["HightTempCorrection"])) {
            $this->HightTempCorrection = $param["HightTempCorrection"];
        }

        if (isset($param["LowTempCorrection"])) {
            $this->LowTempCorrection = $param["LowTempCorrection"];
        }

        if (isset($param["TempFilterMode"])) {
            $this->TempFilterMode = $param["TempFilterMode"];
        }

        if (isset($param["TempFilterMax"])) {
            $this->TempFilterMax = $param["TempFilterMax"];
        }

        if (isset($param["TempFilterMin"])) {
            $this->TempFilterMin = $param["TempFilterMin"];
        }

        if (isset($param["TempDisplay"])) {
            $this->TempDisplay = $param["TempDisplay"];
        }

        if (isset($param["NotTempDetectionPeriod"])) {
            $this->NotTempDetectionPeriod = $param["NotTempDetectionPeriod"];
        }
    }
}