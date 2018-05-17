<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/17
 * Time: 19:10
 */

$content = "write something";
swoole_async_writefile(__DIR__ . "/1.log", $content,
    function ($filename) {
        echo $filename . 'SUCCESS' . PHP_EOL;
    }, FILE_APPEND);

echo "start" . PHP_EOL;