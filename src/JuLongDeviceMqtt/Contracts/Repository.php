<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Contracts;

use DateTime;
use JuLongDeviceMqtt\Common\PendingMessage;
use JuLongDeviceMqtt\Common\Subscription;
use JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException;
use JuLongDeviceMqtt\Exception\PendingMessageNotFoundException;
use JuLongDeviceMqtt\Exception\RepositoryException;

/**
 * 实现该接口，可以为MQTT客户端提供存储能力。
 *
 * 该类型的服务主要有三个主要目标
 *   1. 提供和跟踪消息标识符，因为它们在消息流中必须是唯一的（即不能同时存在不同消息的重复）
 *   2. 存储和跟踪订阅，这在持久会话的情况下尤其必要。
 *   3. 存储和跟踪待处理的消息（即已发送的消息，尚未被服务器确认）。
 */
interface Repository
{
    /**
     * 通过删除所有持久数据并恢复最初创建存储库时给出的原始状态来重新初始化存储库。当客户端在连接期间请求一个 clean session 时使用它。
     *
     * @return bool
     */
    public function reset(): void;

    /**
     * 返回一个新的消息 ID。消息 ID 之前可能已使用，但当前未使用（即在重新发送队列中）
     *
     * @return int
     * @throws RepositoryException
     */
    public function newMessageId(): int;

    /**
     * 返回待处理的传出消息的数量。
     *
     * @return int
     */
    public function countPendingOutgoingMessages(): int;

    /**
     * 如果找到，则获取具有给定消息标识符的待处理传出消息。
     *
     * @param int $messageId
     * @return PendingMessage|null
     */
    public function getPendingOutgoingMessage(int $messageId): ?PendingMessage;

    /**
     * 获取在给定日期时间之前最后发送的消息的列表。
     * @param DateTime|null $dateTime
     * @return array
     * @author LZH
     * @since 2022/04/09
     */
    public function getPendingOutgoingMessagesLastSentBefore(DateTime $dateTime = null): array;

    /**
     * 将待处理的传出消息添加到存储库。
     * @param PendingMessage $message
     * @author LZH
     * @since 2022/04/09
     */
    public function addPendingOutgoingMessage(PendingMessage $message): void;

    /**
     * 将现有待处理的传出已发布消息标记为已接收。
     * @param int $messageId
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function markPendingOutgoingPublishedMessageAsReceived(int $messageId): bool;

    /**
     * 移除一个待处理的输出消息
     * @param int $messageId
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function removePendingOutgoingMessage(int $messageId): bool;

    /**
     * 返回待处理的传入消息的数量。
     * @return int
     * @author LZH
     * @since 2022/04/09
     */
    public function countPendingIncomingMessages(): int;

    /**
     * 根据消息id来获取待处理接收消息。
     * @param int $messageId
     * @return PendingMessage|null
     * @author LZH
     * @since 2022/04/09
     */
    public function getPendingIncomingMessage(int $messageId): ?PendingMessage;

    /**
     * 添加一个待输入消息到存储库中。
     * @param PendingMessage $message
     * @author LZH
     * @since 2022/04/09
     */
    public function addPendingIncomingMessage(PendingMessage $message): void;

    /**
     * 从存储库中移除待处理接收的消息。
     * @param int $messageId
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function removePendingIncomingMessage(int $messageId): bool;

    /**
     * 返回注册的订阅数。
     * @return int
     * @author LZH
     * @since 2022/04/09
     */
    public function countSubscriptions(): int;

    /**
     * 添加一个订阅到存储库
     * @param Subscription $subscription
     * @author LZH
     * @since 2022/04/09
     */
    public function addSubscription(Subscription $subscription): void;

    /**
     * 获取所有匹配给定主题的订阅者
     * @param string $topicName
     * @return array
     * @author LZH
     * @since 2022/04/09
     */
    public function getSubscriptionsMatchingTopic(string $topicName): array;

    /**
     * 根据主题从存储库中移除订阅者
     * @param string $topicFilter
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function removeSubscription(string $topicFilter): bool;
}
