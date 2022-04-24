<?php
/**
 * 文件描述
 * Created on 2022/2/15 13:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 平台获取历史记录(门禁机支持)
 * Created on 2022/2/15 13:58
 * Create by LZH
 */
class GetHistoryRecordRequest extends AbstractRequest
{
    /**
     * @var int 通道号 （NVR）
     */
    public $ChannelNo;

    /**
     * @var int 获取记录指令 0：获取上报状态；1：获取上报记录；2：取消上报记录(上报中途取消)
     */
    public $Type;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss，Type为1时有该字段
     */
    public $BeginTime;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss，Type为1时有该字段
     */
    public $EndTime;

    /**
     * @var int 乘车类型：1上车  2下车
     */
    public $RideType;

    /**
     * @var 0：所有；1：学生；2：家长
     */
    public $PersonIdentity;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_HISTORY_RECORD; // 初始化动作名称
    }
}