<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:22
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 图片/特征值比较相似度(门禁机支持)
 * 用户通过此接口传两张jpg图片或者特征值到设备进行比对返回相似度。
 * Created on 2022/2/10 10:22
 * Create by LZH
 */
class GetFaceSimilarityRequest extends AbstractRequest
{
    /**
     * @var int 人脸类型 0：人员照片(Base64)；1：人员特征值数据
     */
    public $FaceType;

    /**
     * @var string 人员照片（Base64编码），FaceType为0必填
     */
    public $PersonPhoto1;

    /**
     * @var string 人员照片（Base64编码），FaceType为0必填
     */
    public $PersonPhoto2;

    /**
     * @var string 人员特征值数据(Base64，不可转换为图片)，FaceType为1必填
     */
    public $FeatureValue1;

    /**
     * @var string 人员特征值数据(Base64，不可转换为图片)，FaceType为1必填
     */
    public $FeatureValue2;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::GET_FACE_SIMILARITY; // 初始化动作名称
    }
}