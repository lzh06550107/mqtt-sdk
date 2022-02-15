<?php
/**
 * 文件描述
 * Created on 2022/2/14 16:35
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 网络参数配置类
 * Created on 2022/2/14 16:35
 * Create by LZH
 */
class NetCfg extends AbstractModel
{
    /**
     * @var int 动态IP 0：关闭；1：开启
     */
    public $DHCPEnabled;

    /**
     * @var string IP地址
     */
    public $IPAddress;

    /**
     * @var string 子网掩码
     */
    public $SubNetMask;

    /**
     * @var string 网关
     */
    public $Gateway;

    /**
     * @var string 首选DNS服务器地址
     */
    public $DNS1;

    /**
     * @var string 备用DNS服务器地址
     */
    public $DNS2;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (isset($param['DHCPEnabled'])) {
            $this->DHCPEnabled = $param['DHCPEnabled'];
        }

        if (isset($param['IPAddress'])) {
            $this->IPAddress = $param['IPAddress'];
        }

        if (isset($param['SubNetMask'])) {
            $this->SubNetMask = $param['SubNetMask'];
        }

        if (isset($param['Gateway'])) {
            $this->Gateway = $param['Gateway'];
        }

        if (isset($param['DNS1'])) {
            $this->DNS1 = $param['DNS1'];
        }

        if (isset($param['DNS2'])) {
            $this->DNS2 = $param['DNS2'];
        }

    }
}