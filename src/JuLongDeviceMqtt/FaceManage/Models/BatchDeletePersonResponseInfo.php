<?php
/**
 * 文件描述
 * Created on 2022/2/10 16:55
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

class BatchDeletePersonResponseInfo extends AbstractModel
{
    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var string 人员ID
     */
    public $PersonId;

    /**
     * @var int 删除失败错误码 0：成功
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

        if (isset($param['PersonId'])) {
            $this->PersonId = $param['PersonId'];
        }

        if (isset($param['ret'])) {
            $this->ret = $param['ret'];
        }

    }
}