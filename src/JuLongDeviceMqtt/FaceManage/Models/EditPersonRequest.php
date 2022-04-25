<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:15
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 编辑人员请求
 * Created on 2022/2/10 9:16
 * Create by LZH
 *
 * @method setPersonInfo(PersonInfo $PersonInfo) 编辑人员信息
 */
class EditPersonRequest extends AbstractRequest
{

    protected $extraAllowProperty = ['PersonInfo'];

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    public $PersonType;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::EDIT_PERSON); // 初始化动作名称
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