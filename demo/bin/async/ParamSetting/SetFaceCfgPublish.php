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
use JuLongDeviceMqtt\ParamSetting\Models\CaptureModeParam;
use JuLongDeviceMqtt\ParamSetting\Models\FaceCfg;
use JuLongDeviceMqtt\ParamSetting\Models\PictureCompression;
use JuLongDeviceMqtt\ParamSetting\Models\PicturePrefix;
use JuLongDeviceMqtt\ParamSetting\Models\SetFaceCfgRequest;
use JuLongDeviceMqtt\ParamSetting\Models\TimeTable;
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

$setFaceCfgRequest = new SetFaceCfgRequest();
$setFaceCfgRequest->setChannelNo(0);

$faceCfg = new FaceCfg();
$faceCfg->setFaceEnabled(1);
$faceCfg->setSensitivity(8);
$faceCfg->setCaptureMode(0);

$captureModeParam = new CaptureModeParam();
$captureModeParam->setMaxCaptureTimes(1);

$faceCfg->setCaptureModeParam($captureModeParam);

$faceCfg->setMaxFaceSize(300);
$faceCfg->setMinFaceSize(30);
$faceCfg->setFaceAreaSize(3);
$faceCfg->setMinFaceTempSize(200);
$faceCfg->setSceneMode(0);
$faceCfg->setFaceTrackEnabled(1);
$faceCfg->setFTPUploadEnabled(0);
$faceCfg->setPrivateProtocol(0);
$faceCfg->setPictureMode(2);
$faceCfg->setFacePictureQuality(99);
$faceCfg->setScenePictureQuality(99);

$picturePrefix = new PicturePrefix();
$picturePrefix->setPictureEnabled(0);
$picturePrefix->setCustomPrefix("TEST");

$faceCfg->setPicturePrefix($picturePrefix);

$faceCfg->setFaceAttributeEnabled(1);
$faceCfg->setHumanDetection(1);
$faceCfg->setHumanThreshold(60);
$faceCfg->setDetectionPriority(1);

$pictureCompression = new PictureCompression();
$pictureCompression->setCompressionEnabled(0);
$pictureCompression->setCompressionSize(320);

$faceCfg->setPictureCompression($pictureCompression);

$timeTable1 = new TimeTable();
$timeTable1->setTimeEnable(1);
$timeTable1->setTimeBegin("00:00:01");
$timeTable1->setTimeEnd("23:59:01");

$timeTable2 = new TimeTable();
$timeTable2->setTimeEnable(1);
$timeTable2->setTimeBegin("00:00:02");
$timeTable2->setTimeEnd("23:59:02");

$faceCfg->setTimeTable([$timeTable1, $timeTable2]);

$setFaceCfgRequest->FaceCfg = $faceCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setFaceCfgRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setFaceCfgRequest, MQTT_QOS_0);
    Coroutine::sleep(3);
//    }
});