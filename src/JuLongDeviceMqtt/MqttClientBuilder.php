<?php
/**
 * 文件描述
 * Created on 2022/1/20 9:58
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt;

use Simps\MQTT\Config\ClientConfig;

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
    public function setBrokerHost(string $brokerHost): void
    {
        $this->brokerHost = $brokerHost;
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
    public function setBrokerPort(int $brokerPort): void
    {
        $this->brokerPort = $brokerPort;
    }






}