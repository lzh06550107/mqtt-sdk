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
use JuLongDeviceMqtt\ParamSetting\Models\AlarmCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetAlarmCfgRequest;
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

$setAlarmCfgRequest = new SetAlarmCfgRequest();
$setAlarmCfgRequest->ChannelNo = 0;

$alarmCfg = new AlarmCfg();
$alarmCfg->FaceAlarmEnabled = 1;
$alarmCfg->BlackListAlarmEnabled = 0;
$alarmCfg->WhiteListAlarmEnabled = 1;
$alarmCfg->VIPListAlarmEnabled = 0;
$alarmCfg->NonWhiteListAlarmEnabled = 0;
$alarmCfg->IOAlarmEnabled = 1;
$alarmCfg->IOStateType = 0;
$alarmCfg->IOSignalType = 0;
$alarmCfg->IOAlarmTime = 10;
$alarmCfg->FaceAlarmMode = 2;
$alarmCfg->Similarity = 80;
$alarmCfg->PersonsTime = 60;
$alarmCfg->StrangersTime = 60;

$timeTable1 = new TimeTable();
$timeTable1->TimeEnable = 1;
$timeTable1->TimeBegin = "00:00:01";
$timeTable1->TimeEnd = "23:59:01";

$timeTable2 = new TimeTable();
$timeTable2->TimeEnable = 1;
$timeTable2->TimeBegin = "00:00:02";
$timeTable2->TimeEnd = "23:59:02";

$alarmCfg->TimeTable = [$timeTable1, $timeTable2];

$setAlarmCfgRequest->AlarmCfg = $alarmCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setAlarmCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setAlarmCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});