<?php
/**
 * Created by PhpStorm.
 * User: Next
 * Date: 2018/5/14
 * Time: 22:30
 */

class Ws
{
    const HOST = '0.0.0.0';
    const PORT = 8812;

    public $ws = null;

    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST, self::PORT);
        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
        $this->ws->on('close', [$this, 'onClose']);

        $this->ws->start();
    }

    public function onClose($ws, $fd)
    {
        echo "clientid:$fd\n";
    }

    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame)
    {
        echo "client-push-message: $frame->data \n";
        $this->ws->send($frame->fd, "server-push:" . date('Y-m-d H:i:s'));
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        var_dump($request->fd);
    }
}

$obj = new Ws();