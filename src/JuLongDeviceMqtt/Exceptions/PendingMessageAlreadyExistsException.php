<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Exception;

/**
 * 待处理消息已经存在异常类
 * Created on 2022/4/8 11:24
 * Create by LZH
 */
class PendingMessageAlreadyExistsException extends MqttException
{
    /**
     * PendingMessageAlreadyExistsException constructor.
     *
     * @param int $messageId
     */
    public function __construct(int $messageId)
    {
        parent::__construct(sprintf('A pending message with the message identifier [%s] exists already.', $messageId));
    }
}
