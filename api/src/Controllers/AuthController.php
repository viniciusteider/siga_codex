<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Classes\Connection;
use PDO;

class AuthController
{
    private $secretKey = 'your-secret-key'; // Substitua por uma chave secreta segura

    public function login()
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();
        $sql = "SELECT
                    base.nome,
                    endereco.latitude,
                    endereco.longitude,
                    recursos.id,
                    recursos.id_grupo,
                    recursos.prefixo,
                    recursos.placa,
                    recursos.renavam 
                FROM
                    recursos
                    INNER JOIN base ON base.id = recursos.id_base
                    INNER JOIN endereco ON endereco.id = base.id_endereco 
                WHERE recursos.placa = :placa AND recursos.renavam = :renavam AND recursos.excluido IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":placa", $body['placa'], PDO::PARAM_STR);
        $stmt->bindParam(":renavam", $body['renavam'], PDO::PARAM_STR);
        $stmt->execute();

        $recurso = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$recurso) {
            http_response_code(401);
            die(json_encode(['message' => 'Placa ou RENAVAM inválidos']));
        }

        $payload = [
            'iss' => "http://localhost", // Issuer
            'aud' => "http://localhost", // Audience
            'iat' => time(),             // Issued at
            'nbf' => time(),             // Not before
            'exp' => time() + (3600 * 24),      // Expiration time (1 hora)
            'data' => $recurso[0]
        ];

        $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

        echo json_encode([
            'token' => $jwt,
            'user' => array(
                'id' => $recurso[0]['id'],
                'placa' => $recurso[0]['placa'],
                'renavam' => $recurso[0]['renavam'],
                'prefixo' => $recurso[0]['prefixo'],
                'id_grupo' => $recurso[0]['id_grupo'],
                'base_nome' => $recurso[0]['nome'],
                'latitude' => $recurso[0]['latitude'],
                'longitude' => $recurso[0]['longitude']
            )
        ]);
    }

    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return (array) $decoded->data;
        } catch (\Exception $e) {
            return null;
        }
    }
}
