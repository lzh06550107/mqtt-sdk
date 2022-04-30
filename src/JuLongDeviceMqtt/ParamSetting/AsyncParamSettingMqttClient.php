<?php
/**
 * 文件描述
 * Created on 2022/2/11 18:17
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\ParamSetting;

use JuLongDeviceMqtt\AckTopic;
use JuLongDeviceMqtt\Common\AbstractMqttClient;
use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\Common\AbstractResponse;
use JuLongDeviceMqtt\Common\AsyncMqttClient;
use JuLongDeviceMqtt\Contracts\MqttClient;

/**
 * 设备配置客户端
 * Created on 2022/2/11 18:18
 * Create by LZH
 *
 * @method void loop(bool $allowSleep = true, bool $exitWhenQueuesEmpty = false, int $queueWaitLimit = null)
 * @method void interruptedLoop()
 * @method void disconnect()
 * @method MqttClient registerLoopEventHandler(\Closure $callback)
 */
class AsyncParamSettingMqttClient
{

    /**
     * @var AsyncMqttClient mqtt客户端操作对象
     */
    private $asyncMqttClient;

    /**
     * @var string
     */
    protected $service;

    /**
     * @param AsyncMqttClient $asyncMqttClient
     * @param string $service
     */
    public function __construct(AsyncMqttClient $asyncMqttClient, string $service = "ParamSetting")
    {
        $this->asyncMqttClient = $asyncMqttClient;
        $this->service = $service;
    }

    /**
     * 向指定的主题发布消息
     * @param string $uuidOrTopic uuid或topic
     * @param AbstractRequest $message 消息内容
     * @param int $qualityOfService
     * @param bool $dup
     * @param bool $retain
     * @param array $properties
     * @return void
     * @throws \JuLongDeviceMqtt\Exception\ClientNotConnectedToBrokerException
     * @throws \JuLongDeviceMqtt\Exception\PendingMessageAlreadyExistsException
     * @throws \JuLongDeviceMqtt\Exception\RepositoryException
     * @author LZH
     * @since 2022/01/21
     */
    public function publish(string $uuidOrTopic, AbstractRequest $message , int $qualityOfService = MQTT_QOS_0, bool $dup = false, bool $retain = false, array $properties = []): void
    {
        $this->asyncMqttClient->connect();
        $topic = new DeviceConfigureTopic($uuidOrTopic);
        $this->asyncMqttClient->publish((string)$topic, (string)$message, $qualityOfService, $dup, $retain, $properties);
        $this->asyncMqttClient->disconnect();
    }

    /**
     * 订阅指定的主题
     *      指定设备：mqtt/Ack/设备UUID
     *      批量设备：mqtt/Ack/topic
     * @param string $uuidOrTopic uuid或topic
     * @param callable $callback 处理接收到的消息
     * @throws \Throwable
     * @author LZH
     * @since 2022/01/21
     */
    public function subscribe(string $uuidOrTopic, callable $callback, int $qualityOfService = MQTT_QOS_0): void
    {
        $this->asyncMqttClient->connect();
        $topic = new AckTopic($uuidOrTopic);
        $this->asyncMqttClient->subscribe((string)$topic, $callback, $qualityOfService);
//        $this->asyncMqttClient->disconnect(); 不能关闭，需要开启循环
    }

    public function __call($name, $arguments) {

        if (method_exists($this->asyncMqttClient, $name)) {
            call_user_func_array([$this->asyncMqttClient, $name],$arguments);
        } else {
            throw new \Exception('方法不存在');
        }

    }

}