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
    public $FaceCfg;

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