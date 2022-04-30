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
    private $SignalInterface;

    /**
     * @var int 开门控制 0：关闭；1：输出1；2：输出2；3：输出 1+2
     */
    private $OutputControl;

    /**
     * @var int 报警控制 0：关闭；1：输出1；2：输出2；3：输出 1+2
     */
    private $AlarmControl;

    /**
     * @var int 输出1保持时间(单位秒)
     */
    private $IODuration;

    /**
     * @var int 输出1开门动作 0：常开；1：常闭
     */
    private $ContactType;

    /**
     * @var int 输出2保持时间(单位秒)
     */
    private $IODuration2;

    /**
     * @var int 输出2开门动作 0：常开；1：常闭
     */
    private $ContactType2;

    /**
     * @var int 韦根协议 1:26位；2:34位
     */
    private $WiganFormat;

    /**
     * @var int 韦根正反序 0：正序；1：反序
     */
    private $WiganPositive;

    /**
     * @var int 脉冲输出持续时间(微秒为单位)
     */
    private $PulseContinue;

    /**
     * @var int 脉冲间隔时间(微秒为单位)
     */
    private $PulseInterval;

    /**
     * @var int 韦根输出 0：用户ID；1：IC卡号
     */
    private $WiganContent;

    /**
     * @var int 打印机设置 0：关闭；1：时间+体温+姓名；2：时间+体温+人脸图+姓名
     */
    private $PrinterSetting;

    /**
     * @var int 标签纸大小 0：60*40mm；1：60*80mm
     */
    private $PaperSize;

    /**
     * @return int
     */
    public function getSignalInterface(): int
    {
        return $this->SignalInterface;
    }

    /**
     * @param int $SignalInterface
     */
    public function setSignalInterface(int $SignalInterface): void
    {
        $this->SignalInterface = $SignalInterface;
    }

    /**
     * @return int
     */
    public function getOutputControl(): int
    {
        return $this->OutputControl;
    }

    /**
     * @param int $OutputControl
     */
    public function setOutputControl(int $OutputControl): void
    {
        $this->OutputControl = $OutputControl;
    }

    /**
     * @return int
     */
    public function getAlarmControl(): int
    {
        return $this->AlarmControl;
    }

    /**
     * @param int $AlarmControl
     */
    public function setAlarmControl(int $AlarmControl): void
    {
        $this->AlarmControl = $AlarmControl;
    }

    /**
     * @return int
     */
    public function getIODuration(): int
    {
        return $this->IODuration;
    }

    /**
     * @param int $IODuration
     */
    public function setIODuration(int $IODuration): void
    {
        $this->IODuration = $IODuration;
    }

    /**
     * @return int
     */
    public function getContactType(): int
    {
        return $this->ContactType;
    }

    /**
     * @param int $ContactType
     */
    public function setContactType(int $ContactType): void
    {
        $this->ContactType = $ContactType;
    }

    /**
     * @return int
     */
    public function getIODuration2(): int
    {
        return $this->IODuration2;
    }

    /**
     * @param int $IODuration2
     */
    public function setIODuration2(int $IODuration2): void
    {
        $this->IODuration2 = $IODuration2;
    }

    /**
     * @return int
     */
    public function getContactType2(): int
    {
        return $this->ContactType2;
    }

    /**
     * @param int $ContactType2
     */
    public function setContactType2(int $ContactType2): void
    {
        $this->ContactType2 = $ContactType2;
    }

    /**
     * @return int
     */
    public function getWiganFormat(): int
    {
        return $this->WiganFormat;
    }

    /**
     * @param int $WiganFormat
     */
    public function setWiganFormat(int $WiganFormat): void
    {
        $this->WiganFormat = $WiganFormat;
    }

    /**
     * @return int
     */
    public function getWiganPositive(): int
    {
        return $this->WiganPositive;
    }

    /**
     * @param int $WiganPositive
     */
    public function setWiganPositive(int $WiganPositive): void
    {
        $this->WiganPositive = $WiganPositive;
    }

    /**
     * @return int
     */
    public function getPulseContinue(): int
    {
        return $this->PulseContinue;
    }

    /**
     * @param int $PulseContinue
     */
    public function setPulseContinue(int $PulseContinue): void
    {
        $this->PulseContinue = $PulseContinue;
    }

    /**
     * @return int
     */
    public function getPulseInterval(): int
    {
        return $this->PulseInterval;
    }

    /**
     * @param int $PulseInterval
     */
    public function setPulseInterval(int $PulseInterval): void
    {
        $this->PulseInterval = $PulseInterval;
    }

    /**
     * @return int
     */
    public function getWiganContent(): int
    {
        return $this->WiganContent;
    }

    /**
     * @param int $WiganContent
     */
    public function setWiganContent(int $WiganContent): void
    {
        $this->WiganContent = $WiganContent;
    }

    /**
     * @return int
     */
    public function getPrinterSetting(): int
    {
        return $this->PrinterSetting;
    }

    /**
     * @param int $PrinterSetting
     */
    public function setPrinterSetting(int $PrinterSetting): void
    {
        $this->PrinterSetting = $PrinterSetting;
    }

    /**
     * @return int
     */
    public function getPaperSize(): int
    {
        return $this->PaperSize;
    }

    /**
     * @param int $PaperSize
     */
    public function setPaperSize(int $PaperSize): void
    {
        $this->PaperSize = $PaperSize;
    }

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