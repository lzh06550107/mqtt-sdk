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
use JuLongDeviceMqtt\ParamSetting\Models\DeleteRecordRequest;
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

$deleteRecordRequest = new DeleteRecordRequest();
$deleteRecordRequest->setMode(1);
$deleteRecordRequest->setBeginTime("2020-12-14 11:00:00");
$deleteRecordRequest->setEndTime("2022-12-14 11:00:00");

Coroutine\run(function () use($paramSettingMqttClient, $deleteRecordRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $deleteRecordRequest, MQTT_QOS_0);
    Coroutine::sleep(3);
//    }
});