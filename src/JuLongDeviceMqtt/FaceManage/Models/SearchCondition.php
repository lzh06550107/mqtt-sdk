<?php
/**
 * 文件描述
 * Created on 2022/2/8 9:37
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 搜索条件
 * Created on 2022/2/8 9:38
 * Create by LZH
 */
class SearchCondition extends AbstractModel
{
    /**
     * @var int 查找方式 0：条件查找；1：姓名模糊查找；2：重复身份证号查找；3：重复门禁卡号查找
     */
    private $SearchMethod;

    /**
     * @var string|null 姓名，SearchMethod为1时必填
     */
    private $Name;

    /**
     * @var string|null 人员有效开始时间 格式: yyyy-mm-dd hh:mm:ss，SearchMethod为0时必填
     */
    private $StartTime;

    /**
     * @var string|null 人员有效开始时间 格式: yyyy-mm-dd hh:mm:ss，SearchMethod为0时必填
     */
    private $EndTime;

    /**
     * @var int|null 名单时效 0：永久有效；1：临时有效；2：所有，SearchMethod为0时必填
     */
    private $LimitTime;

    /**
     * @var int|null 人员身份类型，用于名单分类 0：所有；1：老师；2：走读(学生)；3：寄宿(学生)；4：访客，SearchMethod为0时必填
     */
    private $PersonIdentity;

    /**
     * @var int[]|null 通行策略ID
     */
    private $StrategyId;

    /**
     * @var int|null 性别 0：所有；1：男；2：女，SearchMethod为0时必填
     */
    private $Sex;

    /**
     * @var int[]|null 年龄范围，SearchMethod为0时必填
     */
    private $AgeRange;

    /**
     * @var int|null 人员ID(对应页面门禁卡号)，SearchMethod为0时可选
     */
    private $PersonId;

    /**
     * @return int
     */
    public function getSearchMethod(): int
    {
        return $this->SearchMethod;
    }

    /**
     * @param int $SearchMethod
     */
    public function setSearchMethod(int $SearchMethod): void
    {
        $this->SearchMethod = $SearchMethod;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * @param string|null $Name
     */
    public function setName(?string $Name): void
    {
        $this->Name = $Name;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->StartTime;
    }

    /**
     * @param string|null $StartTime
     */
    public function setStartTime(?string $StartTime): void
    {
        $this->StartTime = $StartTime;
    }

    /**
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->EndTime;
    }

    /**
     * @param string|null $EndTime
     */
    public function setEndTime(?string $EndTime): void
    {
        $this->EndTime = $EndTime;
    }

    /**
     * @return int|null
     */
    public function getLimitTime(): ?int
    {
        return $this->LimitTime;
    }

    /**
     * @param int|null $LimitTime
     */
    public function setLimitTime(?int $LimitTime): void
    {
        $this->LimitTime = $LimitTime;
    }

    /**
     * @return int|null
     */
    public function getPersonIdentity(): ?int
    {
        return $this->PersonIdentity;
    }

    /**
     * @param int|null $PersonIdentity
     */
    public function setPersonIdentity(?int $PersonIdentity): void
    {
        $this->PersonIdentity = $PersonIdentity;
    }

    /**
     * @return int[]|null
     */
    public function getStrategyId(): ?array
    {
        return $this->StrategyId;
    }

    /**
     * @param int[]|null $StrategyId
     */
    public function setStrategyId(?array $StrategyId): void
    {
        $this->StrategyId = $StrategyId;
    }

    /**
     * @return int|null
     */
    public function getSex(): ?int
    {
        return $this->Sex;
    }

    /**
     * @param int|null $Sex
     */
    public function setSex(?int $Sex): void
    {
        $this->Sex = $Sex;
    }

    /**
     * @return int[]|null
     */
    public function getAgeRange(): ?array
    {
        return $this->AgeRange;
    }

    /**
     * @param int[]|null $AgeRange
     */
    public function setAgeRange(?array $AgeRange): void
    {
        $this->AgeRange = $AgeRange;
    }

    /**
     * @return int|null
     */
    public function getPersonId(): ?int
    {
        return $this->PersonId;
    }

    /**
     * @param int|null $PersonId
     */
    public function setPersonId(?int $PersonId): void
    {
        $this->PersonId = $PersonId;
    }

}