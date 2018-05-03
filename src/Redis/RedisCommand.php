<?php
// +----------------------------------------------------------------------
// | RedisCommandInterface.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Redis;

abstract class RedisCommand implements RedisCommandInterface
{
    protected $arguments;

    public function __construct()
    {
        if (!isset($this->arguments)) {
            throw new RedisException('The redis command must rewrite arguments');
        }
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function getNumKeys()
    {
        return count($this->arguments);
    }
}
