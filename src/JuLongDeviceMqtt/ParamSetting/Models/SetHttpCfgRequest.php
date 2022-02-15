<?php
/**
 * 文件描述
 * Created on 2022/2/14 11:18
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * HTTP上传参数设置
 * Created on 2022/2/14 11:18
 * Create by LZH
 *
 * @property HttpCfg $HttpCfg http参数配置
 */
class SetHttpCfgRequest extends AbstractRequest
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_HTTP_CFG; // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["HttpCfg"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this, 1); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}