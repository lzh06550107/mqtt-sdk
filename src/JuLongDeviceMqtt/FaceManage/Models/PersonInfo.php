<?php
/**
 * 文件描述
 * Created on 2021/12/28 14:58
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceHttp\FaceManage\PersonIdentity;
use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 人员信息
 * Created on 2021/12/28 14:58
 * Create by LZH
 */
class PersonInfo extends AbstractModel
{
    /**
     * @var string 人员ID
     */
    public $PersonId;
    /**
     * @var string 人员姓名
     */
    public $PersonName;
    /**
     * @var int 性别 1：男  2：女  0：未知
     */
    public $Sex;
    /**
     * @var string 身份证编号
     */
    public $IDCard;
    /**
     * @var string 民族
     */
    public $Nation;
    /**
     * @var string 生日
     */
    public $Birthday;
    /**
     * @var string 电话号码
     */
    public $Phone;
    /**
     * @var string 住址
     */
    public $Address;
    /**
     * @var int 人员有效时间限制 0：永久有效；1：周期有效
     */
    public $LimitTime;
    /**
     * @var string 人员有效开始时间 格式:yyyy-mm-dd hh:mm:ss
     */
    public $StartTime;
    /**
     * @var string 人员有效结束时间 格式:yyyy-mm-dd hh:mm:ss
     */
    public $EndTime;
    /**
     * @var PersonIdentity 人员身份，用于名单分类
     */
    public $PersonIdentity;
    /**
     * @var int 人员身份属性，用于名单分组
     */
    public $IdentityAttribute;
    /**
     * @var int[] 关联通行策略
     */
    public $StrategyId;
    /**
     * @var string 人员标签
     */
    public $Label;
    /**
     * @var string 绑定的IC卡号
     */
    public $ICCard;
    /**
     * @var string 扩展IC卡
     */
    public $ICCardList;
    /**
     * @var PersonExtension 人员扩展
     */
    public $PersonExtension;
    /**
     * @var int 图片下发类型 0：URL(PersonPhotoUrl)；1：Base64(PersonPhoto)；2：特征值(FeatureValue)；3：IC卡(ICCard，人卡分离)
     */
    public $PhotoType;
    /**
     * @var int 人员特征值类型 0：float；1：char；2：int；3：通用类型，PhotoType为2时必填
     */
    public $FeatureType;
    /**
     * @var string 图片下载地址，PhotoType为0时必填，PhotoType为2时可选填，图片可以与特征值共存，当图片与特征值共存情况下，以特征值进行人脸对比，图片只起到显示作用
     */
    public $PersonPhotoUrl;
    /**
     * @var string 人员照片（base64编码），PhotoType为0时必填，PhotoType为2时可选填，图片可以与特征值共存，当图片与特征值共存情况下，以特征值进行人脸对比，图片只起到显示作用
     */
    public $PersonPhoto;
    /**
     * @var string 人员特征值数据(base64编码)，PhotoType为2时必填
     */
    public $FeatureValue;
    /**
     * @var string 家长和学生的该值一致，代表XX是XX学生的家长，推荐填学号
     */
    public $KeyId;
    /**
     * @var string 如果是家长则表示家长的称谓，比如父/母 Father/Mother
     */
    public $KeyTitle;
    /**
     * @var int[] 校车的下车站点，
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

        if (isset($param['PersonId'])) {
            $this->PersonId = $param['PersonId'];
        }

        if (isset($param['PersonName'])) {
            $this->PersonName = $param['PersonName'];
        }

        if (isset($param['Sex'])) {
            $this->Sex = $param['Sex'];
        }

        if (isset($param['IDCard'])) {
            $this->IDCard = $param['IDCard'];
        }

        if (isset($param['Nation'])) {
            $this->Nation = $param['Nation'];
        }

        if (isset($param['Birthday'])) {
            $this->Birthday = $param['Birthday'];
        }

        if (isset($param['Phone'])) {
            $this->Phone = $param['Phone'];
        }

        if (isset($param['Address'])) {
            $this->Address = $param['Address'];
        }

        if (isset($param['LimitTime'])) {
            $this->LimitTime = $param['LimitTime'];
        }

        if (isset($param['StartTime'])) {
            $this->StartTime = $param['StartTime'];
        }

        if (isset($param['EndTime'])) {
            $this->EndTime = $param['EndTime'];
        }

        if (isset($param['PersonIdentity'])) {
            $this->PersonIdentity = $param['PersonIdentity'];
        }

        if (isset($param['StrategyId'])) {
            $this->StrategyId = $param['StrategyId'];
        }

        if (isset($param['IdentityAttribute'])) {
            $this->IdentityAttribute = $param['IdentityAttribute'];
        }

        if (isset($param['Label'])) {
            $this->Label = $param['Label'];
        }

        if (isset($param['ICCard'])) {
            $this->ICCard = $param['ICCard'];
        }

        if (isset($param['ICCardList'])) {
            $this->ICCardList = $param['ICCardList'];
        }

        if (isset($param['PersonExtension'])) {
            $personExtension = new PersonExtension();
            $personExtension->deserialize($param['PersonExtension']);
            $this->PersonExtension = $personExtension;
        }

        if (isset($param['PhotoType'])) {
            $this->PhotoType = $param['PhotoType'];
        }

        if (isset($param['FeatureType'])) {
            $this->FeatureType = $param['FeatureType'];
        }

        if (isset($param['PersonPhotoUrl'])) {
            $this->PersonPhotoUrl = $param['PersonPhotoUrl'];
        }

        if (isset($param['PersonPhoto'])) {
            $this->PersonPhoto = $param['PersonPhoto'];
        }

        if (isset($param['FeatureValue'])) {
            $this->FeatureValue = $param['FeatureValue'];
        }

        if (isset($param['KeyId'])) {
            $this->KeyId = $param['KeyId'];
        }

        if (isset($param['KeyTitle'])) {
            $this->KeyTitle = $param['KeyTitle'];
        }

        if (isset($param['PlaceId'])) {
            $this->PlaceId = $param['PlaceId'];
        }

        if (isset($param['StudentsInfo'])) {
            $studentsInfo = [];
            foreach ($param['StudentsInfo'] as $student) {
                $studentInfo = new StudentInfo();
                $studentInfo->deserialize($student);
                $studentsInfo[] = $studentInfo;
            }
            $this->StudentsInfo = $studentsInfo;
        }

    }
}