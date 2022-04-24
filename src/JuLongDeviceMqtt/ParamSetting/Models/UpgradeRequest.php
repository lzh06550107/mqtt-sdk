<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:55
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 升级内核文件
 * Created on 2022/2/15 11:56
 * Create by LZH
 */
class UpgradeRequest extends AbstractRequest
{
    /**
     * @var string 文件MD5值，用于校验文件完整性
     */
    public $MD5Sum;

    /**
     * @var string 升级文件下载地址
     */
    public $DownloadURL;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::UPGRADE; // 初始化动作名称
    }

}