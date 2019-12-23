<?php
namespace swiftphp\common\collection;

use swiftphp\common\collection\IStream;

/**
 * 是否可转换为流接口
 * @author Tomix
 *
 */
interface IStreamable
{
    /**
     * 转换为流对象
     * @return IStream
     */
    function stream();
}

