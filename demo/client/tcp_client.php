<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/10
 * Time: 22:21
 */

$client = new swoole_client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501)) {
    echo 'connect fail';
    exit();
}

fwrite(STDOUT, 'please input sth：');
$msg = trim(fgets(STDIN));

$client->send($msg);
$result = $client->recv();
echo $result;
