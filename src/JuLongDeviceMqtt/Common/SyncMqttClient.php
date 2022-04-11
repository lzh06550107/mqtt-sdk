<?php
/**
 * 文件描述
 * Created on 2022/4/11 11:55
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

use JuLongDeviceMqtt\Contracts\Repository;
use Psr\Log\LoggerInterface;
use Simps\MQTT\Client;
use Swoole\Coroutine\Channel;

/**
 * mqtt同步客户端
 * Created on 2022/4/11 11:56
 * Create by LZH
 */
class SyncMqttClient extends AbstractMqttClient
{

    private $logger;

    public function __construct(
        Client $client = null,
        Repository $repository = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct($client, $repository, $logger);
        $this->logger = $logger ?: new DefaultLogger();
    }

    /**
     * 同步请求
     * @param array $publishTopicInfo
     * @param array $subscribeTopicInfo
     * @param int $timeout
     * @return string
     * @author LZH
     * @since 2022/04/11
     */
    public function request(array $publishTopicInfo, array $subscribeTopicInfo, int $timeout = 5): string
    {
        $this->connect();

        $syncChannel = new Channel(1); // 协程同步
        try {
            $this->publish($publishTopicInfo['topic'], $publishTopicInfo['message'], $publishTopicInfo['qos'], $publishTopicInfo['dup'], $publishTopicInfo['retain'], $publishTopicInfo['properties']);

            $this->subscribe($subscribeTopicInfo['topic'], function (string $topic, string $message, bool $retained) use ($syncChannel) {
                $this->logger->info('We received a {typeOfMessage} on topic [{topic}]: {message}', [
                    'topic' => $topic,
                    'message' => $message,
                    'typeOfMessage' => $retained ? 'retained message' : 'message',
                ]);

                $syncChannel->push($message);

                // 当我们接收到订阅主题的响应时，客户端停止监听
                $this->interruptedLoop();
                $this->disconnect();

            }, $subscribeTopicInfo['qos']);

            $this->loop();

            return (string)$syncChannel->pop($timeout);

        } catch (\Throwable $e) {
            throw $e;
        } finally {
            $this->disconnect();
        }

    }

}