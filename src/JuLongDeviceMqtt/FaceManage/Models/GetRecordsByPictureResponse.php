<?php
/**
 * 文件描述
 * Created on 2022/2/10 18:19
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetRecordsByPictureResponse extends AbstractResponse
{
    /**
     * @var int 通道号(NVR服务器需要用到)
    使用掩码方式，支持组合通道，如要查询1、3、5通道，则传入21，0表示所有通道
     */
    private $ChannelNo;

    /**
     * @var int 比对记录总数
     */
    private $Total;

    /**
     * @var int 总页数
     */
    private $PageTotalNO;

    /**
     * @var int 当前要获取的页，初值为1
     */
    private $PageCurNO;

    /**
     * @var int 指定页号返回的实际名单数目
     */
    private $NameCount;

    /**
     * @var Record[] 比对记录信息
     */
    private $Records;

    /**
     * @return int
     */
    public function getChannelNo(): int
    {
        return $this->ChannelNo;
    }

    /**
     * @param int $ChannelNo
     */
    public function setChannelNo(int $ChannelNo): void
    {
        $this->ChannelNo = $ChannelNo;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->Total;
    }

    /**
     * @param int $Total
     */
    public function setTotal(int $Total): void
    {
        $this->Total = $Total;
    }

    /**
     * @return int
     */
    public function getPageTotalNO(): int
    {
        return $this->PageTotalNO;
    }

    /**
     * @param int $PageTotalNO
     */
    public function setPageTotalNO(int $PageTotalNO): void
    {
        $this->PageTotalNO = $PageTotalNO;
    }

    /**
     * @return int
     */
    public function getPageCurNO(): int
    {
        return $this->PageCurNO;
    }

    /**
     * @param int $PageCurNO
     */
    public function setPageCurNO(int $PageCurNO): void
    {
        $this->PageCurNO = $PageCurNO;
    }

    /**
     * @return int
     */
    public function getNameCount(): int
    {
        return $this->NameCount;
    }

    /**
     * @param int $NameCount
     */
    public function setNameCount(int $NameCount): void
    {
        $this->NameCount = $NameCount;
    }

    /**
     * @return Record[]
     */
    public function getRecords(): array
    {
        return $this->Records;
    }

    /**
     * @param Record[] $Records
     */
    public function setRecords(array $Records): void
    {
        $this->Records = $Records;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["ChannelNo"])) {
            $this->ChannelNo = $param["ChannelNo"];
        }

        if (isset($param['Total'])) {
            $this->Total = $param['Total'];
        }

        if (isset($param['PageTotalNO'])) {
            $this->PageTotalNO = $param['PageTotalNO'];
        }

        if (isset($param['PageCurNO'])) {
            $this->PageCurNO = $param['PageCurNO'];
        }

        if (isset($param['NameCount'])) {
            $this->NameCount = $param['NameCount'];
        }

        if (isset($param['Records'])) {
            $records = [];
            foreach ($param['Records'] as $record) {
                $recordObj = new Record();
                $recordObj->deserialize($record);
                $records[] = $recordObj;
            }
            $this->Records = $records;
        }

    }

}