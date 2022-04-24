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
    public $TimeEnable;

    /**
     * @var string 开始时间 格式:hh:mm:ss(精确到分钟)
     */
    public $TimeBegin;

    /**
     * @var string 结束时间 格式:hh:mm:ss(精确到分钟)
     */
    public $TimeEnd;

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