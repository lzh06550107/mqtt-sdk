<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:41
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class DeletePersonResponse extends AbstractResponse
{

    /**
     * @var string 人员ID
     */
    public $PersonId;

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["PersonId"])) {
            $this->PersonId = $param["PersonId"];
        }

    }
}