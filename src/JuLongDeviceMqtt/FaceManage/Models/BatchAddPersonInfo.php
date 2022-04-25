<?php
/**
 * 文件描述
 * Created on 2022/2/10 11:27
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 批量添加人员信息
 * Created on 2022/2/10 11:27
 * Create by LZH
 *
 * @method setPersonInfo(PersonInfo $personInfo) 添加人员信息
 */
class BatchAddPersonInfo extends AbstractModel
{
    protected $extraAllowProperty = ["PersonInfo"];

    /**
     * @var int|null 是否编辑人员（通过PersonId编辑） 0：入库；1：编辑
     */
    public $OperateType;

    /**
     * @var int|null 是否覆盖人员（通过PersonId覆盖） 0：不覆盖；1：覆盖
     */
    public $PersonCover;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * @return int|null
     */
    public function getOperateType(): ?int
    {
        return $this->OperateType;
    }

    /**
     * @param int|null $OperateType
     */
    public function setOperateType(?int $OperateType): void
    {
        $this->OperateType = $OperateType;
    }

    /**
     * @return int|null
     */
    public function getPersonCover(): ?int
    {
        return $this->PersonCover;
    }

    /**
     * @param int|null $PersonCover
     */
    public function setPersonCover(?int $PersonCover): void
    {
        $this->PersonCover = $PersonCover;
    }

    /**
     * @return int
     */
    public function getPersonType(): int
    {
        return $this->PersonType;
    }

    /**
     * @param int $PersonType
     */
    public function setPersonType(int $PersonType): void
    {
        $this->PersonType = $PersonType;
    }


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
//    function __set($property, $value) {
//        $filterProperty = ["PersonInfo"];
//        if (in_array($property, $filterProperty)) {
//            $this->copyProperties($value, $this); // 复制属性到当前对象
//        } else {
//            $this->$property = $value;
//        }
//    }

}