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
use JuLongDeviceMqtt\FaceManage\Models\GetPersonListRequest;
use JuLongDeviceMqtt\FaceManage\Models\SearchCondition;
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