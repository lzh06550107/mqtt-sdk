<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;


use JuLongDeviceMqtt\Contracts\MqttClient;

/**
 * 包含提供钩子所需的常用方法和属性。
 */
trait OffersHooks
{
    /** @var \SplObjectStorage|array<\Closure> 循环事件监听器 */
    private $loopEventHandlers;

    /** @var \SplObjectStorage|array<\Closure> 发布事件监听器 */
    private $publishEventHandlers;

    /** @var \SplObjectStorage|array<\Closure> 订阅消息接收事件监听器 */
    private $messageReceivedEventHandlers;

    /**
     * 初始化事件处理器容器
     *
     * @return void
     */
    protected function initializeEventHandlers(): void
    {
        $this->loopEventHandlers            = new \SplObjectStorage();
        $this->publishEventHandlers         = new \SplObjectStorage();
        $this->messageReceivedEventHandlers = new \SplObjectStorage();
    }

    /**
     * 注册一个循环事件处理程序，该处理程序在循环的每次迭代中调用。此事件处理程序可用于例如在某些条件下中断循环。
     *
     * 传入回调函数中的第一个参数是MQTT客户端，第二个参数是循环已经运行的时间
     *
     * Example:
     * ```php
     * $mqtt->registerLoopEventHandler(function (
     *     MqttClient $mqtt,
     *     float $elapsedTime
     * ) use ($logger) {
     *     $logger->info("Running for [{$elapsedTime}] seconds already.");
     * });
     * ```
     *
     * 可以注册多个循环事件处理器
     *
     * @param \Closure $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function registerLoopEventHandler(\Closure $callback): MqttClient
    {
        $this->loopEventHandlers->attach($callback);

        /** @var MqttClient $this */
        return $this;
    }

    /**
     * 移除注册的事件循环处理器，如果传入null，则移除所有注册的事件循环处理器。
     * @param \Closure|null $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function unregisterLoopEventHandler(\Closure $callback = null): MqttClient
    {
        if ($callback === null) {
            $this->loopEventHandlers->removeAll($this->loopEventHandlers);
        } else {
            $this->loopEventHandlers->detach($callback);
        }

        /** @var MqttClient $this */
        return $this;
    }

    /**
     * 使用给定的参数执行事件循环处理器
     * @param float $elapsedTime
     * @author LZH
     * @since 2022/04/08
     */
    private function runLoopEventHandlers(float $elapsedTime): void
    {
        foreach ($this->loopEventHandlers as $handler) {
            try {
                call_user_func($handler, $this, $elapsedTime);
            } catch (\Throwable $e) {
                $this->logger->error('Loop hook callback threw exception.', ['exception' => $e]);
            }
        }
    }

    /**
     * 注册一个消息发布事件处理器
     *
     * 传入回调函数中的第一个参数是MQTT客户端，第二个参数是主题，第三个参数是消息，第四个参数是消息id，第五个参数是服务质量，第六个参数是是否保留消息
     *
     * Example:
     * ```php
     * $mqtt->registerPublishEventHandler(function (
     *     MqttClient $mqtt,
     *     string $topic,
     *     string $message,
     *     int $messageId,
     *     int $qualityOfService,
     *     bool $retain
     * ) use ($logger) {
     *     $logger->info("Received message on topic [{$topic}]: {$message}");
     * });
     * ```
     *
     * 可以注册多个发布事件处理器
     *
     * @param \Closure $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function registerPublishEventHandler(\Closure $callback): MqttClient
    {
        $this->publishEventHandlers->attach($callback);

        /** @var MqttClient $this */
        return $this;
    }

    /**
     * 移除发布消息事件处理器，如果传入null，则移除所有注册的事件循环处理器。
     * @param \Closure|null $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function unregisterPublishEventHandler(\Closure $callback = null): MqttClient
    {
        if ($callback === null) {
            $this->publishEventHandlers->removeAll($this->publishEventHandlers);
        } else {
            $this->publishEventHandlers->detach($callback);
        }

        /** @var MqttClient $this */
        return $this;
    }

    /**
     * 使用给定的参数执行发布消息事件处理器
     * @param string $topic
     * @param string $message
     * @param int|null $messageId
     * @param int $qualityOfService
     * @param bool $retain
     * @author LZH
     * @since 2022/04/08
     */
    private function runPublishEventHandlers(string $topic, string $message, ?int $messageId, int $qualityOfService, bool $retain): void
    {
        foreach ($this->publishEventHandlers as $handler) {
            try {
                call_user_func($handler, $this, $topic, $message, $messageId, $qualityOfService, $retain);
            } catch (\Throwable $e) {
                $this->logger->error('Publish hook callback threw exception for published message on topic [{topic}].', [
                    'topic' => $topic,
                    'exception' => $e,
                ]);
            }
        }
    }

    /**
     * 注册一个消息接收事件处理器
     *
     * 传入回调函数中的第一个参数是MQTT客户端，第二个参数是主题，第三个参数是消息，第四个参数是服务质量，第六个参数是是否保留消息
     *
     * Example:
     * ```php
     * $mqtt->registerReceivedMessageEventHandler(function (
     *     MqttClient $mqtt,
     *     string $topic,
     *     string $message,
     *     int $qualityOfService,
     *     bool $retained
     * ) use ($logger) {
     *     $logger->info("Received message on topic [{$topic}]: {$message}");
     * });
     * ```
     *
     * 可以注册多个发布事件处理器
     *
     * @param \Closure $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function registerMessageReceivedEventHandler(\Closure $callback): MqttClient
    {
        $this->messageReceivedEventHandlers->attach($callback);

        /** @var MqttClient $this */
        return $this;
    }

    /**
     * 移除接收消息事件处理器，如果传入null，则移除所有注册的事件循环处理器。
     * @param \Closure|null $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function unregisterMessageReceivedEventHandler(\Closure $callback = null): MqttClient
    {
        if ($callback === null) {
            $this->messageReceivedEventHandlers->removeAll($this->messageReceivedEventHandlers);
        } else {
            $this->messageReceivedEventHandlers->detach($callback);
        }

        /** @var MqttClient $this */
        return $this;
    }

    /**
     * 使用给定的参数执行接收消息事件处理器
     * @param string $topic
     * @param string $message
     * @param int $qualityOfService
     * @param bool $retained
     * @author LZH
     * @since 2022/04/08
     */
    private function runMessageReceivedEventHandlers(string $topic, string $message, int $qualityOfService, bool $retained): void
    {
        foreach ($this->messageReceivedEventHandlers as $handler) {
            try {
                call_user_func($handler, $this, $topic, $message, $qualityOfService, $retained);
            } catch (\Throwable $e) {
                $this->logger->error('Received message hook callback threw exception for received message on topic [{topic}].', [
                    'topic' => $topic,
                    'exception' => $e,
                ]);
            }
        }
    }
}
