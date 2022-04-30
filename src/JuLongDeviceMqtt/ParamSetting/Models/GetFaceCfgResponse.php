<?php
/**
 * 文件描述
 * Created on 2022/2/14 11:59
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * 人脸识别参数获取
 * Created on 2022/2/14 11:59
 * Create by LZH
 */
class GetFaceCfgResponse extends AbstractResponse
{
    /**
     * @var FaceCfg 人脸配置类
     */
    private $FaceCfg;

    /**
     * @return FaceCfg
     */
    public function getFaceCfg(): FaceCfg
    {
        return $this->FaceCfg;
    }

    /**
     * @param FaceCfg $FaceCfg
     */
    public function setFaceCfg(FaceCfg $FaceCfg): void
    {
        $this->FaceCfg = $FaceCfg;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $faceCfg = new FaceCfg();
        $faceCfg->deserialize($param);
        $this->FaceCfg = $faceCfg;

    }
}