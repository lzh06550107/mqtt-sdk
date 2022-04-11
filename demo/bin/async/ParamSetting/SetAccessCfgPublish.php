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
use JuLongDeviceMqtt\ParamSetting\Models\AccessCfg;
use JuLongDeviceMqtt\ParamSetting\Models\AccessControl;
use JuLongDeviceMqtt\ParamSetting\Models\GateControl;
use JuLongDeviceMqtt\ParamSetting\Models\SetAccessCfgRequest;
use JuLongDeviceMqtt\ParamSetting\Models\TempAndMask;
use JuLongDeviceMqtt\ParamSetting\Models\TimePeriod;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
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

$paramSettingMqttClient = new AsyncParamSettingMqttClient($asyncMqttClient);

$setAlarmCfgRequest = new SetAccessCfgRequest();

$accessCfg = new AccessCfg();

$tempAndMask = new TempAndMask();
$tempAndMask->CheckMode = 3;
$tempAndMask->RealTimeTempDetection = 0;
$tempAndMask->ContinuedTempDetection = 0;
$tempAndMask->NoMaskOperate1 = 0;
$tempAndMask->NoMaskOperate2 = 0;
$tempAndMask->TempDetectionMode = 0;
$tempAndMask->TempThreshold = "37.3";
$tempAndMask->TempUnit = 0;
$tempAndMask->TempCorrection = 0;
$tempAndMask->SmartTime = 0;
$tempAndMask->HightTempCorrection = 0;
$tempAndMask->LowTempCorrection = 0;
$tempAndMask->TempFilterMode = 0;
$tempAndMask->TempFilterMax = "37.3";
$tempAndMask->TempFilterMin = "29.7";
$tempAndMask->TempDisplay = 1;

$timePeriod = new TimePeriod();
$timePeriod->PeriodEnabled = 0;
$timePeriod->TimeBegin = "22:00";
$timePeriod->TimeEnd = "23:59";

$tempAndMask->NotTempDetectionPeriod = $timePeriod;

$accessControl = new AccessControl();

$accessControl->LightControl = 1;
$accessControl->DaytimeStart = "06:00:00";
$accessControl->NightStart = "20:00:00";
$accessControl->ScreenDisplayMode = 1;
$accessControl->FaceDetecRatio = 0;
$accessControl->ListSimilarity = 70;
$accessControl->IDCardSimilarity = 60;
$accessControl->SameFilter = 3;
$accessControl->TimeDisplay = 1;
$accessControl->IPDisplay = 1;
$accessControl->UUIDDisplay = 1;
$accessControl->DateFormat = 0;
$accessControl->LeakDisplay = 0;
$accessControl->DateFormat = 0;
$accessControl->ComparisonRecord = 0;
$accessControl->NoMaskIO = 0;
$accessControl->CompareMode = 1;
$accessControl->HealthCodeType = 1;
$accessControl->HealthCodeOnlineEnabled = 1;
$accessControl->FaceWitnessCompare = 1;
$accessControl->PriorityTemperature = 1;
$accessControl->FaceDetectEnabled = 1;
$accessControl->VoiceEnabled = 1;
$accessControl->TempAbnormal = 1;
$accessControl->RFIDModule = 0;

$gateControl = new GateControl();
$gateControl->SignalInterface = 1;
$gateControl->IODuration = 1;
$gateControl->ContactType = 0;
$gateControl->IODuration2 = 1;
$gateControl->ContactType2 = 0;
$gateControl->WiganFormat = 1;
$gateControl->WiganPositive = 0;
$gateControl->PulseContinue = 40;
$gateControl->PulseInterval = 200;
$gateControl->WiganContent = 0;
$gateControl->WiganFormat = 1;
$gateControl->WiganPositive = 0;
$gateControl->PulseContinue = 40;
$gateControl->PulseInterval = 200;
$gateControl->PrinterSetting = 1;
$gateControl->PaperSize = 0;

$accessCfg->TempAndMask = $tempAndMask;
$accessCfg->AccessControl = $accessControl;
$accessCfg->GateControl = $gateControl;

$setAlarmCfgRequest->AccessCfg = $accessCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setAlarmCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setAlarmCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});