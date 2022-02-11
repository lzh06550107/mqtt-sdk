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

use JuLongDeviceMqtt\Common\DisconnectedException;
use JuLongDeviceMqtt\FaceManage\FaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\AddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\BatchAddPersonInfo;
use JuLongDeviceMqtt\FaceManage\Models\BatchAddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\BatchDeletePersonInfo;
use JuLongDeviceMqtt\FaceManage\Models\BatchDeletePersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
use Simps\MQTT\Protocol\Types;
use Swoole\Coroutine;

$faceManageBaseMqttClient = new FaceManageMqttClient();
$faceManageBaseMqttClient->setBrokerHost('128.128.20.81');
$faceManageBaseMqttClient->setBrokerPort(1883);
$faceManageBaseMqttClient->setKeepAlive(10);
$faceManageBaseMqttClient->setDelay(10);
$faceManageBaseMqttClient->setMaxAttempts(3);

$faceManageBaseMqttClient->setSwooleConfig([
    'open_mqtt_protocol' => true,
    'package_max_length' => 2 * 1024 * 1024,
    'connect_timeout' => 5.0,
    'write_timeout' => 5.0,
    'read_timeout' => 5.0,
]);

$batchDeletePersonRequest = new BatchDeletePersonRequest();

$batchDeletePersonInfo = new BatchDeletePersonInfo();
$batchDeletePersonInfo->PersonType = 2; // 白名单
$batchDeletePersonInfo->PersonId = '1';
$batchDeletePersonRequest->PersonInfo = [$batchDeletePersonInfo];

Coroutine\run(function () use($faceManageBaseMqttClient, $batchDeletePersonRequest) {
//    while (true) {
        $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $batchDeletePersonRequest, 1);
        var_dump($response);
        Coroutine::sleep(3);
//    }
});