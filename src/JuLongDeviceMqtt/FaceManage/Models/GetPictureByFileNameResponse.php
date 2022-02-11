<?php
/**
 * 文件描述
 * Created on 2022/2/11 14:10
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetPictureByFileNameResponse extends AbstractResponse
{

    /**
     * @var string 图片名
     */
    public $PictureName;

    /**
     * @var string 图片Base64
     */
    public $Picture;

    public function deserialize($param)
    {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["PictureName"])) {
            $this->PictureName = $param["PictureName"];
        }

        if (isset($param["Picture"])) {
            $this->Picture = $param["Picture"];
        }
    }
}