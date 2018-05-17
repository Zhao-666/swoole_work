<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/17
 * Time: 18:58
 */

//读取文件
swoole_async_readfile(__DIR__ . "/1.txt",
    function ($filename, $fileContent) {
        echo $filename."\t".$fileContent.PHP_EOL;
    });

echo "hello".PHP_EOL;