<?php
/**
 * 文件描述
 * Created on 2022/2/14 11:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 人脸识别参数获取
 * Created on 2022/2/14 11:58
 * Create by LZH
 */
class GetFaceCfgRequest extends AbstractRequest
{
    /**
     * @var int 通道号(NVR服务器需要用到，该通道号对应前端IPC)
     */
    private $ChannelNo;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::GET_FACE_CFG); // 初始化动作名称
    }

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


}