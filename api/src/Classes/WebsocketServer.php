<?php
namespace App\Classes;

require __DIR__ . '/../../vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use App\Controllers\AuthController;

class WebSocket implements MessageComponentInterface {
    protected $clients;
    protected $api;
    protected $clientsOnGroup;
    protected $authController;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->clientsOnGroup = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        
        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryParams);
        $groupId = isset($queryParams['groupId']) ? $queryParams['groupId'] : null;
        
        if ($groupId) {
            $conn->groupId = $groupId;
            
            if (!isset($this->clientsOnGroup[$groupId])) {
                $this->clientsOnGroup[$groupId] = new \SplObjectStorage;
            }
            $this->clientsOnGroup[$groupId]->attach($conn);
            
            echo "Nova conexão! ({$conn->resourceId}) registrada no grupo {$groupId}\n";
        } else {
            echo "Nova conexão! ({$conn->resourceId}) sem grupo especificado\n";
        }
        
        $conn->send(json_encode(array("type" => "connected")));
    }


    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Mensagem recebida: {$msg}\n";
        $data = json_decode($msg, true);
        
        $groupId = null;
        foreach ($this->clientsOnGroup as $id => $clients) {
            if ($clients->contains($from)) {
                $groupId = $id;
                break;
            }
        }

        if ($groupId !== null) {
            foreach ($this->clientsOnGroup[$groupId] as $client) {
                if ($from !== $client) {
                    $client->send($msg);
                }
            }
        } else {
            $from->send(json_encode([
                'type' => 'error',
                'message' => 'Cliente não está registrado em nenhum grupo'
            ]));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Conexão {$conn->resourceId} foi desconectada\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Ocorreu um erro: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocket()
        )
    ),
    8181
);

$server->run();

