<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/13
 * Time: 22:14
 */

$server = new swoole_websocket_server('0.0.0.0', 8812);

$server->on('open', 'onOpen');

function onOpen($server, $request)
{
    print_r($request->fd);
}

$server->set(
    [
        'enable_static_handler' => true,
        'document_root' => '/home/work/htdocs/swoole_work/data',
    ]
);

$server->on('message', function (swoole_websocket_server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "hello-world!!!");
});

$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();