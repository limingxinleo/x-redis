<?php
// +----------------------------------------------------------------------
// | IncrExpireCommand.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Redis\Commands;

use Xin\Redis\RedisCommand;

/**
 * IncrBy的同时增加超时时间设定
 * Class IncrWithExpireTimeCommand
 * @package Xin\Redis\Commands
 */
class IncrByWithExpireTimeCommand extends RedisCommand
{
    /**
     * IncrExpireCommand constructor.
     * @param $key        Redis KEY
     * @param $expireTime 超时时间
     * @throws \Xin\Redis\RedisException
     */
    public function __construct($key, $num, $expireTime)
    {
        $this->arguments = [$key, $num, $expireTime];
        parent::__construct();
    }

    public function getScript()
    {
        $script = <<<LUA
    local result = false;
    result = redis.pcall('incrby',KEYS[1],KEYS[2]);
    if(result)
    then
        redis.pcall('expire',KEYS[1],KEYS[3])
    end
    return result;
LUA;
        return $script;
    }
}
