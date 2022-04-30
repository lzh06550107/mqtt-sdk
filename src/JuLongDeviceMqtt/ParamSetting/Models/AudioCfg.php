<?php
/**
 * 文件描述
 * Created on 2022/2/15 9:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 音频配置类
 * Created on 2022/2/15 9:58
 * Create by LZH
 */
class AudioCfg extends AbstractModel
{
    /**
     * @var int 音频开关 0：关闭；1：打开
     */
    private $Enable;

    /**
     * @var int 音频输入 0：麦克；1：线输入
     */
    private $AudioInput;

    /**
     * @var int 压缩格式 0：G726；1：G711A；2：G711U；3：AAC
     */
    private $AudioFormat;

    /**
     * @var int 输入音量
     */
    private $InputVolume;

    /**
     * @var int 输出音量
     */
    private $OutputVolume;

    /**
     * @return int
     */
    public function getEnable(): int
    {
        return $this->Enable;
    }

    /**
     * @param int $Enable
     */
    public function setEnable(int $Enable): void
    {
        $this->Enable = $Enable;
    }

    /**
     * @return int
     */
    public function getAudioInput(): int
    {
        return $this->AudioInput;
    }

    /**
     * @param int $AudioInput
     */
    public function setAudioInput(int $AudioInput): void
    {
        $this->AudioInput = $AudioInput;
    }

    /**
     * @return int
     */
    public function getAudioFormat(): int
    {
        return $this->AudioFormat;
    }

    /**
     * @param int $AudioFormat
     */
    public function setAudioFormat(int $AudioFormat): void
    {
        $this->AudioFormat = $AudioFormat;
    }

    /**
     * @return int
     */
    public function getInputVolume(): int
    {
        return $this->InputVolume;
    }

    /**
     * @param int $InputVolume
     */
    public function setInputVolume(int $InputVolume): void
    {
        $this->InputVolume = $InputVolume;
    }

    /**
     * @return int
     */
    public function getOutputVolume(): int
    {
        return $this->OutputVolume;
    }

    /**
     * @param int $OutputVolume
     */
    public function setOutputVolume(int $OutputVolume): void
    {
        $this->OutputVolume = $OutputVolume;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["Enable"])) {
            $this->Enable = $param["Enable"];
        }

        if (isset($param["AudioInput"])) {
            $this->AudioInput = $param["AudioInput"];
        }

        if (isset($param["AudioFormat"])) {
            $this->AudioFormat = $param["AudioFormat"];
        }

        if (isset($param["InputVolume"])) {
            $this->InputVolume = $param["InputVolume"];
        }

        if (isset($param["OutputVolume"])) {
            $this->OutputVolume = $param["OutputVolume"];
        }
    }
}