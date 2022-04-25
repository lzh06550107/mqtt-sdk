<?php
/**
 * 文件描述
 * Created on 2022/2/10 11:09
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 批量注册人员
 * Created on 2022/2/10 11:09
 * Create by LZH
 */
class BatchAddPersonRequest extends AbstractRequest
{
    /**
     * @var int 图片下发类型 0：URL(PersonPhotoUrl)；1：Base64(PersonPhoto)；2：特征值(FeatureValue)；3：IC卡(ICCard，人卡分离)
     */
    private $PhotoType;

    /**
     * @var int|null 人员特征值类型 0：float；1：char；2：int；3：通用类型
     */
    private $FeatureType;

    /**
     * @var int|null 人员总数
     */
    private $PersonTotal;

    /**
     * @var BatchAddPersonInfo[] 批量添加人员信息
     */
    private $PersonInfo;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::ADD_PERSONS); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getPhotoType(): int
    {
        return $this->PhotoType;
    }

    /**
     * @param int $PhotoType
     */
    public function setPhotoType(int $PhotoType): void
    {
        $this->PhotoType = $PhotoType;
    }

    /**
     * @return int|null
     */
    public function getFeatureType(): ?int
    {
        return $this->FeatureType;
    }

    /**
     * @param int|null $FeatureType
     */
    public function setFeatureType(?int $FeatureType): void
    {
        $this->FeatureType = $FeatureType;
    }

    /**
     * @return int|null
     */
    public function getPersonTotal(): ?int
    {
        return $this->PersonTotal;
    }

    /**
     * @param int|null $PersonTotal
     */
    public function setPersonTotal(?int $PersonTotal): void
    {
        $this->PersonTotal = $PersonTotal;
    }

    /**
     * @return BatchAddPersonInfo[]
     */
    public function getPersonInfo(): array
    {
        return $this->PersonInfo;
    }

    /**
     * @param BatchAddPersonInfo[] $PersonInfo
     */
    public function setPersonInfo(array $PersonInfo): void
    {
        $this->PersonInfo = $PersonInfo;
    }

}