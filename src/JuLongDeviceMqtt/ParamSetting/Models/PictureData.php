<?php
/**
 * 文件描述
 * Created on 2022/2/14 10:21
 * Create by LZH
 */

declare(strict_types=1);

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
    private $FacePicture;

    /**
     * @var int 人形图片数据 0：不包含；1：包含
     */
    private $BodyPicture;

    /**
     * @var int 背景图片数据 0：不包含；1：包含
     */
    private $BackgroundPicture;

    /**
     * @var int 人员底库图片 0：不包含；1：包含
     */
    private $PersonPhoto;

    /**
     * @return int
     */
    public function getFacePicture(): int
    {
        return $this->FacePicture;
    }

    /**
     * @param int $FacePicture
     */
    public function setFacePicture(int $FacePicture): void
    {
        $this->FacePicture = $FacePicture;
    }

    /**
     * @return int
     */
    public function getBodyPicture(): int
    {
        return $this->BodyPicture;
    }

    /**
     * @param int $BodyPicture
     */
    public function setBodyPicture(int $BodyPicture): void
    {
        $this->BodyPicture = $BodyPicture;
    }

    /**
     * @return int
     */
    public function getBackgroundPicture(): int
    {
        return $this->BackgroundPicture;
    }

    /**
     * @param int $BackgroundPicture
     */
    public function setBackgroundPicture(int $BackgroundPicture): void
    {
        $this->BackgroundPicture = $BackgroundPicture;
    }

    /**
     * @return int
     */
    public function getPersonPhoto(): int
    {
        return $this->PersonPhoto;
    }

    /**
     * @param int $PersonPhoto
     */
    public function setPersonPhoto(int $PersonPhoto): void
    {
        $this->PersonPhoto = $PersonPhoto;
    }

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