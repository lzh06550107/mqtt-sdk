<?php
/**
 * 文件描述
 * Created on 2022/2/12 14:50
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 人脸识别报警参数设置(抓拍机、比对机支持)
 * Created on 2022/2/12 14:50
 * Create by LZH
 *
 * @property AlarmCfg $AlarmCfg 人脸识别报警参数配置类
 */
class SetAlarmCfgRequest extends AbstractRequest
{
    public $ChannelNo;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_ALARM_CFG; // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["AlarmCfg"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}