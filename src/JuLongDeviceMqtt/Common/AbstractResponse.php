<?php
/**
 * 文件描述
 * Created on 2022/1/24 15:33
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

/**
 * 抽象响应类
 * Created on 2022/1/24 15:33
 * Create by LZH
 */
abstract class AbstractResponse extends AbstractModel
{
    /**
     * @var string 响应的请求动作名称
     */
    private $Action;

    /**
     * @var string 消息id
     */
    private $TaskID;

    /**
     * @var string 设备UUID
     */
    private $DeviceUUID;

    /**
     * @var int 返回码 0表示成功
     */
    private $Ret = 0;



    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->Action;
    }

    /**
     * @param string $Action
     */
    public function setAction(string $Action): void
    {
        $this->Action = $Action;
    }

    /**
     * @return string
     */
    public function getTaskID(): string
    {
        return $this->TaskID;
    }

    /**
     * @param string $TaskID
     */
    public function setTaskID(string $TaskID): void
    {
        $this->TaskID = $TaskID;
    }

    /**
     * @return string
     */
    public function getDeviceUUID(): string
    {
        return $this->DeviceUUID;
    }

    /**
     * @param string $DeviceUUID
     */
    public function setDeviceUUID(string $DeviceUUID): void
    {
        $this->DeviceUUID = $DeviceUUID;
    }

    /**
     * @return int
     */
    public function getRet(): int
    {
        return $this->Ret;
    }

    /**
     * @param int $Ret
     */
    public function setRet(int $Ret): void
    {
        $this->Ret = $Ret;
    }


    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["Action"])) {
            $this->setAction($param["Action"]);
        }

        if (isset($param['TaskID'])) {
            $this->setTaskID($param['TaskID']);
        }

        if (isset($param['DeviceUUID'])) {
            $this->setDeviceUUID($param['DeviceUUID']);
        }

        if (isset($param['Ret'])) {
            $this->setRet($param['Ret']);
        }

    }
}