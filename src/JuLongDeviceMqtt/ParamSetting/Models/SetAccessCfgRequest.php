<?php
/**
 * 文件描述
 * Created on 2022/2/12 17:38
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 测温机门禁控制参数设置(门禁机支持)
 * Created on 2022/2/12 17:38
 * Create by LZH
 *
 * @property AccessCfg $AccessCfg 测温机门禁控制参数配置类
 */
class SetAccessCfgRequest extends AbstractRequest
{

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_ACCESS_CFG; // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["AccessCfg"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this, 1); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}