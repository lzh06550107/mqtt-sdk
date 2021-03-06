<?php
/**
 * 文件描述
 * Created on 2022/2/10 16:44
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\FaceManageAction;

/**
 * 批量删除人员
 * Created on 2022/2/10 16:45
 * Create by LZH
 */
class BatchDeletePersonRequest extends AbstractRequest
{
    /**
     * @var BatchDeletePersonInfo[] 批量删除人员信息列表
     */
    private $PersonInfo;

    /**
     * @return BatchDeletePersonInfo[]
     */
    public function getPersonInfo(): array
    {
        return $this->PersonInfo;
    }

    /**
     * @param BatchDeletePersonInfo[] $PersonInfo
     */
    public function setPersonInfo(array $PersonInfo): void
    {
        $this->PersonInfo = $PersonInfo;
    }

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(FaceManageAction::DELETE_PERSONS); // 初始化动作名称
    }
}