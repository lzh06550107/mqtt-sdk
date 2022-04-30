<?php
/**
 * 文件描述
 * Created on 2022/2/11 17:36
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetBatchAddProgressResponse extends AbstractResponse
{
    /**
     * @var int 图片底库当前总数量
     */
    private $CompletedNumber;

    /**
     * @var int 待提取数量
     */
    private $WaitingNumber;

    /**
     * @return int
     */
    public function getCompletedNumber(): int
    {
        return $this->CompletedNumber;
    }

    /**
     * @param int $CompletedNumber
     */
    public function setCompletedNumber(int $CompletedNumber): void
    {
        $this->CompletedNumber = $CompletedNumber;
    }

    /**
     * @return int
     */
    public function getWaitingNumber(): int
    {
        return $this->WaitingNumber;
    }

    /**
     * @param int $WaitingNumber
     */
    public function setWaitingNumber(int $WaitingNumber): void
    {
        $this->WaitingNumber = $WaitingNumber;
    }

    public function deserialize($param)
    {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["CompletedNumber"])) {
            $this->CompletedNumber = $param["CompletedNumber"];
        }

        if (isset($param["WaitingNumber"])) {
            $this->WaitingNumber = $param["WaitingNumber"];
        }
    }
}