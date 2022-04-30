<?php
/**
 * 文件描述
 * Created on 2022/2/15 13:37
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetCaptureSumResponse extends AbstractResponse
{
    /**
     * @var int 抓拍数
     */
    private $CaptureSum;

    /**
     * @return int
     */
    public function getCaptureSum(): int
    {
        return $this->CaptureSum;
    }

    /**
     * @param int $CaptureSum
     */
    public function setCaptureSum(int $CaptureSum): void
    {
        $this->CaptureSum = $CaptureSum;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param['CaptureSum'])) {
            $this->CaptureSum = $param['CaptureSum'];
        }

    }

}