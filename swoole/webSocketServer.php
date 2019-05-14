<?php
/**
 * swoole实现简易聊天室 --- websocket/server服务端
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/5/13
 * Time: 11:23 AM
 */

class webSocketServer
{
    private $_server = null;
    private $_ip = '0.0.0.0';
    private $_port = 9501;
    private $_fds = [];

    function __construct()
    {
        if ($this->_server == null) {
            $this->_server = new Swoole\WebSocket\Server($this->_ip, $this->_port);
        }

        $this->_server->on('open', function (Swoole\WebSocket\Server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
            $this->_fds[] = $request->fd;
        });

        $this->_server->on('message', [$this, 'onMessage']);
        $this->_server->on('close', [$this, 'onClose']);

        $this->_server->start();
    }

    function onMessage($server, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        foreach ($this->_fds as $_fd) {
            if ($this->_server->isEstablished($_fd)) {
                //将消息发送给所有用户
                $server->push($_fd, json_encode(['fd' => $frame->fd, 'msg' => $frame->data]));
            }
        }
    }

    function onClose($ser, $fd)
    {
        echo "client {$fd} closed\n";
    }
}

new webSocketServer();