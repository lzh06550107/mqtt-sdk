<?php
/**
 * 文件描述
 * Created on 2022/2/8 18:45
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetPersonListResponse extends AbstractResponse
{

    /**
     * @var int 名单类型 1：黑名单；2：白名单；3：VIP名单
     */
    private $PersonType;

    /**
     * @var int 该名单总人数
     */
    private $PersonNum;

    /**
     * @var int 总页数
     */
    private $PageTotalNO;

    /**
     * @var int 当前要获取的页码
     */
    private $PageCurNO;

    /**
     * @var int 指定页号返回的实际名单数目
     */
    private $NameCount;

    /**
     * @var PersonInfo[] 获取到的名单列表
     */
    private $PersonList;

    /**
     * @return int
     */
    public function getPersonType(): int
    {
        return $this->PersonType;
    }

    /**
     * @param int $PersonType
     */
    public function setPersonType(int $PersonType): void
    {
        $this->PersonType = $PersonType;
    }

    /**
     * @return int
     */
    public function getPersonNum(): int
    {
        return $this->PersonNum;
    }

    /**
     * @param int $PersonNum
     */
    public function setPersonNum(int $PersonNum): void
    {
        $this->PersonNum = $PersonNum;
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
     * @return PersonInfo[]
     */
    public function getPersonList(): array
    {
        return $this->PersonList;
    }

    /**
     * @param PersonInfo[] $PersonList
     */
    public function setPersonList(array $PersonList): void
    {
        $this->PersonList = $PersonList;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["PersonType"])) {
            $this->PersonType = $param["PersonType"];
        }

        if (isset($param["PersonNum"])) {
            $this->PersonNum = $param["PersonNum"];
        }

        if (isset($param["PageTotalNO"])) {
            $this->PageTotalNO = $param["PageTotalNO"];
        }

        if (isset($param["PageCurNO"])) {
            $this->PageCurNO = $param["PageCurNO"];
        }

        if (isset($param["NameCount"])) {
            $this->NameCount = $param["NameCount"];
        }

        if (isset($param['PersonList'])) {
            $personList = [];
            foreach ($param['PersonList'] as $person) {
                $personInfo = new PersonInfo();
                $personInfo->deserialize($person);
                $personList[] = $personInfo;
            }
            $this->PersonList = $personList;
        }


    }
}