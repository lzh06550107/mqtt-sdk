<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:48
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * IO控制
 * Created on 2022/2/15 11:48
 * Create by LZH
 */
class IOControlRequest extends AbstractRequest
{
    /**
     * @var int IO输出持续时间(以秒为单位)
     */
    private $ContinueSeconds;

    /**
     * @return int
     */
    public function getContinueSeconds(): int
    {
        return $this->ContinueSeconds;
    }

    /**
     * @param int $ContinueSeconds
     */
    public function setContinueSeconds(int $ContinueSeconds): void
    {
        $this->ContinueSeconds = $ContinueSeconds;
    }

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::IO_CONTROL); // 初始化动作名称
    }
}