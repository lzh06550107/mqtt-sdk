<?php
/**
 * 文件描述
 * Created on 2022/2/14 14:17
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 人脸图片名(比视机特有)
 * Created on 2022/2/14 14:17
 * Create by LZH
 */
class PicturePrefix extends AbstractModel
{
    private $PictureEnabled;

    private $CustomPrefix;

    /**
     * @return mixed
     */
    public function getPictureEnabled()
    {
        return $this->PictureEnabled;
    }

    /**
     * @param mixed $PictureEnabled
     */
    public function setPictureEnabled($PictureEnabled): void
    {
        $this->PictureEnabled = $PictureEnabled;
    }

    /**
     * @return mixed
     */
    public function getCustomPrefix()
    {
        return $this->CustomPrefix;
    }

    /**
     * @param mixed $CustomPrefix
     */
    public function setCustomPrefix($CustomPrefix): void
    {
        $this->CustomPrefix = $CustomPrefix;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["PictureEnabled"])) {
            $this->PictureEnabled = $param["PictureEnabled"];
        }

        if (isset($param["CustomPrefix"])) {
            $this->CustomPrefix = $param["CustomPrefix"];
        }
    }
}