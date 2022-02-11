<?php
/**
 * 文件描述
 * Created on 2022/1/20 9:05
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt;

/**
 * mqtt客户端
 * Created on 2022/1/20 9:05
 * Create by LZH
 */
class MqttClient
{
    /**
     * @var string[] 已经实现的客户端类
     */
    private static $method = [
        'BaseClient',
        'AccessControlPasswordClient',
        'AccessStrategyClient',
        'FaceCompareClient',
        'FaceManageClient',
        'HealthCodeClient',
        'NVRManageClient',
        'ParamSettingClient'
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