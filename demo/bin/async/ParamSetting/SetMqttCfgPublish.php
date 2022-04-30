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
use JuLongDeviceMqtt\ParamSetting\Models\MqttCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetMqttCfgRequest;
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

$setMqttCfgRequest = new SetMqttCfgRequest();
$mqttCfg = new MqttCfg();
$mqttCfg->setMqttEnabled(1);
$mqttCfg->setMqttAddress("128.128.13.90");
$mqttCfg->setMqttPort(1883);
$mqttCfg->setMqttUsername("");
$mqttCfg->setMqttPassword("");
$mqttCfg->setRegisterEnabled(0);
$mqttCfg->setRegisterInterval(15);
$mqttCfg->setTopic("");
$mqttCfg->setInterval(10);
$mqttCfg->setRetransmission(0);
$mqttCfg->setReSendSum(0); // 只有Retransmission为1时，该参数才有效
$mqttCfg->setFacePicture(0);
$mqttCfg->setBackgroundPicture(0);
$mqttCfg->setPersonPhoto(0);
$mqttCfg->setResendtime(5);

$setMqttCfgRequest->MqttCfg = $mqttCfg;

Coroutine\run(function () use ($paramSettingMqttClient, $setMqttCfgRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setMqttCfgRequest, 1);
    Coroutine::sleep(3);
//    }
});