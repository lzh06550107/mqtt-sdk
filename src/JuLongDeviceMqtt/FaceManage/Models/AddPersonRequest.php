<?php
/**
 * 文件描述
 * Created on 2022/1/24 14:49
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 添加人员信息
 * Created on 2022/1/24 14:49
 * Create by LZH
 *
 * @property PersonInfo $PersonInfo 添加人员信息
 */
class AddPersonRequest extends AbstractRequest
{
    /**
     * @var int 是否覆盖人员(通过PersonId覆盖) 0：不覆盖；1：覆盖
     */
    public $PersonCover;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = FaceManageAction::ADD_PERSON; // 初始化动作名称
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