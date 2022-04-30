<?php
/**
 * 文件描述
 * Created on 2022/2/14 9:53
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

/**
 * HTTP上传参数获取
 * Created on 2022/2/14 10:43
 * Create by LZH
 */
class GetHttpCfgResponse extends AbstractResponse
{

    /**
     * @var HttpCfg http参数配置
     */
    private $HttpCfg;

    /**
     * @return HttpCfg
     */
    public function getHttpCfg(): HttpCfg
    {
        return $this->HttpCfg;
    }

    /**
     * @param HttpCfg $HttpCfg
     */
    public function setHttpCfg(HttpCfg $HttpCfg): void
    {
        $this->HttpCfg = $HttpCfg;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        $httpCfg = new HttpCfg();
        $httpCfg->deserialize($param);

        $this->HttpCfg = $httpCfg;

    }
}