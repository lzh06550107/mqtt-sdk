<?php
/**
 * 文件描述
 * Created on 2022/2/14 14:12
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 各抓拍模式下所需参数
 * Created on 2022/2/14 14:12
 * Create by LZH
 */
class CaptureModeParam extends AbstractModel
{
    /**
     * @var int 最大抓拍次数(“离开后抓拍”模式特有)
     */
    public $MaxCaptureTimes;

    /**
     * @var int 抓拍次数(“间隔抓拍”，“单人模式”特有)
     */
    public $CaptureTimes;

    /**
     * @var int 抓拍间隔(单位秒/帧，“间隔抓拍”，“单人模式特有”)
     */
    public $CaptureInterval;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["MaxCaptureTimes"])) {
            $this->MaxCaptureTimes = $param["MaxCaptureTimes"];
        }

        if (isset($param["CaptureTimes"])) {
            $this->CaptureTimes = $param["CaptureTimes"];
        }

        if (isset($param["CaptureInterval"])) {
            $this->CaptureInterval = $param["CaptureInterval"];
        }
    }
}