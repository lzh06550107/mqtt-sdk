<?php
/**
 * 文件描述
 * Created on 2022/2/14 14:20
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

class PictureCompression extends AbstractModel
{
    private $CompressionEnabled;

    private $CompressionSize;

    /**
     * @return mixed
     */
    public function getCompressionEnabled()
    {
        return $this->CompressionEnabled;
    }

    /**
     * @param mixed $CompressionEnabled
     */
    public function setCompressionEnabled($CompressionEnabled): void
    {
        $this->CompressionEnabled = $CompressionEnabled;
    }

    /**
     * @return mixed
     */
    public function getCompressionSize()
    {
        return $this->CompressionSize;
    }

    /**
     * @param mixed $CompressionSize
     */
    public function setCompressionSize($CompressionSize): void
    {
        $this->CompressionSize = $CompressionSize;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["CompressionEnabled"])) {
            $this->CompressionEnabled = $param["CompressionEnabled"];
        }

        if (isset($param["CompressionSize"])) {
            $this->CompressionSize = $param["CompressionSize"];
        }
    }
}