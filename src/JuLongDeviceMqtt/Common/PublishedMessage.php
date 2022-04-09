<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

/**
 * 一个简单的 DTO，用于在等待确认交付时需要存储在存储库中的已发布消息。
 */
class PublishedMessage extends PendingMessage
{
    private string $topicName; // 主题名称
    private string $message; // 消息内容
    private int $qualityOfService; // 服务质量
    private bool $retain; // 是否保留消息
    private bool $received = false; // 该消息是否已经被确认，服务质量1和2都需要确认

    /**
     * 创建一个新的发布消息对象
     *
     * @param int $messageId
     * @param string $topicName
     * @param string $message
     * @param int $qualityOfService
     * @param bool $retain
     */
    public function __construct(
        int $messageId,
        string $topicName,
        string $message,
        int $qualityOfService,
        bool $retain
    )
    {
        parent::__construct($messageId);
        $this->topicName        = $topicName;
        $this->message          = $message;
        $this->qualityOfService = $qualityOfService;
        $this->retain           = $retain;
    }

    /**
     * 返回发布消息的主题名称
     *
     * @return string
     * @author LZH
     * @since 2022/04/09
     */
    public function getTopicName(): string
    {
        return $this->topicName;
    }

    /**
     * 返回发布消息的内容
     *
     * @return string
     * @author LZH
     * @since 2022/04/09
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * 返回发布的消息服务质量
     *
     * @return int
     * @author LZH
     * @since 2022/04/09
     */
    public function getQualityOfServiceLevel(): int
    {
        return $this->qualityOfService;
    }

    /**
     * 是否需要保留消息
     *
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function wantsToBeRetained(): bool
    {
        return $this->retain;
    }

    /**
     * 判断发布的消息是否已经确认接收
     *
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function hasBeenReceived(): bool
    {
        return $this->received;
    }

    /**
     * 标记发布的消息为已经接收
     *
     * @return bool 如果消息以前没有标记为接收，则返回true；否则返回false
     * @author LZH
     * @since 2022/04/09
     */
    public function markAsReceived(): bool
    {
        $result = !$this->received;

        $this->received = true;

        return $result;
    }
}
