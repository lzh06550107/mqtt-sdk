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
use JuLongDeviceMqtt\Common\AsyncMqttClient;
use JuLongDeviceMqtt\Common\DefaultLogger;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
use Psr\Log\LogLevel;
use Swoole\Coroutine;

Coroutine\run(function () {

    $logger = new DefaultLogger(LogLevel::INFO);

    $asyncMqttClient = new AsyncMqttClient();

    $asyncMqttClient->setBrokerHost('128.128.20.81');
    $asyncMqttClient->setBrokerPort(1883);
    $asyncMqttClient->setKeepAlive(60);
    $asyncMqttClient->setDelay(10);
    $asyncMqttClient->setMaxAttempts(3);

    $asyncMqttClient->setSwooleConfig([
        'open_mqtt_protocol' => true,
        'package_max_length' => 2 * 1024 * 1024,
        'connect_timeout' => 5.0,
        'write_timeout' => 5.0,
        'read_timeout' => 5.0
    ]);

    $paramSettingMqttClient = new AsyncParamSettingMqttClient($asyncMqttClient);

    // 订阅指定的uuid人脸响应
    $paramSettingMqttClient->subscribe('fwSkNfgI4JKljlkM', function (string $topic, string $message, bool $retained) use ($logger, $paramSettingMqttClient) {
        $logger->info('We received a {typeOfMessage} on topic [{topic}]: {message}', [
            'topic' => $topic,
            'message' => $message,
            'typeOfMessage' => $retained ? 'retained message' : 'message',
        ]);

        // 当我们接收到订阅主题的响应时，客户端停止监听
        $paramSettingMqttClient->interruptedLoop();
        $paramSettingMqttClient->disconnect();
    });

    // 开启循环等待订阅消息
    $paramSettingMqttClient->loop();

});