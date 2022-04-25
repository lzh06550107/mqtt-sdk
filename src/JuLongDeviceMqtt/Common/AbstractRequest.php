<?php
/**
 * 文件描述
 * Created on 2022/1/24 14:40
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use ReflectionClass;
use ReflectionMethod;

/**
 * 抽象请求类
 * Created on 2022/1/24 15:32
 * Create by LZH
 */
abstract class AbstractRequest extends AbstractModel
{
    /**
     * @var string 请求动作
     */
    private $action;

    /**
     * @var string|null 消息id
     */
    private $taskID;

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string|null
     */
    public function getTaskID(): ?string
    {
        return $this->taskID;
    }

    /**
     * @param string|null $taskID
     */
    public function setTaskID(?string $taskID): void
    {
        $this->taskID = $taskID;
    }


    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["Action"])) {
            $this->Action = $param["Action"];
        }

        if (isset($param['TaskID'])) {
            $this->TaskID = $param['TaskID'];
        }

    }

}