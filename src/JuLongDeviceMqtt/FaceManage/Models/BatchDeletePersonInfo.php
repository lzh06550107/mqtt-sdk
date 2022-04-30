<?php
/**
 * 文件描述
 * Created on 2022/2/10 16:49
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 批量删除人员信息
 * Created on 2022/2/10 16:49
 * Create by LZH
 */
class BatchDeletePersonInfo extends AbstractModel
{
    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    private $PersonType;

    /**
     * @var string 人员ID
     */
    private $PersonId;

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

}