<?php
/**
 * 文件描述
 * Created on 2022/2/15 10:25
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 设备配置类
 * Created on 2022/2/15 10:25
 * Create by LZH
 */
class DeviceCfg extends AbstractModel
{
    /**
     * @var int VO环出制式 0：PAL；1：NTSC，暂时只有门禁机支持
     */
    private $VideoFormat;

    /**
     * @var int 设备语音，暂时只有门禁机支持
     * 0:English
    1:简体中文
    2:繁体中文
    3:русский
    4:Deutsch
    5:Le français
    6: 한국어
    7: Português
    8: Espanol
    9: lingua italiana
    10:日本語
    11:Türkiye
    12:Custom language
     */
    private $DeviceLanguage;

    /**
     * @var int 屏幕显示UUID 0：不显示；1：显示，门禁机特有
     */
    private $DisplayUUID;

    /**
     * @return int
     */
    public function getVideoFormat(): int
    {
        return $this->VideoFormat;
    }

    /**
     * @param int $VideoFormat
     */
    public function setVideoFormat(int $VideoFormat): void
    {
        $this->VideoFormat = $VideoFormat;
    }

    /**
     * @return int
     */
    public function getDeviceLanguage(): int
    {
        return $this->DeviceLanguage;
    }

    /**
     * @param int $DeviceLanguage
     */
    public function setDeviceLanguage(int $DeviceLanguage): void
    {
        $this->DeviceLanguage = $DeviceLanguage;
    }

    /**
     * @return int
     */
    public function getDisplayUUID(): int
    {
        return $this->DisplayUUID;
    }

    /**
     * @param int $DisplayUUID
     */
    public function setDisplayUUID(int $DisplayUUID): void
    {
        $this->DisplayUUID = $DisplayUUID;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["VideoFormat"])) {
            $this->VideoFormat = $param["VideoFormat"];
        }

        if (isset($param["DeviceLanguage"])) {
            $this->DeviceLanguage = $param["DeviceLanguage"];
        }

        if (isset($param["DisplayUUID"])) {
            $this->DisplayUUID = $param["DisplayUUID"];
        }
    }
}