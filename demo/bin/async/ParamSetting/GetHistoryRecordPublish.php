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
use JuLongDeviceMqtt\ParamSetting\Models\GetHistoryRecordRequest;
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

$getHistoryRecordRequest = new GetHistoryRecordRequest();
$getHistoryRecordRequest->ChannelNo = 0;
$getHistoryRecordRequest->Type = 1;
$getHistoryRecordRequest->BeginTime = "2020-11-10 00:00:00";
$getHistoryRecordRequest->EndTime = "2022-11-12 23:59:59";
$getHistoryRecordRequest->RideType = 1;
$getHistoryRecordRequest->PersonIdentity = 0;


Coroutine\run(function () use($paramSettingMqttClient, $getHistoryRecordRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $getHistoryRecordRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});