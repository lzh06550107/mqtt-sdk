<?php
/**
 * 文件描述
 * Created on 2022/1/24 15:33
 * Create by LZH
 */

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
    public $Action;

    /**
     * @var string 消息id
     */
    public $TaskID;

    /**
     * @var string 设备UUID
     */
    public $DeviceUUID;

    /**
     * @var int 返回码 0表示成功
     */
    public $Ret = 0;

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

        if (isset($param['DeviceUUID'])) {
            $this->DeviceUUID = $param['DeviceUUID'];
        }

        if (isset($param['Ret'])) {
            $this->Ret = $param['Ret'];
        }

    }
}