<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/22
 * Time: 8:13
 */

$redisClient = new swoole_redis();
$redisClient->connect('127.0.0.1', 6379,
    function (swoole_redis $redisClient, $result) {
        echo "connect" . PHP_EOL;
        var_dump($result);
        $redisClient->set('demo1', time(), function ($redisClient, $result) {
            var_dump($result);
        });
        $redisClient->get('demo1', function ($redisClient, $result) {
            var_dump($result);
            $redisClient->close();
        });
        $redisClient->keys('*', function ($redisClient, $result) {
            
        });
    });