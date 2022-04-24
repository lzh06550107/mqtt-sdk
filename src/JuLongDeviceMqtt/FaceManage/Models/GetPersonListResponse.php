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
    public $PersonType;

    /**
     * @var int 该名单总人数
     */
    public $PersonNum;

    /**
     * @var int 总页数
     */
    public $PageTotalNO;

    /**
     * @var int 当前要获取的页码
     */
    public $PageCurNO;

    /**
     * @var int 指定页号返回的实际名单数目
     */
    public $NameCount;

    /**
     * @var PersonInfo[] 获取到的名单列表
     */
    public $PersonList;

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