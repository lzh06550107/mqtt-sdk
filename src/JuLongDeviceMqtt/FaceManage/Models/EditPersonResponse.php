<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:16
 * Create by LZH
 */

declare(strict_types=1);

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
    private $PersonId;

    /**
     * @var FacePosition 人脸坐标信息(像素为单位)
     */
    private $FacePosition;

    /**
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->PersonId;
    }

    /**
     * @param string $PersonId
     */
    public function setPersonId(string $PersonId): void
    {
        $this->PersonId = $PersonId;
    }

    /**
     * @return FacePosition
     */
    public function getFacePosition(): FacePosition
    {
        return $this->FacePosition;
    }

    /**
     * @param FacePosition $FacePosition
     */
    public function setFacePosition(FacePosition $FacePosition): void
    {
        $this->FacePosition = $FacePosition;
    }

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