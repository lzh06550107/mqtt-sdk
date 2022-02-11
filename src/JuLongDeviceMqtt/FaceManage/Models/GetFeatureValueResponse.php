<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:09
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetFeatureValueResponse extends AbstractResponse
{
    /**
     * @var int 特征值类型 0：float；1：char；2：int；3：通用类型
     */
    public $FeatureType;

    /**
     * @var string 人员特征值数据(Base64，不可转换为图片)
     */
    public $FeatureValue;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["FeatureType"])) {
            $this->FeatureType = $param["FeatureType"];
        }

        if (isset($param['FeatureValue'])) {
            $this->FeatureValue = $param['FeatureValue'];
        }

    }
}