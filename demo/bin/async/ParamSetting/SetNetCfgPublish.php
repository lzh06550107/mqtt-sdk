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
use JuLongDeviceMqtt\ParamSetting\Models\NetCfg;
use JuLongDeviceMqtt\ParamSetting\Models\SetNetCfgRequest;
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

$setNetCfgRequest = new SetNetCfgRequest();

$netCfg = new NetCfg();
$netCfg->setDHCPEnabled(0);
$netCfg->setIPAddress("128.128.77.222");
$netCfg->setSubNetMask("255.255.0.0");
$netCfg->setGateway("128.128.1.1");
$netCfg->setDNS1("114.114.114.114");
$netCfg->setDNS2("8.8.8.8");

$setNetCfgRequest->setNetCfg($netCfg);

// TODO 未测试
Coroutine\run(function () use ($paramSettingMqttClient, $setNetCfgRequest) {
//    while (true) {
    $paramSettingMqttClient->publish('fwSkNfgI4JKljlkM', $setNetCfgRequest, MQTT_QOS_0);
    Coroutine::sleep(3);
//    }
});