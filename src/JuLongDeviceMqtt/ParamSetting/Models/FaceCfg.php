<?php
/**
 * 文件描述
 * Created on 2022/2/14 12:03
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 人脸识别参数配置类
 * Created on 2022/2/14 12:03
 * Create by LZH
 */
class FaceCfg extends AbstractModel
{
    /**
     * @var int 人脸识别功能开关 0：关闭；1：开启
     */
    public $FaceEnabled;

    /**
     * @var int 人脸识别灵敏度
     */
    public $Sensitivity;

    /**
     * @var int 抓拍模式 0：离开后抓拍（距离优先）；1：快速抓拍；2：间隔抓拍（以秒为单位）；3：间隔抓拍（以秒为单位）；4：单人模式（门禁机仅有该模式）；5：离开后抓拍(质量选优)；6：快速+离开后抓拍(抓拍机没有该选项)；7：全抓模式
     */
    public $CaptureMode;

    /**
     * @var CaptureModeParam 各抓拍模式下所需参数
     */
    public $CaptureModeParam;

    /**
     * @var int 人脸识别最大像素
     */
    public $MaxFaceSize;

    /**
     * @var int 人脸识别最小像素
     */
    public $MinFaceSize;

    /**
     * @var int 人脸周边区域扩展系数(抓拍机特有)
     */
    public $FaceAreaSize;

    /**
     * @var int 人脸测温最小像素(测温机特有)
     */
    public $MinFaceTempSize;

    /**
     * @var int 人脸识别场景模式 0：常规模式；1：大堂模式
     */
    public $SceneMode;

    /**
     * @var int 人脸跟踪框 0：关闭；1：开启
     */
    public $FaceTrackEnabled;

    /**
     * @var int FTP 上传人脸抓拍 0：关闭；1：开启
     */
    public $FTPUploadEnabled;

    /**
     * @var int 私有协议上传（抓拍机特有） 0：关闭；1：开启
     */
    public $PrivateProtocol;

    /**
     * @var int 图片上传格式 0：人脸图片；1：场景原图；2：人脸及原图
     */
    public $PictureMode;

    /**
     * @var int 人脸图片质量
     */
    public $FacePictureQuality;

    /**
     * @var int 场景图片质量，PictureMode为1、2时有效
     */
    public $ScenePictureQuality;

    /**
     * @var PicturePrefix 人脸图片名（比视机特有）
     */
    public $PicturePrefix;

    /**
     * @var int 人脸属性检测（抓拍机没有该选项） 0：关闭；1：开启
     */
    public $FaceAttributeEnabled;

    /**
     * @var int 活体检测（设备需要支持活体检测） 0：关闭；1：开启
     */
    public $HumanDetection;

    /**
     * @var int 活体阈值（设备需要支持活体检测），HumanDetection为1时有效
     */
    public $HumanThreshold;

    /**
     * @var int 功能优先（门禁机特有） 0：速度优先；1：活体优先
     */
    public $DetectionPriority;

    /**
     * @var PictureCompression 图片压缩，仅带”压缩”配置的设备支持
     */
    public $PictureCompression;

    /**
     * @var TimeTable 布防时间段(支持2个时间段)
     */
    public $TimeTable;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["FaceEnabled"])) {
            $this->FaceEnabled = $param["FaceEnabled"];
        }

        if (isset($param["Sensitivity"])) {
            $this->Sensitivity = $param["Sensitivity"];
        }

        if (isset($param["CaptureMode"])) {
            $this->CaptureMode = $param["CaptureMode"];
        }

        if (isset($param["CaptureModeParam"])) {
            $captureModeParam = new CaptureModeParam();
            $captureModeParam->deserialize($param['CaptureModeParam']);
            $this->CaptureModeParam = $captureModeParam;
        }

        if (isset($param["MaxFaceSize"])) {
            $this->MaxFaceSize = $param["MaxFaceSize"];
        }

        if (isset($param["MinFaceSize"])) {
            $this->MinFaceSize = $param["MinFaceSize"];
        }

        if (isset($param["FaceAreaSize"])) {
            $this->FaceAreaSize = $param["FaceAreaSize"];
        }

        if (isset($param["MinFaceTempSize"])) {
            $this->MinFaceTempSize = $param["MinFaceTempSize"];
        }

        if (isset($param["SceneMode"])) {
            $this->SceneMode = $param["SceneMode"];
        }

        if (isset($param["FaceTrackEnabled"])) {
            $this->FaceTrackEnabled = $param["FaceTrackEnabled"];
        }

        if (isset($param["FTPUploadEnabled"])) {
            $this->FTPUploadEnabled = $param["FTPUploadEnabled"];
        }

        if (isset($param["PrivateProtocol"])) {
            $this->PrivateProtocol = $param["PrivateProtocol"];
        }

        if (isset($param["PictureMode"])) {
            $this->PictureMode = $param["PictureMode"];
        }

        if (isset($param["FacePictureQuality"])) {
            $this->FacePictureQuality = $param["FacePictureQuality"];
        }

        if (isset($param["ScenePictureQuality"])) {
            $this->ScenePictureQuality = $param["ScenePictureQuality"];
        }

        if (isset($param["PicturePrefix"])) {
            $this->PicturePrefix = $param["PicturePrefix"];
        }

        if (isset($param["FaceAttributeEnabled"])) {
            $this->FaceAttributeEnabled = $param["FaceAttributeEnabled"];
        }

        if (isset($param["HumanDetection"])) {
            $this->HumanDetection = $param["HumanDetection"];
        }

        if (isset($param["HumanThreshold"])) {
            $this->HumanThreshold = $param["HumanThreshold"];
        }

        if (isset($param["DetectionPriority"])) {
            $this->DetectionPriority = $param["DetectionPriority"];
        }

        if (isset($param["PictureCompression"])) {
            $pictureCompression = new PictureCompression();
            $pictureCompression->deserialize($param["PictureCompression"]);
            $this->PictureCompression = $pictureCompression;
        }

        if (isset($param["TimeTable"])) {
            $timeTables = [];
            foreach ($param['TimeTable'] as $table) {
                $timeTableObj = new TimeTable();
                $timeTableObj->deserialize($table);
                $timeTables[] = $timeTableObj;
            }
            $this->TimeTable = $timeTables;
        }

    }
}