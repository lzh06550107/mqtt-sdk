<?php
/**
 * 文件描述
 * Created on 2022/1/24 15:43
 * Create by LZH
 */

namespace JuLongDeviceMqtt\Common;

/**
 * 抽象模型类
 * Created on 2022/1/24 15:43
 * Create by LZH
 */
abstract class AbstractModel
{
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

        foreach ($obj as $property => $value)
        {
            $propertyName = ucfirst($property); // 属性的首字母大写
            if ($value === null) { // 忽略值为null的属性
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
        $act = substr($member,0,3);
        $attr = substr($member,3);
        if ($act === "get") {
            return $this->$attr;
        } else if ($act === "set") {
            $this->$attr = $param[0];
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
}