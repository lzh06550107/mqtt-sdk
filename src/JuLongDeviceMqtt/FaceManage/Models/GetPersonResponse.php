<?php
/**
 * 文件描述
 * Created on 2022/2/9 17:03
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetPersonResponse extends AbstractResponse
{
    /**
     * @var int 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    private $Similarity;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    private $PersonType;

    /**
     * @var PersonInfo 人员信息
     */
    private $PersonInfo;

    /**
     * @return int
     */
    public function getSimilarity(): int
    {
        return $this->Similarity;
    }

    /**
     * @param int $Similarity
     */
    public function setSimilarity(int $Similarity): void
    {
        $this->Similarity = $Similarity;
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
     * @return PersonInfo
     */
    public function getPersonInfo(): PersonInfo
    {
        return $this->PersonInfo;
    }

    /**
     * @param PersonInfo $PersonInfo
     */
    public function setPersonInfo(PersonInfo $PersonInfo): void
    {
        $this->PersonInfo = $PersonInfo;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["Similarity"])) {
            $this->Similarity = $param["Similarity"];
        }

        if (isset($param["PersonType"])) {
            $this->PersonType = $param["PersonType"];
        }

        // 封装 PersonInfo 对象
        $this->PersonInfo = new PersonInfo();
        $this->PersonInfo->deserialize($param);

    }

}