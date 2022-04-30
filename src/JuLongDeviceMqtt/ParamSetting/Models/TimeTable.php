<?php
/**
 * 文件描述
 * Created on 2022/2/12 13:54
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 布防时间段(支持两个时间段)
 * Created on 2022/2/12 13:54
 * Create by LZH
 */
class TimeTable extends AbstractModel
{
    /**
     * @var int 时间段启用 0：不启用；1：启用
     */
    private $TimeEnable;

    /**
     * @var string 开始时间 格式:hh:mm:ss(精确到分钟)
     */
    private $TimeBegin;

    /**
     * @var string 结束时间 格式:hh:mm:ss(精确到分钟)
     */
    private $TimeEnd;

    /**
     * @return int
     */
    public function getTimeEnable(): int
    {
        return $this->TimeEnable;
    }

    /**
     * @param int $TimeEnable
     */
    public function setTimeEnable(int $TimeEnable): void
    {
        $this->TimeEnable = $TimeEnable;
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

        if (isset($param["TimeEnable"])) {
            $this->TimeEnable = $param["TimeEnable"];
        }

        if (isset($param["TimeBegin"])) {
            $this->TimeBegin = $param["TimeBegin"];
        }

        if (isset($param["TimeEnd"])) {
            $this->TimeEnd = $param["TimeEnd"];
        }

    }

}