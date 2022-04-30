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
use JuLongDeviceMqtt\ParamSetting\Models\AlarmCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetAlarmCfgRequest;
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

$setAlarmCfgRequest = new SetAlarmCfgRequest();
$setAlarmCfgRequest->setChannelNo(0);

$alarmCfg = new AlarmCfg();
$alarmCfg->setFaceAlarmEnabled(1);
$alarmCfg->setBlackListAlarmEnabled(0);
$alarmCfg->setWhiteListAlarmEnabled(1);
$alarmCfg->setVIPListAlarmEnabled(0);
$alarmCfg->setNonWhiteListAlarmEnabled(0);
$alarmCfg->setIOAlarmEnabled(1);
$alarmCfg->setIOStateType(0);
$alarmCfg->setIOSignalType(0);
$alarmCfg->setIOAlarmTime(10);
$alarmCfg->setFaceAlarmMode(2);
$alarmCfg->setSimilarity(80);
$alarmCfg->setPersonsTime(60);
$alarmCfg->setStrangersTime(60);

$timeTable1 = new TimeTable();
$timeTable1->setTimeEnable(1);
$timeTable1->setTimeBegin("00:00:01");
$timeTable1->setTimeEnd("23:59:01");

$timeTable2 = new TimeTable();
$timeTable2->setTimeEnable(1);
$timeTable2->setTimeBegin("00:00:02");
$timeTable2->setTimeEnd("23:59:02");

$alarmCfg->setTimeTable([$timeTable1, $timeTable2]);

$setAlarmCfgRequest->setAlarmCfg($alarmCfg);

Coroutine\run(function () use ($paramSettingMqttClient, $setAlarmCfgRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setAlarmCfgRequest, 1);
    Coroutine::sleep(3);
//    }
});