<?php
/**
 * 文件描述
 * Created on 2022/1/24 14:49
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;
use ReflectionClass;
use ReflectionMethod;

/**
 * 添加人员信息
 * Created on 2022/1/24 14:49
 * Create by LZH
 *
 * @method setPersonInfo(PersonInfo $personInfo) 添加人员信息
 */
class AddPersonRequest extends AbstractRequest
{

    protected $extraAllowProperty = ["PersonInfo"];

    /**
     * @var int 是否覆盖人员(通过PersonId覆盖) 0：不覆盖；1：覆盖
     */
    private $personCover;

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    private $personType;


    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::ADD_PERSON); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getPersonCover(): int
    {
        return $this->PersonCover;
    }

    /**
     * @param int $PersonCover
     */
    public function setPersonCover(int $PersonCover): void
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


}