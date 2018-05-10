<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/10
 * Time: 22:36
 */

$server = new swoole_server('127.0.0.1', '9502', SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$server->set([
    'worker_num' => 4,
    'max_request' => 10000
]);

//监听数据接收事件
$server->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
});

//启动服务器
$server->start();
