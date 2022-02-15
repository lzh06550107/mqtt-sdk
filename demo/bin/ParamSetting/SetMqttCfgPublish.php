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

use JuLongDeviceMqtt\ParamSetting\Models\MqttCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetMqttCfgRequest;
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

$setMqttCfgRequest = new SetMqttCfgRequest();
$mqttCfg = new MqttCfg();
$mqttCfg->MqttEnabled = 1;
$mqttCfg->MqttAddress = "128.128.20.81";
$mqttCfg->MqttPort = 1883;
$mqttCfg->MqttUsername = "";
$mqttCfg->MqttPassword = "";
$mqttCfg->RegisterEnabled = 0;
$mqttCfg->RegisterInterval = 15;
$mqttCfg->Topic = "";
$mqttCfg->Interval = 10;
$mqttCfg->Retransmission = 0;
$mqttCfg->ReSendSum = 0; // 只有Retransmission为1时，该参数才有效
$mqttCfg->FacePicture = 0;
$mqttCfg->BackgroundPicture = 0;
$mqttCfg->PersonPhoto = 0;
$mqttCfg->Resendtime = 5;

$setMqttCfgRequest->MqttCfg = $mqttCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setMqttCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setMqttCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});