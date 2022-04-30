<?php
/**
 * 文件描述
 * Created on 2022/2/12 16:00
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 时间段类
 * Created on 2022/2/12 16:01
 * Create by LZH
 */
class TimePeriod extends AbstractModel
{
    /**
     * @var int 时间段开启 0：关闭；1：开启
     */
    private $PeriodEnabled;

    /**
     * @var string 开始时间 格式：hh:mm
     */
    private $TimeBegin;

    /**
     * @var string 结束时间 格式：hh:mm
     */
    private $TimeEnd;

    /**
     * @return int
     */
    public function getPeriodEnabled(): int
    {
        return $this->PeriodEnabled;
    }

    /**
     * @param int $PeriodEnabled
     */
    public function setPeriodEnabled(int $PeriodEnabled): void
    {
        $this->PeriodEnabled = $PeriodEnabled;
    }

    /**
     * @return string
     */
    public function getTimeBegin(): string
    {
        return $this->TimeBegin;
    }

    /**
     * @param string $TimeBegin
     */
    public function setTimeBegin(string $TimeBegin): void
    {
        $this->TimeBegin = $TimeBegin;
    }

    /**
     * @return string
     */
    public function getTimeEnd(): string
    {
        return $this->TimeEnd;
    }

    /**
     * @param string $TimeEnd
     */
    public function setTimeEnd(string $TimeEnd): void
    {
        $this->TimeEnd = $TimeEnd;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["PeriodEnabled"])) {
            $this->PeriodEnabled = $param["PeriodEnabled"];
        }

        if (isset($param["TimeBegin"])) {
            $this->TimeBegin = $param["TimeBegin"];
        }

        if (isset($param["TimeEnd"])) {
            $this->TimeEnd = $param["TimeEnd"];
        }

    }
}