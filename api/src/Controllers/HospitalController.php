<?php

namespace App\Controllers;

use App\Classes\Connection;
use PDO;

class HospitalController
{
    public function get($user)
    {
        header('Content-Type: application/json');

        $pdo = new Connection();
        $sql = "SELECT
                    hospital.id,
                    hospital.nome,
                    hospital.diretor,
                    hospital.id_endereco,
                    hospital.nr_endereco,
                    endereco.latitude,
                    endereco.longitude,
                    hospital.complexidade,
                    hospital.telefone,
                    hospital.vagas_leitos,
                    hospital.vagas_uti,
                    hospital.`status`	
                FROM
                    hospital
                    INNER JOIN endereco ON endereco.id = hospital.id_endereco 
                WHERE
                    hospital.id_grupo = :idGrupo 
                    AND endereco.latitude <> ''
                    AND endereco.longitude <> ''
                    AND hospital.excluido IS NULL";

        $params = [":idGrupo" => $user["id_grupo"]];

        if (isset($_GET['complexity'])) {
            $sql .= " AND hospital.complexidade = :complexity";
            $params[":complexity"] = $_GET['complexity'];
        }

        if (isset($_GET['lat']) && isset($_GET['lng']) && isset($_GET['radius']) && 
            $_GET['lat'] !== 'null' && $_GET['lng'] !== 'null' && is_numeric($_GET['radius'])) {
            $sql .= " AND (6371 * acos(cos(radians(:lat)) * cos(radians(endereco.latitude)) * 
                     cos(radians(endereco.longitude) - radians(:lng)) + 
                     sin(radians(:lat)) * sin(radians(endereco.latitude)))) <= :radius";
            $params[":lat"] = $_GET['lat'];
            $params[":lng"] = $_GET['lng'];
            $params[":radius"] = $_GET['radius'];
        }

        $stmt = $pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_STR);
        }
        $stmt->execute();

        $hospitals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($hospitals);
    }

    public function search($user)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $pdo = new Connection();
        $sql = "SELECT
            hospital.id as id,
            hospital.nome as nome
        FROM
            hospital 
        WHERE
            hospital.id_grupo = :idGrupo ";
        
        $terms = explode(' ', $_GET['term']);
        foreach ($terms as $index => $term) {
            $sql .= " AND hospital.nome LIKE :term$index";
        }

        $sql .= " AND excluido IS NULL";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":idGrupo", $user["id_grupo"], PDO::PARAM_STR);

        foreach ($terms as $index => $term) {
            $term = '%' . $term . '%';
            $stmt->bindParam(":term$index", $term, PDO::PARAM_STR);
        }

        $stmt->execute();
        $hospitals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($hospitals);
    }
}
