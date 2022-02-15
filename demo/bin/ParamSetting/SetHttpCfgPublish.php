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

use JuLongDeviceMqtt\ParamSetting\Models\CaptureContent;
use JuLongDeviceMqtt\ParamSetting\Models\HttpCfg;
use JuLongDeviceMqtt\ParamSetting\Models\PictureData;
use JuLongDeviceMqtt\ParamSetting\Models\SetHttpCfgRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingMqttClient;
use Swoole\Coroutine;

$paramSettingMqttClient = new ParamSettingMqttClient();
$paramSettingMqttClient->setBrokerHost('128.128.20.81');
$paramSettingMqttClient->setBrokerPort(1883);
$paramSettingMqttClient->setKeepAlive(10);
$paramSettingMqttClient->setDelay(10);
$paramSettingMqttClient->setMaxAttempts(3);

$paramSettingMqttClient->setSwooleConfig([
    'open_mqtt_protocol' => true,
    'package_max_length' => 2 * 1024 * 1024,
    'connect_timeout' => 5.0,
    'write_timeout' => 5.0,
    'read_timeout' => 5.0,
]);

$setHttpCfgRequest = new SetHttpCfgRequest();
$httpCfg = new HttpCfg();
$httpCfg->CaptureEnabled = 1;
$httpCfg->CaptureAddress = "http://ip:port/path";
$httpCfg->CaptureType = 1;

$captureContent = new CaptureContent();
$captureContent->FaceInfo = 1;
$captureContent->CompareInfo = 1;

$httpCfg->CaptureContent = $captureContent;

$pictureData = new PictureData();
$pictureData->FacePicture = 1;
$pictureData->BodyPicture = 1;
$pictureData->BackgroundPicture = 1;
$pictureData->PersonPhoto = 1;

$httpCfg->PictureData = $pictureData;

$httpCfg->ResendTimes = 1;
$httpCfg->RegisterEnabled = 1;
$httpCfg->RegisterAddress = "http://ip:port/path";
$httpCfg->HeartbeatEnabled = 1;
$httpCfg->HeartbeatAddress = "http://ip:port/path";
$httpCfg->HeartbeatInterval = 60;
$httpCfg->EventAddress = "http://ip:port/path";
$httpCfg->ResultAddress = "http://ip:port/path";
$httpCfg->MiddlewareEnabled = 0;
$httpCfg->MiddlewareAddress = "http://ip:port/path";
$httpCfg->SignCheck = 1;
$httpCfg->Mode = 0;
$httpCfg->VerifyAddress = "http://server/path";
$httpCfg->NoticeAddress = "http://server/path";
$httpCfg->HistoryRecordAddress = "http://server/path";
$httpCfg->HTTPVersion = 1;

$setHttpCfgRequest->HttpCfg = $httpCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setHttpCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setHttpCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});