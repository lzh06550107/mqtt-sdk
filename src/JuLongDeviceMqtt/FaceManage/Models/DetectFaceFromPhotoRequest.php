<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:39
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 检测图片人脸(门禁机支持)
 * 检测图片中人脸是否合格
 * Created on 2022/2/10 10:39
 * Create by LZH
 */
class DetectFaceFromPhotoRequest extends AbstractRequest
{
    /**
     * @var string 人员照片（Base64编码）
     */
    public $PersonPhoto;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::DETECT_FACE_FROM_PHOTO); // 初始化动作名称
    }

    /**
     * @return string
     */
    public function getPersonPhoto(): string
    {
        return $this->PersonPhoto;
    }

    /**
     * @param string $PersonPhoto
     */
    public function setPersonPhoto(string $PersonPhoto): void
    {
        $this->PersonPhoto = $PersonPhoto;
    }


}