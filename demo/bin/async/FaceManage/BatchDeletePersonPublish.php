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

use JuLongDeviceMqtt\Common\AsyncMqttClient;
use JuLongDeviceMqtt\Common\DefaultLogger;
use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\BatchDeletePersonInfo;
use JuLongDeviceMqtt\FaceManage\Models\BatchDeletePersonRequest;
use Psr\Log\LogLevel;
use Swoole\Coroutine;

$logger = new DefaultLogger(LogLevel::INFO);

$asyncMqttClient = new AsyncMqttClient(null, $logger);

$asyncMqttClient->setBrokerHost('128.128.13.90');
$asyncMqttClient->setBrokerPort(1883);
$asyncMqttClient->setKeepAlive(10);
$asyncMqttClient->setDelay(10);
$asyncMqttClient->setMaxAttempts(3);

$asyncMqttClient->setSwooleConfig([
    'open_mqtt_protocol' => true,
    'package_max_length' => 2 * 1024 * 1024,
    'connect_timeout' => 5.0,
    'write_timeout' => 5.0,
    'read_timeout' => 5.0,
]);

$faceManageBaseMqttClient = new AsyncFaceManageMqttClient($asyncMqttClient);

$batchDeletePersonRequest = new BatchDeletePersonRequest();

$batchDeletePersonInfo = new BatchDeletePersonInfo();
$batchDeletePersonInfo->setPersonType(2); // 白名单
$batchDeletePersonInfo->setPersonId('1');
$batchDeletePersonRequest->setPersonInfo([$batchDeletePersonInfo]);

// TaskID 字段值不能加下划线
Coroutine\run(function () use ($faceManageBaseMqttClient, $batchDeletePersonRequest) {
//    while (true) {
    $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $batchDeletePersonRequest);
    Coroutine::sleep(3);
//    }
});