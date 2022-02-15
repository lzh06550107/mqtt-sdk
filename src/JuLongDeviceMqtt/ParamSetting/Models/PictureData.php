<?php
/**
 * 文件描述
 * Created on 2022/2/14 10:21
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 抓拍信息所包含的图片数据
 * Created on 2022/2/14 10:21
 * Create by LZH
 */
class PictureData extends AbstractModel
{
    /**
     * @var int 人脸图片数据 0：不包含；1：包含
     */
    public $FacePicture;

    /**
     * @var int 人形图片数据 0：不包含；1：包含
     */
    public $BodyPicture;

    /**
     * @var int 背景图片数据 0：不包含；1：包含
     */
    public $BackgroundPicture;

    /**
     * @var int 人员底库图片 0：不包含；1：包含
     */
    public $PersonPhoto;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["FacePicture"])) {
            $this->FacePicture = $param["FacePicture"];
        }

        if (isset($param["BodyPicture"])) {
            $this->BodyPicture = $param["BodyPicture"];
        }

        if (isset($param["BackgroundPicture"])) {
            $this->BackgroundPicture = $param["BackgroundPicture"];
        }

        if (isset($param["PersonPhoto"])) {
            $this->PersonPhoto = $param["PersonPhoto"];
        }
    }
}