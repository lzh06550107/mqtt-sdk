<?php
/**
 * 文件描述
 * Created on 2022/2/9 17:03
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetPersonResponse extends AbstractResponse
{
    /**
     * @var int 相似度阈值，返回大于等于该阈值的人脸，SearchType不为2时必填
     */
    public $Similarity;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var PersonInfo 人员信息
     */
    public $PersonInfo;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["Similarity"])) {
            $this->Similarity = $param["Similarity"];
        }

        if (isset($param["PersonType"])) {
            $this->PersonType = $param["PersonType"];
        }

        // 封装 PersonInfo 对象
        $this->PersonInfo = new PersonInfo();
        $this->PersonInfo->deserialize($param);

    }

}