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
    public $CheckMode;

    /**
     * @var int 实时测温 0：关闭；1：开启
     */
    public $RealTimeTempDetection;

    /**
     * @var int 持续测温 0：关闭；1：开启
     */
    public $ContinuedTempDetection;

    /**
     * @var int 未戴口罩 0：不开门；1：开门
     */
    public $NoMaskOperate1;

    /**
     * @var int 未戴口罩 0：比对测温；1：不比对测温
     */
    public $NoMaskOperate2;

    /**
     * @var int 测温模式 0：精准模式；1：快速模式；2：极速模式
     */
    public $TempDetectionMode;

    /**
     * @var string 温度阈值(保留一位小数点)
     */
    public $TempThreshold;

    /**
     * @var int 温度单位 0：摄氏度；1：华氏度
     */
    public $TempUnit;

    /**
     * @var int 温度校正 0：智能模式；1：常规模式
     */
    public $TempCorrection;

    /**
     * @var int 智能时段 0：关闭；1：开启
     */
    public $SmartTime;

    /**
     * @var TimePeriod[] 智能时段设置，SmartTime为1时有效
     */
    public $SmartTimePeriod;

    /**
     * @var int 高温修正 0：关闭；1：打开
     */
    public $HightTempCorrection;

    /**
     * @var int 低温修正 0：关闭；1：打开
     */
    public $LowTempCorrection;

    /**
     * @var int 测温筛选模式 0：自动；1：手动，T5测温模块才有
     */
    public $TempFilterMode;

    /**
     * @var float 测温筛选上限，T5测温模块才有
     */
    public $TempFilterMax;

    /**
     * @var float 测温筛选下限，T5测温模块才有
     */
    public $TempFilterMin;

    /**
     * @var int 体温数据 0：不显示；1：显示
     */
    public $TempDisplay;

    /**
     * @var TimePeriod 不测温时间段
     */
    public $NotTempDetectionPeriod;

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