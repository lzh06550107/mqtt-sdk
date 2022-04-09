<?php
/**
 * 文件描述
 * Created on 2022/1/21 10:49
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * 默认日志实现
 */
class DefaultLogger implements LoggerInterface
{
    /**
     * 整个系统不可用，可输出此日志
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * 警报日志
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * 应用组件不可用，或者异常，可使用该日志
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * 不需要立即提醒的运行时错误日志
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * 非错误的提醒信息
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * 正常但重要的日志
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * 用户感兴趣的日志
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * 详细的调试信息
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * 记录任意等级的日志
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function log($level, $message, array $context = []): void
    {
        $date = date('Y-m-d H:i:s');
        $msg = $this->interpolate($message, $context);

        echo "[{$date}][{$level}]:[{$msg}]\n";
    }

    private function interpolate($message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        return strtr($message, $replace);
    }
}
