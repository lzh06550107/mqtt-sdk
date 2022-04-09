<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use DateTime;

/**
 * 表示一个待处理消息
 *
 * 对于具有 QoS 1 和 2 的消息，如果在给定的时间段内没有收到来自服务器的确认，则客户端负责重新发送消息。
 *
 * 此类用作消息对象的公共基础，如果没有收到确认，则需要重新发送这些对象。
 */
abstract class PendingMessage
{
    private int $messageId; // 消息id
    private int $sendingAttempts = 1; // 消息重发次数
    private DateTime $lastSentAt; // 最近一次发送时间

    /**
     * 创建一个新的待处理消息对象
     * @param int $messageId
     * @param DateTime|null $sentAt
     */
    protected function __construct(int $messageId, DateTime $sentAt = null)
    {
        $this->messageId  = $messageId;
        $this->lastSentAt = $sentAt ?? new DateTime();
    }

    /**
     * 返回一个消息id
     *
     * @return int
     * @author LZH
     * @since 2022/04/09
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * 返回消息最近一次发送时间
     * @return DateTime
     * @author LZH
     * @since 2022/04/09
     */
    public function getLastSentAt(): DateTime
    {
        return $this->lastSentAt;
    }

    /**
     * 返回消息重发次数
     * @return int
     * @author LZH
     * @since 2022/04/09
     */
    public function getSendingAttempts(): int
    {
        return $this->sendingAttempts;
    }

    /**
     * 设置消息最近一次发送的时间
     *
     * @param DateTime|null $value
     * @return $this
     * @author LZH
     * @since 2022/04/09
     */
    public function setLastSentAt(DateTime $value = null): self
    {
        $this->lastSentAt = $value ?? new DateTime();

        return $this;
    }

    /**
     * 增加消息重发次数
     *
     * @return $this
     * @author LZH
     * @since 2022/04/09
     */
    public function incrementSendingAttempts(): self
    {
        $this->sendingAttempts++;

        return $this;
    }
}
