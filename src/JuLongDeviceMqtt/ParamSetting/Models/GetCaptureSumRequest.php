<?php
/**
 * 文件描述
 * Created on 2022/2/15 13:36
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 抓拍比对记录总数查询(门禁机支持)
 * Created on 2022/2/15 13:36
 * Create by LZH
 */
class GetCaptureSumRequest extends AbstractRequest
{
    /**
     * @var int 通道号(NVR服务器需要用到，不填默认0，该通道号对应前端IPC)
     */
    public $ChannelNo;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss
     */
    public $BeginTime;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::GET_CAPTURE_SUM; // 初始化动作名称
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["ChannelNo"])) {
            $this->ChannelNo = $param["ChannelNo"];
        }

        if (isset($param["BeginTime"])) {
            $this->BeginTime = $param["BeginTime"];
        }

        if (isset($param["EndTime"])) {
            $this->EndTime = $param["EndTime"];
        }
    }
}