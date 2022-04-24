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
    public $CaptureEnabled;

    /**
     * @var string 抓拍比对信息推送地址
     */
    public $CaptureAddress;

    /**
     * @var int 抓拍比对信息上传类型（比对机特有选项） 0：所有人上传；1：比对成功上传；2：黑名单上传；3：白名单上传；4：VIP名单上传；5：陌生人上传；6：非白名单上传
     */
    public $CaptureType;

    /**
     * @var CaptureContent 抓拍信息上传内容
     */
    public $CaptureContent;

    /**
     * @var PictureData 抓拍信息所包含的图片数据
     */
    public $PictureData;

    /**
     * @var int 重传次数
     */
    public $ResendTimes;

    /**
     * @var int 注册功能 0：不开启注册；1：开启注册
     */
    public $RegisterEnabled;

    /**
     * @var string 注册额信息推送地址
     */
    public $RegisterAddress;

    /**
     * @var int 上传心跳信息 0：不上传；1：上传
     */
    public $HeartbeatEnabled;

    /**
     * @var string 心跳信息推送地址
     */
    public $HeartbeatAddress;

    /**
     * @var int 心跳推送间隔(单位秒)
     */
    public $HeartbeatInterval;

    /**
     * @var string 主动获取任务推送地址
     */
    public $EventAddress;

    /**
     * @var string 任务结果上报地址
     */
    public $ResultAddress;

    /**
     * @var int 中心连接 0：关闭；1：开启
     */
    public $MiddlewareEnabled;

    /**
     * @var int 中心连接 0：关闭；1：开启
     */
    public $MiddlewareAddress;

    /**
     * @var int Sign验证 0：关闭；1：开启
     */
    public $SignCheck;

    /**
     * @var int 运行模式 0：脱机模式；1：在线模式
     */
    public $Mode;

    /**
     * @var string 验证信息推送地址 格式: http://server/path
     */
    public $VerifyAddress;

    /**
     * @var string 通知信息推送地址 格式: http://server/path
     */
    public $NoticeAddress;

    /**
     * @var string 历史记录上传地址 格式: http://server/path
     */
    public $HistoryRecordAddress;

    /**
     * @var string 当前HTTP版本 0：1.0.x；1:1.1.x/2.0.x
     */
    public $HTTPVersion;

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