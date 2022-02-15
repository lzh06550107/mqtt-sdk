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

use JuLongDeviceMqtt\ParamSetting\Models\DeviceCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetDeviceInfoRequest;
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

$setDeviceInfoRequest = new SetDeviceInfoRequest();

$deviceCfg = new DeviceCfg();
$deviceCfg->VideoFormat = 1;
$deviceCfg->DeviceLanguage = 1;

$setDeviceInfoRequest->DeviceCfg = $deviceCfg;

// TODO 测试未通过
Coroutine\run(function () use($paramSettingMqttClient, $setDeviceInfoRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setDeviceInfoRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});