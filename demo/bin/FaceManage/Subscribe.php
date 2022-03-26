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
use JuLongDeviceMqtt\FaceManage\FaceManageMqttClient;
use Swoole\Coroutine;

Coroutine\run(function () {
    $faceManageBaseMqttClient = new FaceManageMqttClient();
    $faceManageBaseMqttClient->setBrokerHost('128.128.20.81');
    $faceManageBaseMqttClient->setBrokerPort(1883);
    $faceManageBaseMqttClient->setKeepAlive(60);
    $faceManageBaseMqttClient->setDelay(10);
    $faceManageBaseMqttClient->setMaxAttempts(3);

    $faceManageBaseMqttClient->setSwooleConfig([
        'open_mqtt_protocol' => true,
        'package_max_length' => 2 * 1024 * 1024,
        'connect_timeout' => 5.0,
        'write_timeout' => 5.0,
        'read_timeout' => 5.0
    ]);

    // 订阅指定的uuid人脸响应
    $faceManageBaseMqttClient->subscribe('fwSkNfgI4JKljlkM', function(\Simps\MQTT\Client $client, AbstractResponse $response) {

        print_r($response); // 打印数据

    });
});



