<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 获取人脸识别报警参数(抓拍机、比对机支持)的请求
 * Created on 2022/2/12 12:02
 * Create by LZH
 */
class GetAlarmCfgRequest extends AbstractRequest
{
    /**
     * @var int 通道号(NVR服务器需要用到，该通道号对应前端IPC)
     */
    private $ChannelNo;

    /**
     * @return int
     */
    public function getChannelNo(): int
    {
        return $this->ChannelNo;
    }

    /**
     * @param int $ChannelNo
     */
    public function setChannelNo(int $ChannelNo): void
    {
        $this->ChannelNo = $ChannelNo;
    }

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::GET_ALARM_CFG); // 初始化动作名称
    }
}