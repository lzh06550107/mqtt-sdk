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
use JuLongDeviceMqtt\FaceManage\Models\BatchAddPersonInfo;
use JuLongDeviceMqtt\FaceManage\Models\BatchAddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
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

$batchAddPersonRequest = new BatchAddPersonRequest();

$batchAddPersonRequest->PhotoType = 0;
$batchAddPersonRequest->PersonTotal = 1;

$batchAddPersonInfo1 = new BatchAddPersonInfo();

$batchAddPersonInfo1->OperateType = 0;
$batchAddPersonInfo1->PersonCover = 1;
$batchAddPersonInfo1->PersonType = 2;

$personInfo1 = new PersonInfo();
$personInfo1->PersonId = '1';
$personInfo1->ICCard = 'id1';
$personInfo1->ICCardList = [
    "321281199002271070",
    "321281199002271071"
];
$personInfo1->IDCard = '321281199002271069';
$personInfo1->PersonName = 'test1';
$personInfo1->Sex = 2;
$personInfo1->Nation = '广东';
$personInfo1->Birthday = '1990-09-12';
$personInfo1->Phone = '13654124584';
$personInfo1->Address = '广东省广州市';
$personInfo1->LimitTime = 0;
$personInfo1->StartTime = '2020-09-12 09:10:00';
$personInfo1->EndTime = '2021-09-12 09:10:00';
$personInfo1->PersonIdentity = 0;
$personInfo1->IdentityAttribute = 0;

$personInfo1->PhotoType = 0;
// 04f8532b016fde1b.jpg
$personInfo1->PersonPhotoUrl = 'http://qczxadmin.jvt.cc/temp/image/2021/11/901d316b7b30d3ca.jpg';

$batchAddPersonInfo1->PersonInfo = $personInfo1;

$batchAddPersonInfo2 = new BatchAddPersonInfo();

$batchAddPersonInfo2->OperateType = 0;
$batchAddPersonInfo2->PersonCover = 1;
$batchAddPersonInfo2->PersonType = 2;

$personInfo2 = new PersonInfo();
$personInfo2->PersonId = '2';
$personInfo2->ICCard = 'id2';
$personInfo2->ICCardList = [
    "321281199002271072",
    "321281199002271073"
];
$personInfo2->IDCard = '321281199002271070';
$personInfo2->PersonName = 'test2';
$personInfo2->Sex = 1;
$personInfo2->Nation = '广东';
$personInfo2->Birthday = '1990-09-12';
$personInfo2->Phone = '13654124584';
$personInfo2->Address = '广东省广州市';
$personInfo2->LimitTime = 0;
$personInfo2->StartTime = '2020-09-12 09:10:00';
$personInfo2->EndTime = '2021-09-12 09:10:00';
$personInfo2->PersonIdentity = 0;
$personInfo2->IdentityAttribute = 0;

$personInfo2->PhotoType = 0;
$personInfo2->PersonPhotoUrl = 'http://qczxadmin.jvt.cc/temp/image/2021/09/04f8532b016fde1b.jpg';

$batchAddPersonInfo2->PersonInfo = $personInfo2;

$batchAddPersonRequest->PersonInfo = [ $batchAddPersonInfo1, $batchAddPersonInfo2 ];

Coroutine\run(function () use($faceManageBaseMqttClient, $batchAddPersonRequest) {
//    while (true) {
        $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $batchAddPersonRequest, 1);
        var_dump($response);
        Coroutine::sleep(3);
//    }
});