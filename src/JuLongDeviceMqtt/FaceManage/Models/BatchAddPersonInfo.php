<?php
/**
 * 文件描述
 * Created on 2022/2/10 11:27
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 批量添加人员信息
 * Created on 2022/2/10 11:27
 * Create by LZH
 *
 * @property PersonInfo $PersonInfo 添加人员信息
 */
class BatchAddPersonInfo extends AbstractModel
{
    /**
     * @var int 是否编辑人员（通过PersonId编辑） 0：入库；1：编辑
     */
    public $OperateType;

    /**
     * @var int 是否覆盖人员（通过PersonId覆盖） 0：不覆盖；1：覆盖
     */
    public $PersonCover;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param['OperateType'])) {
            $this->OperateType = $param['OperateType'];
        }

        if (isset($param['PersonCover'])) {
            $this->PersonCover = $param['PersonCover'];
        }

        if (isset($param['PersonType'])) {
            $this->PersonType = $param['PersonType'];
        }

        if (isset($param['PersonInfo'])) {
            $this->PersonInfo = $param['PersonInfo'];
        }

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