<?php
/**
 * 文件描述
 * Created on 2022/2/14 14:17
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 人脸图片名(比视机特有)
 * Created on 2022/2/14 14:17
 * Create by LZH
 */
class PicturePrefix extends AbstractModel
{
    public $PictureEnabled;

    public $CustomPrefix;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["PictureEnabled"])) {
            $this->PictureEnabled = $param["PictureEnabled"];
        }

        if (isset($param["CustomPrefix"])) {
            $this->CustomPrefix = $param["CustomPrefix"];
        }
    }
}