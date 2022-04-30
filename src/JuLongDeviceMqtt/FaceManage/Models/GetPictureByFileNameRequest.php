<?php
/**
 * 文件描述
 * Created on 2022/2/11 14:08
 * Create by LZH
 */

declare(strict_types=1);

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
    private $PicturePath;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::GET_PICTURE_BY_FILENAME); // 初始化动作名称
    }

    /**
     * @return string
     */
    public function getPicturePath(): string
    {
        return $this->PicturePath;
    }

    /**
     * @param string $PicturePath
     */
    public function setPicturePath(string $PicturePath): void
    {
        $this->PicturePath = $PicturePath;
    }

}