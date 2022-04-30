<?php
/**
 * 文件描述
 * Created on 2022/2/14 12:03
 * Create by LZH
 */

declare(strict_types=1);

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
    private $FaceEnabled;

    /**
     * @var int 人脸识别灵敏度
     */
    private $Sensitivity;

    /**
     * @var int 抓拍模式 0：离开后抓拍（距离优先）；1：快速抓拍；2：间隔抓拍（以秒为单位）；3：间隔抓拍（以秒为单位）；4：单人模式（门禁机仅有该模式）；5：离开后抓拍(质量选优)；6：快速+离开后抓拍(抓拍机没有该选项)；7：全抓模式
     */
    private $CaptureMode;

    /**
     * @var CaptureModeParam 各抓拍模式下所需参数
     */
    private $CaptureModeParam;

    /**
     * @var int 人脸识别最大像素
     */
    private $MaxFaceSize;

    /**
     * @var int 人脸识别最小像素
     */
    private $MinFaceSize;

    /**
     * @var int 人脸周边区域扩展系数(抓拍机特有)
     */
    private $FaceAreaSize;

    /**
     * @var int 人脸测温最小像素(测温机特有)
     */
    private $MinFaceTempSize;

    /**
     * @var int 人脸识别场景模式 0：常规模式；1：大堂模式
     */
    private $SceneMode;

    /**
     * @var int 人脸跟踪框 0：关闭；1：开启
     */
    private $FaceTrackEnabled;

    /**
     * @var int FTP 上传人脸抓拍 0：关闭；1：开启
     */
    private $FTPUploadEnabled;

    /**
     * @var int 私有协议上传（抓拍机特有） 0：关闭；1：开启
     */
    private $PrivateProtocol;

    /**
     * @var int 图片上传格式 0：人脸图片；1：场景原图；2：人脸及原图
     */
    private $PictureMode;

    /**
     * @var int 人脸图片质量
     */
    private $FacePictureQuality;

    /**
     * @var int 场景图片质量，PictureMode为1、2时有效
     */
    private $ScenePictureQuality;

    /**
     * @var PicturePrefix 人脸图片名（比视机特有）
     */
    private $PicturePrefix;

    /**
     * @var int 人脸属性检测（抓拍机没有该选项） 0：关闭；1：开启
     */
    private $FaceAttributeEnabled;

    /**
     * @var int 活体检测（设备需要支持活体检测） 0：关闭；1：开启
     */
    private $HumanDetection;

    /**
     * @var int 活体阈值（设备需要支持活体检测），HumanDetection为1时有效
     */
    private $HumanThreshold;

    /**
     * @var int 功能优先（门禁机特有） 0：速度优先；1：活体优先
     */
    private $DetectionPriority;

    /**
     * @var PictureCompression 图片压缩，仅带”压缩”配置的设备支持
     */
    private $PictureCompression;

    /**
     * @var TimeTable[] 布防时间段(支持2个时间段)
     */
    private $TimeTable;

    /**
     * @return int
     */
    public function getFaceEnabled(): int
    {
        return $this->FaceEnabled;
    }

    /**
     * @param int $FaceEnabled
     */
    public function setFaceEnabled(int $FaceEnabled): void
    {
        $this->FaceEnabled = $FaceEnabled;
    }

    /**
     * @return int
     */
    public function getSensitivity(): int
    {
        return $this->Sensitivity;
    }

    /**
     * @param int $Sensitivity
     */
    public function setSensitivity(int $Sensitivity): void
    {
        $this->Sensitivity = $Sensitivity;
    }

    /**
     * @return int
     */
    public function getCaptureMode(): int
    {
        return $this->CaptureMode;
    }

    /**
     * @param int $CaptureMode
     */
    public function setCaptureMode(int $CaptureMode): void
    {
        $this->CaptureMode = $CaptureMode;
    }

    /**
     * @return CaptureModeParam
     */
    public function getCaptureModeParam(): CaptureModeParam
    {
        return $this->CaptureModeParam;
    }

    /**
     * @param CaptureModeParam $CaptureModeParam
     */
    public function setCaptureModeParam(CaptureModeParam $CaptureModeParam): void
    {
        $this->CaptureModeParam = $CaptureModeParam;
    }

    /**
     * @return int
     */
    public function getMaxFaceSize(): int
    {
        return $this->MaxFaceSize;
    }

    /**
     * @param int $MaxFaceSize
     */
    public function setMaxFaceSize(int $MaxFaceSize): void
    {
        $this->MaxFaceSize = $MaxFaceSize;
    }

    /**
     * @return int
     */
    public function getMinFaceSize(): int
    {
        return $this->MinFaceSize;
    }

    /**
     * @param int $MinFaceSize
     */
    public function setMinFaceSize(int $MinFaceSize): void
    {
        $this->MinFaceSize = $MinFaceSize;
    }

    /**
     * @return int
     */
    public function getFaceAreaSize(): int
    {
        return $this->FaceAreaSize;
    }

    /**
     * @param int $FaceAreaSize
     */
    public function setFaceAreaSize(int $FaceAreaSize): void
    {
        $this->FaceAreaSize = $FaceAreaSize;
    }

    /**
     * @return int
     */
    public function getMinFaceTempSize(): int
    {
        return $this->MinFaceTempSize;
    }

    /**
     * @param int $MinFaceTempSize
     */
    public function setMinFaceTempSize(int $MinFaceTempSize): void
    {
        $this->MinFaceTempSize = $MinFaceTempSize;
    }

    /**
     * @return int
     */
    public function getSceneMode(): int
    {
        return $this->SceneMode;
    }

    /**
     * @param int $SceneMode
     */
    public function setSceneMode(int $SceneMode): void
    {
        $this->SceneMode = $SceneMode;
    }

    /**
     * @return int
     */
    public function getFaceTrackEnabled(): int
    {
        return $this->FaceTrackEnabled;
    }

    /**
     * @param int $FaceTrackEnabled
     */
    public function setFaceTrackEnabled(int $FaceTrackEnabled): void
    {
        $this->FaceTrackEnabled = $FaceTrackEnabled;
    }

    /**
     * @return int
     */
    public function getFTPUploadEnabled(): int
    {
        return $this->FTPUploadEnabled;
    }

    /**
     * @param int $FTPUploadEnabled
     */
    public function setFTPUploadEnabled(int $FTPUploadEnabled): void
    {
        $this->FTPUploadEnabled = $FTPUploadEnabled;
    }

    /**
     * @return int
     */
    public function getPrivateProtocol(): int
    {
        return $this->PrivateProtocol;
    }

    /**
     * @param int $PrivateProtocol
     */
    public function setPrivateProtocol(int $PrivateProtocol): void
    {
        $this->PrivateProtocol = $PrivateProtocol;
    }

    /**
     * @return int
     */
    public function getPictureMode(): int
    {
        return $this->PictureMode;
    }

    /**
     * @param int $PictureMode
     */
    public function setPictureMode(int $PictureMode): void
    {
        $this->PictureMode = $PictureMode;
    }

    /**
     * @return int
     */
    public function getFacePictureQuality(): int
    {
        return $this->FacePictureQuality;
    }

    /**
     * @param int $FacePictureQuality
     */
    public function setFacePictureQuality(int $FacePictureQuality): void
    {
        $this->FacePictureQuality = $FacePictureQuality;
    }

    /**
     * @return int
     */
    public function getScenePictureQuality(): int
    {
        return $this->ScenePictureQuality;
    }

    /**
     * @param int $ScenePictureQuality
     */
    public function setScenePictureQuality(int $ScenePictureQuality): void
    {
        $this->ScenePictureQuality = $ScenePictureQuality;
    }

    /**
     * @return PicturePrefix
     */
    public function getPicturePrefix(): PicturePrefix
    {
        return $this->PicturePrefix;
    }

    /**
     * @param PicturePrefix $PicturePrefix
     */
    public function setPicturePrefix(PicturePrefix $PicturePrefix): void
    {
        $this->PicturePrefix = $PicturePrefix;
    }

    /**
     * @return int
     */
    public function getFaceAttributeEnabled(): int
    {
        return $this->FaceAttributeEnabled;
    }

    /**
     * @param int $FaceAttributeEnabled
     */
    public function setFaceAttributeEnabled(int $FaceAttributeEnabled): void
    {
        $this->FaceAttributeEnabled = $FaceAttributeEnabled;
    }

    /**
     * @return int
     */
    public function getHumanDetection(): int
    {
        return $this->HumanDetection;
    }

    /**
     * @param int $HumanDetection
     */
    public function setHumanDetection(int $HumanDetection): void
    {
        $this->HumanDetection = $HumanDetection;
    }

    /**
     * @return int
     */
    public function getHumanThreshold(): int
    {
        return $this->HumanThreshold;
    }

    /**
     * @param int $HumanThreshold
     */
    public function setHumanThreshold(int $HumanThreshold): void
    {
        $this->HumanThreshold = $HumanThreshold;
    }

    /**
     * @return int
     */
    public function getDetectionPriority(): int
    {
        return $this->DetectionPriority;
    }

    /**
     * @param int $DetectionPriority
     */
    public function setDetectionPriority(int $DetectionPriority): void
    {
        $this->DetectionPriority = $DetectionPriority;
    }

    /**
     * @return PictureCompression
     */
    public function getPictureCompression(): PictureCompression
    {
        return $this->PictureCompression;
    }

    /**
     * @param PictureCompression $PictureCompression
     */
    public function setPictureCompression(PictureCompression $PictureCompression): void
    {
        $this->PictureCompression = $PictureCompression;
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