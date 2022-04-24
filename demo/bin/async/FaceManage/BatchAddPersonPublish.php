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
use JuLongDeviceMqtt\FaceManage\Models\BatchAddPersonInfo;
use JuLongDeviceMqtt\FaceManage\Models\BatchAddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
use JuLongDeviceMqtt\FaceManage\PersonIdentity;
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

$batchAddPersonRequest = new BatchAddPersonRequest();

$batchAddPersonRequest->setPhotoType(0);
$batchAddPersonRequest->setPersonTotal(1);

$batchAddPersonInfo1 = new BatchAddPersonInfo();

$batchAddPersonInfo1->setOperateType(0);
$batchAddPersonInfo1->setPersonCover(1);
$batchAddPersonInfo1->setPersonType(2);

$personInfo1 = new PersonInfo();
$personInfo1->setPersonId('1');
$personInfo1->setICCard('id1');
$personInfo1->setICCardList([
    "321281199002271070",
    "321281199002271071"
]);
$personInfo1->setIDCard('321281199002271069');
$personInfo1->setPersonName('test1');
$personInfo1->setSex(2);
$personInfo1->setNation('广东');
$personInfo1->setBirthday('1990-09-12');
$personInfo1->setPhone('13654124584');
$personInfo1->setAddress('广东省广州市');
$personInfo1->setLimitTime(0);
$personInfo1->setStartTime('2020-09-12 09:10:00');
$personInfo1->setEndTime('2021-09-12 09:10:00');
$personInfo1->setPersonIdentity(new PersonIdentity(PersonIdentity::ALL));
$personInfo1->setIdentityAttribute(0);

$personInfo1->setPhotoType(0);
// 04f8532b016fde1b.jpg
$personInfo1->setPersonPhotoUrl('http://qczxadmin.jvt.cc/temp/image/2021/11/901d316b7b30d3ca.jpg');

$batchAddPersonInfo1->setPersonInfo($personInfo1);

$batchAddPersonInfo2 = new BatchAddPersonInfo();

$batchAddPersonInfo2->setOperateType(0);
$batchAddPersonInfo2->setPersonCover(1);
$batchAddPersonInfo2->setPersonType(2);

$personInfo2 = new PersonInfo();
$personInfo2->setPersonId('2');
$personInfo2->setICCard('id2');
$personInfo2->setICCardList([
    "321281199002271072",
    "321281199002271073"
]);
$personInfo2->setIDCard('321281199002271070');
$personInfo2->setPersonName('test2');
$personInfo2->setSex(1);
$personInfo2->setNation('广东');
$personInfo2->setBirthday('1990-09-12');
$personInfo2->setPhone('13654124584');
$personInfo2->setAddress('广东省广州市');
$personInfo2->setLimitTime(0);
$personInfo2->setStartTime('2020-09-12 09:10:00');
$personInfo2->setEndTime('2021-09-12 09:10:00');
$personInfo2->setPersonIdentity(new PersonIdentity(PersonIdentity::ALL));
$personInfo2->setIdentityAttribute(0);

$personInfo2->setPhotoType(0);
$personInfo2->setPersonPhotoUrl('http://qczxadmin.jvt.cc/temp/image/2021/09/04f8532b016fde1b.jpg');

$batchAddPersonInfo2->setPersonInfo($personInfo2);

$batchAddPersonRequest->setPersonInfo([ $batchAddPersonInfo1, $batchAddPersonInfo2 ]);

Coroutine\run(function () use($faceManageBaseMqttClient, $batchAddPersonRequest) {
//    while (true) {
        $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $batchAddPersonRequest);
        Coroutine::sleep(3);
//    }
});