<?php
/**
 * 文件描述
 * Created on 2022/4/24 15:43
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

use Simps\MQTT\Client;
use Simps\MQTT\Config\ClientConfig;
use Simps\MQTT\Exception\ProtocolException;
use Simps\MQTT\Protocol\Types;

/**
 * 需要把一些同步调用转换为异步调用
 * Created on 2022/4/24 15:43
 * Create by LZH
 */
class CommonClient extends Client
{

    public function __construct(
        string $host,
        int $port,
        ClientConfig $config,
        int $clientType = self::COROUTINE_CLIENT_TYPE
    )
    {
        parent::__construct($host, $port, $config, $clientType);
    }

    /**
     * 同步调用转换为异步调用
     * @param array $topics
     * @param array $properties
     * @return array|bool
     * @author LZH
     * @since 2022/04/24
     */
    public function subscribe(array $topics, array $properties = [])
    {
        $data = [
            'type' => Types::SUBSCRIBE,
            'message_id' => $this->buildMessageId(),
            'properties' => $properties,
            'topics' => $topics,
        ];

        return $this->send($data,false); // 不需要立即返回 by lzh
    }

    /**
     * 同步调用转换为异步调用
     * @param array $topics
     * @param array $properties
     * @return array|bool
     * @author LZH
     * @since 2022/04/24
     */
    public function unSubscribe(array $topics, array $properties = [])
    {
        $data = [
            'type' => Types::UNSUBSCRIBE,
            'message_id' => $this->buildMessageId(),
            'properties' => $properties,
            'topics' => $topics,
        ];

        return $this->send($data, false); // 不需要立即返回 by lzh
    }

    /**
     * 同步调用转换为异步调用
     * @param string $topic
     * @param string $message
     * @param int $qos
     * @param int $dup
     * @param int $retain
     * @param array $properties
     * @return array|bool
     * @author LZH
     * @since 2022/04/24
     */
    public function publish(
        string $topic,
        string $message,
        int $qos = 0,
        int $dup = 0,
        int $retain = 0,
        array $properties = []
    ) {
        if (empty($topic)) {
            if ($this->getConfig()->isMQTT5()) {
                if (!isset($properties['topic_alias']) || empty($properties['topic_alias'])) {
                    throw new ProtocolException('Topic cannot be empty or need to set topic_alias');
                }
            } else {
                throw new ProtocolException('Topic cannot be empty');
            }
        }

        // A PUBLISH packet MUST NOT contain a Packet Identifier if its QoS value is set to 0
        $message_id = 0;
        if ($qos) {
            $message_id = $this->buildMessageId();
        }

        return $this->send(
            [
                'type' => Types::PUBLISH,
                'qos' => $qos,
                'dup' => $dup,
                'retain' => $retain,
                'topic' => $topic,
                'message_id' => $message_id,
                'properties' => $properties,
                'message' => $message,
            ],
            false
        );
    }

}