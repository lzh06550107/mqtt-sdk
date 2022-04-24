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
    public $QRCode;

    /**
     * @var string 抓拍图片完整路径(可通过完整路径获取图片)，刷卡识别无该字段
     */
    public $FacePicturePath;

    /**
     * @var string 原图完整路径(可通过完整路径获取图片)，刷卡识别无该字段
     */
    public $BackgroundPath;

    /**
     * @var FacePosition 人脸坐标信息(像素为单位)，有人脸图片才有该字段
     */
    public $FacePosition;

    /**
     * @var FaceAttribute 人脸属性，需要开启属性检测
     */
    public $Attribute;

    /**
     * @var int 人脸活体检测 0：非活体；1：活体，需要开启活体检测
     */
    public $Liveness;

    /**
     * @var int 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    public $Similarity;

    /**
     * @var string 体温，测温机特有
     */
    public $Temprature;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var string 人员ID
     */
    public $PersonId;

    /**
     * @var string IC卡号
     */
    public $ICCard;

    /**
     * @var array 扩展IC卡
     */
    public $ICCardList;

    /**
     * @var string 身份证号
     */
    public $IDCard;

    /**
     * @var string 人员姓名
     */
    public $PersonName;

    /**
     * @var int 性别 1：男；2：女
     */
    public $Sex;

    /**
     * @var string 抓拍时间 格式：yyyy-MM-dd hh:mm:ss
     */
    public $CaptureTime;

    /**
     * @var string 经度，精确到小数点后8位
     */
    public $Longitude;

    /**
     * @var string 维度，精确到小数点后8位
     */
    public $Latitude;

    /**
     * @var int 乘车类型 1：上车；2：下车
     */
    public $RideType;

    /**
     * @var int 乘车站点
     */
    public $RideId;

    /**
     * @var string 站点名
     */
    public $Station;

    /**
     * @var string 家长和学生的该值一致，代表XX是XX学生的家长，推荐填学号
     */
    public $KeyId;

    /**
     * @var string 如果是家长则表示家长的称谓，比如父/母 Father/Mother
     */
    public $KeyTitle;

    /**
     * @var int[] 注册站点ID
     */
    public $PlaceId;

    /**
     * @var StudentInfo[] 分班播报学生信息列表
     */
    public $StudentsInfo;

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