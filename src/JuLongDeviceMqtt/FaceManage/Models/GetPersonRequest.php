<?php
/**
 * 文件描述
 * Created on 2022/2/9 16:39
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 获取名单列表
 * Created on 2022/2/9 16:40
 * Create by LZH
 */
class GetPersonRequest extends AbstractRequest
{
    /**
     * @var int 名单类型 0：所有名单；1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var int 搜索方式 0：图片；2：特征值；3：人员ID
     */
    public $SearchType;

    /**
     * @var int|null 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    public $Similarity;

    /**
     * @var string|null 人脸图片(Base64)，SearchType等于0
     */
    public $FacePicture;

    /**
     * @var string|null 人员特征值数据(Base64，不可转换为图片)，SearchType等于1
     */
    public $FeatureValue;

    /**
     * @var string|null 人员入库时的ID，SearchType等于2
     */
    public $PersonId;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::GET_PERSON); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getPersonType(): int
    {
        return $this->PersonType;
    }

    /**
     * @param int $PersonType
     */
    public function setPersonType(int $PersonType): void
    {
        $this->PersonType = $PersonType;
    }

    /**
     * @return int
     */
    public function getSearchType(): int
    {
        return $this->SearchType;
    }

    /**
     * @param int $SearchType
     */
    public function setSearchType(int $SearchType): void
    {
        $this->SearchType = $SearchType;
    }

    /**
     * @return int|null
     */
    public function getSimilarity(): ?int
    {
        return $this->Similarity;
    }

    /**
     * @param int|null $Similarity
     */
    public function setSimilarity(?int $Similarity): void
    {
        $this->Similarity = $Similarity;
    }

    /**
     * @return string|null
     */
    public function getFacePicture(): ?string
    {
        return $this->FacePicture;
    }

    /**
     * @param string|null $FacePicture
     */
    public function setFacePicture(?string $FacePicture): void
    {
        $this->FacePicture = $FacePicture;
    }

    /**
     * @return string|null
     */
    public function getFeatureValue(): ?string
    {
        return $this->FeatureValue;
    }

    /**
     * @param string|null $FeatureValue
     */
    public function setFeatureValue(?string $FeatureValue): void
    {
        $this->FeatureValue = $FeatureValue;
    }

    /**
     * @return string|null
     */
    public function getPersonId(): ?string
    {
        return $this->PersonId;
    }

    /**
     * @param string|null $PersonId
     */
    public function setPersonId(?string $PersonId): void
    {
        $this->PersonId = $PersonId;
    }

}