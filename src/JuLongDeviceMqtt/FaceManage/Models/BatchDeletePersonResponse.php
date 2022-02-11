<?php
/**
 * 文件描述
 * Created on 2022/2/10 16:46
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class BatchDeletePersonResponse extends AbstractResponse
{
    /**
     * @var BatchAddPersonResponseInfo[] 批量删除人员信息
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
                $batchDeletePersonResponseInfo = new BatchDeletePersonResponseInfo();
                $batchDeletePersonResponseInfo->deserialize($person);
                $personInfos[] = $batchDeletePersonResponseInfo;
            }
            $this->PersonInfo = $personInfos;
        }
    }
}