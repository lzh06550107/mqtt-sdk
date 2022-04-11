<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\Contracts;

/**
 * mqtt客户端接口
 */
interface MqttClient
{

    /**
     * 连接 MQTT 中间件
     * @param bool $clean 是否清除会话
     * @param array $will 遗嘱配置
     * @author LZH
     * @since 2022/04/08
     */
    public function connect(
        bool $clean = true, array $will = []
    );

    /**
     * 断开连接
     * @author LZH
     * @since 2022/04/08
     */
    public function disconnect(): void;

    /**
     * 客户端是否已经连接
     * @return bool
     * @author LZH
     * @since 2022/04/08
     */
    public function isConnected(): bool;

    /**
     * 在给定主题上发布给定消息。如果设置了额外的服务质量和保留标志，则将使用这些设置发布消息。
     * @param string $uuidOrTopic
     * @param string $message
     * @param int $qualityOfService
     * @param int $dup
     * @param int $retain
     * @param array $properties
     * @author LZH
     * @since 2022/04/08
     */
    public function publish(string $uuidOrTopic, string $message , int $qualityOfService = 0, int $dup = 0, int $retain = 0, array $properties = []);

    /**
     * 订阅给定服务质量的主题
     *
     * 订阅回调函数的第一个参数是主题，第二个参数是消息内容，第三个参数标志该消息是否是保留消息
     *
     * Example:
     * ```php
     * $mqtt->subscribe(
     *     '/foo/bar/+',
     *     function (string $topic, string $message, bool $retained) use ($logger) {
     *         $logger->info("Received {retained} message on topic [{topic}]: {message}", [
     *             'topic' => $topic,
     *             'message' => $message,
     *             'retained' => $retained ? 'retained' : 'live'
     *         ]);
     *     }
     * );
     * ```
     *
     * 如果没有通过回调，仍然会进行订阅。但是，接收到的消息仅传递给接收到的消息的事件处理程序。
     * @param string $topicFilter
     * @param callable|null $callback
     * @param int $qualityOfService
     * @author LZH
     * @since 2022/04/08
     */
    public function subscribe(string $topicFilter, callable $callback = null, int $qualityOfService = 0);

    /**
     * 解除订阅给定的主题
     * @param string $topicFilter
     * @author LZH
     * @since 2022/04/08
     */
    public function unsubscribe(string $topicFilter);

    /**
     * 中断订阅循环
     * @author LZH
     * @since 2022/04/08
     */
    public function interruptedLoop();

    /**
     * 开启一个协程来处理服务端返回的消息并调用订阅回调函数
     *
     * 如果提供了第二个参数，则一旦所有队列为空，循环将立即退出。这意味着可能没有打开的订阅，没有待处理的消息以及确认，也没有待处理的取消订阅请求。
     *
     * 如果设置了第三个参数，将在指定的秒数后强制退出，但前提是第二个参数设置为 true。这基本上意味着如果我们等待所有待处理的消息被确认后，我们最多只等待 $queueWaitLimit 秒，我们才退出。如果有开放主题订阅，我们不会在给定时间后退出。
     *
     * @param bool $allowSleep
     * @param bool $exitWhenQueuesEmpty
     * @param int|null $queueWaitLimit
     * @author LZH
     * @since 2022/04/08
     */
    public function loop(bool $allowSleep = true, bool $exitWhenQueuesEmpty = false, int $queueWaitLimit = null);


    /**
     * 返回连接的服务器域名
     * @return string
     * @author LZH
     * @since 2022/04/08
     */
    public function getBrokerHost(): string;

    /**
     * 返回连接到服务器端口
     * @return int
     * @author LZH
     * @since 2022/04/08
     */
    public function getBrokerPort(): int;

    /**
     * 返回客户端标志id
     * @return string
     * @author LZH
     * @since 2022/04/08
     */
    public function getClientId(): string;


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
    public function registerLoopEventHandler(\Closure $callback): MqttClient;

    /**
     * 移除注册的事件循环处理器，如果传入null，则移除所有注册的事件循环处理器。
     * @param \Closure|null $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function unregisterLoopEventHandler(\Closure $callback = null): MqttClient;

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
    public function registerPublishEventHandler(\Closure $callback): MqttClient;


    /**
     * 移除发布消息事件处理器，如果传入null，则移除所有注册的事件循环处理器。
     * @param \Closure|null $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function unregisterPublishEventHandler(\Closure $callback = null): MqttClient;

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
    public function registerMessageReceivedEventHandler(\Closure $callback): MqttClient;

    /**
     * 移除接收消息事件处理器，如果传入null，则移除所有注册的事件循环处理器。
     * @param \Closure|null $callback
     * @return MqttClient
     * @author LZH
     * @since 2022/04/08
     */
    public function unregisterMessageReceivedEventHandler(\Closure $callback = null): MqttClient;
}
