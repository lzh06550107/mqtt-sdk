<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting;

/**
 * 参数设置请求动作类
 * Created on 2022/2/11 16:35
 * Create by LZH
 */
class ParamSettingAction
{
    /**
     * 人脸识别报警参数获取(抓拍机、比对机支持)
     */
    public const GET_ALARM_CFG = "getAlarmCfgRequest";

    /**
     * 人脸识别报警参数设置(抓拍机、比对机支持)
     */
    public const SET_ALARM_CFG = "setAlarmCfgRequest";

    /**
     * 测温机门禁控制参数获取(门禁机支持)
     */
    public const GET_ACCESS_CFG = "getAccessCfgRequest";

    /**
     * 测温机门禁控制参数设置(门禁机支持)
     */
    public const SET_ACCESS_CFG = "setAccessCfgRequest";

    /**
     * 获取HTTP上传参数
     */
    public const GET_HTTP_CFG = "getHttpCfgRequest";

    /**
     * HTTP 上传参数设置
     */
    public const SET_HTTP_CFG = "setHttpCfgRequest";

    /**
     * 获取人脸识别参数
     */
    public const GET_FACE_CFG = "getFaceCfgRequest";

    /**
     * 人脸识别参数设置，注：门禁机设备抓拍模式仅有单人模式。
     */
    public const SET_FACE_CFG = "setFaceCfgRequest";

    /**
     * 网络参数获取
     */
    public const GET_NET_CFG = "getNetCfgRequest";

    /**
     * 网络参数设置
     */
    public const SET_NET_CFG = "setNetCfgRequest";

    /**
     * 获取系统时间
     */
    public const GET_SYS_TIME = "getSysTimeRequest";

    /**
     * 系统时间设置
     */
    public const SET_SYS_TIME = "setSysTimeRequest";

    /**
     * MQTT参数获取
     */
    public const GET_MQTT_CFG = "getMqttCfgRequest";

    /**
     * MQTT参数设置
     */
    public const SET_MQTT_CFG = "setMqttCfgRequest";

    /**
     * 音频参数获取
     */
    public const GET_AUDIO_CFG = "getAudioCfgRequest";

    /**
     * 音频参数设置
     */
    public const SET_AUDIO_CFG = "setAudioCfgRequest";

    /**
     * 设备信息获取
     */
    public const GET_DEVICE_INFO = "deviceInfoRequest";

    /**
     * 设备信息设置
     */
    public const SET_DEVICE_INFO = "setDeviceInfoRequest";

    /**
     * 重启设备
     */
    public const RESTART = "restartRequest";

    /**
     * 恢复出厂
     */
    public const RESTORE = "restoreRequest";

    /**
     * 用户名密码设置
     */
    public const SET_ACCOUNT = "setAccountRequest";

    /**
     * IO 控制
     */
    public const IO_CONTROL = "IOControlRequest";

    /**
     * 使用URL方式升级
     */
    public const UPGRADE = "upgradeRequest";

    /**
     * 抓拍比对记录总数查询(门禁机支持)
     */
    public const GET_CAPTURE_SUM = "getCaptureSumRequest";

    /**
     * 平台获取历史记录(门禁机支持)
     */
    public const GET_HISTORY_RECORD = "getHistoryRecordRequest";

    /**
     * 删除历史识别记录
     */
    public const DELETE_RECORD = "deleteRecordRequest";

    /**
     * 扫码结果(与二维码设置对应)
     */
    public const SCAN_ORCODE = "scanQRCodeResult";

    /**
     * 添加/修改通行策略
     */
    public const ADD_ACCESS_STRATEGY = "addAccessStrategyRequest";

    /**
     * 删除通行策略
     */
    public const DELETE_ACCESS_STRATEGY = "deleteAccessStrategyRequest";

    /**
     * 查询所有策略
     */
    public const QUERY_ALL_STRATEGY = "queryAllStrategyRequest";

    /**
     * 通过ID查询策略
     */
    public const QUERY_STRATEGY_BY_ID = "queryStrategyByIdRequest";

    /**
     * 分页查询策略
     */
    public const QUERY_STRATEGY_BY_PAGE = "queryStrategyByPageRequest";

    /**
     * 获取所有人员类型所关联的通行策略
     */
    public const GET_ALL_RELATED = "getAllRelatedRequest";

    /**
     * 通过人员类型获取所关联的通行策略
     */
    public const GET_RELATED_BY_IDENTITY = "getRelatedByIdentityRequest";

    /**
     * 设置人员类型和通行策略
     */
    public const SET_RELATED = "setRelatedRequest";

    /**
     * 通过人员类型删除人员（未实现）
     */
    public const DELETE_BY_IDENTITY = "deleteByIdentityRequest";

    /**
     * 人员绑定通行策略
     */
    public const PERSON_BIND_STRATEGY = "personBindStrategyRequest";

    /**
     * 人员解绑通行策略
     */
    public const PERSON_UNBIND_STRATEGY = "personUnbindStrategyRequest";

    /**
     * 人员类型替换
     */
    public const IDENTITY_REPLACE = "identityReplaceRequest";

    /**
     * 人员类型更新通行策略（未实现）
     */
    public const IDENTITY_UPDATE_STRATEGY = "identityUpdateStrategyRequest";

    /**
     * 通过策略ID查询所关联的人员
     */
    public const QUERY_PERSONS_BY_STRATEGY = "queryPersonsByStrategyRequest";

    /**
     * GPS信息参数获取（门禁机支持）
     */
    public const GET_GPS_CFG = "getGPSCfgRequest";

    /**
     * GPS参数设置（门禁机支持）
     */
    public const SET_GPS_CFG = "setGPSCfgRequest";

    /**
     * 添加/修改GPS信息（门禁机支持）
     */
    public const ADD_GPS = "addGPSRequest";

    /**
     * 删除GPS信息（门禁机支持）
     */
    public const DELETE_GPS = "deleteGPSRequest";

    /**
     * 查询所有站点（门禁机支持）
     */
    public const QUERY_ALL_GPS = "queryAllGPSRequest";

    /**
     * 人员绑定站点ID（门禁机支持）
     */
    public const PERSON_BIND_PLACEID = "personBindPlaceIdRequest";

    /**
     * 人员解绑站点ID（门禁机支持）
     */
    public const PERSON_UNBIND_PLACEID = "personUnbindPlaceIdRequest";

    /**
     * 请求参数（门禁机支持）
     */
    public const QUERY_PERSONS_BY_PLACEID = "queryPersonsByPlaceIdRequest";

    /**
     * 批量更改播放机编号
     */
    public const CHANGE_REPORT = "changeReportRequest";

}