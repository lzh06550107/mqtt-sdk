<?php
/**
 * 文件描述
 * Created on 2022/2/9 16:39
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 获取名单列表
 * Created on 2022/2/9 16:40
 * Create by LZH
 */
class GetPersonRequest extends AbstractRequest
{
    /**
     * @var int 名单类型 0：所有名单；1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var int 搜索方式 0：图片；2：特征值；3：人员ID
     */
    public $SearchType;

    /**
     * @var int 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    public $Similarity;

    /**
     * @var string 人脸图片(Base64)，SearchType等于0
     */
    public $FacePicture;

    /**
     * @var string 人员特征值数据(Base64，不可转换为图片)，SearchType等于1
     */
    public $FeatureValue;

    /**
     * @var string 人员入库时的ID，SearchType等于2
     */
    public $PersonId;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::GET_PERSON; // 初始化动作名称
    }


}