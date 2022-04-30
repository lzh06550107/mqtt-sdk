<?php
/**
 * 文件描述
 * Created on 2022/2/14 11:18
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 网络参数设置
 * Created on 2022/2/14 16:52
 * Create by LZH
 *
 * @method setNetCfg(NetCfg $NetCfg) 网络参数配置
 */
class SetNetCfgRequest extends AbstractRequest {

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::SET_NET_CFG); // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["NetCfg"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this, 1); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}