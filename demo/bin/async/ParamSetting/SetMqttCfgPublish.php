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
use JuLongDeviceMqtt\ParamSetting\Models\MqttCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetMqttCfgRequest;
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

$setMqttCfgRequest = new SetMqttCfgRequest();
$mqttCfg = new MqttCfg();
$mqttCfg->MqttEnabled = 1;
$mqttCfg->MqttAddress = "128.128.13.90";
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