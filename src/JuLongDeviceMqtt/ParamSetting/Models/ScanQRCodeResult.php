<?php
/**
 * 文件描述
 * Created on 2022/2/15 14:38
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 对上报的二维码进行二次校验后，下发给设备
 * Created on 2022/2/15 14:39
 * Create by LZH
 */
class ScanQRCodeResult extends AbstractRequest
{
    /**
     * @var int 二维码扫码结果
     *
     * 0:绿码请通行(开门+语音提示)
    1:橙码禁止通行(语音提示)
    2:红码禁止通行(语音提示)
    3:人脸未采集，禁止通行(语音提示)
    4:未知身份，禁止通行(语音提示)
    5:访客无权限通行(语音提示)
    6:系统繁忙(语音提示)
     */
    public $PassStatus;

    /**
     * @var string 二维码数据
     */
    public $QRCodeData;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SCAN_ORCODE; // 初始化动作名称
    }
}