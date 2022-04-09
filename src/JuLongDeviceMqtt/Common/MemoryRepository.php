<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use JuLongDeviceMqtt\Contracts\Repository;
use JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException;
use JuLongDeviceMqtt\Exception\PendingMessageNotFoundException;
use JuLongDeviceMqtt\Exception\RepositoryException;

/**
 * 提供管理 消息ID、订阅和待处理消息 的内存实现。
 * Created on 2022/4/9 7:58
 * Create by LZH
 */
class MemoryRepository implements Repository
{
    private int $nextMessageId = 1;

    /** @var array<int, PendingMessage> 待处理输出消息 */
    private array $pendingOutgoingMessages = [];

    /** @var array<int, PendingMessage> 待处理输入消息 */
    private array $pendingIncomingMessages = [];

    /** @var array<int, Subscription>  订阅实例对象 */
    private array $subscriptions = [];

    /**
     * {@inheritDoc}
     */
    public function reset(): void
    {
        $this->nextMessageId           = 1;
        $this->pendingOutgoingMessages = [];
        $this->pendingIncomingMessages = [];
        $this->subscriptions           = [];
    }

    /**
     * {@inheritDoc}
     */
    public function newMessageId(): int
    {
        if (count($this->pendingOutgoingMessages) >= 65535) {
            throw new RepositoryException('No more message identifiers available. The queue is full.');
        }

        // 如果消息id已经存在，则递增，直到找到一个未使用消息id
        while (isset($this->pendingOutgoingMessages[$this->nextMessageId])) {
            $this->nextMessageId++;
            if ($this->nextMessageId > 65535) {
                $this->nextMessageId = 1;
            }
        }

        return $this->nextMessageId;
    }

    /**
     * {@inheritDoc}
     */
    public function countPendingOutgoingMessages(): int
    {
        return count($this->pendingOutgoingMessages);
    }

    /**
     * {@inheritDoc}
     */
    public function getPendingOutgoingMessage(int $messageId): ?PendingMessage
    {
        return $this->pendingOutgoingMessages[$messageId] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function getPendingOutgoingMessagesLastSentBefore(\DateTime $dateTime = null): array
    {
        $result = [];

        foreach ($this->pendingOutgoingMessages as $pendingMessage) {
            if ($pendingMessage->getLastSentAt() < $dateTime) {
                $result[] = $pendingMessage;
            }
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function addPendingOutgoingMessage(PendingMessage $message): void
    {
        if (isset($this->pendingOutgoingMessages[$message->getMessageId()])) {
            throw new PendingMessageAlreadyExistsException($message->getMessageId());
        }

        $this->pendingOutgoingMessages[$message->getMessageId()] = $message;
    }

    /**
     * {@inheritDoc}
     */
    public function markPendingOutgoingPublishedMessageAsReceived(int $messageId): bool
    {
        if (!isset($this->pendingOutgoingMessages[$messageId]) ||
            !$this->pendingOutgoingMessages[$messageId] instanceof PublishedMessage) {
            throw new PendingMessageNotFoundException($messageId);
        }

        return $this->pendingOutgoingMessages[$messageId]->markAsReceived();
    }

    /**
     * {@inheritDoc}
     */
    public function removePendingOutgoingMessage(int $messageId): bool
    {
        if (!isset($this->pendingOutgoingMessages[$messageId])) {
            return false;
        }

        unset($this->pendingOutgoingMessages[$messageId]);
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function countPendingIncomingMessages(): int
    {
        return count($this->pendingIncomingMessages);
    }

    /**
     * {@inheritDoc}
     */
    public function getPendingIncomingMessage(int $messageId): ?PendingMessage
    {
        return $this->pendingIncomingMessages[$messageId] ?? null;
    }

    /**
     * {@inheritDoc}
     */
    public function addPendingIncomingMessage(PendingMessage $message): void
    {
        if (isset($this->pendingIncomingMessages[$message->getMessageId()])) {
            throw new PendingMessageAlreadyExistsException($message->getMessageId());
        }

        $this->pendingIncomingMessages[$message->getMessageId()] = $message;
    }

    /**
     * {@inheritDoc}
     */
    public function removePendingIncomingMessage(int $messageId): bool
    {
        if (!isset($this->pendingIncomingMessages[$messageId])) {
            return false;
        }

        unset($this->pendingIncomingMessages[$messageId]);
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function countSubscriptions(): int
    {
        return count($this->subscriptions);
    }

    /**
     * {@inheritDoc}
     */
    public function addSubscription(Subscription $subscription): void
    {
        $this->subscriptions[] = $subscription;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscriptionsMatchingTopic(string $topicName): array
    {
        $result = [];

        foreach ($this->subscriptions as $subscription) {
            if ($topicName !== null && !$subscription->matchesTopic($topicName)) {
                continue;
            }

            $result[] = $subscription;
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function removeSubscription(string $topicFilter): bool
    {
        $result = false;

        foreach ($this->subscriptions as $index => $subscription) {
            if ($subscription->getTopicFilter() === $topicFilter) {
                unset($this->subscriptions[$index]);
                $result = true;
                break;
            }
        }

        return $result;
    }
}
