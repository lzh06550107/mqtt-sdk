<?php
/**
 * 文件描述
 * Created on 2022/2/14 15:13
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class SetFaceCfgResponse extends AbstractResponse
{
    /**
     * @var int 通道号(NVR服务器需要用到，该通道号对应前端IPC)
     */
    public $ChannelNo;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param['ChannelNo'])) {
            $this->ChannelNo = $param['ChannelNo'];
        }

    }
}