<?php
/**
 * 文件描述
 * Created on 2022/1/21 9:47
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage;

use JuLongDeviceMqtt\Common\Topic;

/**
 * 人脸管理主题
 * Created on 2022/1/21 9:48
 * Create by LZH
 */
class SmartFaceTopic extends Topic
{

    /**
     * 初始化人脸主题
     * @param string $UUIDORCustom 设备uuid或者自定义主题
     * @param string $name 主题名称
     * @param string $prefix 主题前缀
     */
    public function __construct(string $UUIDORCustom, string $name = 'SmartFace', string $prefix = 'mqtt')
    {
        parent::__construct($name, $UUIDORCustom);
    }


}