<?php
/**
 * 文件描述
 * Created on 2022/2/10 11:11
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class BatchAddPersonResponse extends AbstractResponse
{
    /**
     * @var BatchAddPersonResponseInfo[] 批量添加返回响应信息
     */
    public $PersonInfo;

    public function deserialize($param)
    {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param['PersonInfo'])) {
            $personInfos = [];
            foreach ($param['PersonInfo'] as $person) {
                $batchAddPersonResponseInfo = new BatchAddPersonResponseInfo();
                $batchAddPersonResponseInfo->deserialize($person);
                $personInfos[] = $batchAddPersonResponseInfo;
            }
            $this->PersonInfo = $personInfos;
        }
    }
}