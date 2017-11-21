<?php
// +----------------------------------------------------------------------
// | Redis.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin;

use Redis as RedisClient;

class Redis
{
    protected static $_instance = [];
    protected $redis;

    /**
     * Redis constructor.
     * @param $host
     * @param $port
     * @param $auth
     */
    private function __construct($host, $port, $auth, $db)
    {
    }

    /**
     * 防止克隆
     */
    private function __clone()
    {
    }

    /**
     * @desc   获取redis单例
     * @author limx
     * @param string $host   地址
     * @param string $auth   密码
     * @param int    $db     数据库ID
     * @param int    $port   端口号
     * @param string $uniqid 当相同配置，但是想新开实例时，可以赋值
     * @return RedisClient
     */
    public static function getInstance($host = '127.0.0.1', $auth = null, $db = 0, $port = 6379, $uniqid = null)
    {
        $key = md5(json_encode([$host, $auth, $db, $port, $uniqid]));

        if (isset(static::$_instance[$key]) && static::$_instance[$key] instanceof RedisClient) {
            return static::$_instance[$key];
        }

        return static::$_instance[$key] = static::getClient($host, $port, $auth, $db);
    }

    /**
     * @desc   获取Redis实例
     * @author limx
     * @param $host ip地址
     * @param $port 端口
     * @param $auth 密码
     * @param $db   默认DB库
     * @return RedisClient
     */
    protected static function getClient($host, $port, $auth, $db)
    {
        $redis = new RedisClient();
        $redis->connect($host, $port);
        if (!empty($auth)) {
            $redis->auth($auth);
        }
        if ($db > 0) {
            $redis->select($db);
        }
        return $redis;
    }

    /**
     * @desc   返回实例数
     * @author limx
     * @return int
     */
    public static function count()
    {
        return count(static::$_instance);
    }
}