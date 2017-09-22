<?php
// +----------------------------------------------------------------------
// | TestCase.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests;

use PHPUnit\Framework\TestCase as UnitTestCase;
use Xin\Redis;

class TestCase extends UnitTestCase
{
    protected $key = 'test:test';
    protected $redis;

    public function setUp()
    {
        $this->redis = Redis::getInstance('127.0.0.1', '910123');
        $this->redis->del($this->key);
    }
}