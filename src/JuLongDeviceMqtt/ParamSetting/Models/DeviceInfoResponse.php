<?php
/**
 * 文件描述
 * Created on 2022/2/15 10:23
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * 类文件描述
 * Created on 2022/2/15 10:23
 * Create by LZH
 */
class DeviceInfoResponse extends AbstractResponse
{
    /**
     * @var DeviceInfo 设备查询的信息
     */
    private $DeviceInfo;

    /**
     * @return DeviceInfo
     */
    public function getDeviceInfo(): DeviceInfo
    {
        return $this->DeviceInfo;
    }

    /**
     * @param DeviceInfo $DeviceInfo
     */
    public function setDeviceInfo(DeviceInfo $DeviceInfo): void
    {
        $this->DeviceInfo = $DeviceInfo;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $deviceInfo = new DeviceInfo();
        $deviceInfo->deserialize($param);
        $this->DeviceInfo = $deviceInfo;

    }
}