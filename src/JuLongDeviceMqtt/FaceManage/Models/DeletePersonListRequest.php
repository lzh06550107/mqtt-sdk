<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:53
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 删除名单库（名单分组）
 * Created on 2022/2/10 9:54
 * Create by LZH
 */
class DeletePersonListRequest extends AbstractRequest
{

    /**
     * @var int 名单类型 0：所有名单(门禁机支持)；1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::DELETE_PERSON_LIST; // 初始化动作名称
    }
}