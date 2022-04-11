# mqtt-device-sdk

对应 mqtt-20220208 协议版本。

# 演示配置

# 完成的接口

## 人脸图片管理

### 异步调用

- 添加人脸

方法一：

```PHP
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
use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\AddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
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

$faceManageBaseMqttClient = new AsyncFaceManageMqttClient($asyncMqttClient);

$addPersonRequest = new AddPersonRequest();

$addPersonRequest->PersonCover = 1;
$addPersonRequest->PersonType = 2;

$personInfo = new PersonInfo();

$personInfo->PersonId = '1'; // 注意，这里必须是字符串，否则，会出现各种奇葩的问题
$personInfo->ICCard = 'id1';
$personInfo->ICCardList = [
    "321281199002271070",
    "321281199002271071"
];
$personInfo->IDCard = '321281199002271069';
$personInfo->PersonName = 'test';
$personInfo->Sex = 1;
$personInfo->Nation = '广东';
$personInfo->Birthday = '1990-09-12';
$personInfo->Phone = '13654124584';
$personInfo->Address = '广东省广州市';
$personInfo->LimitTime = 0;
$personInfo->StartTime = '2020-09-12 09:10:00';
$personInfo->EndTime = '2021-09-12 09:10:00';
$personInfo->PersonIdentity = 0;
$personInfo->IdentityAttribute = 0;
///////////使用图片链接开始/////////////////
//$personInfo->PhotoType = 0;
//$personInfo->PersonPhotoUrl = 'http://qczxadmin.jvt.cc/temp/image/2021/11/901d316b7b30d3ca.jpg';
///////////使用图片链接结束/////////////////
$personInfo->PhotoType = 1;
$personInfo->PersonPhoto = 'base64编码图片';

$addPersonRequest->PersonInfo = $personInfo;

Coroutine\run(function () use($faceManageBaseMqttClient, $addPersonRequest) {
//    while (true) {
        $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $addPersonRequest, 1);
        var_dump($response);
        Coroutine::sleep(3);
//    }
});
```

方法二：

```PHP
<?php

declare(strict_types=1);

use JuLongDeviceMqtt\AsyncMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\AddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
use Swoole\Coroutine;

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

AsyncMqttClient::configurator()->setBrokerHost('128.128.20.81')->setBrokerPort(1883)
    ->setKeepAlive(10)->setDelay(10)->setMaxAttempts(3)->setSwooleConfig([
        'open_mqtt_protocol' => true,
        'package_max_length' => 2 * 1024 * 1024,
        'connect_timeout' => 5.0,
        'write_timeout' => 5.0,
        'read_timeout' => 5.0,
    ]);

$faceManageBaseMqttClient = AsyncMqttClient::getAsyncFaceManageMqttClient(true); // 获取异步客户端

$addPersonRequest = new AddPersonRequest();

$addPersonRequest->PersonCover = 1;
$addPersonRequest->PersonType = 2;

$personInfo = new PersonInfo();

$personInfo->PersonId = '1'; // 注意，这里必须是字符串，否则，会出现各种奇葩的问题
$personInfo->ICCard = 'id1';
$personInfo->ICCardList = [
    "321281199002271070",
    "321281199002271071"
];
$personInfo->IDCard = '321281199002271069';
$personInfo->PersonName = 'test';
$personInfo->Sex = 1;
$personInfo->Nation = '广东';
$personInfo->Birthday = '1990-09-12';
$personInfo->Phone = '13654124584';
$personInfo->Address = '广东省广州市';
$personInfo->LimitTime = 0;
$personInfo->StartTime = '2020-09-12 09:10:00';
$personInfo->EndTime = '2021-09-12 09:10:00';
$personInfo->PersonIdentity = 0;
$personInfo->IdentityAttribute = 0;
///////////使用图片链接开始/////////////////
//$personInfo->PhotoType = 0;
//$personInfo->PersonPhotoUrl = 'http://qczxadmin.jvt.cc/temp/image/2021/11/901d316b7b30d3ca.jpg';
///////////使用图片链接结束/////////////////
$personInfo->PhotoType = 1;
$personInfo->PersonPhoto = 'base64编码图片';

$addPersonRequest->PersonInfo = $personInfo;

Coroutine\run(function () use($faceManageBaseMqttClient, $addPersonRequest) {
//    while (true) {
    $response = $faceManageBaseMqttClient->publish('fwSkNfgI4JKljlkM', $addPersonRequest, 1);
    var_dump($response);
    Coroutine::sleep(3);
//    }
});
```
### 同步调用

方法一：

```PHP
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

use JuLongDeviceMqtt\Common\SyncMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\AddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
use JuLongDeviceMqtt\FaceManage\SyncFaceManageMqttClient;
use Swoole\Coroutine;

$syncMqttClient = new SyncMqttClient();

$syncMqttClient->setBrokerHost('128.128.20.81');
$syncMqttClient->setBrokerPort(1883);
$syncMqttClient->setKeepAlive(10);
$syncMqttClient->setDelay(10);
$syncMqttClient->setMaxAttempts(3);

$syncMqttClient->setSwooleConfig([
    'open_mqtt_protocol' => true,
    'package_max_length' => 2 * 1024 * 1024,
    'connect_timeout' => 5.0,
    'write_timeout' => 5.0,
    'read_timeout' => 5.0,
]);

$faceManageMqttClient = new SyncFaceManageMqttClient($syncMqttClient);

$addPersonRequest = new AddPersonRequest();

$addPersonRequest->PersonCover = 1;
$addPersonRequest->PersonType = 2;

$personInfo = new PersonInfo();

$personInfo->PersonId = '1'; // 注意，这里必须是字符串，否则，会出现各种奇葩的问题
$personInfo->ICCard = 'id1';
$personInfo->ICCardList = [
    "321281199002271070",
    "321281199002271071"
];
$personInfo->IDCard = '321281199002271069';
$personInfo->PersonName = 'test';
$personInfo->Sex = 1;
$personInfo->Nation = '广东';
$personInfo->Birthday = '1990-09-12';
$personInfo->Phone = '13654124584';
$personInfo->Address = '广东省广州市';
$personInfo->LimitTime = 0;
$personInfo->StartTime = '2020-09-12 09:10:00';
$personInfo->EndTime = '2021-09-12 09:10:00';
$personInfo->PersonIdentity = 0;
$personInfo->IdentityAttribute = 0;
///////////使用图片链接开始/////////////////
//$personInfo->PhotoType = 0;
//$personInfo->PersonPhotoUrl = 'http://qczxadmin.jvt.cc/temp/image/2021/11/901d316b7b30d3ca.jpg';
///////////使用图片链接结束/////////////////
$personInfo->PhotoType = 1;
$personInfo->PersonPhoto = 'base64编码图片';

$addPersonRequest->PersonInfo = $personInfo;

try {
    $result = $faceManageMqttClient->request('fwSkNfgI4JKljlkM', $addPersonRequest);
    print_r($result);
} catch (\JuLongDeviceMqtt\Exception\MqttException $e) {
    echo $e->getMessage();
}
```

方法二：

```php
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

use JuLongDeviceMqtt\Common\SyncMqttClient;
use JuLongDeviceMqtt\FaceManage\Models\AddPersonRequest;
use JuLongDeviceMqtt\FaceManage\Models\PersonInfo;
use JuLongDeviceMqtt\FaceManage\SyncFaceManageMqttClient;
use Swoole\Coroutine;

$syncMqttClient = new SyncMqttClient();

$syncMqttClient->setBrokerHost('128.128.20.81');
$syncMqttClient->setBrokerPort(1883);
$syncMqttClient->setKeepAlive(10);
$syncMqttClient->setDelay(10);
$syncMqttClient->setMaxAttempts(3);

$syncMqttClient->setSwooleConfig([
    'open_mqtt_protocol' => true,
    'package_max_length' => 2 * 1024 * 1024,
    'connect_timeout' => 5.0,
    'write_timeout' => 5.0,
    'read_timeout' => 5.0,
]);

$faceManageMqttClient = new SyncFaceManageMqttClient($syncMqttClient);

$addPersonRequest = new AddPersonRequest();

$addPersonRequest->PersonCover = 1;
$addPersonRequest->PersonType = 2;

$personInfo = new PersonInfo();

$personInfo->PersonId = '1'; // 注意，这里必须是字符串，否则，会出现各种奇葩的问题
$personInfo->ICCard = 'id1';
$personInfo->ICCardList = [
    "321281199002271070",
    "321281199002271071"
];
$personInfo->IDCard = '321281199002271069';
$personInfo->PersonName = 'test';
$personInfo->Sex = 1;
$personInfo->Nation = '广东';
$personInfo->Birthday = '1990-09-12';
$personInfo->Phone = '13654124584';
$personInfo->Address = '广东省广州市';
$personInfo->LimitTime = 0;
$personInfo->StartTime = '2020-09-12 09:10:00';
$personInfo->EndTime = '2021-09-12 09:10:00';
$personInfo->PersonIdentity = 0;
$personInfo->IdentityAttribute = 0;
///////////使用图片链接开始/////////////////
//$personInfo->PhotoType = 0;
//$personInfo->PersonPhotoUrl = 'http://qczxadmin.jvt.cc/temp/image/2021/11/901d316b7b30d3ca.jpg';
///////////使用图片链接结束/////////////////
$personInfo->PhotoType = 1;
$personInfo->PersonPhoto = 'base64编码图片';

$addPersonRequest->PersonInfo = $personInfo;

try {
    $result = $faceManageMqttClient->request('fwSkNfgI4JKljlkM', $addPersonRequest);
    print_r($result);
} catch (\JuLongDeviceMqtt\Exception\MqttException $e) {
    echo $e->getMessage();
}
```

## 配置选项

## 数据流

## 文件传送

# 参考文档

- http://www.taichi-maker.com/homepage/esp8266-nodemcu-iot/iot-tuttorial/mqtt-tutorial/
- http://docs.oasis-open.org/mqtt/mqtt/v3.1.1/mqtt-v3.1.1.html
- https://docs.oasis-open.org/mqtt/mqtt/v5.0/os/mqtt-v5.0-os.html