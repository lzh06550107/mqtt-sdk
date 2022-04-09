<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Exception;

/**
 * 待处理消息未发现异常类
 * Created on 2022/4/8 11:25
 * Create by LZH
 */
class PendingMessageNotFoundException extends MqttException
{
    /**
     * PendingMessageNotFoundException constructor.
     *
     * @param int $messageId
     */
    public function __construct(int $messageId)
    {
        parent::__construct(sprintf('No pending message with the message identifier [%s].', $messageId));
    }
}
