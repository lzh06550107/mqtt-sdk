<?php
/**
 * 文件描述
 * Created on 2022/2/10 16:49
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 批量删除人员信息
 * Created on 2022/2/10 16:49
 * Create by LZH
 */
class BatchDeletePersonInfo extends AbstractModel
{
    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var string 人员ID
     */
    public $PersonId;
}