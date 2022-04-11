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
use JuLongDeviceMqtt\ParamSetting\Models\NetCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetNetCfgRequest;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
use Swoole\Coroutine;

$asyncMqttClient = new AsyncMqttClient();

$asyncMqttClient->setBrokerHost('128.128.20.81');
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

$setNetCfgRequest = new SetNetCfgRequest();

$netCfg = new NetCfg();
$netCfg->DHCPEnabled = 0;
$netCfg->IPAddress = "128.128.77.222";
$netCfg->SubNetMask = "255.255.0.0";
$netCfg->Gateway = "128.128.1.1";
$netCfg->DNS1 = "114.114.114.114";
$netCfg->DNS2 = "8.8.8.8";

$setNetCfgRequest->NetCfg = $netCfg;

// TODO 未测试
Coroutine\run(function () use ($paramSettingMqttClient, $setNetCfgRequest) {
//    while (true) {
    $response = $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setNetCfgRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});