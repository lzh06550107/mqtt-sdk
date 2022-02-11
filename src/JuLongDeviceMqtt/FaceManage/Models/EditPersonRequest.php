<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:15
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 编辑人员请求
 * Created on 2022/2/10 9:16
 * Create by LZH
 *
 * @property PersonInfo $PersonInfo 编辑人员信息
 */
class EditPersonRequest extends AbstractRequest
{
    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::EDIT_PERSON; // 初始化动作名称
    }

    // 给一个未定义的属性赋值时调用
    function __set($property, $value) {
        $filterProperty = ["PersonInfo"];
        if (in_array($property, $filterProperty)) {
            $this->copyProperties($value, $this); // 复制属性到当前对象
        } else {
            $this->$property = $value;
        }
    }
}