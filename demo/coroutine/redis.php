<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/25
 * Time: 7:44
 */

$server = new swoole_http_server('0.0.0.0', 8013);
$server->on('request', function ($request, $response) {
    $redis = new \Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1', 6379);
    $key = $redis->get('key');
    $response->end($key);
});

$server->start();