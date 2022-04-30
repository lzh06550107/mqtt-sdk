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
use JuLongDeviceMqtt\ParamSetting\Models\CaptureContent;
use JuLongDeviceMqtt\ParamSetting\Models\HttpCfg;
use JuLongDeviceMqtt\ParamSetting\Models\PictureData;
use JuLongDeviceMqtt\ParamSetting\Models\SetHttpCfgRequest;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
use Psr\Log\LogLevel;
use Swoole\Coroutine;

$logger = new DefaultLogger(LogLevel::INFO);

$asyncMqttClient = new AsyncMqttClient($logger);

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

$paramSettingMqttClient = new AsyncParamSettingMqttClient($asyncMqttClient);

$setHttpCfgRequest = new SetHttpCfgRequest();
$httpCfg = new HttpCfg();
$httpCfg->setCaptureEnabled(1);
$httpCfg->setCaptureAddress("http://ip:port/path");
$httpCfg->setCaptureType(1);

$captureContent = new CaptureContent();
$captureContent->setFaceInfo(1);
$captureContent->setCompareInfo(1);

$httpCfg->setCaptureContent($captureContent);

$pictureData = new PictureData();
$pictureData->setFacePicture(1);
$pictureData->setBodyPicture(1);
$pictureData->setBackgroundPicture(1);
$pictureData->setPersonPhoto(1);

$httpCfg->setPictureData($pictureData);

$httpCfg->setResendTimes(1);
$httpCfg->setRegisterEnabled(1);
$httpCfg->setRegisterAddress("http://ip:port/path");
$httpCfg->setHeartbeatEnabled(1);
$httpCfg->setHeartbeatAddress("http://ip:port/path");
$httpCfg->setHeartbeatInterval(60);
$httpCfg->setEventAddress("http://ip:port/path");
$httpCfg->setResultAddress("http://ip:port/path");
$httpCfg->setMiddlewareEnabled(0);
$httpCfg->setMiddlewareAddress("http://ip:port/path");
$httpCfg->setSignCheck(1);
$httpCfg->setMode(0);
$httpCfg->setVerifyAddress("http://server/path");
$httpCfg->setNoticeAddress("http://server/path");
$httpCfg->setHistoryRecordAddress("http://server/path");
$httpCfg->setHTTPVersion('1');

$setHttpCfgRequest->HttpCfg = $httpCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setHttpCfgRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setHttpCfgRequest, 1);
    Coroutine::sleep(3);
//    }
});