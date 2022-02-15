<?php
/**
 * 文件描述
 * Created on 2022/2/14 17:23
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 时间服务器配置类
 * Created on 2022/2/14 17:23
 * Create by LZH
 */
class NTPServer extends AbstractModel
{
    /**
     * @var string 服务器
     */
    public $Server;

    /**
     * @var int 端口
     */
    public $Port;

    /**
     * @var int 更新间隔(单位为分钟)
     */
    public $UpdateInterval;

    /**
     * @var int 时区，TimeMode为0时有效
     *
     * 0:GMT-12:00 安尼威吐克
    1:GMT-11:00 萨摩亚
    2:GMT-10:00 夏威夷
    3:GMT-09:00 阿拉斯加
    4:GMT-08:00 美国&加拿大
    5:GMT-07:00 亚利桑那州
    6:GMT-06:00 墨西哥
    7:GMT-05:00 波哥大
    8:GMT-04:30 印第安纳州东
    9:GMT-04:00 卡拉卡斯
    10:GMT-03:30 纽芬兰
    11:GMT-03:00 乔治城
    12:GMT-02:00 阿根廷中部
    13:GMT-01:00 亚速尔群岛
    14:GMT 伦敦
    15:GMT+01:00 阿姆斯特丹
    16:GMT+01:00 布达佩斯
    17:GMT+01:00 巴黎
    18:GMT+01:00 华沙
    19:GMT+02:00 雅典
    20:GMT+02:00耶路撒冷
    21:GMT+03:00莫斯科
    22:GMT+03:30德黑兰
    23:GMT+04:00阿布达比
    24:GMT+04:30喀布尔
    25:GMT+05:00塔什干
    26:GMT+05:30新德里
    27:GMT+05:45加德满都
    28:GMT+06:00亚斯塔蒂
    29:GMT+06:30仰光
    30:GMT+07:00曼谷
    31:GMT+08:00北京
    32:GMT+09:00东京
    33:GMT+09:30达尔文
    34:GMT+10:00关岛
    35:GMT+11:00 麦哲伦
    36:GMT+12:00 斐济
     */
    public $TimeZone;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (isset($param['Server'])) {
            $this->Server = $param['Server'];
        }

        if (isset($param['Port'])) {
            $this->Port = $param['Port'];
        }

        if (isset($param['UpdateInterval'])) {
            $this->UpdateInterval = $param['UpdateInterval'];
        }

        if (isset($param['TimeZone'])) {
            $this->TimeZone = $param['TimeZone'];
        }

    }
}