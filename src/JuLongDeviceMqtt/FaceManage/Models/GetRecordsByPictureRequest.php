<?php
/**
 * 文件描述
 * Created on 2022/2/10 18:17
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 以图/特征值/人员ID搜索比对记录(门禁机支持)，注：一次最多返回1000条。
 * Created on 2022/2/10 18:17
 * Create by LZH
 */
class GetRecordsByPictureRequest extends AbstractRequest
{
    /**
     * @var int|null 通道号(NVR服务器需要用到)
    使用掩码方式，支持组合通道，如要查询1、3、5通道，则传入21，0表示所有通道
     */
    private $ChannelNo;

    /**
     * @var int 搜索方式 0：图片；1：特征值；2：人员ID
     */
    private $SearchType;

    /**
     * @var string|null 人脸图片（Base64），SearchType等于0
     */
    private $FacePicture;

    /**
     * @var string|null 人员特征值数据(Base64，不可转换为图片)，SearchType等于1
     */
    private $FeatureValue;

    /**
     * @var string|null 人员入库时的ID
     */
    private $PersonId;

    /**
     * @var int 排序方式 0：按相似度排序；1：按时间排序（从小到大）；2：按时间排序（从大到小）
     */
    private $SortBy;

    /**
     * @var int|null 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    private $Similarity;

    /**
     * @var string|null 开始时间 格式：yyyy-MM-dd hh:mm:ss，如不填则从第一次比对开始查询
     */
    private $BeginTime;

    /**
     * @var string|null 结束时间 格式：yyyy-MM-dd hh:mm:ss，如不填则从最后一次比对开始查询
     */
    private $EndTime;

    /**
     * @var int|null 当前要获取的页，初值为1
     */
    private $PageCurNO;

    /**
     * @var int|null 指定页号需要返回的比对记录数目，默认1000，最多一页返回1000条记录
     */
    private $NameCount;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::GET_RECORDS_BY_PICTURE); // 初始化动作名称
    }

    /**
     * @return int|null
     */
    public function getChannelNo(): ?int
    {
        return $this->ChannelNo;
    }

    /**
     * @param int|null $ChannelNo
     */
    public function setChannelNo(?int $ChannelNo): void
    {
        $this->ChannelNo = $ChannelNo;
    }

    /**
     * @return int
     */
    public function getSearchType(): int
    {
        return $this->SearchType;
    }

    /**
     * @param int $SearchType
     */
    public function setSearchType(int $SearchType): void
    {
        $this->SearchType = $SearchType;
    }

    /**
     * @return string|null
     */
    public function getFacePicture(): ?string
    {
        return $this->FacePicture;
    }

    /**
     * @param string|null $FacePicture
     */
    public function setFacePicture(?string $FacePicture): void
    {
        $this->FacePicture = $FacePicture;
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
    public function getPersonId(): ?string
    {
        return $this->PersonId;
    }

    /**
     * @param string|null $PersonId
     */
    public function setPersonId(?string $PersonId): void
    {
        $this->PersonId = $PersonId;
    }

    /**
     * @return int
     */
    public function getSortBy(): int
    {
        return $this->SortBy;
    }

    /**
     * @param int $SortBy
     */
    public function setSortBy(int $SortBy): void
    {
        $this->SortBy = $SortBy;
    }

    /**
     * @return int|null
     */
    public function getSimilarity(): ?int
    {
        return $this->Similarity;
    }

    /**
     * @param int|null $Similarity
     */
    public function setSimilarity(?int $Similarity): void
    {
        $this->Similarity = $Similarity;
    }

    /**
     * @return string|null
     */
    public function getBeginTime(): ?string
    {
        return $this->BeginTime;
    }

    /**
     * @param string|null $BeginTime
     */
    public function setBeginTime(?string $BeginTime): void
    {
        $this->BeginTime = $BeginTime;
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
     * @return int|null
     */
    public function getPageCurNO(): ?int
    {
        return $this->PageCurNO;
    }

    /**
     * @param int|null $PageCurNO
     */
    public function setPageCurNO(?int $PageCurNO): void
    {
        $this->PageCurNO = $PageCurNO;
    }

    /**
     * @return int|null
     */
    public function getNameCount(): ?int
    {
        return $this->NameCount;
    }

    /**
     * @param int|null $NameCount
     */
    public function setNameCount(?int $NameCount): void
    {
        $this->NameCount = $NameCount;
    }

}