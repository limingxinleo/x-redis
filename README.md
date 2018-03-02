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