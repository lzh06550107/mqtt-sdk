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
    public $PeriodEnabled;

    /**
     * @var string 开始时间 格式：hh:mm
     */
    public $TimeBegin;

    /**
     * @var string 结束时间 格式：hh:mm
     */
    public $TimeEnd;

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