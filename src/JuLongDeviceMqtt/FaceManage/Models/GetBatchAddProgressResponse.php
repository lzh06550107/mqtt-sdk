<?php
/**
 * 文件描述
 * Created on 2022/2/11 17:36
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetBatchAddProgressResponse extends AbstractResponse
{
    /**
     * @var int 图片底库当前总数量
     */
    public $CompletedNumber;

    /**
     * @var int 待提取数量
     */
    public $WaitingNumber;

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