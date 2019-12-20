<?php
namespace swiftphp\common\collection;

/**
 * 集合类
 * @author Tomix
 *
 */
class ArrayCollection implements ICollection
{
    /**
     * 元素实体集
     * @var array
     */
    private $entries=[];
    
    /**
     * 构造函数
     * @param array $entries
     */
    public function __construct(array $entries = [])
    {
        $this->entries = array_values($entries);
    }
    
    /**
     * 从数组创建对象
     * @param array $entries
     * @return ArrayCollection
     */
    public static function parse(array $entries=[]){
        return new ArrayCollection($entries);
    }
    
    /**
     * 过滤元素
     * @return ArrayCollection
     */
    public function filter(\Closure $filter){
        $els=array_filter($this->entries,$filter);
        return new ArrayCollection($els);
    }
    
    /**
     * 映射元素
     * {@inheritDoc}
     * @see \swiftphp\common\collection\IStream::map()
     * @return ArrayCollection
     */
    public function map(\Closure $mapper){
        $els=array_map($mapper,$this->entries);
        return new ArrayCollection($els);
    }       
    
    /**
     * 集合是否为空
     */
    public function isEmpty(){
        return empty($this->entries);
    }
    
    /**
     * 元素计数
     */
    public function size(){
        return count($this->entries);
    }
    
    /**
     * 当前元素计数
     * {@inheritDoc}
     * @see Countable::count()
     */
    public function count(){
        return count($this->entries);
    }
    
    /**
     * 转换为数组
     * {@inheritDoc}
     * @see \swiftphp\common\collection\IStream::toArray()
     */
    public function toArray(){
        return $this->entries;
    }
    
    /**
     * 转换为键值对数组
     * {@inheritDoc}
     * @see \swiftphp\common\collection\IStream::toMap()
     */
    public function toMap(\Closure $keyMapper,\Closure $valueMapper=null){
        $kvs=[];
        foreach ($this->entries as $el){
            $key=$keyMapper($el);
            $value=!empty($valueMapper)?$valueMapper($el):$el;
            $kvs[$key]=$value;
        }
        return $kvs;
    }
    
    /**
     * 分组并转换为键值对二维数组
     */
    public function groupBy(\Closure $keyMapper,\Closure $valueMapper=null){
        $kvs=[];
        foreach ($this->entries as $el){
            $key=$keyMapper($el);
            $value=!empty($valueMapper)?$valueMapper($el):$el;
            if(!array_key_exists($key, $kvs)){
                $kvs[$key]=[];
            }
            $kvs[$key][]=$value;
        }
        return $kvs;
    }
    /**
     * 添加元素
     * {@inheritDoc}
     * @see \swiftphp\common\collection\ICollection::add()
     */
    public function add($entry){
        $this->entries[]=$entry;
        return $this;
    }
    
    /**
     * 移除元素
     * {@inheritDoc}
     * @see \swiftphp\common\collection\ICollection::remove()
     */
    public function remove($entry){
        $key = array_search($entry, $this->entries, true);
        if ($key === false) {
            return false;
        }
        unset($this->entries[$key]);
        return $this;
    }
    
    /**
     * 返回第一个元素
     */
    public function first(){
        return reset($this->entries);
    }
    
    /**
     * 返回最后一个元素
     */
    public function last(){
        return end($this->entries);
    }
    
    /**
     * 是否包含某个元素
     * @param mixed $entry
     */
    public function contains($entry){
        return in_array($entry, $this->entries, true);
    }
    
    /**
     * 清空所有元素
     * {@inheritDoc}
     * @see \swiftphp\common\collection\ICollection::clear()
     */
    public function clear(){
        $this->entries=[];
        return $this;
    }
}

