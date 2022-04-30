<?php
/**
 * 文件描述
 * Created on 2022/2/10 16:46
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class BatchDeletePersonResponse extends AbstractResponse
{
    /**
     * @var BatchAddPersonResponseInfo[] 批量删除人员信息
     */
    private $PersonInfo;

    /**
     * @return BatchAddPersonResponseInfo[]
     */
    public function getPersonInfo(): array
    {
        return $this->PersonInfo;
    }

    /**
     * @param BatchAddPersonResponseInfo[] $PersonInfo
     */
    public function setPersonInfo(array $PersonInfo): void
    {
        $this->PersonInfo = $PersonInfo;
    }

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