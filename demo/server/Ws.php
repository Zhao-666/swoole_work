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
        $this->ws->on('task', [$this, 'onTask']);
        $this->ws->on('finish', [$this, 'onFinish']);
        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);

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
        $data = [
            'task' => 1,
            'fd' => $frame->fd
        ];
//        $this->ws->task($data);
        swoole_timer_after(5000, function () use ($ws, $frame) {
            $this->ws->push($frame->fd, 'server-time-after:');
        });
        $this->ws->push($frame->fd, "server-push:" . date('Y-m-d H:i:s'));
    }

    public function onTask($serv, $taskId, $workerId, $data)
    {
        print_r($data);
        sleep(10);
        return 'on task finish';
    }

    public function onFinish($serv, $taskId, $data)
    {
        echo "taskId:$taskId";
        echo "finish-data-success " . $data;
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        var_dump($request->fd);
        if ($request->fd == 1) {
            swoole_timer_tick(2000, function ($timer_id) {
                echo '2s timerId: ' . $timer_id;
            });
        }
    }
}

$obj = new Ws();