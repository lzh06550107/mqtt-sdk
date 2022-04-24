<?php
/**
 * 文件描述
 * Created on 2022/1/24 17:08
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage;

/**
 * 名单管理请求动作类
 * Created on 2021/12/28 14:05
 * Create by LZH
 */
class FaceManageAction
{
    /**
     * 获取名单列表，
     */
    public const GET_PERSON_LIST = "getPersonList";

    /**
     * 获取人员信息，
     */
    public const GET_PERSON = "getPerson";

    /**
     * 添加人员信息，
     */
    public const ADD_PERSON = "addPerson";

    /**
     * 编辑人员信息，
     */
    public const EDIT_PERSON = "editPerson";

    /**
     * 删除人员信息，
     */
    public const DELETE_PERSON = "deletePerson";

    /**
     * 删除名单库（名单分组），
     */
    public const DELETE_PERSON_LIST = "deletePersonList";

    /**
     * 批量添加人员，
     */
    public const ADD_PERSONS = "batchAddPerson";

    /**
     * 批量删除人员
     */
    public const DELETE_PERSONS = "batchDeletePerson";

    /**
     * 获取人脸特征值
     */
    public const GET_FEATURE_VALUE = "getFeatureValue";

    /**
     * 获取图片、特征值比较相似度
     */
    public const GET_FACE_SIMILARITY = "getFaceSimilarity";

    /**
     * 检测图片中人脸是否合格
     */
    public const DETECT_FACE_FROM_PHOTO = "detectFaceFromPhoto";

    /**
     * 以图/特征值/人员ID搜索比对记录(门禁机支持)
     */
    public const GET_RECORDS_BY_PICTURE = "getRecordsByPicture";

    /**
     * 通过图片路径获取图片
     */
    public const GET_PICTURE_BY_FILENAME = "getPictureByFileName";

    /**
     * 二维码设置（与扫码结果对应）
     */
    public const SET_QRCODE = "setQRCode";

    /**
     * 获取批量注册人员进度
     */
    public const GET_BATCH_ADD_PROGRESS = "getBatchAddProgressRequest";
}