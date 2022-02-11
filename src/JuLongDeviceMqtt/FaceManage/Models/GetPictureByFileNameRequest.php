<?php
/**
 * 文件描述
 * Created on 2022/2/11 14:08
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 通过图片路径获取图片
 * Created on 2022/2/11 14:08
 * Create by LZH
 */
class GetPictureByFileNameRequest extends AbstractRequest
{
    /**
     * @var string 图片路径
     */
    public $PicturePath;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::GET_PICTURE_BY_FILENAME; // 初始化动作名称
    }
}