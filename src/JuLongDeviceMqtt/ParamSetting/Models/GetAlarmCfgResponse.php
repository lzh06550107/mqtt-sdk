<?php
/**
 * 文件描述
 * Created on 2022/2/12 12:04
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * 获取人脸识别报警参数(抓拍机、比对机支持)的响应
 * Created on 2022/2/12 12:04
 * Create by LZH
 */
class GetAlarmCfgResponse extends AbstractResponse
{
    /**
     * @var int 通道号(NVR服务器需要用到，该通道号对应前端IPC)
     */
    public $ChannelNo;

    /**
     * @var AlarmCfg 人脸识别报警参数配置类
     */
    public $AlarmCfg;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["ChannelNo"])) {
            $this->ChannelNo = $param["ChannelNo"];
        }

        $alarmCfg = new AlarmCfg();
        $alarmCfg->deserialize($param);
        $this->AlarmCfg = $alarmCfg;

    }

}