<?php
/**
 * 文件描述
 * Created on 2022/1/24 15:31
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class AddPersonResponse extends AbstractResponse
{
    /**
     * @var string 人员ID
     */
    public $PersonId;

    /**
     * @var FacePosition 人脸坐标信息(像素为单位)
     */
    public $FacePosition;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["PersonId"])) {
            $this->PersonId = $param["PersonId"];
        }

        if (isset($param['FacePosition'])) {
            $facePosition = new FacePosition();
            $facePosition->deserialize($param['FacePosition']);
            $this->FacePosition = $facePosition;
        }

    }
}