<?php
/**
 * 文件描述
 * Created on 2022/2/14 16:35
 * Create by LZH
 */

declare(strict_types=1);

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
    private $DHCPEnabled;

    /**
     * @var string IP地址
     */
    private $IPAddress;

    /**
     * @var string 子网掩码
     */
    private $SubNetMask;

    /**
     * @var string 网关
     */
    private $Gateway;

    /**
     * @var string 首选DNS服务器地址
     */
    private $DNS1;

    /**
     * @var string 备用DNS服务器地址
     */
    private $DNS2;

    /**
     * @return int
     */
    public function getDHCPEnabled(): int
    {
        return $this->DHCPEnabled;
    }

    /**
     * @param int $DHCPEnabled
     */
    public function setDHCPEnabled(int $DHCPEnabled): void
    {
        $this->DHCPEnabled = $DHCPEnabled;
    }

    /**
     * @return string
     */
    public function getIPAddress(): string
    {
        return $this->IPAddress;
    }

    /**
     * @param string $IPAddress
     */
    public function setIPAddress(string $IPAddress): void
    {
        $this->IPAddress = $IPAddress;
    }

    /**
     * @return string
     */
    public function getSubNetMask(): string
    {
        return $this->SubNetMask;
    }

    /**
     * @param string $SubNetMask
     */
    public function setSubNetMask(string $SubNetMask): void
    {
        $this->SubNetMask = $SubNetMask;
    }

    /**
     * @return string
     */
    public function getGateway(): string
    {
        return $this->Gateway;
    }

    /**
     * @param string $Gateway
     */
    public function setGateway(string $Gateway): void
    {
        $this->Gateway = $Gateway;
    }

    /**
     * @return string
     */
    public function getDNS1(): string
    {
        return $this->DNS1;
    }

    /**
     * @param string $DNS1
     */
    public function setDNS1(string $DNS1): void
    {
        $this->DNS1 = $DNS1;
    }

    /**
     * @return string
     */
    public function getDNS2(): string
    {
        return $this->DNS2;
    }

    /**
     * @param string $DNS2
     */
    public function setDNS2(string $DNS2): void
    {
        $this->DNS2 = $DNS2;
    }

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