<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:22
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 图片/特征值比较相似度(门禁机支持)
 * 用户通过此接口传两张jpg图片或者特征值到设备进行比对返回相似度。
 * Created on 2022/2/10 10:22
 * Create by LZH
 */
class GetFaceSimilarityRequest extends AbstractRequest
{
    /**
     * @var int 人脸类型 0：人员照片(Base64)；1：人员特征值数据
     */
    public $FaceType;

    /**
     * @var string|null 人员照片（Base64编码），FaceType为0必填
     */
    public $PersonPhoto1;

    /**
     * @var string|null 人员照片（Base64编码），FaceType为0必填
     */
    public $PersonPhoto2;

    /**
     * @var string|null 人员特征值数据(Base64，不可转换为图片)，FaceType为1必填
     */
    public $FeatureValue1;

    /**
     * @var string|null 人员特征值数据(Base64，不可转换为图片)，FaceType为1必填
     */
    public $FeatureValue2;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::GET_FACE_SIMILARITY); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getFaceType(): int
    {
        return $this->FaceType;
    }

    /**
     * @param int $FaceType
     */
    public function setFaceType(int $FaceType): void
    {
        $this->FaceType = $FaceType;
    }

    /**
     * @return string|null
     */
    public function getPersonPhoto1(): ?string
    {
        return $this->PersonPhoto1;
    }

    /**
     * @param string $PersonPhoto1
     */
    public function setPersonPhoto1(string $PersonPhoto1): void
    {
        $this->PersonPhoto1 = $PersonPhoto1;
    }

    /**
     * @return string|null
     */
    public function getPersonPhoto2(): ?string
    {
        return $this->PersonPhoto2;
    }

    /**
     * @param string $PersonPhoto2
     */
    public function setPersonPhoto2(string $PersonPhoto2): void
    {
        $this->PersonPhoto2 = $PersonPhoto2;
    }

    /**
     * @return string|null
     */
    public function getFeatureValue1(): ?string
    {
        return $this->FeatureValue1;
    }

    /**
     * @param string $FeatureValue1
     */
    public function setFeatureValue1(string $FeatureValue1): void
    {
        $this->FeatureValue1 = $FeatureValue1;
    }

    /**
     * @return string|null
     */
    public function getFeatureValue2(): ?string
    {
        return $this->FeatureValue2;
    }

    /**
     * @param string $FeatureValue2
     */
    public function setFeatureValue2(string $FeatureValue2): void
    {
        $this->FeatureValue2 = $FeatureValue2;
    }

}