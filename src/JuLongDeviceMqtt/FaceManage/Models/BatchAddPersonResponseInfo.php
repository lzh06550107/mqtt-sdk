<?php
/**
 * 文件描述
 * Created on 2022/2/10 13:49
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 批量添加响应主体对象类
 * Created on 2022/2/10 13:49
 * Create by LZH
 */
class BatchAddPersonResponseInfo extends AbstractModel
{
    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var int 图片下发类型 0：URL(PersonPhotoUrl)；1：Base64(PersonPhoto)；2：特征值(FeatureValue)
     */
    public $PhotoType;

    /**
     * @var int 人员ID
     */
    public $PersonId;

    /**
     * @var FacePosition 人脸坐标信息(像素为单位)
     */
    public $FacePosition;

    /**
     * @var int 入库失败错误码 0：成功
     */
    public $ret;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param['PersonType'])) {
            $this->PersonType = $param['PersonType'];
        }

        if (isset($param['PhotoType'])) {
            $this->PhotoType = $param['PhotoType'];
        }

        if (isset($param['PersonId'])) {
            $this->PersonId = $param['PersonId'];
        }

        if (isset($param['FacePosition'])) {
            $facePosition = new FacePosition();
            $facePosition->deserialize($param['FacePosition']);
            $this->FacePosition = $facePosition;
        }

        if (isset($param['ret'])) {
            $this->ret = $param['ret'];
        }
    }
}