<?php
/**
 * 文件描述
 * Created on 2022/2/14 10:19
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 抓拍信息上传内容
 * Created on 2022/2/14 10:19
 * Create by LZH
 */
class CaptureContent extends AbstractModel
{
    /**
     * @var int 上传”FaceInfo”内容(抓拍信息) 0：不上传；1：上传
     */
    private $FaceInfo;

    /**
     * @var int 上传”CompareInfo”内容(比对信息) 0：不上传；1：上传
     */
    private $CompareInfo;

    /**
     * @return int
     */
    public function getFaceInfo(): int
    {
        return $this->FaceInfo;
    }

    /**
     * @param int $FaceInfo
     */
    public function setFaceInfo(int $FaceInfo): void
    {
        $this->FaceInfo = $FaceInfo;
    }

    /**
     * @return int
     */
    public function getCompareInfo(): int
    {
        return $this->CompareInfo;
    }

    /**
     * @param int $CompareInfo
     */
    public function setCompareInfo(int $CompareInfo): void
    {
        $this->CompareInfo = $CompareInfo;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["FaceInfo"])) {
            $this->FaceInfo = $param["FaceInfo"];
        }

        if (isset($param["CompareInfo"])) {
            $this->CompareInfo = $param["CompareInfo"];
        }

    }
}