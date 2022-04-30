<?php
/**
 * 文件描述
 * Created on 2022/1/20 9:05
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt;

use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;

/**
 * mqtt异步客户端
 * Created on 2022/1/20 9:05
 * Create by LZH
 *
 * @method static AsyncFaceManageMqttClient asyncFaceManageMqttClient() 人脸管理异步客户端
 * @method static AsyncParamSettingMqttClient asyncParamSettingMqttClient() 设备参数管理异步客户端
 */
class AsyncMqttClient
{
    /**
     * @var string[] 已经实现的客户端类
     */
    private static $method = [
        'AsyncFaceManageMqttClient',
        'AsyncParamSettingMqttClient',
    ];

    /**
     * @var MqttClientBuilder
     */
    private static $mqttClientBuilder;

    public static function configurator(): MqttClientBuilder
    {
        return self::$mqttClientBuilder = new MqttClientBuilder();
    }

    /**
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {

        if (in_array(ucfirst($name), self::$method)) {
            print_r('get' . ucfirst($name));
            return call_user_func_array([self::$mqttClientBuilder,'get'. ucfirst($name)], $arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }
}