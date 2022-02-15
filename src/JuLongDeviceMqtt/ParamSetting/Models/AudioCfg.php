<?php
/**
 * 文件描述
 * Created on 2022/2/15 9:58
 * Create by LZH
 */

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
    public $Enable;

    /**
     * @var int 音频输入 0：麦克；1：线输入
     */
    public $AudioInput;

    /**
     * @var int 压缩格式 0：G726；1：G711A；2：G711U；3：AAC
     */
    public $AudioFormat;

    /**
     * @var int 输入音量
     */
    public $InputVolume;

    /**
     * @var int 输出音量
     */
    public $OutputVolume;

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