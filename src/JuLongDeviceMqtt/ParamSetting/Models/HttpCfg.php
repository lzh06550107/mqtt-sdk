<?php
/**
 * 文件描述
 * Created on 2022/2/14 9:55
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

class HttpCfg extends AbstractModel
{
    /**
     * @var int 抓拍比对上传信息 0：不上传；1：上传
     */
    private $CaptureEnabled;

    /**
     * @var string 抓拍比对信息推送地址
     */
    private $CaptureAddress;

    /**
     * @var int 抓拍比对信息上传类型（比对机特有选项） 0：所有人上传；1：比对成功上传；2：黑名单上传；3：白名单上传；4：VIP名单上传；5：陌生人上传；6：非白名单上传
     */
    private $CaptureType;

    /**
     * @var CaptureContent 抓拍信息上传内容
     */
    private $CaptureContent;

    /**
     * @var PictureData 抓拍信息所包含的图片数据
     */
    private $PictureData;

    /**
     * @var int 重传次数
     */
    private $ResendTimes;

    /**
     * @var int 注册功能 0：不开启注册；1：开启注册
     */
    private $RegisterEnabled;

    /**
     * @var string 注册额信息推送地址
     */
    private $RegisterAddress;

    /**
     * @var int 上传心跳信息 0：不上传；1：上传
     */
    private $HeartbeatEnabled;

    /**
     * @var string 心跳信息推送地址
     */
    private $HeartbeatAddress;

    /**
     * @var int 心跳推送间隔(单位秒)
     */
    private $HeartbeatInterval;

    /**
     * @var string 主动获取任务推送地址
     */
    private $EventAddress;

    /**
     * @var string 任务结果上报地址
     */
    private $ResultAddress;

    /**
     * @var int 中心连接 0：关闭；1：开启
     */
    private $MiddlewareEnabled;

    /**
     * @var string 中心连接地址
     */
    private $MiddlewareAddress;

    /**
     * @var int Sign验证 0：关闭；1：开启
     */
    private $SignCheck;

    /**
     * @var int 运行模式 0：脱机模式；1：在线模式
     */
    private $Mode;

    /**
     * @var string 验证信息推送地址 格式: http://server/path
     */
    private $VerifyAddress;

    /**
     * @var string 通知信息推送地址 格式: http://server/path
     */
    private $NoticeAddress;

    /**
     * @var string 历史记录上传地址 格式: http://server/path
     */
    private $HistoryRecordAddress;

    /**
     * @var string 当前HTTP版本 0：1.0.x；1:1.1.x/2.0.x
     */
    private $HTTPVersion;

    /**
     * @return int
     */
    public function getCaptureEnabled(): int
    {
        return $this->CaptureEnabled;
    }

    /**
     * @param int $CaptureEnabled
     */
    public function setCaptureEnabled(int $CaptureEnabled): void
    {
        $this->CaptureEnabled = $CaptureEnabled;
    }

    /**
     * @return string
     */
    public function getCaptureAddress(): string
    {
        return $this->CaptureAddress;
    }

    /**
     * @param string $CaptureAddress
     */
    public function setCaptureAddress(string $CaptureAddress): void
    {
        $this->CaptureAddress = $CaptureAddress;
    }

    /**
     * @return int
     */
    public function getCaptureType(): int
    {
        return $this->CaptureType;
    }

    /**
     * @param int $CaptureType
     */
    public function setCaptureType(int $CaptureType): void
    {
        $this->CaptureType = $CaptureType;
    }

    /**
     * @return CaptureContent
     */
    public function getCaptureContent(): CaptureContent
    {
        return $this->CaptureContent;
    }

    /**
     * @param CaptureContent $CaptureContent
     */
    public function setCaptureContent(CaptureContent $CaptureContent): void
    {
        $this->CaptureContent = $CaptureContent;
    }

    /**
     * @return PictureData
     */
    public function getPictureData(): PictureData
    {
        return $this->PictureData;
    }

    /**
     * @param PictureData $PictureData
     */
    public function setPictureData(PictureData $PictureData): void
    {
        $this->PictureData = $PictureData;
    }

    /**
     * @return int
     */
    public function getResendTimes(): int
    {
        return $this->ResendTimes;
    }

    /**
     * @param int $ResendTimes
     */
    public function setResendTimes(int $ResendTimes): void
    {
        $this->ResendTimes = $ResendTimes;
    }

    /**
     * @return int
     */
    public function getRegisterEnabled(): int
    {
        return $this->RegisterEnabled;
    }

    /**
     * @param int $RegisterEnabled
     */
    public function setRegisterEnabled(int $RegisterEnabled): void
    {
        $this->RegisterEnabled = $RegisterEnabled;
    }

    /**
     * @return string
     */
    public function getRegisterAddress(): string
    {
        return $this->RegisterAddress;
    }

    /**
     * @param string $RegisterAddress
     */
    public function setRegisterAddress(string $RegisterAddress): void
    {
        $this->RegisterAddress = $RegisterAddress;
    }

    /**
     * @return int
     */
    public function getHeartbeatEnabled(): int
    {
        return $this->HeartbeatEnabled;
    }

    /**
     * @param int $HeartbeatEnabled
     */
    public function setHeartbeatEnabled(int $HeartbeatEnabled): void
    {
        $this->HeartbeatEnabled = $HeartbeatEnabled;
    }

    /**
     * @return string
     */
    public function getHeartbeatAddress(): string
    {
        return $this->HeartbeatAddress;
    }

    /**
     * @param string $HeartbeatAddress
     */
    public function setHeartbeatAddress(string $HeartbeatAddress): void
    {
        $this->HeartbeatAddress = $HeartbeatAddress;
    }

    /**
     * @return int
     */
    public function getHeartbeatInterval(): int
    {
        return $this->HeartbeatInterval;
    }

    /**
     * @param int $HeartbeatInterval
     */
    public function setHeartbeatInterval(int $HeartbeatInterval): void
    {
        $this->HeartbeatInterval = $HeartbeatInterval;
    }

    /**
     * @return string
     */
    public function getEventAddress(): string
    {
        return $this->EventAddress;
    }

    /**
     * @param string $EventAddress
     */
    public function setEventAddress(string $EventAddress): void
    {
        $this->EventAddress = $EventAddress;
    }

    /**
     * @return string
     */
    public function getResultAddress(): string
    {
        return $this->ResultAddress;
    }

    /**
     * @param string $ResultAddress
     */
    public function setResultAddress(string $ResultAddress): void
    {
        $this->ResultAddress = $ResultAddress;
    }

    /**
     * @return int
     */
    public function getMiddlewareEnabled(): int
    {
        return $this->MiddlewareEnabled;
    }

    /**
     * @param int $MiddlewareEnabled
     */
    public function setMiddlewareEnabled(int $MiddlewareEnabled): void
    {
        $this->MiddlewareEnabled = $MiddlewareEnabled;
    }

    /**
     * @return string
     */
    public function getMiddlewareAddress(): string
    {
        return $this->MiddlewareAddress;
    }

    /**
     * @param string $MiddlewareAddress
     */
    public function setMiddlewareAddress(string $MiddlewareAddress): void
    {
        $this->MiddlewareAddress = $MiddlewareAddress;
    }

    /**
     * @return int
     */
    public function getSignCheck(): int
    {
        return $this->SignCheck;
    }

    /**
     * @param int $SignCheck
     */
    public function setSignCheck(int $SignCheck): void
    {
        $this->SignCheck = $SignCheck;
    }

    /**
     * @return int
     */
    public function getMode(): int
    {
        return $this->Mode;
    }

    /**
     * @param int $Mode
     */
    public function setMode(int $Mode): void
    {
        $this->Mode = $Mode;
    }

    /**
     * @return string
     */
    public function getVerifyAddress(): string
    {
        return $this->VerifyAddress;
    }

    /**
     * @param string $VerifyAddress
     */
    public function setVerifyAddress(string $VerifyAddress): void
    {
        $this->VerifyAddress = $VerifyAddress;
    }

    /**
     * @return string
     */
    public function getNoticeAddress(): string
    {
        return $this->NoticeAddress;
    }

    /**
     * @param string $NoticeAddress
     */
    public function setNoticeAddress(string $NoticeAddress): void
    {
        $this->NoticeAddress = $NoticeAddress;
    }

    /**
     * @return string
     */
    public function getHistoryRecordAddress(): string
    {
        return $this->HistoryRecordAddress;
    }

    /**
     * @param string $HistoryRecordAddress
     */
    public function setHistoryRecordAddress(string $HistoryRecordAddress): void
    {
        $this->HistoryRecordAddress = $HistoryRecordAddress;
    }

    /**
     * @return string
     */
    public function getHTTPVersion(): string
    {
        return $this->HTTPVersion;
    }

    /**
     * @param string $HTTPVersion
     */
    public function setHTTPVersion(string $HTTPVersion): void
    {
        $this->HTTPVersion = $HTTPVersion;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["CaptureEnabled"])) {
            $this->CaptureEnabled = $param["CaptureEnabled"];
        }

        if (isset($param["CaptureAddress"])) {
            $this->CaptureAddress = $param["CaptureAddress"];
        }

        if (isset($param["CaptureType"])) {
            $this->CaptureType = $param["CaptureType"];
        }

        if (isset($param["CaptureContent"])) {
            $this->CaptureContent = $param["CaptureContent"];
        }

        if (isset($param["CaptureContent"])) {
            $captureContent = new CaptureContent();
            $captureContent->deserialize($param["CaptureContent"]);
            $this->CaptureContent = $captureContent;
        }

        if (isset($param["PictureData"])) {
            $pictureData = new PictureData();
            $pictureData->deserialize($param['PictureData']);
            $this->PictureData = $pictureData;
        }

        if (isset($param["ResendTimes"])) {
            $this->ResendTimes = $param["ResendTimes"];
        }

        if (isset($param["RegisterEnabled"])) {
            $this->RegisterEnabled = $param["RegisterEnabled"];
        }

        if (isset($param["RegisterAddress"])) {
            $this->RegisterAddress = $param["RegisterAddress"];
        }

        if (isset($param["HeartbeatEnabled"])) {
            $this->HeartbeatEnabled = $param["HeartbeatEnabled"];
        }

        if (isset($param["HeartbeatAddress"])) {
            $this->HeartbeatAddress = $param["HeartbeatAddress"];
        }

        if (isset($param["HeartbeatInterval"])) {
            $this->HeartbeatInterval = $param["HeartbeatInterval"];
        }

        if (isset($param["EventAddress"])) {
            $this->EventAddress = $param["EventAddress"];
        }

        if (isset($param["ResultAddress"])) {
            $this->ResultAddress = $param["ResultAddress"];
        }

        if (isset($param["MiddlewareEnabled"])) {
            $this->MiddlewareEnabled = $param["MiddlewareEnabled"];
        }

        if (isset($param["MiddlewareAddress"])) {
            $this->MiddlewareAddress = $param["MiddlewareAddress"];
        }

        if (isset($param["SignCheck"])) {
            $this->SignCheck = $param["SignCheck"];
        }

        if (isset($param["Mode"])) {
            $this->Mode = $param["Mode"];
        }

        if (isset($param["VerifyAddress"])) {
            $this->VerifyAddress = $param["VerifyAddress"];
        }

        if (isset($param["NoticeAddress"])) {
            $this->NoticeAddress = $param["NoticeAddress"];
        }

        if (isset($param["HistoryRecordAddress"])) {
            $this->HistoryRecordAddress = $param["HistoryRecordAddress"];
        }

        if (isset($param["HTTPVersion"])) {
            $this->HTTPVersion = $param["HTTPVersion"];
        }

    }
}