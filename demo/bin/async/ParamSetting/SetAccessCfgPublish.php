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
use JuLongDeviceMqtt\ParamSetting\Models\AccessCfg;
use JuLongDeviceMqtt\ParamSetting\Models\AccessControl;
use JuLongDeviceMqtt\ParamSetting\Models\GateControl;
use JuLongDeviceMqtt\ParamSetting\Models\SetAccessCfgRequest;
use JuLongDeviceMqtt\ParamSetting\Models\TempAndMask;
use JuLongDeviceMqtt\ParamSetting\Models\TimePeriod;
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

$setAlarmCfgRequest = new SetAccessCfgRequest();

$accessCfg = new AccessCfg();

$tempAndMask = new TempAndMask();
$tempAndMask->setCheckMode(3);
$tempAndMask->setRealTimeTempDetection(0);
$tempAndMask->setContinuedTempDetection(0);
$tempAndMask->setNoMaskOperate1(0);
$tempAndMask->setNoMaskOperate2(0);
$tempAndMask->setTempDetectionMode(0);
$tempAndMask->setTempThreshold("37.3");
$tempAndMask->setTempUnit(0);
$tempAndMask->setTempCorrection(0);
$tempAndMask->setSmartTime(0);
$tempAndMask->setHightTempCorrection(0);
$tempAndMask->setLowTempCorrection(0);
$tempAndMask->setTempFilterMode(0);
$tempAndMask->setTempFilterMax(37.3);
$tempAndMask->setTempFilterMin(29.7);
$tempAndMask->setTempDisplay(1);

$timePeriod = new TimePeriod();
$timePeriod->setPeriodEnabled(0);
$timePeriod->setTimeBegin("22:00");
$timePeriod->setTimeEnd("23:59");

$tempAndMask->setNotTempDetectionPeriod($timePeriod);

$accessControl = new AccessControl();

$accessControl->setLightControl(1);
$accessControl->setDaytimeStart("06:00:00");
$accessControl->setNightStart("20:00:00");
$accessControl->setScreenDisplayMode(1);
$accessControl->setFaceDetecRatio(0);
$accessControl->setListSimilarity(70);
$accessControl->setIDCardSimilarity(60);
$accessControl->setSameFilter(3);
$accessControl->setTimeDisplay(1);
$accessControl->setIPDisplay(1);
$accessControl->setUUIDDisplay(1);
$accessControl->setDateFormat(0);
$accessControl->setLeakDisplay(0);
$accessControl->setDateFormat(0);
$accessControl->setComparisonRecord(0);
$accessControl->setNoMaskIO(0);
$accessControl->setCompareMode(1);
$accessControl->setHealthCodeType(1);
$accessControl->setHealthCodeOnlineEnabled(1);
$accessControl->setFaceWitnessCompare(1);
$accessControl->setPriorityTemperature(1);
$accessControl->setFaceDetectEnabled(1);
$accessControl->setVoiceEnabled(1);
$accessControl->setTempAbnormal(1);
$accessControl->setRFIDModule(0);

$gateControl = new GateControl();
$gateControl->setSignalInterface(1);
$gateControl->setIODuration(1);
$gateControl->setContactType(0);
$gateControl->setIODuration2(1);
$gateControl->setContactType2(0);
$gateControl->setWiganFormat(1);
$gateControl->setWiganPositive(0);
$gateControl->setPulseContinue(40);
$gateControl->setPulseInterval(200);
$gateControl->setWiganContent(0);
$gateControl->setWiganFormat(1);
$gateControl->setWiganPositive(0);
$gateControl->setPulseContinue(40);
$gateControl->setPulseInterval(200);
$gateControl->setPrinterSetting(1);
$gateControl->setPaperSize(0);

$accessCfg->setTempAndMask($tempAndMask);
$accessCfg->setAccessControl($accessControl);
$accessCfg->setGateControl($gateControl);

$setAlarmCfgRequest->setAccessCfg($accessCfg);

Coroutine\run(function () use ($paramSettingMqttClient, $setAlarmCfgRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setAlarmCfgRequest, MQTT_QOS_0);
    Coroutine::sleep(3);
//    }
});