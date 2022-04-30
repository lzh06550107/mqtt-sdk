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
    private $NetworkReset;

    /**
     * @var int 用户名密码恢复默认 0：不恢复；1：恢复
     */
    private $AccountReset;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::RESTORE); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getNetworkReset(): int
    {
        return $this->NetworkReset;
    }

    /**
     * @param int $NetworkReset
     */
    public function setNetworkReset(int $NetworkReset): void
    {
        $this->NetworkReset = $NetworkReset;
    }

    /**
     * @return int
     */
    public function getAccountReset(): int
    {
        return $this->AccountReset;
    }

    /**
     * @param int $AccountReset
     */
    public function setAccountReset(int $AccountReset): void
    {
        $this->AccountReset = $AccountReset;
    }

}