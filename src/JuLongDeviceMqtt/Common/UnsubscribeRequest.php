<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

/**
 * 表示一个取消订阅请求
 * Created on 2022/4/8 17:27
 * Create by LZH
 */
class UnsubscribeRequest extends PendingMessage
{
    /** @var string[] 取消订阅的主题 */
    private array $topicFilters;

    /**
     * 创建一个新的取消订阅请求
     *
     * @param int $messageId
     * @param array $topicFilters
     */
    public function __construct(int $messageId, array $topicFilters)
    {
        parent::__construct($messageId);

        $this->topicFilters = array_values($topicFilters);
    }

    /**
     * 返回请求主题过滤器
     *
     * @return array|string[]
     * @author LZH
     * @since 2022/04/09
     */
    public function getTopicFilters(): array
    {
        return $this->topicFilters;
    }
}
