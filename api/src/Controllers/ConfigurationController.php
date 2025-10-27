<?php

namespace App\Controllers;

use App\Classes\Connection;
use PDO;

class ConfigurationController
{
    public function getDropdown($user)
    {

        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();

        $infos = [
            'vias_aereas',
            'respiracao',
            'circulacao_local',
            'pupilas_sintomas',
            'lesoes',
            'tipo_obstetricia',
            'estagio_parto',
            'vias',
            'orgao_apoio',
            'unidade_medida'
        ];

        $options = [];


        foreach ($infos as $info) {
            $sql = "SELECT
                id,
                nome
            FROM
                " . $info . " 
            WHERE excluido IS NULL";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $option = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $options[$info] = $option;
        }

        $sqls = [
            'sinais_clinicos_obstetricia' => 'SELECT id, procedimentos as nome, id_estagio_parto as grupo FROM sinais_clinicos_obstetricia WHERE excluido IS NULL',
            'circulacao' => 'SELECT id, nome, id_circulacao_local as grupo FROM `circulacao` WHERE excluido IS NULL',
            'etnia' => 'SELECT id_etnia as id, etnia as nome FROM `etnia` WHERE excluido IS NULL',
            'sinais_clinicos' => 'SELECT id, sinais as nome FROM `sinais_clinicos` WHERE excluido IS NULL order by sinais',
            'procedimentos' => 'SELECT
                                    procedimentos.id AS id,
                                    procedimentos.procedimento AS nome,
                                    procedimentos_tipo.id AS grupo 
                                FROM
                                    procedimentos
                                    INNER JOIN procedimentos_tipo ON procedimentos_tipo.id = procedimentos.id_procedimento_tipo 
                                ORDER BY
                                    procedimentos.procedimento',
            'respostas' => 'SELECT
                                respostas.id,
                                respostas.nome,
                                respostas.tipo_resposta_id as grupo,
                                respostas.pontos as extra
                            FROM
                                respostas'
        ];
        foreach ($sqls as $chave => $sql) {

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $option = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $options[$chave] = $option;
        }

        echo json_encode($options);
    }

    public function searchMedicamentos($user)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();
        $sql = "SELECT
            medicamentos.id as id,
            medicamentos.nome as nome
        FROM
            medicamentos 
        WHERE
            1=1 ";

        $terms = explode(' ', $_GET['term']);
        foreach ($terms as $index => $term) {
            $sql .= " AND medicamentos.nome LIKE :term$index";
        }

        $sql .= " AND excluido IS NULL";

        $stmt = $pdo->prepare($sql);

        foreach ($terms as $index => $term) {
            $term = '%' . $term . '%';
            $stmt->bindParam(":term$index", $term, PDO::PARAM_STR);
        }

        $stmt->execute();
        $medicamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($medicamentos);
    }

    public function searchMateriais($user)
    {
        header('Content-Type: application/json');

        $pdo = new Connection();
        $sql = "SELECT
            materiais_itens.id as id,
            materiais_itens.nome as nome
        FROM
            materiais_itens 
        WHERE
            1=1 ";

        $terms = explode(' ', $_GET['term']);
        foreach ($terms as $index => $term) {
            $sql .= " AND materiais_itens.nome LIKE :term$index";
        }

        $sql .= " AND excluido IS NULL";

        $stmt = $pdo->prepare($sql);

        foreach ($terms as $index => $term) {
            $term = '%' . $term . '%';
            $stmt->bindParam(":term$index", $term, PDO::PARAM_STR);
        }

        $stmt->execute();
        $materiais = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($materiais);
    }

    public function getResourceInformation($user)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();

        $resourceId = $user['id'];

        if (!$resourceId) {
            echo json_encode(['error' => 'Resource ID is required']);
            return;
        }

        // Get resource information
        $sqlResource = "SELECT
        recursos.id,
        recursos.prefixo,
        recursos.placa,
        recursos.ufplaca,
        recursos.ano_modelo,
        recursos.ano_fabricacao,
        recursos.renavam,
        recursos.chassi,
        recursos.km_atual,
        recursos.potencia,
        recursos.cilindradas,
        recursos.peso_liquido,
        recursos.tanque,
        marca.nome AS marca,
        modelo.nome as modelo,
        tipo_combustivel.tipo_combustivel,
        base.nome as base
    FROM
        recursos
    INNER JOIN modelo ON modelo.id = recursos.id_modelo
    INNER JOIN marca ON marca.id = modelo.id_marca
    INNER JOIN tipo_combustivel ON tipo_combustivel.id = recursos.id_tipo_combustivel
    INNER JOIN base ON base.id = recursos.id_base
    WHERE recursos.id = :resourceId";

        $stmtResource = $pdo->prepare($sqlResource);
        $stmtResource->bindParam(':resourceId', $resourceId, PDO::PARAM_INT);
        $stmtResource->execute();
        $resourceInfo = $stmtResource->fetch(PDO::FETCH_ASSOC);

        // Get current schedule
        $sqlSchedule = "SELECT
        escala_mensal.id,
        escala_mensal.data_hora_entrada,
        escala_mensal.data_hora_saida,
        usuario.nome as efetivo,
        funcao.nome as funcao
    FROM
        escala_mensal
    INNER JOIN usuario ON usuario.id = escala_mensal.id_usuario
    INNER JOIN funcao ON funcao.id = escala_mensal.id_funcao
    WHERE
        escala_mensal.id_local = :resourceId AND
        escala_mensal.data_hora_entrada <= NOW() AND
        escala_mensal.data_hora_saida >= NOW()";

        $stmtSchedule = $pdo->prepare($sqlSchedule);
        $stmtSchedule->bindParam(':resourceId', $resourceId, PDO::PARAM_INT);
        $stmtSchedule->execute();
        $currentSchedule = $stmtSchedule->fetchAll(PDO::FETCH_ASSOC);

        $resourceInfo['escala'] = $currentSchedule;

        echo json_encode($resourceInfo);
    }
}
