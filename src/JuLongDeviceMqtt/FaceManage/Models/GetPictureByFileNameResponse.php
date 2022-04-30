<?php
/**
 * 文件描述
 * Created on 2022/2/11 14:10
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetPictureByFileNameResponse extends AbstractResponse
{

    /**
     * @var string 图片名
     */
    private $PictureName;

    /**
     * @var string 图片Base64
     */
    private $Picture;

    /**
     * @return string
     */
    public function getPictureName(): string
    {
        return $this->PictureName;
    }

    /**
     * @param string $PictureName
     */
    public function setPictureName(string $PictureName): void
    {
        $this->PictureName = $PictureName;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->Picture;
    }

    /**
     * @param string $Picture
     */
    public function setPicture(string $Picture): void
    {
        $this->Picture = $Picture;
    }

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