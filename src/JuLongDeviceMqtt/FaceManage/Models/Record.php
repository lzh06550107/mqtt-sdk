<?php
/**
 * 文件描述
 * Created on 2022/2/10 18:55
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 比对记录信息
 * Created on 2022/2/10 18:57
 * Create by LZH
 */
class Record extends AbstractModel
{
    /**
     * @var string 二维码数据，需要设备支持二维码
     */
    private $QRCode;

    /**
     * @var string 抓拍图片完整路径(可通过完整路径获取图片)，刷卡识别无该字段
     */
    private $FacePicturePath;

    /**
     * @var string 原图完整路径(可通过完整路径获取图片)，刷卡识别无该字段
     */
    private $BackgroundPath;

    /**
     * @var FacePosition 人脸坐标信息(像素为单位)，有人脸图片才有该字段
     */
    private $FacePosition;

    /**
     * @var FaceAttribute 人脸属性，需要开启属性检测
     */
    private $Attribute;

    /**
     * @var int 人脸活体检测 0：非活体；1：活体，需要开启活体检测
     */
    private $Liveness;

    /**
     * @var int 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    private $Similarity;

    /**
     * @var string 体温，测温机特有
     */
    private $Temprature;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    private $PersonType;

    /**
     * @var string 人员ID
     */
    private $PersonId;

    /**
     * @var string IC卡号
     */
    private $ICCard;

    /**
     * @var array 扩展IC卡
     */
    private $ICCardList;

    /**
     * @var string 身份证号
     */
    private $IDCard;

    /**
     * @var string 人员姓名
     */
    private $PersonName;

    /**
     * @var int 性别 1：男；2：女
     */
    private $Sex;

    /**
     * @var string 抓拍时间 格式：yyyy-MM-dd hh:mm:ss
     */
    private $CaptureTime;

    /**
     * @var string 经度，精确到小数点后8位
     */
    private $Longitude;

    /**
     * @var string 维度，精确到小数点后8位
     */
    private $Latitude;

    /**
     * @var int 乘车类型 1：上车；2：下车
     */
    private $RideType;

    /**
     * @var int 乘车站点
     */
    private $RideId;

    /**
     * @var string 站点名
     */
    private $Station;

    /**
     * @var string 家长和学生的该值一致，代表XX是XX学生的家长，推荐填学号
     */
    private $KeyId;

    /**
     * @var string 如果是家长则表示家长的称谓，比如父/母 Father/Mother
     */
    private $KeyTitle;

    /**
     * @var int[] 注册站点ID
     */
    private $PlaceId;

    /**
     * @var StudentInfo[] 分班播报学生信息列表
     */
    private $StudentsInfo;

    /**
     * @return string
     */
    public function getQRCode(): string
    {
        return $this->QRCode;
    }

    /**
     * @param string $QRCode
     */
    public function setQRCode(string $QRCode): void
    {
        $this->QRCode = $QRCode;
    }

    /**
     * @return string
     */
    public function getFacePicturePath(): string
    {
        return $this->FacePicturePath;
    }

    /**
     * @param string $FacePicturePath
     */
    public function setFacePicturePath(string $FacePicturePath): void
    {
        $this->FacePicturePath = $FacePicturePath;
    }

    /**
     * @return string
     */
    public function getBackgroundPath(): string
    {
        return $this->BackgroundPath;
    }

    /**
     * @param string $BackgroundPath
     */
    public function setBackgroundPath(string $BackgroundPath): void
    {
        $this->BackgroundPath = $BackgroundPath;
    }

    /**
     * @return FacePosition
     */
    public function getFacePosition(): FacePosition
    {
        return $this->FacePosition;
    }

    /**
     * @param FacePosition $FacePosition
     */
    public function setFacePosition(FacePosition $FacePosition): void
    {
        $this->FacePosition = $FacePosition;
    }

    /**
     * @return FaceAttribute
     */
    public function getAttribute(): FaceAttribute
    {
        return $this->Attribute;
    }

    /**
     * @param FaceAttribute $Attribute
     */
    public function setAttribute(FaceAttribute $Attribute): void
    {
        $this->Attribute = $Attribute;
    }

    /**
     * @return int
     */
    public function getLiveness(): int
    {
        return $this->Liveness;
    }

    /**
     * @param int $Liveness
     */
    public function setLiveness(int $Liveness): void
    {
        $this->Liveness = $Liveness;
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
     * @return string
     */
    public function getTemprature(): string
    {
        return $this->Temprature;
    }

    /**
     * @param string $Temprature
     */
    public function setTemprature(string $Temprature): void
    {
        $this->Temprature = $Temprature;
    }

    /**
     * @return int
     */
    public function getPersonType(): int
    {
        return $this->PersonType;
    }

    /**
     * @param int $PersonType
     */
    public function setPersonType(int $PersonType): void
    {
        $this->PersonType = $PersonType;
    }

    /**
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->PersonId;
    }

    /**
     * @param string $PersonId
     */
    public function setPersonId(string $PersonId): void
    {
        $this->PersonId = $PersonId;
    }

    /**
     * @return string
     */
    public function getICCard(): string
    {
        return $this->ICCard;
    }

    /**
     * @param string $ICCard
     */
    public function setICCard(string $ICCard): void
    {
        $this->ICCard = $ICCard;
    }

    /**
     * @return array
     */
    public function getICCardList(): array
    {
        return $this->ICCardList;
    }

    /**
     * @param array $ICCardList
     */
    public function setICCardList(array $ICCardList): void
    {
        $this->ICCardList = $ICCardList;
    }

    /**
     * @return string
     */
    public function getIDCard(): string
    {
        return $this->IDCard;
    }

    /**
     * @param string $IDCard
     */
    public function setIDCard(string $IDCard): void
    {
        $this->IDCard = $IDCard;
    }

    /**
     * @return string
     */
    public function getPersonName(): string
    {
        return $this->PersonName;
    }

    /**
     * @param string $PersonName
     */
    public function setPersonName(string $PersonName): void
    {
        $this->PersonName = $PersonName;
    }

    /**
     * @return int
     */
    public function getSex(): int
    {
        return $this->Sex;
    }

    /**
     * @param int $Sex
     */
    public function setSex(int $Sex): void
    {
        $this->Sex = $Sex;
    }

    /**
     * @return string
     */
    public function getCaptureTime(): string
    {
        return $this->CaptureTime;
    }

    /**
     * @param string $CaptureTime
     */
    public function setCaptureTime(string $CaptureTime): void
    {
        $this->CaptureTime = $CaptureTime;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->Longitude;
    }

    /**
     * @param string $Longitude
     */
    public function setLongitude(string $Longitude): void
    {
        $this->Longitude = $Longitude;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->Latitude;
    }

    /**
     * @param string $Latitude
     */
    public function setLatitude(string $Latitude): void
    {
        $this->Latitude = $Latitude;
    }

    /**
     * @return int
     */
    public function getRideType(): int
    {
        return $this->RideType;
    }

    /**
     * @param int $RideType
     */
    public function setRideType(int $RideType): void
    {
        $this->RideType = $RideType;
    }

    /**
     * @return int
     */
    public function getRideId(): int
    {
        return $this->RideId;
    }

    /**
     * @param int $RideId
     */
    public function setRideId(int $RideId): void
    {
        $this->RideId = $RideId;
    }

    /**
     * @return string
     */
    public function getStation(): string
    {
        return $this->Station;
    }

    /**
     * @param string $Station
     */
    public function setStation(string $Station): void
    {
        $this->Station = $Station;
    }

    /**
     * @return string
     */
    public function getKeyId(): string
    {
        return $this->KeyId;
    }

    /**
     * @param string $KeyId
     */
    public function setKeyId(string $KeyId): void
    {
        $this->KeyId = $KeyId;
    }

    /**
     * @return string
     */
    public function getKeyTitle(): string
    {
        return $this->KeyTitle;
    }

    /**
     * @param string $KeyTitle
     */
    public function setKeyTitle(string $KeyTitle): void
    {
        $this->KeyTitle = $KeyTitle;
    }

    /**
     * @return int[]
     */
    public function getPlaceId(): array
    {
        return $this->PlaceId;
    }

    /**
     * @param int[] $PlaceId
     */
    public function setPlaceId(array $PlaceId): void
    {
        $this->PlaceId = $PlaceId;
    }

    /**
     * @return StudentInfo[]
     */
    public function getStudentsInfo(): array
    {
        return $this->StudentsInfo;
    }

    /**
     * @param StudentInfo[] $StudentsInfo
     */
    public function setStudentsInfo(array $StudentsInfo): void
    {
        $this->StudentsInfo = $StudentsInfo;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["QRCode"])) {
            $this->QRCode = $param["QRCode"];
        }

        if (isset($param["FacePicturePath"])) {
            $this->FacePicturePath = $param["FacePicturePath"];
        }

        if (isset($param["BackgroundPath"])) {
            $this->BackgroundPath = $param["BackgroundPath"];
        }

        if (isset($param["FacePosition"])) {
            $facePosition = new FacePosition();
            $facePosition->deserialize($param['FacePosition']);
            $this->FacePosition = $facePosition;
        }

        if (isset($param["Attribute"])) {
            $faceAttribute = new FaceAttribute();
            $faceAttribute->deserialize($param['Attribute']);
            $this->Attribute = $faceAttribute;
        }

        if (isset($param["Liveness"])) {
            $this->Liveness = $param["Liveness"];
        }

        if (isset($param["Similarity"])) {
            $this->Similarity = $param["Similarity"];
        }

        if (isset($param["Temprature"])) {
            $this->Temprature = $param["Temprature"];
        }

        if (isset($param["PersonType"])) {
            $this->PersonType = $param["PersonType"];
        }

        if (isset($param["PersonId"])) {
            $this->PersonId = $param["PersonId"];
        }

        if (isset($param["ICCard"])) {
            $this->ICCard = $param["ICCard"];
        }

        if (isset($param["ICCardList"])) {
            $this->ICCardList = $param["ICCardList"];
        }

        if (isset($param["IDCard"])) {
            $this->IDCard = $param["IDCard"];
        }

        if (isset($param["PersonName"])) {
            $this->PersonName = $param["PersonName"];
        }

        if (isset($param["Sex"])) {
            $this->Sex = $param["Sex"];
        }

        if (isset($param["CaptureTime"])) {
            $this->CaptureTime = $param["CaptureTime"];
        }

        if (isset($param["Longitude"])) {
            $this->Longitude = $param["Longitude"];
        }

        if (isset($param["Latitude"])) {
            $this->Latitude = $param["Latitude"];
        }

        if (isset($param["RideType"])) {
            $this->RideType = $param["RideType"];
        }

        if (isset($param["RideId"])) {
            $this->RideId = $param["RideId"];
        }

        if (isset($param["Station"])) {
            $this->Station = $param["Station"];
        }

        if (isset($param["KeyId"])) {
            $this->KeyId = $param["KeyId"];
        }

        if (isset($param["KeyTitle"])) {
            $this->KeyTitle = $param["KeyTitle"];
        }

        if (isset($param["PlaceId"])) {
            $this->PlaceId = $param["PlaceId"];
        }

        if (isset($param["StudentsInfo"])) {
            $studentsInfo = [];
            foreach ($param['StudentsInfo'] as $student) {
                $studentInfo = new StudentInfo();
                $studentInfo->deserialize($param['StudentsInfo']);
                $studentsInfo[] = $studentInfo;
            }
            $this->StudentsInfo = $studentsInfo;
        }

    }
}