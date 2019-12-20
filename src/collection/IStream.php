<?php
namespace swiftphp\common\collection;

/**
 * IStream接口
 * @author Tomix
 *
 */
interface IStream extends \Countable
{    
    /**
     * 过滤元素
     * @return IStream
     */
    function filter(\Closure $filter);
    
    /**
     * 映射元素
     * @return IStream
     */
    function map(\Closure $mapper);
    
    /**
     * 转换为数组
     */
    function toArray();
    
    /**
     * 转换为键值对数组
     */
    function toMap(\Closure $keyMapper,\Closure $valueMapper=null);
    
    /**
     * 分组并转换为键值对二维数组
     */
    function groupBy(\Closure $keyMapper,\Closure $valueMapper=null);    
}

