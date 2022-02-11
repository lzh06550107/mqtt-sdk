<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:41
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 删除人员
 * Created on 2022/2/10 9:41
 * Create by LZH
 */
class DeletePersonRequest extends AbstractRequest
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
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::DELETE_PERSON; // 初始化动作名称
    }
}