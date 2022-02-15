<?php
/**
 * 文件描述
 * Created on 2022/2/15 13:37
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetCaptureSumResponse extends AbstractResponse
{
    /**
     * @var int 抓拍数
     */
    public $CaptureSum;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param['CaptureSum'])) {
            $this->CaptureSum = $param['CaptureSum'];
        }

    }

}