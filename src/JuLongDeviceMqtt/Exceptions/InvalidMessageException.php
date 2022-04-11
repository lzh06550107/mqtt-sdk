<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Exception;

/**
 * 如果MQTT客户端遇到一个无效的消息，则抛出该异常
 * Created on 2022/4/11 10:06
 * Create by LZH
 */
class InvalidMessageException extends MqttException
{
}
