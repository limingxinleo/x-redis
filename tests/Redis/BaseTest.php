<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Redis;

use Tests\TestCase;
use Xin\Redis;

class BaseTest extends TestCase
{
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testString()
    {
        $this->redis->set($this->key, 1);
        $this->assertEquals(1, $this->redis->get($this->key));
    }

    public function testHash()
    {
        $this->redis->hset($this->key, 'test', 1);
        $this->assertEquals(1, $this->redis->hget($this->key, 'test'));
    }

    public function testSet()
    {
        $this->redis->sadd($this->key, 1);
        $this->assertTrue($this->redis->sIsMember($this->key, 1));
    }

    public function testCount()
    {
        // $this->redis new 1
        $redis = Redis::getInstance($this->host, $this->auth, 0, 6379); // old 1
        $redis = Redis::getInstance($this->host, $this->auth, 0, 6379, 1); // new 2
        $redis = Redis::getInstance($this->host, $this->auth, 1, 6379, 1); // new 3
        $redis = Redis::getInstance($this->host, $this->auth, 1, 6379, 1); // old 3

        $this->assertEquals(3, Redis::count());
    }
}
