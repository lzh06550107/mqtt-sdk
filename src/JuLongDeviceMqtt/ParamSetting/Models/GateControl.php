<?php
/**
 * 文件描述
 * Created on 2022/2/12 17:07
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 闸机控制
 * Created on 2022/2/12 17:07
 * Create by LZH
 */
class GateControl extends AbstractModel
{
    /**
     * @var int 控制接口 0：韦根接口；1：开关量；2：韦根接口+开关量
     */
    public $SignalInterface;

    /**
     * @var int 开门控制 0：关闭；1：输出1；2：输出2；3：输出 1+2
     */
    public $OutputControl;

    /**
     * @var int 报警控制 0：关闭；1：输出1；2：输出2；3：输出 1+2
     */
    public $AlarmControl;

    /**
     * @var int 输出1保持时间(单位秒)
     */
    public $IODuration;

    /**
     * @var int 输出1开门动作 0：常开；1：常闭
     */
    public $ContactType;

    /**
     * @var int 输出2保持时间(单位秒)
     */
    public $IODuration2;

    /**
     * @var int 输出2开门动作 0：常开；1：常闭
     */
    public $ContactType2;

    /**
     * @var int 韦根协议 1:26位；2:34位
     */
    public $WiganFormat;

    /**
     * @var int 韦根正反序 0：正序；1：反序
     */
    public $WiganPositive;

    /**
     * @var int 脉冲输出持续时间(微秒为单位)
     */
    public $PulseContinue;

    /**
     * @var int 脉冲间隔时间(微秒为单位)
     */
    public $PulseInterval;

    /**
     * @var int 韦根输出 0：用户ID；1：IC卡号
     */
    public $WiganContent;

    /**
     * @var int 打印机设置 0：关闭；1：时间+体温+姓名；2：时间+体温+人脸图+姓名
     */
    public $PrinterSetting;

    /**
     * @var int 标签纸大小 0：60*40mm；1：60*80mm
     */
    public $PaperSize;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["SignalInterface"])) {
            $this->SignalInterface = $param["SignalInterface"];
        }

        if (isset($param["OutputControl"])) {
            $this->OutputControl = $param["OutputControl"];
        }

        if (isset($param["AlarmControl"])) {
            $this->AlarmControl = $param["AlarmControl"];
        }

        if (isset($param["IODuration"])) {
            $this->IODuration = $param["IODuration"];
        }

        if (isset($param["ContactType"])) {
            $this->ContactType = $param["ContactType"];
        }

        if (isset($param["IODuration2"])) {
            $this->IODuration2 = $param["IODuration2"];
        }

        if (isset($param["ContactType2"])) {
            $this->ContactType2 = $param["ContactType2"];
        }

        if (isset($param["WiganFormat"])) {
            $this->WiganFormat = $param["WiganFormat"];
        }

        if (isset($param["WiganPositive"])) {
            $this->WiganPositive = $param["WiganPositive"];
        }

        if (isset($param["PulseContinue"])) {
            $this->PulseContinue = $param["PulseContinue"];
        }

        if (isset($param["PulseInterval"])) {
            $this->PulseInterval = $param["PulseInterval"];
        }

        if (isset($param["WiganContent"])) {
            $this->WiganContent = $param["WiganContent"];
        }

        if (isset($param["PrinterSetting"])) {
            $this->PrinterSetting = $param["PrinterSetting"];
        }

        if (isset($param["PaperSize"])) {
            $this->PaperSize = $param["PaperSize"];
        }

    }
}