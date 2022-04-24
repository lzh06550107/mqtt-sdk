<?php
/**
 * 文件描述
 * Created on 2022/2/11 18:13
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting;

use JuLongDeviceMqtt\Common\Topic;

/**
 * 设备配置主题
 * Created on 2022/2/11 18:14
 * Create by LZH
 */
class DeviceConfigureTopic extends Topic
{
    /**
     * 初始化设备配置主题
     * @param string $UUIDORCustom 设备uuid或者自定义主题
     * @param string $name 主题名称
     * @param string $prefix 主题前缀
     */
    public function __construct(string $UUIDORCustom, string $name = 'Configure', string $prefix = 'mqtt')
    {
        parent::__construct($name, $UUIDORCustom);
    }
}