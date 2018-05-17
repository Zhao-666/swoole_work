<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/10
 * Time: 22:55
 */

$server = new swoole_http_server('0.0.0.0', 8811);

$server->set(
    [
        'enable_static_handler' => true,
        'document_root' => '/home/work/htdocs/swoole_work/data',
    ]
);

$server->on('request', function ($request, $response) {
    $content = [
        'date:' => date('Ymd H:i:s'),
        'get:' => $request->get,
        'post:' => $request->post,
        'header:' => $request->header
    ];
    swoole_async_writefile(__DIR__ . "/access.log", json_encode($content) . PHP_EOL, function ($filename) {

    }, FILE_APPEND);
    var_dump($request->get);
    $response->end('<h1>HelloWorld!!!</h1>');
});

$server->start();