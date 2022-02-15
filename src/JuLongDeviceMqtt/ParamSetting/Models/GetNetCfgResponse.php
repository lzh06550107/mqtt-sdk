<?php
/**
 * 文件描述
 * Created on 2022/2/14 16:17
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetNetCfgResponse extends AbstractResponse
{
    /**
     * @var NetCfg 网络参数配置类
     */
    public $NetCfg;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $netCfg = new NetCfg();
        $netCfg->deserialize($param);
        $this->NetCfg = $netCfg;

    }

}