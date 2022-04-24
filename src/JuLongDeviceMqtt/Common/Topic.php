<?php
/**
 * 文件描述
 * Created on 2022/1/20 11:06
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

/**
 * 主题抽象类
 * Created on 2022/1/21 10:04
 * Create by LZH
 */
abstract class Topic
{
    /**
     * @var string
     */
    private $prefix; // 主题前缀

    /**
     * @var string
     */
    private $name; // 主题名称

    /**
     * @var string
     */
    private $UUIDORCustom; // UUID或者自定义主题名称

    public function __construct(string $name, $UUIDORCustom = '', string $prefix = 'mqtt')
    {
        $this->prefix = $prefix;
        $this->UUIDORCustom = $UUIDORCustom;
        $this->name = $name;
    }

    public static function with(string $name, string $UUIDORCustom = '', string $prefix = 'mqtt')
    {
        return new static($name, $UUIDORCustom, $prefix);
    }

    public function equals(self $topic): bool
    {
        return (string) $this === (string) $topic;
    }

    public static function fromString(string $topic): self
    {
        $topicParts = explode('/', $topic);

        if (2 !== \count($topicParts) && 3 != \count($topicParts)) { // 主题长度可能为2端或者3端
            throw new \InvalidArgumentException(sprintf('Topic "%s" might be invalid.', $topic));
        }

        if(count($topicParts) == 2) {
            return new static($topicParts[1], '', $topicParts[0]);
        } else {
            return new static($topicParts[1], $topicParts[3], $topicParts[0]);
        }

    }

    public function toTopicName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {

        if (empty($this->UUIDORCustom)) {
            return sprintf('%s/%s', $this->prefix, $this->name);
        } else {
            return sprintf('%s/%s/%s', $this->prefix, $this->name, $this->UUIDORCustom);
        }

    }
}