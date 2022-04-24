<?php
/**
 * 文件描述
 * Created on 2022/2/14 15:11
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 人脸识别参数设置
 * Created on 2022/2/14 15:11
 * Create by LZH
 *
 * @property FaceCfg $FaceCfg 人脸识别参数配置类
 */
class SetFaceCfgRequest extends AbstractRequest
{

    /**
     * @var int 通道号(NVR服务器需要用到，该通道号对应前端IPC)
     */
    public $ChannelNo;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_FACE_CFG; // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["FaceCfg"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this, 1); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}