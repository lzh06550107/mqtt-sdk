<?php
/**
 * 文件描述
 * Created on 2022/1/20 9:05
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\FaceManage\SyncFaceManageMqttClient;
use JuLongDeviceMqtt\ParamSetting\SyncParamSettingMqttClient;

/**
 * mqtt同步客户端
 * Created on 2022/1/20 9:05
 * Create by LZH
 *
 * @method static SyncFaceManageMqttClient getSyncFaceManageMqttClient(bool $asyncOrSync) 人脸管理同步客户端
 * @method static SyncParamSettingMqttClient getSyncParamSettingMqttClient(bool $asyncOrSync) 设备参数管理同步客户端
 * @method string request($uuidOrTopic, AbstractRequest $request) 发送同步请求
 */
class SyncMqttClient
{
    /**
     * @var string[] 已经实现的客户端类
     */
    private static $method = [
        'SyncFaceManageMqttClient',
        'SyncParamSettingMqttClient',
    ];

    private static MqttClientBuilder $mqttClientBuilder;

    public static function configurator(): MqttClientBuilder
    {
        return self::$mqttClientBuilder = new MqttClientBuilder();
    }

    /**
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments) {

        if (in_array(strtoupper($name), self::$method)) {
            call_user_func_array([self::$mqttClientBuilder,'get'. strtoupper($name)], $arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }
}