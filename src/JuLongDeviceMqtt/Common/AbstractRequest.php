<?php
/**
 * 文件描述
 * Created on 2022/1/24 14:40
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

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
    public $Action;

    /**
     * @var string 消息id
     */
    public $TaskID;


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