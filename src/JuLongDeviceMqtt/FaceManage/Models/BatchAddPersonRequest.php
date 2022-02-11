<?php
/**
 * 文件描述
 * Created on 2022/2/10 11:09
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 批量注册人员
 * Created on 2022/2/10 11:09
 * Create by LZH
 *
 */
class BatchAddPersonRequest extends AbstractRequest
{
    /**
     * @var int 图片下发类型 0：URL(PersonPhotoUrl)；1：Base64(PersonPhoto)；2：特征值(FeatureValue)；3：IC卡(ICCard，人卡分离)
     */
    public $PhotoType;

    /**
     * @var int 人员特征值类型 0：float；1：char；2：int；3：通用类型
     */
    public $FeatureType;

    /**
     * @var int 人员总数
     */
    public $PersonTotal;

    /**
     * @var BatchAddPersonInfo[] 批量添加人员信息
     */
    public $PersonInfo;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::ADD_PERSONS; // 初始化动作名称
    }
}