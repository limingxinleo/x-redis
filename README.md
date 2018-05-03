# X-Redis

[![Build Status](https://travis-ci.org/limingxinleo/x-redis.svg?branch=master)](https://travis-ci.org/limingxinleo/x-redis)

## 安装
~~~
composer require limingxinleo/x-redis
~~~

## 使用
~~~php
<?php
use Xin\Redis; 
$redis = Redis::getInstance();
$redis->set('key','val');
echo $redis->get('key'); // val
~~~

## 使用LuaCommand
~~~php
<?php
use Xin\Redis\Commands;
use Xin\Redis; 

$command = new Commands\IncrByWithExpireTimeCommand($this->key, 5, 3600);
$redis = Redis::getInstance();
$res = $redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
echo $res; // 5
$time = $redis->ttl($this->key);
echo $time; // 3600

sleep(1);

$res = $redis->evaluate($command->getScript(), $command->getArguments(), $command->getNumKeys());
echo $res; // 10
$time = $redis->ttl($this->key);
echo $time; // 3599
~~~