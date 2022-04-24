<?php
/**
 * 文件描述
 * Created on 2022/2/12 14:52
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 人脸识别报警参数配置类
 * Created on 2022/2/12 14:52
 * Create by LZH
 */
class AlarmCfg extends AbstractModel
{
    /**
     * @var int 报警开关 0：关闭；1：开启
     */
    public $FaceAlarmEnabled;

    /**
     * @var int 黑名单报警开关 0：关闭；1：开启
     */
    public $BlackListAlarmEnabled;

    /**
     * @var int 白名单报警开关 0：关闭；1：开启
     */
    public $WhiteListAlarmEnabled;

    /**
     * @var int VIP名单报警开关 0：关闭；1：开启
     */
    public $VIPListAlarmEnabled;

    /**
     * @var int 非白名单报警开关 0：关闭；1：开启
     */
    public $NonWhiteListAlarmEnabled;

    /**
     * @var int IO输出开关 0：关闭；1：开启
     */
    public $IOAlarmEnabled;

    /**
     * @var int IO输出状态类型 0：常开；1：常闭
     */
    public $IOStateType;

    /**
     * @var int IO输出信号类型 0：持续输出；1：脉冲输出
     */
    public $IOSignalType;

    /**
     * @var int 报警输出持续时间（秒为单位）
     */
    public $IOAlarmTime;

    /**
     * @var int 人脸识别模式 0：次数识别；1：一直识别；2：单张识别
     */
    public $FaceAlarmMode;

    /**
     * @var int 人脸识别次数，注：”次数识别”模式特有参数(FaceAlarmMode=0)，其它模式无效
     */
    public $FaceAlarmTimes;

    /**
     * @var int 人脸识别相似度
     */
    public $Similarity;

    /**
     * @var int 名单识别过滤时间(秒为单位)，同一名单间隔时间内只识别一次，目前仅比对机支持
     */
    public $PersonsTime;

    /**
     * @var int 陌生人过滤时间(秒为单位)，目前仅比对机支持
     */
    public $StrangersTime;

    /**
     * @var TimeTable[] 布防时间段(支持两个时间段)
     */
    public $TimeTable;

    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (isset($param["ChannelNo"])) {
            $this->ChannelNo = $param["ChannelNo"];
        }

        if (isset($param["FaceAlarmEnabled"])) {
            $this->FaceAlarmEnabled = $param["FaceAlarmEnabled"];
        }

        if (isset($param["BlackListAlarmEnabled"])) {
            $this->BlackListAlarmEnabled = $param["BlackListAlarmEnabled"];
        }

        if (isset($param["WhiteListAlarmEnabled"])) {
            $this->WhiteListAlarmEnabled = $param["WhiteListAlarmEnabled"];
        }

        if (isset($param["VIPListAlarmEnabled"])) {
            $this->VIPListAlarmEnabled = $param["VIPListAlarmEnabled"];
        }

        if (isset($param["NonWhiteListAlarmEnabled"])) {
            $this->NonWhiteListAlarmEnabled = $param["NonWhiteListAlarmEnabled"];
        }

        if (isset($param["IOAlarmEnabled"])) {
            $this->IOAlarmEnabled = $param["IOAlarmEnabled"];
        }

        if (isset($param["IOStateType"])) {
            $this->IOStateType = $param["IOStateType"];
        }

        if (isset($param["IOSignalType"])) {
            $this->IOSignalType = $param["IOSignalType"];
        }

        if (isset($param["IOAlarmTime"])) {
            $this->IOAlarmTime = $param["IOAlarmTime"];
        }

        if (isset($param["FaceAlarmMode"])) {
            $this->FaceAlarmMode = $param["FaceAlarmMode"];
        }

        if (isset($param["FaceAlarmTimes"])) {
            $this->FaceAlarmTimes = $param["FaceAlarmTimes"];
        }

        if (isset($param["Similarity"])) {
            $this->Similarity = $param["Similarity"];
        }

        if (isset($param["PersonsTime"])) {
            $this->PersonsTime = $param["PersonsTime"];
        }

        if (isset($param["StrangersTime"])) {
            $this->StrangersTime = $param["StrangersTime"];
        }

        if (isset($param["TimeTable"])) {
            $timeTables = [];
            foreach ($param['TimeTable'] as $timeTable) {
                $timeTableObj = new TimeTable();
                $timeTableObj->deserialize($timeTable);
                $timeTables[] = $timeTableObj;
            }
            $this->TimeTable = $timeTables;
        }

    }
}