<?php
/**
 * 文件描述
 * Created on 2022/2/10 18:17
 * Create by LZH
 */

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
     * @var int 通道号(NVR服务器需要用到)
    使用掩码方式，支持组合通道，如要查询1、3、5通道，则传入21，0表示所有通道
     */
    public $ChannelNo;

    /**
     * @var int 搜索方式 0：图片；1：特征值；2：人员ID
     */
    public $SearchType;

    /**
     * @var string 人脸图片（Base64），SearchType等于0
     */
    public $FacePicture;

    /**
     * @var string 人员特征值数据(Base64，不可转换为图片)，SearchType等于1
     */
    public $FeatureValue;

    /**
     * @var string 人员入库时的ID
     */
    public $PersonId;

    /**
     * @var int 排序方式 0：按相似度排序；1：按时间排序（从小到大）；2：按时间排序（从大到小）
     */
    public $SortBy;

    /**
     * @var int 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    public $Similarity;

    /**
     * @var string 开始时间 格式：yyyy-MM-dd hh:mm:ss，如不填则从第一次比对开始查询
     */
    public $BeginTime;

    /**
     * @var string 结束时间 格式：yyyy-MM-dd hh:mm:ss，如不填则从最后一次比对开始查询
     */
    public $EndTime;

    /**
     * @var int 当前要获取的页，初值为1
     */
    public $PageCurNO;

    /**
     * @var int 指定页号需要返回的比对记录数目，默认1000，最多一页返回1000条记录
     */
    public $NameCount;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::GET_RECORDS_BY_PICTURE; // 初始化动作名称
    }
}