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
    private $PictureType;

    /**
     * @var int 图片格式 0：JPG；1：BMP
     */
    private $PictureFormat;

    /**
     * @var string|null 二维码下载地址
     */
    private $QRCodeUrl;

    /**
     * @var string|null 二维码图片（Base64）
     */
    private $QRCodePicture;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::SET_QRCODE); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getPictureType(): int
    {
        return $this->PictureType;
    }

    /**
     * @param int $PictureType
     */
    public function setPictureType(int $PictureType): void
    {
        $this->PictureType = $PictureType;
    }

    /**
     * @return int
     */
    public function getPictureFormat(): int
    {
        return $this->PictureFormat;
    }

    /**
     * @param int $PictureFormat
     */
    public function setPictureFormat(int $PictureFormat): void
    {
        $this->PictureFormat = $PictureFormat;
    }

    /**
     * @return string|null
     */
    public function getQRCodeUrl(): ?string
    {
        return $this->QRCodeUrl;
    }

    /**
     * @param string|null $QRCodeUrl
     */
    public function setQRCodeUrl(?string $QRCodeUrl): void
    {
        $this->QRCodeUrl = $QRCodeUrl;
    }

    /**
     * @return string|null
     */
    public function getQRCodePicture(): ?string
    {
        return $this->QRCodePicture;
    }

    /**
     * @param string|null $QRCodePicture
     */
    public function setQRCodePicture(?string $QRCodePicture): void
    {
        $this->QRCodePicture = $QRCodePicture;
    }


}