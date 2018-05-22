<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/23
 * Time: 7:19
 */

$process = new swoole_process(function (swoole_process $pro) {
    $pro->exec("/home/work/study/soft/php/bin/php", [
        __DIR__ . '/../server/http_server.php'
    ]);
}, false);

$pid = $process->start();
var_dump($pid);
swoole_process::wait();