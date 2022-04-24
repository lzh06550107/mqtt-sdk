<?php
/**
 * 文件描述
 * Created on 2022/2/11 14:31
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 二维码设置
 * Created on 2022/2/11 14:32
 * Create by LZH
 */
class SetQRCodeRequest extends AbstractRequest
{
    /**
     * @var int 二维码显示类型 0：URL下载地址；1：图片Base64
     */
    public $PictureType;

    /**
     * @var int 图片格式 0：JPG；1：BMP
     */
    public $PictureFormat;

    /**
     * @var string 二维码下载地址
     */
    public $QRCodeUrl;

    /**
     * @var string 二维码图片（Base64）
     */
    public $QRCodePicture;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::SET_QRCODE; // 初始化动作名称
    }
}