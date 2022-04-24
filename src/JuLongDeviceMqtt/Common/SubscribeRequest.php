<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;


/**
 * 表示一个待处理的订阅请求
 * Created on 2022/4/8 17:30
 * Create by LZH
 */
class SubscribeRequest extends PendingMessage
{
    /** @var Subscription[] 一个订阅请求可能包括多个主题订阅 */
    private $subscriptions;

    /**
     * 创建一个订阅请求消息
     *
     * @param int $messageId
     * @param array $subscriptions
     */
    public function __construct(int $messageId, array $subscriptions)
    {
        parent::__construct($messageId);

        $this->subscriptions = array_values($subscriptions);
    }

    /**
     * 返回该请求中的所有订阅
     * @return array|Subscription[]
     * @author LZH
     * @since 2022/04/09
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }
}
