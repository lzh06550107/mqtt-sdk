<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:27
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 恢复出厂
 * Created on 2022/2/15 11:28
 * Create by LZH
 */
class RestoreRequest extends AbstractRequest
{
    /**
     * @var int 网络参数恢复默认(IP、DNS等) 0：不恢复；1：恢复
     */
    public $NetworkReset;

    /**
     * @var int 用户名密码恢复默认 0：不恢复；1：恢复
     */
    public $AccountReset;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::RESTORE; // 初始化动作名称
    }
}