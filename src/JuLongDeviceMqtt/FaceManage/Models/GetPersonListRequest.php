<?php
/**
 * 文件描述
 * Created on 2022/2/8 9:22
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 获取名单列表
 * Created on 2022/2/8 9:23
 * Create by LZH
 */
class GetPersonListRequest extends AbstractRequest
{
    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @var SearchCondition 搜索条件
     */
    public $SearchCondition;

    /**
     * @var int 当前页码
     */
    public $PageCurNO;

    /**
     * @var int 当前页需要返回的记录数
     */
    public $NameCount;


    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::GET_PERSON_LIST; // 初始化动作名称
    }
}