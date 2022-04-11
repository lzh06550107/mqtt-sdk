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
use JuLongDeviceMqtt\FaceManage\Models\GetPersonListRequest;
use JuLongDeviceMqtt\FaceManage\Models\SearchCondition;
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

$getPersonListRequest = new GetPersonListRequest();
$getPersonListRequest->PersonType = 2;
$getPersonListRequest->PageCurNO = 1;
$getPersonListRequest->NameCount = 1000;

$searchCondition = new SearchCondition();
$searchCondition->SearchMethod = 0;
$searchCondition->StartTime = '2000-01-01 00:00:00';
$searchCondition->EndTime = '2022-12-01 00:00:00';
$searchCondition->LimitTime = 0;
$searchCondition->PersonIdentity = 0;
$searchCondition->Sex = 0;
$searchCondition->AgeRange = [
    0,
    100
];
//$searchCondition->SearchMethod = 1;
//$searchCondition->Name = 'test';

$getPersonListRequest->SearchCondition = $searchCondition;

Coroutine\run(function () use($faceManageBaseMqttClient, $getPersonListRequest) {
//    while (true) {
        $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $getPersonListRequest, 1);
        var_dump($response);
        Coroutine::sleep(3);
//    }
});