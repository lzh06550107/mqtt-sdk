<?php
/**
 * 文件描述
 * Created on 2022/2/15 14:25
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 删除历史识别记录
 * Created on 2022/2/15 14:25
 * Create by LZH
 */
class DeleteRecordRequest extends AbstractRequest
{
    /**
     * @var int 1：按时间段删除
     */
    public $Mode;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss，不传默认从第一条开始
     */
    public $BeginTime;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss，不传默认到最后一条结束
     */
    public $EndTime;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::DELETE_RECORD; // 初始化动作名称
    }

}