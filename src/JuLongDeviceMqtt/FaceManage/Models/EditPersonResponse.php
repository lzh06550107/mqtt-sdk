<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:16
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * 编辑人员响应
 * Created on 2022/2/10 9:17
 * Create by LZH
 */
class EditPersonResponse extends AbstractResponse
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