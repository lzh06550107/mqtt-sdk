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
use JuLongDeviceMqtt\ParamSetting\Models\CaptureModeParam;
use JuLongDeviceMqtt\ParamSetting\Models\FaceCfg;
use JuLongDeviceMqtt\ParamSetting\Models\PictureCompression;
use JuLongDeviceMqtt\ParamSetting\Models\PicturePrefix;
use JuLongDeviceMqtt\ParamSetting\Models\SetFaceCfgRequest;
use JuLongDeviceMqtt\ParamSetting\Models\TimeTable;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
use Swoole\Coroutine;

$asyncMqttClient = new AsyncMqttClient();

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
$setFaceCfgRequest->ChannelNo = 0;

$faceCfg = new FaceCfg();
$faceCfg->FaceEnabled = 1;
$faceCfg->Sensitivity = 8;
$faceCfg->CaptureMode = 0;

$captureModeParam = new CaptureModeParam();
$captureModeParam->MaxCaptureTimes = 1;

$faceCfg->CaptureModeParam = $captureModeParam;

$faceCfg->MaxFaceSize = 300;
$faceCfg->MinFaceSize = 30;
$faceCfg->FaceAreaSize = 3;
$faceCfg->MinFaceTempSize = 200;
$faceCfg->SceneMode = 0;
$faceCfg->FaceTrackEnabled = 1;
$faceCfg->FTPUploadEnabled = 0;
$faceCfg->PrivateProtocol = 0;
$faceCfg->PictureMode = 2;
$faceCfg->FacePictureQuality = 99;
$faceCfg->ScenePictureQuality = 99;

$picturePrefix = new PicturePrefix();
$picturePrefix->PictureEnabled = 0;
$picturePrefix->CustomPrefix = "TEST";

$faceCfg->PicturePrefix = $picturePrefix;

$faceCfg->FaceAttributeEnabled = 1;
$faceCfg->HumanDetection = 1;
$faceCfg->HumanThreshold = 60;
$faceCfg->DetectionPriority = 1;

$pictureCompression = new PictureCompression();
$pictureCompression->CompressionEnabled = 0;
$pictureCompression->CompressionSize = 320;

$faceCfg->PictureCompression = $pictureCompression;

$timeTable1 = new TimeTable();
$timeTable1->TimeEnable = 1;
$timeTable1->TimeBegin = "00:00:01";
$timeTable1->TimeEnd = "23:59:01";

$timeTable2 = new TimeTable();
$timeTable2->TimeEnable = 1;
$timeTable2->TimeBegin = "00:00:02";
$timeTable2->TimeEnd = "23:59:02";

$faceCfg->TimeTable = [$timeTable1, $timeTable2];

$setFaceCfgRequest->FaceCfg = $faceCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setFaceCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setFaceCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});