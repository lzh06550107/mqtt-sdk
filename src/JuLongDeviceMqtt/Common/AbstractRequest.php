<?php
/**
 * 文件描述
 * Created on 2022/1/24 14:40
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use ReflectionClass;
use ReflectionMethod;

/**
 * 抽象请求类
 * Created on 2022/1/24 15:32
 * Create by LZH
 */
abstract class AbstractRequest extends AbstractModel
{

    /**
     * @var array 动态属性，用于保存需要额外添加的属性字段
     */
    protected $_dynamicPropertyArray;

    /**
     * @var string[]|null 该数组中的类是需要复制它的属性到当前请求对象的
     */
    protected $extraProperty;

    /**
     * @var string 请求动作
     */
    private $action;

    /**
     * @var string|null 消息id
     */
    private $taskID;

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string|null
     */
    public function getTaskID(): ?string
    {
        return $this->taskID;
    }

    /**
     * @param string|null $taskID
     */
    public function setTaskID(?string $taskID): void
    {
        $this->taskID = $taskID;
    }


    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["Action"])) {
            $this->Action = $param["Action"];
        }

        if (isset($param['TaskID'])) {
            $this->TaskID = $param['TaskID'];
        }

    }

    // 调用未定义方法时调用
    function __call($member, $param)
    {

        if (is_int($member) || in_array(substr($member,3), $this->extraProperty)) {

            // 遍历所有的get方法，把值存入 $this->_dynamicPropertyArray 中
            // 反射获取对象所有方法
            if (is_array($param[0])) {
                foreach ($param[0] as $arrayKey => $arrayItem) {
                    self::__call($arrayKey, [$arrayItem]); // 数组传入的是key
                }
            } else {
                $reflectionClassObj = new ReflectionClass($param[0]); // 第一个参数对象
                $allPublicMethods = $reflectionClassObj->getMethods( ReflectionMethod::IS_PUBLIC);

                $allGetMethods = [];
                foreach ($allPublicMethods as $publicMethod) {
                    $methodName = substr($publicMethod->name, 3);
                    if (str_starts_with($publicMethod->name, 'get')) {
                        $allGetMethods[$methodName] = $publicMethod;
                    }
                }

                foreach ($allGetMethods as $propertyName => $setMethod) {
                    $value = $setMethod->invoke($param[0]);
                    if ($value) { // 收集非空值
                        $this->_dynamicPropertyArray[$propertyName] = $value; // 收集所有属性和值
                    }
                }
            }
        }
    }

}