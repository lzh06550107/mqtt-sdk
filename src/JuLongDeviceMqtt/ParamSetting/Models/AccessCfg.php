<?php
/**
 * 文件描述
 * Created on 2022/2/12 15:35
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 测温机门禁控制参数配置类
 * Created on 2022/2/12 15:35
 * Create by LZH
 */
class AccessCfg extends AbstractModel
{
    /**
     * @var TempAndMask 温度和口罩设置
     */
    public $TempAndMask;

    /**
     * @var AccessControl 门禁控制
     */
    public $AccessControl;

    /**
     * @var GateControl 闸机控制
     */
    public $GateControl;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["TempAndMask"])) {
            $tempAndMask = new TempAndMask();
            $tempAndMask->deserialize($param['TempAndMask']);
            $this->TempAndMask = $tempAndMask;
        }

        if (isset($param["AccessControl"])) {
            $accessControl = new AccessControl();
            $accessControl->deserialize($param['AccessControl']);
            $this->AccessControl = $accessControl;
        }

        if (isset($param["GateControl"])) {
            $gateControl = new GateControl();
            $gateControl->deserialize($param['GateControl']);
            $this->GateControl = $gateControl;
        }

    }

}