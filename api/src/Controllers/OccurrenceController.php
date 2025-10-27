<?php

namespace App\Controllers;

use App\Classes\Connection;
use App\Classes\WebsocketClient;
use PDO;

class OccurrenceController
{
    public function getActualOccurrence($user, $responseObject = false)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();
        $sql = "SELECT
            ocorrencias.id,
            ocorrencias.data_hora,
            ocorrencias.nome,
            ocorrencias.telefone,
            ocorrencias.numero_ocorrencia,
            ocorrencias.logradouro,
            ocorrencias.numero,
            ocorrencias.bairro,
            ocorrencias.cidade as cidade,
            ocorrencias.latitude,
            ocorrencias.longitude,
            ocorrencias.descritivo,
            ocorrencias_recursos.`data`,
            ocorrencias_recursos.horario_saida_base,
            ocorrencias_recursos.horario_chegada_local,
            ocorrencias_recursos.horario_saida_local,
            ocorrencias_recursos.horario_chegada_hospital,
            ocorrencias_recursos.horario_saida_hospital,
            ocorrencias_recursos.horario_chegada_base,
            ocorrencias_recursos.ultimo_qta,
            ocorrencias_recursos.ultimo_qth,
            ocorrencias_recursos.id as idqth,
            classificacao_risco.nome as classificacao_risco,
            usuario.nome as regulador
        FROM
            ocorrencias
            INNER JOIN ocorrencias_recursos ON ocorrencias.id = ocorrencias_recursos.id_ocorrencia
            LEFT JOIN classificacao_risco on classificacao_risco.id = ocorrencias.id_ocorrencia_classificacao
            LEFT JOIN usuario on usuario.id = ocorrencias.id_regulador
        WHERE
            ocorrencias.id_grupo = :idGrupo
            AND ocorrencias_recursos.id_recurso = :idRecurso 
            AND ocorrencias_recursos.horario_chegada_base IS NULL 
            AND ocorrencias_recursos.ultimo_qta IS NULL";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idGrupo", $user["id_grupo"], PDO::PARAM_STR);
        $stmt->bindParam(":idRecurso", $user["id"], PDO::PARAM_STR);
        $stmt->execute();

        $occurrence = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!count($occurrence)) {
            if ($responseObject) {
                return null;
            }
            die(json_encode(null));
        }

        $occurrence[0]["qths"] = [];
        switch ($occurrence[0]["ultimo_qth"]) {
            case '1':
                $occurrence[0]["qths"] = ['2'];
                break;
            case '2':
                $occurrence[0]["qths"] = ['3', '4'];
                break;
            case '3':
                $occurrence[0]["qths"] = ['5'];
                break;
            case '4':
                $occurrence[0]["qths"] = ['8'];
                break;
            case '5':
                $occurrence[0]["qths"] = ['6', '7'];
                break;
            case '6':
            case '7':
                $occurrence[0]["qths"] = ['8'];
                break;
            case '8':
                break;
            default:
                $occurrence[0]["qths"] = ['1'];
                break;
        }

        if ($responseObject) {
            return $occurrence[0];
        }
        echo json_encode($occurrence[0]);
    }

    public function getQTH($user)
    {
        $pdo = new Connection();
        $sqlQTH = "SELECT ocorrencias_recursos.id as idqth
                FROM ocorrencias
                INNER JOIN ocorrencias_recursos ON ocorrencias.id = ocorrencias_recursos.id_ocorrencia
                WHERE ocorrencias.id_grupo = :idGrupo
                AND ocorrencias_recursos.id_recurso = :idRecurso 
                AND ocorrencias_recursos.horario_chegada_base IS NULL 
                AND ocorrencias_recursos.ultimo_qta IS NULL
                LIMIT 1";

        $stmtQTH = $pdo->prepare($sqlQTH);
        $stmtQTH->bindParam(":idGrupo", $user["id_grupo"], PDO::PARAM_STR);
        $stmtQTH->bindParam(":idRecurso", $user["id"], PDO::PARAM_STR);
        $stmtQTH->execute();

        $resultQTH = $stmtQTH->fetch(PDO::FETCH_ASSOC);

        if (!$resultQTH) {
            http_response_code(404);
            die(json_encode(array("errors" => ["Despacho não encontrado!"])));
        }

        return $resultQTH['idqth'];
    }

    public function updateQTH($user)
    {
        $pdo = new Connection();
        $idQTH = $this->getQTH($user);

        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        if (!isset($body["ultimo_qth"])) {
            http_response_code(404);
            die(json_encode(array("errors" => ["Status do QTH não informado!"])));
        }

        $field = "";
        switch ($body["ultimo_qth"]) {
            case '1':
                $field = "horario_saida_base";
                break;
            case '2':
                $field = "horario_chegada_local";
                break;
            case '3':
                $field = "horario_saida_local";
                break;
            case '4':
                $field = "horario_saida_local";
                break;
            case '5':
                $field = "horario_chegada_hospital";
                break;
            case '6':
                $field = "horario_saida_hospital";
                break;
            case '7':
                $field = "horario_saida_hospital";
                break;
            case '8':
                $field = "horario_chegada_base";
                break;
        }

        $sql = "UPDATE `siga`.`ocorrencias_recursos` SET `$field` = NOW(), `ultimo_qth` = :ultimoQTH, `ultimo_qta` = :ultimoQTA WHERE `id` = :idQTH";

        $ultimoQTA = $body["ultimo_qth"] == 8 ? 1 : null;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idQTH", $idQTH, PDO::PARAM_STR);
        $stmt->bindParam(":ultimoQTH", $body["ultimo_qth"], PDO::PARAM_STR);
        $stmt->bindParam(":ultimoQTA", $ultimoQTA,  $body["ultimo_qth"] == 8 ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->execute();

        $this->getActualOccurrence($user);
    }

    public function getResourceByQthId($qthId)
    {
        $pdo = new Connection();

        $sql = "SELECT ocorrencias_recursos.id_recurso 
                FROM ocorrencias_recursos 
                WHERE ocorrencias_recursos.id = :qthId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":qthId", $qthId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $result['id_recurso'];
    }


    public function requestSupport($user)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();

        $occurrence = $this->getActualOccurrence($user, true);
        $idOcorrencia = $occurrence['id'] ?? null;
        $idOrgaoApoio = isset($body['id_orgao_apoio']) ? intval($body['id_orgao_apoio']) : null;

        if (!$idOcorrencia) {
            http_response_code(400);
            die(json_encode(array("errors" => ["Ocorrência não encontrada!"])));
        }

        if (!$idOrgaoApoio) {
            http_response_code(400);
            die(json_encode(array("errors" => ["Organização de apoio não encontrada!"])));
        }

        $sql = "INSERT INTO `siga`.`ocorrencias_apoio` 
                (`id_ocorrencia`, `hora_pedido`, `id_orgao_apoio`, `data_hora_cadastro`) 
                VALUES (:id_ocorrencia, NOW(), :id_orgao_apoio, UTC_TIMESTAMP())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_ocorrencia', $idOcorrencia, PDO::PARAM_INT);
        $stmt->bindParam(':id_orgao_apoio', $idOrgaoApoio, PDO::PARAM_INT);
        $stmt->execute();

        $idOcorrenciaApoio = $pdo->lastInsertId();

        $sqlSelect = "SELECT nome FROM orgao_apoio WHERE id = :id";
        $stmtSelect = $pdo->prepare($sqlSelect);
        $stmtSelect->bindParam(':id', $idOrgaoApoio, PDO::PARAM_INT);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        $websocketClient = new WebsocketClient($user['id_grupo']);
        $websocketClient->connect();
        $websocketClient->send(json_encode(['type' => 'requestSupport', 'data' => array(
            'id_ocorrencia' => $idOcorrencia,
            'id_orgao_apoio' => $idOrgaoApoio,
            'id_ocorrencia_apoio' => $idOcorrenciaApoio,
            'prefixo' => $user['prefixo'],
            'orgao_apoio' => $resultSelect['nome']
        )]));
        // $websocketClient->close();

        die(json_encode(['success' => true]));
    }

    public function confirmOccurrence($user)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();

        $occurrence = $this->getActualOccurrence($user, true);
        $idOcorrencia = $occurrence['id'] ?? null;
        $idQTH = $this->getQTH($user);

        if (!$idOcorrencia) {
            http_response_code(400);
            die(json_encode(array("errors" => ["Ocorrência não encontrada!"])));
        }

        $sql = "UPDATE ocorrencias_recursos SET viatura_confirmou = 1, horario_confirmacao = UTC_TIMESTAMP() WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $idQTH, PDO::PARAM_INT);
        $stmt->execute();

        $websocketClient = new WebsocketClient($user['id_grupo']);
        $websocketClient->connect();
        $websocketClient->send(json_encode(['type' => 'confirmOccurrence', 'data' => array(
            'id_ocorrencia' => $idOcorrencia,
            'prefixo' => $user['prefixo'],
        )]));
        // $websocketClient->close();

        die(json_encode(['success' => true]));
    }
}
