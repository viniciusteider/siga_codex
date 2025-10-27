<?php

namespace App\Controllers;

class ApiController
{
    public function get($user, $name)
    {
        echo json_encode(['message' => "Hello, $name"]);
    }

    public function post()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        echo json_encode($body);
    }

    public function put($id)
    {
        $body = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['id' => $id, 'data' => $body]);
    }

    public function delete($id)
    {
        echo json_encode(['message' => "Deleted item with id $id"]);
    }
}