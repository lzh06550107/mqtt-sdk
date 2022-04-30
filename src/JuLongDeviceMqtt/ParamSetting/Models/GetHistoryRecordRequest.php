<?php
/**
 * 文件描述
 * Created on 2022/2/15 13:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 平台获取历史记录(门禁机支持)
 * Created on 2022/2/15 13:58
 * Create by LZH
 */
class GetHistoryRecordRequest extends AbstractRequest
{
    /**
     * @var int 通道号 （NVR）
     */
    private $ChannelNo;

    /**
     * @var int 获取记录指令 0：获取上报状态；1：获取上报记录；2：取消上报记录(上报中途取消)
     */
    private $Type;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss，Type为1时有该字段
     */
    private $BeginTime;

    /**
     * @var string 开始时间（年-月-日 时：分：秒） 格式：yyyy-mm-dd hh:mm:ss，Type为1时有该字段
     */
    private $EndTime;

    /**
     * @var int 乘车类型：1上车  2下车
     */
    private $RideType;

    /**
     * @var 0：所有；1：学生；2：家长
     */
    private $PersonIdentity;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::GET_HISTORY_RECORD); // 初始化动作名称
    }

    /**
     * @return int
     */
    public function getChannelNo(): int
    {
        return $this->ChannelNo;
    }

    /**
     * @param int $ChannelNo
     */
    public function setChannelNo(int $ChannelNo): void
    {
        $this->ChannelNo = $ChannelNo;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->Type;
    }

    /**
     * @param int $Type
     */
    public function setType(int $Type): void
    {
        $this->Type = $Type;
    }

    /**
     * @return string
     */
    public function getBeginTime(): string
    {
        return $this->BeginTime;
    }

    /**
     * @param string $BeginTime
     */
    public function setBeginTime(string $BeginTime): void
    {
        $this->BeginTime = $BeginTime;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->EndTime;
    }

    /**
     * @param string $EndTime
     */
    public function setEndTime(string $EndTime): void
    {
        $this->EndTime = $EndTime;
    }

    /**
     * @return int
     */
    public function getRideType(): int
    {
        return $this->RideType;
    }

    /**
     * @param int $RideType
     */
    public function setRideType(int $RideType): void
    {
        $this->RideType = $RideType;
    }

    /**
     * @return mixed
     */
    public function getPersonIdentity()
    {
        return $this->PersonIdentity;
    }

    /**
     * @param mixed $PersonIdentity
     */
    public function setPersonIdentity($PersonIdentity): void
    {
        $this->PersonIdentity = $PersonIdentity;
    }

}