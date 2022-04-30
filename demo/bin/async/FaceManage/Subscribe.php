#!/usr/bin/env php
<?php

declare(strict_types=1);

foreach (
    [
        __DIR__ . '/vendor/autoload.php',
        __DIR__ . '/../vendor/autoload.php',
        __DIR__ . '/../../vendor/autoload.php',
        __DIR__ . '/../../../vendor/autoload.php',
        __DIR__ . '/../../../../vendor/autoload.php',
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
use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use Psr\Log\LogLevel;
use Swoole\Coroutine;

Coroutine\run(function () {

    $logger = new DefaultLogger(LogLevel::INFO);

    $asyncMqttClient = new AsyncMqttClient($logger);

    $asyncMqttClient->setBrokerHost('128.128.13.90');
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

    $faceManageBaseMqttClient = new AsyncFaceManageMqttClient($asyncMqttClient);

//    $faceManageBaseMqttClient->registerLoopEventHandler(function() {
//        echo '调用循环事件处理器' . PHP_EOL;
//    });

    // 订阅指定的uuid人脸响应
    $faceManageBaseMqttClient->subscribe('fwSkNfgI4JKljlkM', function (string $topic, AbstractResponse $message, bool $retained) use ($logger, $faceManageBaseMqttClient) {
        $logger->info('We received a {typeOfMessage} on topic [{topic}]: {message}', [
            'topic' => $topic,
            'message' => $message,
            'typeOfMessage' => $retained ? 'retained message' : 'message',
        ]);

        // 当我们接收到订阅主题的响应时，客户端停止监听
        $faceManageBaseMqttClient->interruptedLoop();
        $faceManageBaseMqttClient->disconnect();
    });

    // 开启循环等待订阅消息
    $faceManageBaseMqttClient->loop();

});




