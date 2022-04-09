<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Exception;

/**
 * 如果MQTT客户端遇到违法协议字段，则抛出该异常
 * Created on 2022/4/8 17:43
 * Create by LZH
 */
class ProtocolViolationException extends MqttException
{

    public function __construct(string $error)
    {
        parent::__construct(sprintf('Protocol violation: %s.', $error));
    }
}
