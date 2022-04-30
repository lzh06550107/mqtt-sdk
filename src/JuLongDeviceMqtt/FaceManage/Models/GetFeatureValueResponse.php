<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:09
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetFeatureValueResponse extends AbstractResponse
{
    /**
     * @var int 特征值类型 0：float；1：char；2：int；3：通用类型
     */
    private $FeatureType;

    /**
     * @var string 人员特征值数据(Base64，不可转换为图片)
     */
    private $FeatureValue;

    /**
     * @return int
     */
    public function getFeatureType(): int
    {
        return $this->FeatureType;
    }

    /**
     * @param int $FeatureType
     */
    public function setFeatureType(int $FeatureType): void
    {
        $this->FeatureType = $FeatureType;
    }

    /**
     * @return string
     */
    public function getFeatureValue(): string
    {
        return $this->FeatureValue;
    }

    /**
     * @param string $FeatureValue
     */
    public function setFeatureValue(string $FeatureValue): void
    {
        $this->FeatureValue = $FeatureValue;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["FeatureType"])) {
            $this->FeatureType = $param["FeatureType"];
        }

        if (isset($param['FeatureValue'])) {
            $this->FeatureValue = $param['FeatureValue'];
        }

    }
}