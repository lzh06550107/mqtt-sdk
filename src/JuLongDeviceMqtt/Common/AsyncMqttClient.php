<?php
/**
 * 文件描述
 * Created on 2022/4/11 11:53
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use JuLongDeviceMqtt\Contracts\Repository;
use Psr\Log\LoggerInterface;

/**
 * mqtt异步客户端
 * Created on 2022/4/11 11:53
 * Create by LZH
 */
class AsyncMqttClient extends AbstractMqttClient
{

    public function __construct(LoggerInterface $logger = null, Repository $repository = null)
    {
        parent::__construct(null, $logger, $repository);
    }
}