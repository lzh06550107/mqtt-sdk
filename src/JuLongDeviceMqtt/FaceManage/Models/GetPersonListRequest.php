<?php
/**
 * 文件描述
 * Created on 2022/2/8 9:22
 * Create by LZH
 */

declare(strict_types=1);

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
     * @var SearchCondition|null 搜索条件
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
        $this->setAction(FaceManageAction::GET_PERSON_LIST); // 初始化动作名称
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
     * @return SearchCondition|null
     */
    public function getSearchCondition(): ?SearchCondition
    {
        return $this->SearchCondition;
    }

    /**
     * @param SearchCondition $SearchCondition
     */
    public function setSearchCondition(SearchCondition $SearchCondition): void
    {
        $this->SearchCondition = $SearchCondition;
    }

    /**
     * @return int
     */
    public function getPageCurNO(): int
    {
        return $this->PageCurNO;
    }

    /**
     * @param int $PageCurNO
     */
    public function setPageCurNO(int $PageCurNO): void
    {
        $this->PageCurNO = $PageCurNO;
    }

    /**
     * @return int
     */
    public function getNameCount(): int
    {
        return $this->NameCount;
    }

    /**
     * @param int $NameCount
     */
    public function setNameCount(int $NameCount): void
    {
        $this->NameCount = $NameCount;
    }

}