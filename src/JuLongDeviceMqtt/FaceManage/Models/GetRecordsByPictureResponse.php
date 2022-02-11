<?php
/**
 * 文件描述
 * Created on 2022/2/10 18:19
 * Create by LZH
 */

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class GetRecordsByPictureResponse extends AbstractResponse
{
    /**
     * @var int 通道号(NVR服务器需要用到)
    使用掩码方式，支持组合通道，如要查询1、3、5通道，则传入21，0表示所有通道
     */
    public $ChannelNo;

    /**
     * @var int 比对记录总数
     */
    public $Total;

    /**
     * @var int 总页数
     */
    public $PageTotalNO;

    /**
     * @var int 当前要获取的页，初值为1
     */
    public $PageCurNO;

    /**
     * @var int 指定页号返回的实际名单数目
     */
    public $NameCount;

    /**
     * @var Record[] 比对记录信息
     */
    public $Records;


}