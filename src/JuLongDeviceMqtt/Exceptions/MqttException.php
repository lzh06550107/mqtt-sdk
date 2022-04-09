<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Exception;

/**
 * mqtt异常基类
 * Created on 2022/4/8 11:19
 * Create by LZH
 */
class MqttException extends \Exception
{
    /**
     * MqttClientException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $parentException
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $parentException = null)
    {
        if (empty($message)) {
            parent::__construct(
                sprintf('[%s] The MQTT client encountered an error.', $code),
                $code,
                $parentException
            );
        } else {
            parent::__construct($message, $code, $parentException);
        }
    }
}
