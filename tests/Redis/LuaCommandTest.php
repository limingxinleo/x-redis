<?php
// +----------------------------------------------------------------------
// | LuaCommandTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Redis;

use Tests\TestCase;
use Xin\Redis\Commands;

class LuaCommandTest extends TestCase
{
    public function testIncrWithExpireTimeCase()
    {
        $command = new Commands\IncrWithExpireTimeCommand($this->key, 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertEquals(1, $res);
        $time = $this->redis->ttl($this->key);
        $this->assertEquals(3600, $time);

        $this->redis->set('test:string', 'aa');
        $command = new Commands\IncrWithExpireTimeCommand('test:string', 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertFalse($res);
    }

    public function testIncrWithExpireTimeFirstCommandCase()
    {
        $command = new Commands\IncrWithExpireTimeFirstCommand($this->key, 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertEquals(1, $res);
        $time = $this->redis->ttl($this->key);
        $this->assertEquals(3600, $time);

        sleep(2);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertEquals(2, $res);
        $time = $this->redis->ttl($this->key);
        $this->assertTrue($time < 3600);

        $this->redis->set('test:string', 'aa');
        $command = new Commands\IncrWithExpireTimeFirstCommand('test:string', 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertFalse($res);
    }

    public function testIncrByWithExpireTimeCase()
    {
        $command = new Commands\IncrByWithExpireTimeCommand($this->key, 5, 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertEquals(5, $res);
        $time = $this->redis->ttl($this->key);
        $this->assertEquals(3600, $time);

        $this->redis->set('test:string', 'aa');
        $command = new Commands\IncrByWithExpireTimeCommand('test:string', 2, 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertFalse($res);
    }

    public function testIncrByWithExpireTimeFirstCommandCase()
    {
        $command = new Commands\IncrByWithExpireTimeFirstCommand($this->key, 5, 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertEquals(5, $res);
        $time = $this->redis->ttl($this->key);
        $this->assertEquals(3600, $time);

        sleep(2);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertEquals(10, $res);
        $time = $this->redis->ttl($this->key);
        $this->assertTrue($time < 3600);

        $this->redis->set('test:string', 'aa');
        $command = new Commands\IncrByWithExpireTimeFirstCommand('test:string', 3, 3600);
        $res = $this->redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
        $this->assertFalse($res);
    }
}
