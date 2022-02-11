<?php
/**
 * 文件描述
 * Created on 2022/1/21 11:09
 * Create by LZH
 */

namespace JuLongDeviceMqtt;

use JuLongDeviceMqtt\Common\Topic;

/**
 * 人脸和参数配置结果应答主题
 * Created on 2022/1/21 11:09
 * Create by LZH
 */
class AckTopic extends Topic
{
    /**
     * 构造函数
     * @param string $UUIDORCustom 设备uuid或者自定义主题
     * @param string $name 主题名称
     * @param string $prefix 主题前缀
     */
    public function __construct(string $UUIDORCustom, string $name = 'Ack', string $prefix = 'mqtt')
    {
        parent::__construct($name, $UUIDORCustom);
    }
}