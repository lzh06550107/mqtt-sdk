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
    private $FaceAlarmEnabled;

    /**
     * @var int 黑名单报警开关 0：关闭；1：开启
     */
    private $BlackListAlarmEnabled;

    /**
     * @var int 白名单报警开关 0：关闭；1：开启
     */
    private $WhiteListAlarmEnabled;

    /**
     * @var int VIP名单报警开关 0：关闭；1：开启
     */
    private $VIPListAlarmEnabled;

    /**
     * @var int 非白名单报警开关 0：关闭；1：开启
     */
    private $NonWhiteListAlarmEnabled;

    /**
     * @var int IO输出开关 0：关闭；1：开启
     */
    private $IOAlarmEnabled;

    /**
     * @var int IO输出状态类型 0：常开；1：常闭
     */
    private $IOStateType;

    /**
     * @var int IO输出信号类型 0：持续输出；1：脉冲输出
     */
    private $IOSignalType;

    /**
     * @var int 报警输出持续时间（秒为单位）
     */
    private $IOAlarmTime;

    /**
     * @var int 人脸识别模式 0：次数识别；1：一直识别；2：单张识别
     */
    private $FaceAlarmMode;

    /**
     * @var int 人脸识别次数，注：”次数识别”模式特有参数(FaceAlarmMode=0)，其它模式无效
     */
    private $FaceAlarmTimes;

    /**
     * @var int 人脸识别相似度
     */
    private $Similarity;

    /**
     * @var int 名单识别过滤时间(秒为单位)，同一名单间隔时间内只识别一次，目前仅比对机支持
     */
    private $PersonsTime;

    /**
     * @var int 陌生人过滤时间(秒为单位)，目前仅比对机支持
     */
    private $StrangersTime;

    /**
     * @var TimeTable[] 布防时间段(支持两个时间段)
     */
    private $TimeTable;

    /**
     * @return int
     */
    public function getFaceAlarmEnabled(): int
    {
        return $this->FaceAlarmEnabled;
    }

    /**
     * @param int $FaceAlarmEnabled
     */
    public function setFaceAlarmEnabled(int $FaceAlarmEnabled): void
    {
        $this->FaceAlarmEnabled = $FaceAlarmEnabled;
    }

    /**
     * @return int
     */
    public function getBlackListAlarmEnabled(): int
    {
        return $this->BlackListAlarmEnabled;
    }

    /**
     * @param int $BlackListAlarmEnabled
     */
    public function setBlackListAlarmEnabled(int $BlackListAlarmEnabled): void
    {
        $this->BlackListAlarmEnabled = $BlackListAlarmEnabled;
    }

    /**
     * @return int
     */
    public function getWhiteListAlarmEnabled(): int
    {
        return $this->WhiteListAlarmEnabled;
    }

    /**
     * @param int $WhiteListAlarmEnabled
     */
    public function setWhiteListAlarmEnabled(int $WhiteListAlarmEnabled): void
    {
        $this->WhiteListAlarmEnabled = $WhiteListAlarmEnabled;
    }

    /**
     * @return int
     */
    public function getVIPListAlarmEnabled(): int
    {
        return $this->VIPListAlarmEnabled;
    }

    /**
     * @param int $VIPListAlarmEnabled
     */
    public function setVIPListAlarmEnabled(int $VIPListAlarmEnabled): void
    {
        $this->VIPListAlarmEnabled = $VIPListAlarmEnabled;
    }

    /**
     * @return int
     */
    public function getNonWhiteListAlarmEnabled(): int
    {
        return $this->NonWhiteListAlarmEnabled;
    }

    /**
     * @param int $NonWhiteListAlarmEnabled
     */
    public function setNonWhiteListAlarmEnabled(int $NonWhiteListAlarmEnabled): void
    {
        $this->NonWhiteListAlarmEnabled = $NonWhiteListAlarmEnabled;
    }

    /**
     * @return int
     */
    public function getIOAlarmEnabled(): int
    {
        return $this->IOAlarmEnabled;
    }

    /**
     * @param int $IOAlarmEnabled
     */
    public function setIOAlarmEnabled(int $IOAlarmEnabled): void
    {
        $this->IOAlarmEnabled = $IOAlarmEnabled;
    }

    /**
     * @return int
     */
    public function getIOStateType(): int
    {
        return $this->IOStateType;
    }

    /**
     * @param int $IOStateType
     */
    public function setIOStateType(int $IOStateType): void
    {
        $this->IOStateType = $IOStateType;
    }

    /**
     * @return int
     */
    public function getIOSignalType(): int
    {
        return $this->IOSignalType;
    }

    /**
     * @param int $IOSignalType
     */
    public function setIOSignalType(int $IOSignalType): void
    {
        $this->IOSignalType = $IOSignalType;
    }

    /**
     * @return int
     */
    public function getIOAlarmTime(): int
    {
        return $this->IOAlarmTime;
    }

    /**
     * @param int $IOAlarmTime
     */
    public function setIOAlarmTime(int $IOAlarmTime): void
    {
        $this->IOAlarmTime = $IOAlarmTime;
    }

    /**
     * @return int
     */
    public function getFaceAlarmMode(): int
    {
        return $this->FaceAlarmMode;
    }

    /**
     * @param int $FaceAlarmMode
     */
    public function setFaceAlarmMode(int $FaceAlarmMode): void
    {
        $this->FaceAlarmMode = $FaceAlarmMode;
    }

    /**
     * @return int
     */
    public function getFaceAlarmTimes(): int
    {
        return $this->FaceAlarmTimes;
    }

    /**
     * @param int $FaceAlarmTimes
     */
    public function setFaceAlarmTimes(int $FaceAlarmTimes): void
    {
        $this->FaceAlarmTimes = $FaceAlarmTimes;
    }

    /**
     * @return int
     */
    public function getSimilarity(): int
    {
        return $this->Similarity;
    }

    /**
     * @param int $Similarity
     */
    public function setSimilarity(int $Similarity): void
    {
        $this->Similarity = $Similarity;
    }

    /**
     * @return int
     */
    public function getPersonsTime(): int
    {
        return $this->PersonsTime;
    }

    /**
     * @param int $PersonsTime
     */
    public function setPersonsTime(int $PersonsTime): void
    {
        $this->PersonsTime = $PersonsTime;
    }

    /**
     * @return int
     */
    public function getStrangersTime(): int
    {
        return $this->StrangersTime;
    }

    /**
     * @param int $StrangersTime
     */
    public function setStrangersTime(int $StrangersTime): void
    {
        $this->StrangersTime = $StrangersTime;
    }

    /**
     * @return TimeTable[]
     */
    public function getTimeTable(): array
    {
        return $this->TimeTable;
    }

    /**
     * @param TimeTable[] $TimeTable
     */
    public function setTimeTable(array $TimeTable): void
    {
        $this->TimeTable = $TimeTable;
    }

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