<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:08
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 获取人脸特征值
 * Created on 2022/2/10 10:09
 * Create by LZH
 */
class GetFeatureValueRequest extends AbstractRequest
{

    /**
     * @var string 人脸图片(Base64)
     */
    public $FacePicture;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::GET_FEATURE_VALUE; // 初始化动作名称
    }
}