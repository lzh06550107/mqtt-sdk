<?php
/**
 * 文件描述
 * Created on 2022/1/20 9:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt;

use JuLongDeviceMqtt\Common\AbstractMqttClient;
use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\SyncFaceManageMqttClient;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
use JuLongDeviceMqtt\ParamSetting\SyncParamSettingMqttClient;
use ReflectionClass;
use ReflectionMethod;
use Simps\MQTT\Config\ClientConfig;
use JuLongDeviceMqtt\Common\AsyncMqttClient;
use JuLongDeviceMqtt\Common\SyncMqttClient;

/**
 * mqtt客户端构建器
 * Created on 2022/1/20 10:40
 * Create by LZH
 */
final class MqttClientBuilder extends ClientConfig
{
    /**
     * @var string 中间件主机地址
     */
    private $brokerHost;

    /**
     * @var int 中间件服务端口
     */
    private $brokerPort;

    /**
     * @return string
     */
    public function getBrokerHost(): string
    {
        return $this->brokerHost;
    }

    /**
     * @param string $brokerHost
     */
    public function setBrokerHost(string $brokerHost)
    {
        $this->brokerHost = $brokerHost;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrokerPort(): int
    {
        return $this->brokerPort;
    }

    /**
     * @param int $brokerPort
     */
    public function setBrokerPort(int $brokerPort)
    {
        $this->brokerPort = $brokerPort;
        return $this;
    }

    /**
     * 获取人脸管理同步客户端
     * @return SyncFaceManageMqttClient
     * @author LZH
     * @since 2022/04/25
     */
    public function getSyncFaceManageMqttClient() : SyncFaceManageMqttClient
    {
        $syncMqttClient = new SyncMqttClient();
        $this->copyValue($syncMqttClient);
        return new SyncFaceManageMqttClient($syncMqttClient);
    }

    /**
     * 获取人脸管理异步客户端
     * @return AsyncFaceManageMqttClient
     * @author LZH
     * @since 2022/04/25
     */
    public function getAsyncFaceManageMqttClient() : AsyncFaceManageMqttClient
    {
        $asyncMqttClient = new AsyncMqttClient();
        $this->copyValue($asyncMqttClient);
        return new AsyncFaceManageMqttClient($asyncMqttClient);
    }

    /**
     * 获取参数设置同步客户端
     * @return SyncParamSettingMqttClient
     * @author LZH
     * @since 2022/04/25
     */
    public function getSyncParamSettingMqttClient() : SyncParamSettingMqttClient
    {
        $syncMqttClient = new SyncMqttClient();
        $this->copyValue($syncMqttClient);
        return new SyncParamSettingMqttClient($syncMqttClient);
    }

    /**
     * 获取参数设置异步客户端
     * @return AsyncParamSettingMqttClient
     * @author LZH
     * @since 2022/04/25
     */
    public function getAsyncParamSettingMqttClient() : AsyncParamSettingMqttClient
    {
        $asyncMqttClient = new AsyncMqttClient();
        $this->copyValue($asyncMqttClient);
        return new AsyncParamSettingMqttClient($asyncMqttClient);
    }

    /**
     * 复制构建器的值给客户端
     * @author LZH
     * @since 2022/04/25
     */
    private function copyValue(AbstractMqttClient $mqttClient) : void
    {
        $reflectionClassObj = new ReflectionClass($this); // 第一个参数对象
        $allPublicMethods = $reflectionClassObj->getMethods(ReflectionMethod::IS_PUBLIC);

        $reflectionClientObj = new ReflectionClass($mqttClient);
        $clientAllPublicMethods = array_column($reflectionClientObj->getMethods(ReflectionMethod::IS_PUBLIC), 'name');
        foreach ($allPublicMethods as $publicMethod) {
            $methodName = substr($publicMethod->name, 3);
            if (str_starts_with($publicMethod->name, 'get') && in_array($publicMethod->name, $clientAllPublicMethods)) {
                $mqttClient->{'set' . $methodName}($publicMethod->invoke($this));
            }
        }
    }

}