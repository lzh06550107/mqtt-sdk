<?php
/**
 * 文件描述
 * Created on 2022/2/15 13:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetHistoryRecordResponse extends AbstractResponse
{
    /**
     * @var int 历史数据上传状态 0：空闲；1：上传中
     */
    private $Status;

    /**
     * @var int 本次将上报的数目
     */
    private $TotalCount;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->Status;
    }

    /**
     * @param int $Status
     */
    public function setStatus(int $Status): void
    {
        $this->Status = $Status;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->TotalCount;
    }

    /**
     * @param int $TotalCount
     */
    public function setTotalCount(int $TotalCount): void
    {
        $this->TotalCount = $TotalCount;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param['Status'])) {
            $this->Status = $param['Status'];
        }

        if (isset($param['TotalCount'])) {
            $this->TotalCount = $param['TotalCount'];
        }

    }
}