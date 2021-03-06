<?php
/**
 * 文件描述
 * Created on 2022/1/24 15:43
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\Common;

use ReflectionClass;
use ReflectionMethod;

/**
 * 抽象模型类
 * Created on 2022/1/24 15:43
 * Create by LZH
 */
abstract class AbstractModel
{
    /**
     * @var string[] 额外允许的属性
     */
    protected $extraAllowProperty = ["PersonInfo"];
    /**
     * @var array 收集的值
     */
    protected $extraArrayProperty = [];

    /**
     * 内部实现，用户禁止调用
     */
    public function serialize()
    {
        $ret = $this->objSerialize($this);
        return $ret;
    }

    /**
     * 对象系列化，支持嵌套数组和对象
     * @param $obj
     * @return array
     * @author LZH
     * @since 2021/12/23
     */
    private function objSerialize($obj) {

        $memberRet = [];

        // 反射获取对象所有方法
        $reflectionClassObj = new ReflectionClass(get_class($obj));
        $allPublicMethods = $reflectionClassObj->getMethods( ReflectionMethod::IS_PUBLIC);

        $allSetMethods = [];
        $allGetMethods = [];
        foreach ($allPublicMethods as $publicMethod) {
            $methodName = substr($publicMethod->name, 3);
            if (str_starts_with($publicMethod->name, 'set')) {
                $allSetMethods[$methodName] = $publicMethod;
            } elseif (str_starts_with($publicMethod->name, 'get')) {
                $allGetMethods[$methodName] = $publicMethod;
            }
        }

        foreach ($allGetMethods as $propertyName => $setMethod) {
            $value = $setMethod->invoke($obj); // 获取属性值

            if ($propertyName === 'TaskID' && $value === null) { // 如果属性名称是 TaskID 且该值为空，则自动生成一个
                $memberRet[$propertyName] = uniqid('taskid');
            }

            if ($value === null) {
                continue;
            }

            if ($value instanceof \JuLongDeviceMqtt\Common\AbstractModel) { // 如果还是模型对象，则递归序列化
                $memberRet[$propertyName] = $this->objSerialize($value);
            } else if (is_array($value)) { // 如果是数组，则数组系列化
                $memberRet[$propertyName] = $this->arraySerialize($value);
            } else {
                $memberRet[$propertyName] = $value;
            }
        }

//        print_r('-------打印动态属性----------' . PHP_EOL);
//        print_r($obj);

        if (!($obj instanceof AbstractResponse) && $obj->extraArrayProperty) { // 请求类存在非空额外属性值，则需要收集
            foreach ($obj->extraArrayProperty as $propertyName => $propertyValue) {
                $memberRet[$propertyName] = $propertyValue;
            }
        }

        return $memberRet;
    }

    /**
     * 数组序列化，支持嵌套数组和对象
     * @param $memberList
     * @return array
     * @author LZH
     * @since 2021/12/23
     */
    private function arraySerialize($memberList) {
        $memberRet = [];
        foreach ($memberList as $name => $value)
        {
            if ($value === null) { // 忽略值为null的属性
                continue;
            }
            if ($value instanceof AbstractModel) { // 如果还是模型对象，则递归序列化
                $memberRet[$name] = $this->objSerialize($value);
            } elseif (is_array($value)) { // 如果是数组，则数组系列化
                $memberRet[$name] = $this->arraySerialize($value);
            }else {
                $memberRet[$name] = $value;
            }
        }
        return $memberRet;
    }

    /**
     * 数组合并，支持嵌套数组
     * @param $array
     * @param $prepend string 合并键前缀
     * @return array
     * @author LZH
     * @since 2021/12/23
     */
    private function arrayMerge($array, $prepend = null)
    {
        $results = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $results = array_merge($results, static::arrayMerge($value, $prepend.$key.'.'));
            }
            else {
                if (is_bool($value)) {
                    $results[$prepend.$key] = json_encode($value); // 布尔值转换为字符串表示
                } else {
                    $results[$prepend.$key] = $value;
                }

            }
        }
        return $results;
    }

    /**
     * 根据响应生成模型对象
     * @param $param
     * @author LZH
     * @since 2021/12/23
     */
    public function deserialize($param) {

    }

    /**
     * @param string $jsonString json格式的字符串
     */
    public function fromJsonString($jsonString)
    {
        $arr = json_decode($jsonString, true); // json转换为数组
        $this->deserialize($arr); // 数组反序列为模型
    }

    /**
     * 模型系列化后转换为json字符串
     * @return false|string
     * @author LZH
     * @since 2021/12/23
     */
    public function toJsonString()
    {
        $r = $this->serialize();
        // it is an object rather than an array
        if (empty($r)) {
            return "{}";
        }
        return json_encode($r, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 属性set/get方法
     * @param $member string 带get/set属性名称
     * @param $param mixed 属性值
     * @author LZH
     * @since 2021/12/23
     */
    public function __call($member, $param)
    {
//        $act = substr($member,0,3);
//        $attr = substr($member,3);
//        if ($act === "get") {
//            return $this->$attr;
//        } else if ($act === "set") {
//            $this->$attr = $param[0];
//        }

        if (in_array(substr($member,3), $this->extraAllowProperty)) {
            $this->collectionProperty($param[0], $this->extraArrayProperty);
        }

    }

    public function __toString() {
        return $this->toJsonString();
    }

    /**
     * 复制一个对象的所有属性到另一个对象
     * @param $fromObj
     * @param $toObj
     * @param $level int 复制层级，0表示不限制，其它正整数表示控制层级
     * @author LZH
     * @since 2022/02/09
     */
    function copyProperties($fromObj, &$toObj, $level = 0)
    {
        static $count = 1;
        if ( $level != 0 && $count++ > $level ) { // 超过次数，则结束迭代
            // 剩下的属性都复制到目标对象
            foreach ($fromObj as $key1 => $value1) {
                if (!empty($value1)) {
                    $toObj->$key1 = $value1;
                }
            }
        } else {
            foreach ($fromObj as $key => $value) {

                if (is_object($value)) {
                    $toObj->$key = new class extends AbstractModel{}; // 匿名类
                    static::copyProperties($value, $toObj->$key);
                } else {
                    $toObj->$key = $value;
                }

            }
        }

    }

    /**
     * @param $objectOrClass
     * @param array $_extraProperty
     * @param null $key 有值，则表示数组，否则是对象
     * @throws \ReflectionException
     * @author LZH
     * @since 2022/04/24
     */
    private function collectionProperty($objectOrClass, array &$_extraProperty): void
    {

        $reflectionClassObj = new ReflectionClass($objectOrClass); // 第一个参数对象
        $allPublicMethods = $reflectionClassObj->getMethods(ReflectionMethod::IS_PUBLIC);

        $allGetMethods = [];
        foreach ($allPublicMethods as $publicMethod) {
            $methodName = substr($publicMethod->name, 3);
            if (str_starts_with($publicMethod->name, 'get')) {
                $allGetMethods[$methodName] = $publicMethod;
            }
        }

        foreach ($allGetMethods as $propertyName => $setMethod) {
            $value = $setMethod->invoke($objectOrClass);
            if ($value) { // 收集非空值
                $_extraProperty[$propertyName] = $value; // 收集所有属性和值
            }
        }
    }
}