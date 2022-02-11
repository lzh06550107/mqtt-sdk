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

use JuLongDeviceMqtt\FaceManage\FaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\DeletePersonRequest;
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

$deletePersonRequest = new DeletePersonRequest();

$deletePersonRequest->PersonType = 2;

$deletePersonRequest->PersonId = '116';

Coroutine\run(function () use($faceManageBaseMqttClient, $deletePersonRequest) {
//    while (true) {
        $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $deletePersonRequest, 1);
        var_dump($response);
        Coroutine::sleep(3);
//    }
});