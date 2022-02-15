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

use JuLongDeviceMqtt\ParamSetting\Models\AudioCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetAudioCfgRequest;
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

$setAudioCfgRequest = new SetAudioCfgRequest();

$audioCfg = new AudioCfg();
$audioCfg->Enable = 0;
$audioCfg->AudioInput = 0;
$audioCfg->AudioFormat = 0;
$audioCfg->InputVolume = 11;
$audioCfg->OutputVolume = 10;

$setAudioCfgRequest->AudioCfg = $audioCfg;

Coroutine\run(function () use($paramSettingMqttClient, $setAudioCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setAudioCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});