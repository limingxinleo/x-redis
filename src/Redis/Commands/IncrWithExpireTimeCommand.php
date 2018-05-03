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
 * Incr的同时增加超时时间设定
 * Class IncrWithExpireTimeCommand
 * @package Xin\Redis\Commands
 */
class IncrWithExpireTimeCommand extends RedisCommand
{
    /**
     * IncrExpireCommand constructor.
     * @param $key        Redis KEY
     * @param $expireTime 超时时间
     * @throws \Xin\Redis\RedisException
     */
    public function __construct($key, $expireTime)
    {
        $this->arguments = [$key, $expireTime];
        parent::__construct();
    }

    public function getScript()
    {
        $script = <<<LUA
    local result = false;
    result = redis.pcall('incr',KEYS[1]);
    if(result)
    then
        redis.pcall('expire',KEYS[1],KEYS[2])
    end
    return result;
LUA;
        return $script;
    }
}
