<?php
/**
 * 文件描述
 * Created on 2022/2/14 14:20
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

class PictureCompression extends AbstractModel
{
    public $CompressionEnabled;

    public $CompressionSize;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["CompressionEnabled"])) {
            $this->CompressionEnabled = $param["CompressionEnabled"];
        }

        if (isset($param["CompressionSize"])) {
            $this->CompressionSize = $param["CompressionSize"];
        }
    }
}