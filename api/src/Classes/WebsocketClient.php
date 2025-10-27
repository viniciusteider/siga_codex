<?php
namespace App\Classes;

use Ratchet\Client\WebSocket;
use React\EventLoop\Factory;
use Ratchet\Client\Connector;


class WebsocketClient
{
    private $conn;
    private $loop;
    private $uri;
    private $groupId;

    public function __construct($groupId, $uri = 'ws://localhost:8080')
    {
        $this->uri = $uri;
        $this->groupId = $groupId;
        $this->loop = Factory::create();
    }

    public function connect()
    {
        $connector = new Connector($this->loop);        
        $promise = $connector($this->uri . "?groupId=" . $this->groupId);
        
        $promise->then(
            function (WebSocket $conn) {
                $this->conn = $conn;

                $conn->on('message', function ($msg) {});

                $conn->on('close', function ($code = null, $reason = null) {});
            },
            function (\Exception $e) {
            }
        );

        $this->loop->addTimer(1, function () use ($promise) {
            if (!$this->conn) {
                $promise->cancel();
            }
            $this->loop->stop();
        });

        $this->loop->run();
    }

    public function send($message)
    {
        if ($this->conn) {
            $this->conn->send($message);
            $this->loop->addTimer(0.2, function () {
                $this->loop->stop();
            });
    
            $this->loop->run();
        } else {
            echo "Not connected\n";
        }
    }

    public function run()
    {
        $this->loop->run();
    }

    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
