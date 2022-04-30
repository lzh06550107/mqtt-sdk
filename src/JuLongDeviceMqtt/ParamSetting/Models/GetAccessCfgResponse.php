<?php
/**
 * 文件描述
 * Created on 2022/2/12 15:31
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * 测温机门禁控制参数获取(门禁机支持)
 * Created on 2022/2/12 15:31
 * Create by LZH
 */
class GetAccessCfgResponse extends AbstractResponse
{
    /**
     * @var AccessCfg $AccessCfg 测温机门禁控制参数配置对象
     */
    private $AccessCfg;

    /**
     * @return AccessCfg
     */
    public function getAccessCfg(): AccessCfg
    {
        return $this->AccessCfg;
    }

    /**
     * @param AccessCfg $AccessCfg
     */
    public function setAccessCfg(AccessCfg $AccessCfg): void
    {
        $this->AccessCfg = $AccessCfg;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $accessCfg = new AccessCfg();
        $accessCfg->deserialize($param);
        $this->AccessCfg = $accessCfg;

    }
}