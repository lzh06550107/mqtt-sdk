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
    private $TempAndMask;

    /**
     * @var AccessControl 门禁控制
     */
    private $AccessControl;

    /**
     * @var GateControl 闸机控制
     */
    private $GateControl;

    /**
     * @return TempAndMask
     */
    public function getTempAndMask(): TempAndMask
    {
        return $this->TempAndMask;
    }

    /**
     * @param TempAndMask $TempAndMask
     */
    public function setTempAndMask(TempAndMask $TempAndMask): void
    {
        $this->TempAndMask = $TempAndMask;
    }

    /**
     * @return AccessControl
     */
    public function getAccessControl(): AccessControl
    {
        return $this->AccessControl;
    }

    /**
     * @param AccessControl $AccessControl
     */
    public function setAccessControl(AccessControl $AccessControl): void
    {
        $this->AccessControl = $AccessControl;
    }

    /**
     * @return GateControl
     */
    public function getGateControl(): GateControl
    {
        return $this->GateControl;
    }

    /**
     * @param GateControl $GateControl
     */
    public function setGateControl(GateControl $GateControl): void
    {
        $this->GateControl = $GateControl;
    }

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