<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:41
 * Create by LZH
 */

declare(strict_types=1);

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
        $this->setAction(FaceManageAction::DELETE_PERSON); // 初始化动作名称
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

    /**
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->PersonId;
    }

    /**
     * @param string $PersonId
     */
    public function setPersonId(string $PersonId): void
    {
        $this->PersonId = $PersonId;
    }


}