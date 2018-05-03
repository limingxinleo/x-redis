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
    /** @var \Redis */
    protected $redis;

    protected $host;
    protected $auth;

    public function setUp()
    {
        $config = include TESTS_PATH . '/_ci/config.php';
        $this->host = $config['host'];
        $this->auth = $config['auth'];

        $this->redis = Redis::getInstance($this->host, $this->auth);
        $this->redis->del($this->key);
    }
}