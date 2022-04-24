<?php
/**
 * 文件描述
 * Created on 2021/12/28 14:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\FaceManage\PersonIdentity;
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
    private $PersonId;

    /**
     * @var string|null 人员姓名
     */
    private $PersonName;

    /**
     * @var int|null 性别 1：男  2：女  0：未知
     */
    private $Sex;

    /**
     * @var string|null 身份证编号
     */
    private $IDCard;

    /**
     * @var string|null 民族
     */
    private $Nation;

    /**
     * @var string|null 生日
     */
    private $Birthday;

    /**
     * @var string|null 电话号码
     */
    private $Phone;

    /**
     * @var string|null 住址
     */
    private $Address;

    /**
     * @var int|null 人员有效时间限制 0：永久有效；1：周期有效
     */
    private $LimitTime;

    /**
     * @var string|null 人员有效开始时间 格式:yyyy-mm-dd hh:mm:ss
     */
    private $StartTime;

    /**
     * @var string|null 人员有效结束时间 格式:yyyy-mm-dd hh:mm:ss
     */
    private $EndTime;

    /**
     * @var PersonIdentity|null 人员身份，用于名单分类
     */
    private $PersonIdentity;

    /**
     * @var int|null 人员身份属性，用于名单分组
     */
    private $IdentityAttribute;

    /**
     * @var int[]|null 关联通行策略
     */
    private $StrategyId;

    /**
     * @var string|null 人员标签
     */
    private $Label;

    /**
     * @var string|null 绑定的IC卡号
     */
    private $ICCard;

    /**
     * @var string[]|null 扩展IC卡
     */
    private $ICCardList;

    /**
     * @var PersonExtension|null 人员扩展
     */
    private $PersonExtension;

    /**
     * @var int 图片下发类型 0：URL(PersonPhotoUrl)；1：Base64(PersonPhoto)；2：特征值(FeatureValue)；3：IC卡(ICCard，人卡分离)
     */
    private $PhotoType;

    /**
     * @var int|null 人员特征值类型 0：float；1：char；2：int；3：通用类型，PhotoType为2时必填
     */
    private $FeatureType;

    /**
     * @var string|null 图片下载地址，PhotoType为0时必填，PhotoType为2时可选填，图片可以与特征值共存，当图片与特征值共存情况下，以特征值进行人脸对比，图片只起到显示作用
     */
    private $PersonPhotoUrl;

    /**
     * @var string|null 人员照片（base64编码），PhotoType为0时必填，PhotoType为2时可选填，图片可以与特征值共存，当图片与特征值共存情况下，以特征值进行人脸对比，图片只起到显示作用
     */
    private $PersonPhoto;

    /**
     * @var string|null 人员特征值数据(base64编码)，PhotoType为2时必填
     */
    private $FeatureValue;

    /**
     * @var string|null 家长和学生的该值一致，代表XX是XX学生的家长，推荐填学号
     */
    private $KeyId;

    /**
     * @var string|null 如果是家长则表示家长的称谓，比如父/母 Father/Mother
     */
    private $KeyTitle;

    /**
     * @var int[]|null 校车的下车站点，
     */
    private $PlaceId;

    /**
     * @var StudentInfo[]|null 分班播报学生信息列表
     */
    private $StudentsInfo;

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
     * @return string|null
     */
    public function getPersonName(): ?string
    {
        return $this->PersonName;
    }

    /**
     * @param string|null $PersonName
     */
    public function setPersonName(?string $PersonName): void
    {
        $this->PersonName = $PersonName;
    }

    /**
     * @return int|null
     */
    public function getSex(): ?int
    {
        return $this->Sex;
    }

    /**
     * @param int|null $Sex
     */
    public function setSex(?int $Sex): void
    {
        $this->Sex = $Sex;
    }

    /**
     * @return string|null
     */
    public function getIDCard(): ?string
    {
        return $this->IDCard;
    }

    /**
     * @param string|null $IDCard
     */
    public function setIDCard(?string $IDCard): void
    {
        $this->IDCard = $IDCard;
    }

    /**
     * @return string|null
     */
    public function getNation(): ?string
    {
        return $this->Nation;
    }

    /**
     * @param string|null $Nation
     */
    public function setNation(?string $Nation): void
    {
        $this->Nation = $Nation;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->Birthday;
    }

    /**
     * @param string|null $Birthday
     */
    public function setBirthday(?string $Birthday): void
    {
        $this->Birthday = $Birthday;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    /**
     * @param string|null $Phone
     */
    public function setPhone(?string $Phone): void
    {
        $this->Phone = $Phone;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->Address;
    }

    /**
     * @param string|null $Address
     */
    public function setAddress(?string $Address): void
    {
        $this->Address = $Address;
    }

    /**
     * @return int|null
     */
    public function getLimitTime(): ?int
    {
        return $this->LimitTime;
    }

    /**
     * @param int|null $LimitTime
     */
    public function setLimitTime(?int $LimitTime): void
    {
        $this->LimitTime = $LimitTime;
    }

    /**
     * @return string|null
     */
    public function getStartTime(): ?string
    {
        return $this->StartTime;
    }

    /**
     * @param string|null $StartTime
     */
    public function setStartTime(?string $StartTime): void
    {
        $this->StartTime = $StartTime;
    }

    /**
     * @return string|null
     */
    public function getEndTime(): ?string
    {
        return $this->EndTime;
    }

    /**
     * @param string|null $EndTime
     */
    public function setEndTime(?string $EndTime): void
    {
        $this->EndTime = $EndTime;
    }

    /**
     * @return PersonIdentity|null
     */
    public function getPersonIdentity(): ?PersonIdentity
    {
        return $this->PersonIdentity;
    }

    /**
     * @param PersonIdentity|null $PersonIdentity
     */
    public function setPersonIdentity(?PersonIdentity $PersonIdentity): void
    {
        $this->PersonIdentity = $PersonIdentity;
    }

    /**
     * @return int|null
     */
    public function getIdentityAttribute(): ?int
    {
        return $this->IdentityAttribute;
    }

    /**
     * @param int|null $IdentityAttribute
     */
    public function setIdentityAttribute(?int $IdentityAttribute): void
    {
        $this->IdentityAttribute = $IdentityAttribute;
    }

    /**
     * @return int[]|null
     */
    public function getStrategyId(): ?array
    {
        return $this->StrategyId;
    }

    /**
     * @param int[]|null $StrategyId
     */
    public function setStrategyId(?array $StrategyId): void
    {
        $this->StrategyId = $StrategyId;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->Label;
    }

    /**
     * @param string|null $Label
     */
    public function setLabel(?string $Label): void
    {
        $this->Label = $Label;
    }

    /**
     * @return string|null
     */
    public function getICCard(): ?string
    {
        return $this->ICCard;
    }

    /**
     * @param string|null $ICCard
     */
    public function setICCard(?string $ICCard): void
    {
        $this->ICCard = $ICCard;
    }

    /**
     * @return string[]|null
     */
    public function getICCardList(): ?array
    {
        return $this->ICCardList;
    }

    /**
     * @param string[]|null $ICCardList
     */
    public function setICCardList(?array $ICCardList): void
    {
        $this->ICCardList = $ICCardList;
    }

    /**
     * @return PersonExtension|null
     */
    public function getPersonExtension(): ?PersonExtension
    {
        return $this->PersonExtension;
    }

    /**
     * @param PersonExtension|null $PersonExtension
     */
    public function setPersonExtension(?PersonExtension $PersonExtension): void
    {
        $this->PersonExtension = $PersonExtension;
    }

    /**
     * @return int
     */
    public function getPhotoType(): int
    {
        return $this->PhotoType;
    }

    /**
     * @param int $PhotoType
     */
    public function setPhotoType(int $PhotoType): void
    {
        $this->PhotoType = $PhotoType;
    }

    /**
     * @return int|null
     */
    public function getFeatureType(): ?int
    {
        return $this->FeatureType;
    }

    /**
     * @param int|null $FeatureType
     */
    public function setFeatureType(?int $FeatureType): void
    {
        $this->FeatureType = $FeatureType;
    }

    /**
     * @return string|null
     */
    public function getPersonPhotoUrl(): ?string
    {
        return $this->PersonPhotoUrl;
    }

    /**
     * @param string|null $PersonPhotoUrl
     */
    public function setPersonPhotoUrl(?string $PersonPhotoUrl): void
    {
        $this->PersonPhotoUrl = $PersonPhotoUrl;
    }

    /**
     * @return string|null
     */
    public function getPersonPhoto(): ?string
    {
        return $this->PersonPhoto;
    }

    /**
     * @param string|null $PersonPhoto
     */
    public function setPersonPhoto(?string $PersonPhoto): void
    {
        $this->PersonPhoto = $PersonPhoto;
    }

    /**
     * @return string|null
     */
    public function getFeatureValue(): ?string
    {
        return $this->FeatureValue;
    }

    /**
     * @param string|null $FeatureValue
     */
    public function setFeatureValue(?string $FeatureValue): void
    {
        $this->FeatureValue = $FeatureValue;
    }

    /**
     * @return string|null
     */
    public function getKeyId(): ?string
    {
        return $this->KeyId;
    }

    /**
     * @param string|null $KeyId
     */
    public function setKeyId(?string $KeyId): void
    {
        $this->KeyId = $KeyId;
    }

    /**
     * @return string|null
     */
    public function getKeyTitle(): ?string
    {
        return $this->KeyTitle;
    }

    /**
     * @param string|null $KeyTitle
     */
    public function setKeyTitle(?string $KeyTitle): void
    {
        $this->KeyTitle = $KeyTitle;
    }

    /**
     * @return int[]|null
     */
    public function getPlaceId(): ?array
    {
        return $this->PlaceId;
    }

    /**
     * @param int[] $PlaceId
     */
    public function setPlaceId(?array $PlaceId): void
    {
        $this->PlaceId = $PlaceId;
    }

    /**
     * @return StudentInfo[]|null
     */
    public function getStudentsInfo(): ?array
    {
        return $this->StudentsInfo;
    }

    /**
     * @param StudentInfo[]|null $StudentsInfo
     */
    public function setStudentsInfo(?array $StudentsInfo): void
    {
        $this->StudentsInfo = $StudentsInfo;
    }



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