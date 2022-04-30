<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:54
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class DeletePersonListResponse extends AbstractResponse
{
    /**
     * @var int 名单类型 0：所有名单(门禁机支持)；1：黑名单；2：白名单；3：VIP名单
     */
    private $PersonType;

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

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["PersonType"])) {
            $this->PersonType = $param["PersonType"];
        }

    }
}