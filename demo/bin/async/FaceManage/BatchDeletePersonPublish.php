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

use JuLongDeviceMqtt\Common\AsyncMqttClient;
use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\BatchDeletePersonInfo;
use JuLongDeviceMqtt\FaceManage\Models\BatchDeletePersonRequest;
use Swoole\Coroutine;

$asyncMqttClient = new AsyncMqttClient();


$asyncMqttClient->setBrokerHost('128.128.20.81');
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
$batchDeletePersonInfo->PersonType = 2; // 白名单
$batchDeletePersonInfo->PersonId = '1';
$batchDeletePersonRequest->PersonInfo = [$batchDeletePersonInfo];

Coroutine\run(function () use ($faceManageBaseMqttClient, $batchDeletePersonRequest) {
//    while (true) {
    $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $batchDeletePersonRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});