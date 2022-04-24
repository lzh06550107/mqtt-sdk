<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

/**
 * 用于订阅需要存储在存储库中的主题简单 DTO
 * Created on 2022/4/8 11:27
 * Create by LZH
 */
class Subscription
{
    /**
     * @var string 主题名称
     */
    private $topicFilter;

    /**
     * @var string 正在表达式主题过滤器
     */
    private $regexifiedTopicFilter;

    /**
     * @var int 服务质量
     */
    private $qualityOfService;

    /**
     * @var \Closure|null 订阅主题的回调方法
     */
    private $callback;

    /**
     * 创建一个新的订阅对象
     * @param string $topicFilter
     * @param int $qualityOfService
     * @param \Closure|null $callback
     */
    public function __construct(string $topicFilter, int $qualityOfService = 0, ?\Closure $callback = null)
    {
        $this->topicFilter      = $topicFilter;
        $this->qualityOfService = $qualityOfService;
        $this->callback         = $callback;

        $this->regexifyTopicFilter();
    }

    /**
     * 转换主题过滤器为一个正在表达式
     *
     * @author LZH
     * @since 2022/04/09
     */
    private function regexifyTopicFilter(): void
    {
        $topicFilter = $this->topicFilter;

        // 共享订阅格式为：$share/<group>/<topic>
        if (strpos($topicFilter, '$share/') === 0 && ($separatorIndex = strpos($topicFilter, '/', 7)) !== false) {
            $topicFilter = substr($topicFilter, $separatorIndex + 1);
        }

        $this->regexifiedTopicFilter = '/^' . str_replace(['$', '/', '+', '#'], ['\$', '\/', '[^\/]*', '.*'], $topicFilter) . '$/';
    }

    /**
     * 返回订阅主题
     *
     * @return string
     * @author LZH
     * @since 2022/04/09
     */
    public function getTopicFilter(): string
    {
        return $this->topicFilter;
    }

    /**
     * 使用给定的主题名称匹配订阅主题过滤器
     *
     * @param string $topicName
     * @return bool
     * @author LZH
     * @since 2022/04/09
     */
    public function matchesTopic(string $topicName): bool
    {
        return (bool) preg_match($this->regexifiedTopicFilter, $topicName);
    }


    /**
     * 返回订阅的回调闭包
     *
     * @return \Closure|null
     * @author LZH
     * @since 2022/04/09
     */
    public function getCallback(): ?\Closure
    {
        return $this->callback;
    }

    /**
     * 返回订阅的服务质量
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
     * 设置订阅的服务质量
     *
     * @param int $qualityOfService
     * @author LZH
     * @since 2022/04/09
     */
    public function setQualityOfServiceLevel(int $qualityOfService): void
    {
        $this->qualityOfService = $qualityOfService;
    }
}
