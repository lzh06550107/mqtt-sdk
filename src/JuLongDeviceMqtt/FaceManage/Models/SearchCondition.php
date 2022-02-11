<?php
/**
 * 文件描述
 * Created on 2022/2/8 9:37
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 搜索条件
 * Created on 2022/2/8 9:38
 * Create by LZH
 */
class SearchCondition extends AbstractModel
{
    /**
     * @var int 查找方式 0：条件查找；1：姓名模糊查找；2：重复身份证号查找；3：重复门禁卡号查找
     */
    public $SearchMethod;

    /**
     * @var string 姓名，SearchMethod为1时必填
     */
    public $Name;

    /**
     * @var string 人员有效开始时间 格式: yyyy-mm-dd hh:mm:ss，SearchMethod为0时必填
     */
    public $StartTime;

    /**
     * @var string 人员有效开始时间 格式: yyyy-mm-dd hh:mm:ss，SearchMethod为0时必填
     */
    public $EndTime;

    /**
     * @var int 名单时效 0：永久有效；1：临时有效；2：所有，SearchMethod为0时必填
     */
    public $LimitTime;

    /**
     * @var int 人员身份类型，用于名单分类 0：所有；1：老师；2：走读(学生)；3：寄宿(学生)；4：访客，SearchMethod为0时必填
     */
    public $PersonIdentity;

    /**
     * @var int[] 通行策略ID
     */
    public $StrategyId;

    /**
     * @var int 性别 0：所有；1：男；2：女，SearchMethod为0时必填
     */
    public $Sex;

    /**
     * @var int[] 年龄范围，SearchMethod为0时必填
     */
    public $AgeRange;

    /**
     * @var int 人员ID(对应页面门禁卡号)，SearchMethod为0时可选
     */
    public $PersonId;

}