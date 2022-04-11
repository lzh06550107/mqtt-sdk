<?php
/**
 * 文件描述
 * Created on 2022/1/20 9:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt;

use JuLongDeviceMqtt\FaceManage\AsyncFaceManageMqttClient;
use JuLongDeviceMqtt\FaceManage\SyncFaceManageMqttClient;
use JuLongDeviceMqtt\ParamSetting\AsyncParamSettingMqttClient;
use JuLongDeviceMqtt\ParamSetting\SyncParamSettingMqttClient;
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
     * 获取人脸管理客户端
     * @param bool $asyncOrSync 异步客户端还是同步客户端
     * @author LZH
     * @since 2022/04/11
     */
    public function getFaceManageMqttClient(bool $asyncOrSync = true)
    {
        if ($asyncOrSync) {
            $asyncMqttClient = new AsyncMqttClient();
            return new AsyncFaceManageMqttClient($asyncMqttClient);
        } else {
            $syncMqttClient = new SyncMqttClient();
            return new SyncFaceManageMqttClient($syncMqttClient);
        }

    }

    /**
     * 获取参数设置客户端
     * @param bool $asyncOrSync 异步客户端还是同步客户端
     * @author LZH
     * @since 2022/04/11
     */
    public function getParamSettingMqttClient(bool $asyncOrSync = true)
    {
        if ($asyncOrSync) {
            $asyncMqttClient = new AsyncMqttClient();
            return new AsyncParamSettingMqttClient($asyncMqttClient);
        } else {
            $syncMqttClient = new SyncMqttClient();
            return new SyncParamSettingMqttClient($syncMqttClient);
        }

    }

}