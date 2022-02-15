#!/usr/bin/env php
<?php

declare(strict_types=1);

foreach (
    [
        __DIR__ . '/vendor/autoload.php',
        __DIR__ . '/../vendor/autoload.php',
        __DIR__ . '/../../vendor/autoload.php',
        __DIR__ . '/../../../vendor/autoload.php',
        __DIR__ . '/../../../autoload.php',
    ] as $file
) {
    if (file_exists($file)) {
        require $file;
        break;
    }
}

use JuLongDeviceMqtt\Common\AbstractResponse;
use JuLongDeviceMqtt\ParamSetting\ParamSettingMqttClient;
use Swoole\Coroutine;

Coroutine\run(function () {
    $paramSettingMqttClient = new ParamSettingMqttClient();
    $paramSettingMqttClient->setBrokerHost('128.128.20.81');
    $paramSettingMqttClient->setBrokerPort(1883);
    $paramSettingMqttClient->setKeepAlive(60);
    $paramSettingMqttClient->setDelay(10);
    $paramSettingMqttClient->setMaxAttempts(3);

    $paramSettingMqttClient->setSwooleConfig([
        'open_mqtt_protocol' => true,
        'package_max_length' => 2 * 1024 * 1024,
        'connect_timeout' => 5.0,
        'write_timeout' => 5.0,
        'read_timeout' => 5.0
    ]);

    // 订阅指定的uuid人脸响应
    $paramSettingMqttClient->subscribe('fwSkNfgI4JKljlkM', function(\Simps\MQTT\Client $client, AbstractResponse $response) {

        print_r($response); // 打印数据

    });
});
