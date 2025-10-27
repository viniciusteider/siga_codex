<?php

namespace App\Controllers;

use App\Classes\Connection;
use Exception;
use PDO;

class PatientController
{
    public function listPatients($user)
    {

        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);

        $occurrence = $this->getOccurrenceId($user);

        if (!count($occurrence)) {
            die(json_encode([]));
        }

        $pdo = new Connection();
        $sql = "SELECT
            paciente.id,
            paciente.nome,
            paciente.rg,
            paciente.cpf,
            paciente.sexo,
            paciente.idade,
            paciente.id_etnia 
        FROM
            paciente 
        WHERE
            id_ocorrencia = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $occurrence[0]["id"], PDO::PARAM_INT);
        $stmt->execute();
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return die(json_encode($patients));
    }

    private function getOccurrenceId($user)
    {
        $pdo = new Connection();

        $sql = "SELECT
            ocorrencias.id
        FROM
            ocorrencias
            INNER JOIN ocorrencias_recursos ON ocorrencias.id = ocorrencias_recursos.id_ocorrencia
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

        return $occurrence;
    }

    public function createPatient($user)
    {

        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);
        if (!isset($body['nome'])) {
            http_response_code(500);
            die(json_encode(['message' => 'Nome obrigatório']));
        }
        //salva em arquivo o json para debug
        // file_put_contents('./json.json', json_encode($body));

        $nome = $body['nome'];
        $rg = $body['rg'];
        $cpf = $body['cpf'];
        $sexo = $body['sexo'];
        $idade = $body['idade'];
        $etniaId = $body['id_etnia'];

        $occurrence = $this->getOccurrenceId($user);

        if (!count($occurrence)) {
            http_response_code(500);
            die(json_encode(['message' => 'Ocorrencia nâo encontrada']));
        }

        $occurrenceId = $occurrence[0]["id"];

        $pdo = new Connection();

        if (!empty($rg) || !empty($cpf)) {

            $sql = "SELECT
                paciente.id
            FROM
                paciente 
            WHERE
                id_ocorrencia = :idOcorrencia  " . (isset($rg) || isset($cpf) ? " AND (" . (isset($rg) && !empty($rg) ? "rg = :rg" : "") . (isset($rg) && isset($cpf) && !empty($cpf) && !empty($rg) ? " OR " : "") . (isset($cpf) && !empty($cpf) ? "cpf = :cpf" : "") . ")" : "");

            $stmtValidation = $pdo->prepare($sql);
            $stmtValidation->bindParam(":idOcorrencia", $occurrenceId, PDO::PARAM_INT);
            if (isset($rg) && !empty($rg)) $stmtValidation->bindParam(":rg", $rg, PDO::PARAM_STR);
            if (isset($cpf) && !empty($cpf)) $stmtValidation->bindParam(":cpf", $cpf, PDO::PARAM_STR);
            $stmtValidation->execute();
            $patient = $stmtValidation->fetchAll(PDO::FETCH_ASSOC);

            if (count($patient)) {
                http_response_code(404);
                die(json_encode(['message' => 'Paciente já existe!']));
            }
        }

        if (empty($nome) || empty($sexo)) {
            http_response_code(404);
            die(json_encode(['message' => 'Nome ou sexo está vazio']));
        }

        

        // $idAddress = $this->createAddress($pdo, $body);

        $enderecoCompleto = $body['logradouro'] . " " . $body['numero'] . " " . $body['bairro'] . " " . $body['cidade'] . " " . $body['estado'];
        $idEstado = $this->getStateId($pdo, $body['estado']);
        $idCidade = $this->getCityId($pdo, $body['cidade']);

        $sql_paciente = "INSERT INTO paciente (nome, rg, cpf, sexo, id_ocorrencia, idade, id_etnia, `logradouro`, `numero`, `estado`, `cidade`, `bairro`, `telefone`, `celular`,  `observacao`, `id_estado`, `id_cidade`, `endereco_completo`) VALUES (:nome, :rg, :cpf, :sexo, :idOcorrencia, :idade, :id_etnia, :logradouro, :numero, :estado, :cidade, :bairro, :telefone, :celular, :observacao, :id_estado, :id_cidade, :endereco_completo)";
        $stmt = $pdo->prepare($sql_paciente);
        $stmt->bindParam(":idOcorrencia", $occurrenceId, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":rg", $rg, PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $sexo, PDO::PARAM_STR);
        $stmt->bindParam(":idade", $idade, PDO::PARAM_STR);
        $stmt->bindParam(":id_etnia", $etniaId, PDO::PARAM_STR);
        $stmt->bindParam(":logradouro", $body['logradouro'], PDO::PARAM_STR);
        $stmt->bindParam(":endereco_completo", $enderecoCompleto, PDO::PARAM_STR);
        $stmt->bindParam(":numero", $body['numero'], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $body['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":cidade", $body['cidade'], PDO::PARAM_STR);
        $stmt->bindParam(":bairro", $body['bairro'], PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $body['telefone'], PDO::PARAM_STR);
        $stmt->bindParam(":celular", $body['celular'], PDO::PARAM_STR);
        $stmt->bindParam(":observacao", $body['observacao'], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $idEstado, PDO::PARAM_INT);
        $stmt->bindParam(":id_cidade", $idCidade, PDO::PARAM_INT);

        

        // $stmt->bindParam(":idEndereco", $idAddress, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao inserir paciente']));
        }

        $this->getPacient($user, $pdo->lastInsertId());
    }

    private function getStateId($pdo, $state)
    {
        $sql = "SELECT id FROM estados WHERE sigla = :state";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":state", $state, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    private function getCityId($pdo, $city)
    {
        $sql = "SELECT id FROM cidades WHERE nome = :city";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":city", $city, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    public function createAddress($pdo, $body)
    {
        if (empty($body['logradouro'])) {
            return null;
        }
        $sql_insert = "INSERT INTO `siga`.`endereco`(`logradouro`, `numero`, `estado`, `cidade`, `bairro`, `telefone`, `celular`, `data_hora_cadastro`, `observacao`) 
                        VALUES (:logradouro, :numero, :estado, :cidade, :bairro, :telefone, :celular, NOW(), :observacao)";
        $stmt = $pdo->prepare($sql_insert);

        $stmt->bindParam(':logradouro', $body['logradouro'], PDO::PARAM_STR);
        $stmt->bindParam(':numero', $body['numero'], PDO::PARAM_STR);
        $stmt->bindParam(':estado', $body['estado'], PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $body['cidade'], PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $body['bairro'], PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $body['telefone'], PDO::PARAM_STR);
        $stmt->bindParam(':celular', $body['celular'], PDO::PARAM_STR);
        $stmt->bindParam(':observacao', $body['observacao'], PDO::PARAM_STR);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao criar endereço']));
        }

        return $pdo->lastInsertId();
    }

    public function getPacient($user, $id, $method = "die")
    {

        $pdo = new Connection();
        $sql = "SELECT
                paciente.id,
                paciente.nome,
                paciente.rg,
                paciente.cpf,
                paciente.sexo,
                paciente.idade,
                paciente.id_etnia,
                paciente.id_respiracao,
                paciente.id_vias_aereas,
                ( SELECT paciente_circulacao.id_circulacao FROM paciente_circulacao INNER JOIN circulacao ON circulacao.id = paciente_circulacao.id_circulacao WHERE id_circulacao_local = 1 and paciente_circulacao.id_paciente = paciente.id) as id_circulacao_pele,
                ( SELECT paciente_circulacao.id_circulacao FROM paciente_circulacao INNER JOIN circulacao ON circulacao.id = paciente_circulacao.id_circulacao WHERE id_circulacao_local = 2 and paciente_circulacao.id_paciente = paciente.id ) as id_circulacao_pulso,
                ( SELECT paciente_circulacao.id_circulacao FROM paciente_circulacao INNER JOIN circulacao ON circulacao.id = paciente_circulacao.id_circulacao WHERE id_circulacao_local = 3 and paciente_circulacao.id_paciente = paciente.id ) as id_circulacao_perfusao,
                id_pupilas as id_tipo_pupila,
                paciente.id_tipo_obstetricia,
                paciente.idade_gestacional,
                paciente.bcf,
                (SELECT paciente_sinais_clinicos_obstetricia.id_sinais_clinicos_obstetrica FROM paciente_sinais_clinicos_obstetricia INNER JOIN sinais_clinicos_obstetricia ON sinais_clinicos_obstetricia.id = paciente_sinais_clinicos_obstetricia.id_sinais_clinicos_obstetrica WHERE paciente_sinais_clinicos_obstetricia.id_paciente = paciente.id AND sinais_clinicos_obstetricia.id_estagio_parto = 1) as id_pre_parto,
                (SELECT paciente_sinais_clinicos_obstetricia.id_sinais_clinicos_obstetrica FROM paciente_sinais_clinicos_obstetricia INNER JOIN sinais_clinicos_obstetricia ON sinais_clinicos_obstetricia.id = paciente_sinais_clinicos_obstetricia.id_sinais_clinicos_obstetrica WHERE paciente_sinais_clinicos_obstetricia.id_paciente = paciente.id AND sinais_clinicos_obstetricia.id_estagio_parto = 2) as id_pos_parto,
                paciente.apgar_1,
                paciente.apgar_5,
                paciente.logradouro,
                paciente.numero,
                paciente.estado,
                paciente.cidade,
                paciente.bairro,
                paciente.telefone,
                paciente.celular,

                paciente.tipo_encaminhamento,
                paciente.recusa_atendimento,
                paciente.recusa_transporte,
                paciente.profissional,
                paciente.data_recebimento,
                paciente.id_situacao,
                paciente.observacao,
                hospital.nome as nome_hospital,
                hospital.id as id_hospital,
                paciente.assinatura
            FROM
                paciente
            LEFT JOIN hospital on paciente.id_hospital = hospital.id
            WHERE
                paciente.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!count($patients)) {
            http_response_code(404);
            die(json_encode(['message' => 'Paciente não encontrado!']));
        }

        $patient = $patients[0];

        $sqlPupils = "SELECT
                        pupilas_sintomas.id AS pupilas_sintomas_id,
                        paciente_pupilas.direita,
                        paciente_pupilas.esquerda
                    FROM
                        pupilas_sintomas
                    LEFT JOIN 
                        (SELECT * FROM paciente_pupilas WHERE id_paciente = :id) AS paciente_pupilas
                        ON paciente_pupilas.id_pupilas_sintomas = pupilas_sintomas.id;";

        $stmtPupils = $pdo->prepare($sqlPupils);
        $stmtPupils->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtPupils->execute();
        $pupils = $stmtPupils->fetchAll(PDO::FETCH_ASSOC);

        $sqlLesions = "SELECT
                        partes_corpo.id,
                        ( SELECT GROUP_CONCAT( id_lesao ) FROM paciente_lesoes WHERE id_paciente = :id AND paciente_lesoes.id_parte_corpo = partes_corpo.id ) as lesoes_ids
                    FROM
                        partes_corpo 
                    WHERE
                        excluido IS NULL";

        $stmtLesions = $pdo->prepare($sqlLesions);
        $stmtLesions->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtLesions->execute();
        $lesions = $stmtLesions->fetchAll(PDO::FETCH_ASSOC);

        $sqlVitalSigns = "SELECT
                        paciente_sinais_vitais.id,
                        paciente_sinais_vitais.horario,
                        paciente_sinais_vitais.pressao_arterial_minima,
                        paciente_sinais_vitais.pressao_arterial_maxima,
                        paciente_sinais_vitais.frequencia_cardiaca,
                        paciente_sinais_vitais.frequencia_respiratoria,
                        paciente_sinais_vitais.saturacao_o2,
                        paciente_sinais_vitais.glasgow,
                        paciente_sinais_vitais.temperatura,
                        paciente_sinais_vitais.hgt,
                        paciente_sinais_vitais.escala_trauma,
                        abertura_ocular_id,
                        resposta_verbal_id,
                        resposta_motora_id
                    FROM
                        paciente_sinais_vitais 
                    WHERE
                        paciente_sinais_vitais.id_paciente = :id";

        $stmtVitalSigns = $pdo->prepare($sqlVitalSigns);
        $stmtVitalSigns->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtVitalSigns->execute();
        $vitalSigns = $stmtVitalSigns->fetchAll(PDO::FETCH_ASSOC);

        $sqlMedicamentos = "SELECT
                paciente_medicamentos.id_via,
                vias.nome as via_nome,
                paciente_medicamentos.id_efetivo,
                paciente_medicamentos.horario,
                paciente_medicamentos.dose,
                paciente_medicamentos.id,
                paciente_medicamentos.id_medicamento,
                medicamentos.nome ,
                paciente_medicamentos.unidade_medida_id
            FROM
                paciente_medicamentos
                INNER JOIN medicamentos ON medicamentos.id = paciente_medicamentos.id_medicamento 
                INNER JOIN vias ON vias.id = paciente_medicamentos.id_via
            WHERE
                paciente_medicamentos.id_paciente = :id";

        $stmtMedicamentos = $pdo->prepare($sqlMedicamentos);
        $stmtMedicamentos->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtMedicamentos->execute();
        $medicamentos = $stmtMedicamentos->fetchAll(PDO::FETCH_ASSOC);

        $medicamentosFormatados = array_map(function ($medicamento) {
            return [
                'via' => [
                    'id' => $medicamento['id_via'],
                    'nome' => $medicamento['via_nome']
                ],
                'id_efetivo' => $medicamento['id_efetivo'],
                'horario' => $medicamento['horario'],
                'dose' => $medicamento['dose'],
                'id' => $medicamento['id'],
                'medicamento' => [
                    'id' => $medicamento['id_medicamento'],
                    'nome' => $medicamento['nome']
                ],
                'unidade_medida_id' => $medicamento['unidade_medida_id']
            ];
        }, $medicamentos);

        $patient["medicamentos"] = $medicamentosFormatados;

        $sqlSignals = "SELECT
                        paciente_sinais_clinicos.id_sinais_clinicos
                    FROM
                        paciente_sinais_clinicos
                    WHERE   
                        paciente_sinais_clinicos.id_paciente = :id";
        $stmtSignals = $pdo->prepare($sqlSignals);
        $stmtSignals->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtSignals->execute();
        $clinicSignals = $stmtSignals->fetchAll(PDO::FETCH_ASSOC);

        $proceduresTypes = [
            1 => 'padrao',
            2 => 'sondagens',
            3 => 'curativos',
            4 => 'imobilizacoes',
        ];

        foreach ($proceduresTypes as $key => $value) {
            $sqlProcedures = "SELECT
                                paciente_procedimentos.id_procedimento
                            FROM
                                paciente_procedimentos
                                INNER JOIN procedimentos ON procedimentos.id = paciente_procedimentos.id_procedimento 
                            WHERE
                                paciente_procedimentos.id_paciente = :id
                                AND procedimentos.id_procedimento_tipo = :type";
            $stmtProcedures = $pdo->prepare($sqlProcedures);
            $stmtProcedures->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtProcedures->bindParam(":type", $key, PDO::PARAM_INT);
            $stmtProcedures->execute();
            $procedures = $stmtProcedures->fetchAll(PDO::FETCH_ASSOC);
            $patient[$value] = array_map(function ($n) {
                return $n['id_procedimento'];
            }, $procedures);
        }

        $sqlMaterials = "SELECT
            ocorrencias_materiais.id as id,
            ocorrencias_materiais.id_hospital as hospital_id,
            hospital.nome as hospital_nome,
            ocorrencias_materiais.responsavel_hospital as responsavel_hospital,	
            ocorrencias_materiais_itens.id as ocorrencia_material_id, 
            materiais_itens.id as material_id,
            materiais_itens.nome as material_nome,
            ocorrencias_materiais_itens.quantidade as quantidade 
        FROM
            ocorrencias_materiais
            INNER JOIN hospital ON hospital.id = ocorrencias_materiais.id_hospital
            LEFT JOIN ocorrencias_materiais_itens ON ocorrencias_materiais_itens.id_ocorrencia_entrega = ocorrencias_materiais.id
            LEFT JOIN materiais_itens ON materiais_itens.id = ocorrencias_materiais_itens.id_item 
        WHERE
            ocorrencias_materiais.id_paciente = :id";

        $stmtMaterials = $pdo->prepare($sqlMaterials);
        $stmtMaterials->bindParam(":id", $id, PDO::PARAM_INT);
        $stmtMaterials->execute();
        $materials = $stmtMaterials->fetchAll(PDO::FETCH_ASSOC);

        $formattedMaterials = [];
        foreach ($materials as $material) {
            $materialId = $material['id'];
            if (!isset($formattedMaterials[$materialId])) {
                $formattedMaterials[$materialId] = [
                    'id' => $materialId,
                    'hospital' => [
                        'id' => $material['hospital_id'],
                        'nome' => $material['hospital_nome']
                    ],
                    'responsavel_hospital' => $material['responsavel_hospital'],
                    'materiais' => []
                ];
            }
            if ($material['ocorrencia_material_id']) {
                $formattedMaterials[$materialId]['materiais'][] = [
                    'id' => $material['ocorrencia_material_id'],
                    'material' => [
                        'id' => $material['material_id'],
                        'nome' => $material['material_nome']
                    ],
                    'quantidade' => $material['quantidade']
                ];
            }
        }

        $patient['materiais'] = array_values($formattedMaterials);


        $patient["pupilas_sintomas"] = $pupils;
        $patient["sinais_vitais"] = $vitalSigns;

        $patient["sinais_clinicos"] = array_map(function ($n) {
            return $n['id_sinais_clinicos'];
        }, $clinicSignals);

        $patient["hospital"] = array(
            "id" => $patient["id_hospital"],
            "nome" => $patient["nome_hospital"]
        );
        unset($patient["id_hospital"]);
        unset($patient["nome_hospital"]);

        $patient["lesoes"] = array_map(function ($n) {
            if ($n['lesoes_ids'] == null) {
                $n['lesoes_ids'] = array();
            } else {
                $n['lesoes_ids'] = explode(',', $n['lesoes_ids']);
            }
            return $n;
        }, $lesions);

        if ($method == "die")
            return die(json_encode($patient));
        return $patient;
    }

    public function deletePatient($user, $id)
    {
        $pdo = new Connection();
        $pdo->beginTransaction();

        try {
            // Delete related data
            $tables = [
                'paciente_sinais_vitais',
                'paciente_sinais_clinicos',
                'paciente_sinais_clinicos_obstetricia',
                'paciente_circulacao',
                'paciente_medicamentos',
                'paciente_lesoes'
            ];

            foreach ($tables as $table) {
                $sql = "DELETE FROM `siga`.`$table` WHERE `id_paciente` = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }

            $sql = "DELETE omi FROM `siga`.`ocorrencias_materiais_itens` omi
                    INNER JOIN `siga`.`ocorrencias_materiais` om ON omi.id_ocorrencia_entrega = om.id
                    WHERE om.id_paciente = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $sql = "DELETE FROM `siga`.`ocorrencias_materiais` WHERE `id_paciente` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Finally, delete the patient
            $sql = "DELETE FROM `siga`.`paciente` WHERE `id` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $pdo->commit();
            http_response_code(200);
            echo json_encode(['message' => 'Paciente excluído com sucesso']);
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            echo json_encode(['message' => 'Erro ao excluir paciente: ' . $e->getMessage()]);
        }
    }


    public function updatePacient($user, $id)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);
        if (!isset($body['nome'])) {
            http_response_code(500);
            die(json_encode(['message' => 'Nome obrigatório']));
        }

        //sava em arquivo o json para debug
        // file_put_contents('./json.json', json_encode($body));

        $nome = $body['nome'];
        $rg = $body['rg'];
        $cpf = $body['cpf'];
        $sexo = $body['sexo'];
        $idade = $body['idade'];
        $etniaId = $body['id_etnia'];

        $respiracaoId = $body['id_respiracao'];
        $viasAereasId = $body['id_vias_aereas'];

        $pupilasTipoId = $body['id_tipo_pupila'];

        $tipoObstetriciaId = $body['id_tipo_obstetricia'];
        $idadeGestacional = $body['idade_gestacional'];
        $bcf = $body['bcf'];
        $apgar1 = $body['apgar_1'];
        $apgar5 = $body['apgar_5'];

        $signature = $body['assinatura'] ?? null;

        $hospitalId = $body['hospital']['id'] ?? null;

        $occurrence = $this->getOccurrenceId($user);

        if (!count($occurrence)) {
            http_response_code(500);
            die(json_encode(['message' => 'Ocorrencia nâo encontrada']));
        }

        $occurrenceId = $occurrence[0]["id"];

        $pdo = new Connection();

        $enderecoCompleto = $body['logradouro'] . " " . $body['numero'] . " " . $body['bairro'] . " " . $body['cidade'] . " " . $body['estado'];
        $idEstado = $this->getStateId($pdo, $body['estado']);
        $idCidade = $this->getCityId($pdo, $body['cidade']);

        $pdo->beginTransaction();


        $sql_paciente = "UPDATE paciente
                            SET nome = :nome,
                                rg = :rg,
                                cpf = :cpf,
                                sexo = :sexo,
                                idade = :idade,
                                id_etnia = :id_etnia,

                                id_respiracao = :id_respiracao,
                                id_vias_aereas = :id_vias_aereas,

                                id_pupilas = :id_pupilas,

                                id_tipo_obstetricia = :id_tipo_obstetricia,
                                idade_gestacional = :idade_gestacional,
                                bcf = :bcf,
                                apgar_1 = :apgar_1,
                                apgar_5 = :apgar_5,
                                id_hospital = :id_hospital,
                                recusa_atendimento = :recusa_atendimento,
                                recusa_transporte = :recusa_transporte,
                                profissional = :profissional,
                                data_recebimento = :data_recebimento,
                                id_situacao = :id_situacao,
                                tipo_encaminhamento = :tipo_encaminhamento,
                                assinatura = :assinatura,
                                logradouro = :logradouro,
                                numero = :numero,
                                complemento = :complemento,
                                bairro = :bairro,
                                cidade = :cidade,
                                estado = :estado,
                                telefone = :telefone,
                                celular = :celular,
                                observacao = :observacao,
                                id_estado = :id_estado,
                                id_cidade = :id_cidade,
                                endereco_completo = :endereco_completo


                            WHERE id = :id and id_ocorrencia = :idOcorrencia";

        $stmt = $pdo->prepare($sql_paciente);
        $stmt->bindParam(":idOcorrencia", $occurrenceId, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":rg", $rg, PDO::PARAM_STR);
        $stmt->bindParam(":cpf", $cpf, PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $sexo, PDO::PARAM_STR);
        $stmt->bindParam(":idade", $idade, PDO::PARAM_STR);
        $stmt->bindParam(":id_etnia", $etniaId, PDO::PARAM_STR);

        $stmt->bindParam(":id_respiracao", $respiracaoId, PDO::PARAM_STR);
        $stmt->bindParam(":id_vias_aereas", $viasAereasId, PDO::PARAM_STR);

        $stmt->bindParam(":id_pupilas", $pupilasTipoId, PDO::PARAM_STR);

        $stmt->bindParam(":id_tipo_obstetricia", $tipoObstetriciaId, PDO::PARAM_INT);
        $stmt->bindParam(":idade_gestacional", $idadeGestacional, PDO::PARAM_INT);
        $stmt->bindParam(":bcf", $bcf, PDO::PARAM_INT);
        $stmt->bindParam(":apgar_1", $apgar1, PDO::PARAM_INT);
        $stmt->bindParam(":apgar_5", $apgar5, PDO::PARAM_INT);
        $stmt->bindParam(':id_hospital', $hospitalId, $hospitalId !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindParam(":recusa_atendimento", $body['recusa_atendimento'], PDO::PARAM_INT);
        $stmt->bindParam(":recusa_transporte", $body['recusa_transporte'], PDO::PARAM_INT);
        $stmt->bindParam(":profissional", $body['profissional'], PDO::PARAM_STR);
        $dataRecebimento = $body['data_recebimento'] ?? null;
        $dataRecebimento = !empty($dataRecebimento) ? $dataRecebimento : null;
        $stmt->bindParam(":data_recebimento", $dataRecebimento, $dataRecebimento !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":id_situacao", $body['id_situacao'], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_encaminhamento", $body['tipo_encaminhamento'], PDO::PARAM_INT);
        $stmt->bindParam(":assinatura", $signature, $signature !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":logradouro", $body['logradouro'], $body['logradouro'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":numero", $body['numero'], $body['numero'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":complemento", $body['complemento'], $body['complemento'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":bairro", $body['bairro'], $body['bairro'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":cidade", $body['cidade'], $body['cidade'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":estado", $body['estado'], $body['estado'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":telefone", $body['telefone'], $body['telefone'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":celular", $body['celular'], $body['celular'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":observacao", $body['observacao'], $body['observacao'] !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);
        $stmt->bindParam(":id_estado", $idEstado, $idEstado !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindParam(":id_cidade", $idCidade, $idCidade !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
        $stmt->bindParam(":endereco_completo", $enderecoCompleto, $enderecoCompleto !== null ? PDO::PARAM_STR : PDO::PARAM_NULL);


        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        $this->updateBloodCirculation($pdo, $id, $body);
        $this->updatePupilsSymptom($pdo, $id, $body["pupilas_sintomas"]);
        $this->updateLesions($pdo, $id, $body["lesoes"]);
        $this->updateVitalSigns($pdo, $id, $body["sinais_vitais"]);
        $this->updateObstetrics($pdo, $id, $body);
        $this->updateClinicSignals($pdo, $id, $body["sinais_clinicos"]);
        $this->updateProcedures($pdo, $id, $body["padrao"], 1);
        $this->updateProcedures($pdo, $id, $body["sondagens"], 2);
        $this->updateProcedures($pdo, $id, $body["curativos"], 3);
        $this->updateProcedures($pdo, $id, $body["imobilizacoes"], 4);
        $this->updateMedicamentos($pdo, $id, $body["medicamentos"]);
        $this->updateMaterials($pdo, $id, $occurrenceId, $body["materiais"]);

        $pdo->commit();

        $this->getPacient($user, $id);
    }

    public function updateAddress($user, $pdo, $idPatient, $body)
    {
        $patient = $this->getPacient($user, $idPatient, "json");
        if (!isset($patient)) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        $sql_delete = "DELETE FROM `siga`.`endereco` WHERE `id` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $patient['idendereco'], PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        if (empty($body['logradouro'])) {
            return null;
        }

        $sql_insert = "INSERT INTO `siga`.`endereco`(`logradouro`, `numero`, `estado`, `cidade`, `bairro`, `telefone`, `celular`, `data_hora_cadastro`, `observacao`) 
                        VALUES (:logradouro, :numero, :estado, :cidade, :bairro, :telefone, :celular, NOW(), :observacao)";
        $stmt = $pdo->prepare($sql_insert);

        $stmt->bindParam(':logradouro', $body['logradouro'], PDO::PARAM_STR);
        $stmt->bindParam(':numero', $body['numero'], PDO::PARAM_STR);
        $stmt->bindParam(':estado', $body['estado'], PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $body['cidade'], PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $body['bairro'], PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $body['telefone'], PDO::PARAM_STR);
        $stmt->bindParam(':celular', $body['celular'], PDO::PARAM_STR);
        $stmt->bindParam(':observacao', $body['observacao'], PDO::PARAM_STR);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        return $pdo->lastInsertId();
    }
    public function updateBloodCirculation($pdo, $idPatient, $body)
    {

        $sql_delete = "DELETE FROM `siga`.`paciente_circulacao` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        $pulsoId = isset($body['id_circulacao_pulso']) ? $body['id_circulacao_pulso'] : null;
        $peleId = isset($body['id_circulacao_pele']) ? $body['id_circulacao_pele'] : null;
        $perfusaoId = isset($body['id_circulacao_perfusao']) ? $body['id_circulacao_perfusao'] : null;

        $circulations = [
            'pulso' => $pulsoId,
            'pele' => $peleId,
            'perfusao' => $perfusaoId
        ];

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_circulacao`(`id_paciente`, `id_circulacao`) VALUES (:id, :circulacaoId)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($circulations as $key => $circulationId) {
                if ($circulationId !== null) {
                    $stmt->bindParam(':id', $idPatient, PDO::PARAM_INT);
                    $stmt->bindParam(':circulacaoId', $circulationId, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }
    }

    public function updateProcedures($pdo, $idPatient, $procedures, $type)
    {

        $sql_delete = "DELETE paciente_procedimentos
                FROM paciente_procedimentos
                INNER JOIN procedimentos ON paciente_procedimentos.id_procedimento = procedimentos.id
                WHERE paciente_procedimentos.id_paciente = :id 
                AND procedimentos.id_procedimento_tipo = :type ;";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_procedimentos`(`id_paciente`, `id_procedimento`) VALUES (:id, :procedimentoId)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($procedures as $key => $procedimentoId) {
                if ($procedimentoId !== null) {
                    $stmt->bindParam(':id', $idPatient, PDO::PARAM_INT);
                    $stmt->bindParam(':procedimentoId', $procedimentoId, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }
    }

    public function updateObstetrics($pdo, $idPatient, $body)
    {

        $sql_delete = "DELETE FROM `siga`.`paciente_sinais_clinicos_obstetricia` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        $circulations = [
            1 => isset($body['id_pre_parto']) ? $body['id_pre_parto'] : null,
            2 => isset($body['id_pos_parto']) ? $body['id_pos_parto'] : null
        ];

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_sinais_clinicos_obstetricia`(`id_paciente`, `id_sinais_clinicos_obstetrica`) VALUES (:id, :sinalId)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($circulations as $key => $sinalId) {
                if ($sinalId !== null) {
                    $stmt->bindParam(':id', $idPatient, PDO::PARAM_INT);
                    $stmt->bindParam(':sinalId', $sinalId, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }
    }

    public function updatePupilsSymptom($pdo, $idPatient, $symptoms)
    {

        $sql_delete = "DELETE FROM `siga`.`paciente_pupilas` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_pupilas`(`id_paciente`, `id_pupilas_sintomas`, `direita`, `esquerda`) VALUES (:idPaciente, :idSintoma, :direita, :esquerda)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($symptoms as $key => $symptom) {
                if ($symptom["pupilas_sintomas_id"] !== null) {
                    $stmt->bindParam(':idSintoma', $symptom["pupilas_sintomas_id"], PDO::PARAM_INT);
                    $stmt->bindParam(':idPaciente', $idPatient, PDO::PARAM_INT);
                    $stmt->bindParam(':direita', $symptom["direita"], PDO::PARAM_BOOL);
                    $stmt->bindParam(':esquerda', $symptom["esquerda"], PDO::PARAM_BOOL);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }
    }

    public function updateLesions($pdo, $idPatient, $bodyParts)
    {

        $sql_delete = "DELETE FROM `siga`.`paciente_lesoes` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_lesoes`(`id_paciente`, `id_lesao`, `id_parte_corpo`) VALUES (:idPaciente, :idLesao, :idParte)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($bodyParts as $k => $part) {
                foreach ($part["lesoes_ids"] as $j => $lesion) {
                    if ($lesion !== null) {
                        $stmt->bindParam(':idLesao', $lesion, PDO::PARAM_INT);
                        $stmt->bindParam(':idPaciente', $idPatient, PDO::PARAM_INT);
                        $stmt->bindParam(':idParte', $part["id"], PDO::PARAM_INT);
                        $stmt->execute();
                    }
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar paciente']));
        }
    }

    public function updateClinicSignals($pdo, $idPatient, $signals)
    {

        $sql_delete = "DELETE FROM `siga`.`paciente_sinais_clinicos` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar sinais clinicos do paciente']));
        }

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_sinais_clinicos`(`id_paciente`, `id_sinais_clinicos`) VALUES (:id, :sinalId)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($signals as $key => $sinalId) {
                if ($sinalId !== null) {
                    $stmt->bindParam(':id', $idPatient, PDO::PARAM_INT);
                    $stmt->bindParam(':sinalId', $sinalId, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar sinais clinicos do paciente']));
        }
    }

    public function updateVitalSigns($pdo, $idPatient, $vitalSigns)
    {
        $sql_delete = "DELETE FROM `siga`.`paciente_sinais_vitais` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar sinais vitais do paciente']));
        }

        try {
            $sql_insert = "INSERT INTO `siga`.`paciente_sinais_vitais`(`id`, `id_paciente`, `horario`, `pressao_arterial_minima`, `pressao_arterial_maxima`, `frequencia_cardiaca`, `frequencia_respiratoria`, `saturacao_o2`, `glasgow`, `temperatura`, `hgt`, `escala_trauma`, `abertura_ocular_id`, `resposta_verbal_id`, `resposta_motora_id`) 
                        VALUES (:id, :idPaciente, :horario, :pressaoArterialMinima, :pressaoArterialMaxima, :frequenciaCardiaca, :frequenciaRespiratoria, :saturacaoO2, :glasgow, :temperatura, :hgt, :escalaTrauma, :aberturaOcularId, :respostaVerbalId, :respostaMotoraId)";
            $stmt = $pdo->prepare($sql_insert);

            foreach ($vitalSigns as $sign) {
                $stmt->bindParam(':id', $sign['id'], $sign['id'] !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
                $stmt->bindParam(':idPaciente', $idPatient, PDO::PARAM_INT);
                $stmt->bindParam(':horario', $sign['horario'], PDO::PARAM_STR);
                $stmt->bindParam(':pressaoArterialMinima', $sign['pressao_arterial_minima'], PDO::PARAM_INT);
                $stmt->bindParam(':pressaoArterialMaxima', $sign['pressao_arterial_maxima'], PDO::PARAM_INT);
                $stmt->bindParam(':frequenciaCardiaca', $sign['frequencia_cardiaca'], PDO::PARAM_INT);
                $stmt->bindParam(':frequenciaRespiratoria', $sign['frequencia_respiratoria'], PDO::PARAM_INT);
                $stmt->bindParam(':saturacaoO2', $sign['saturacao_o2'], PDO::PARAM_INT);
                $stmt->bindParam(':glasgow', $sign['glasgow'], PDO::PARAM_INT);
                $stmt->bindParam(':temperatura', $sign['temperatura'], PDO::PARAM_INT);
                $stmt->bindParam(':hgt', $sign['hgt'], PDO::PARAM_INT);
                $stmt->bindParam(':escalaTrauma', $sign['escala_trauma'], PDO::PARAM_INT);
                $stmt->bindParam(':aberturaOcularId', $sign['abertura_ocular_id'], $sign['abertura_ocular_id'] !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
                $stmt->bindParam(':respostaVerbalId', $sign['resposta_verbal_id'], $sign['resposta_verbal_id'] !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
                $stmt->bindParam(':respostaMotoraId', $sign['resposta_motora_id'], $sign['resposta_motora_id'] !== null ? PDO::PARAM_INT : PDO::PARAM_NULL);
                $stmt->execute();
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar sinais vitais do paciente']));
        }
    }

    public function updateMedicamentos($pdo, $idPatient, $medicamentos)
    {
        $sql_delete = "DELETE FROM `siga`.`paciente_medicamentos` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar medicamentos do paciente']));
        }

        try {
            $sql_paciente = "INSERT INTO `siga`.`paciente_medicamentos`(`id_paciente`, `id_medicamento`, `id_via`, `horario`, `dose`, `unidade_medida_id`) 
                        VALUES (:idPaciente, :idMedicamento, :idVia, :horario, :dose, :unidade_medida_id)";
            $stmt = $pdo->prepare($sql_paciente);

            foreach ($medicamentos as $key => $medicamento) {
                if ($medicamento["medicamento"]["id"] !== null) {
                    $stmt->bindParam(':idPaciente', $idPatient, PDO::PARAM_INT);
                    $stmt->bindParam(':idMedicamento', $medicamento["medicamento"]["id"], PDO::PARAM_INT);
                    $stmt->bindParam(':idVia', $medicamento["via"]["id"], PDO::PARAM_INT);
                    $stmt->bindParam(':horario', $medicamento["horario"], PDO::PARAM_STR);
                    $stmt->bindParam(':dose', $medicamento["dose"], PDO::PARAM_STR);
                    $stmt->bindParam(':unidade_medida_id', $medicamento["unidade_medida_id"], PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } catch (Exception $e) {
            die($e);
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar medicamentos do paciente']));
        }
    }

    public function updateMaterials($pdo, $idPatient, $occurrenceId, $materials)
    {
        $sql_delete = "DELETE FROM `siga`.`ocorrencias_materiais` WHERE `id_paciente` = :id";
        $stmt = $pdo->prepare($sql_delete);
        $stmt->bindParam(":id", $idPatient, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao deletar materiais do paciente']));
        }

        try {
            $sql_ocorrencias_materiais = "INSERT INTO `siga`.`ocorrencias_materiais`
                (`id_paciente`, `id_hospital`, `responsavel_hospital`, `data_hora_cadastro`, `id_ocorrencia`) 
                VALUES (:idPaciente, :idHospital, :responsavelHospital, NOW(), :idOcorrencia)";
            $stmt_ocorrencias_materiais = $pdo->prepare($sql_ocorrencias_materiais);

            $sql_ocorrencias_materiais_itens = "INSERT INTO `siga`.`ocorrencias_materiais_itens`
                (`id_ocorrencia_entrega`, `id_item`, `quantidade`, `data_hora_cadastro`) 
                VALUES (:idOcorrenciaEntrega, :idItem, :quantidade, NOW())";
            $stmt_ocorrencias_materiais_itens = $pdo->prepare($sql_ocorrencias_materiais_itens);

            foreach ($materials as $material) {
                $stmt_ocorrencias_materiais->bindParam(':idPaciente', $idPatient, PDO::PARAM_INT);
                $stmt_ocorrencias_materiais->bindParam(':idOcorrencia', $occurrenceId, PDO::PARAM_INT);
                $stmt_ocorrencias_materiais->bindParam(':idHospital', $material["hospital"]["id"], PDO::PARAM_INT);
                $stmt_ocorrencias_materiais->bindParam(':responsavelHospital', $material["responsavel_hospital"], PDO::PARAM_STR);
                $stmt_ocorrencias_materiais->execute();

                $idOcorrenciaEntrega = $pdo->lastInsertId();

                foreach ($material["materiais"] as $item) {
                    $stmt_ocorrencias_materiais_itens->bindParam(':idOcorrenciaEntrega', $idOcorrenciaEntrega, PDO::PARAM_INT);
                    $stmt_ocorrencias_materiais_itens->bindParam(':idItem', $item["material"]["id"], PDO::PARAM_INT);
                    $stmt_ocorrencias_materiais_itens->bindParam(':quantidade', $item["quantidade"], PDO::PARAM_INT);
                    $stmt_ocorrencias_materiais_itens->execute();
                }
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar materiais do paciente: ']));
        }
    }


    public function updateSignature($user, $id)
    {
        header('Content-Type: application/json');
        $body = json_decode(file_get_contents('php://input'), true);
        $signature = $body['assinatura'] ?? null;

        if (!$signature) {
            http_response_code(400);
            die(json_encode(['message' => 'Assinatura é obrigatória']));
        }

        if (!base64_decode($signature, true)) {
            http_response_code(400);
            die(json_encode(['message' => 'Assinatura não é uma imagem válida']));
        }

        $pdo = new Connection();

        $sql = "UPDATE `siga`.`ocorrencias_materiais` SET `assinatura` = :assinatura WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':assinatura', $signature, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Assinatura atualizada com sucesso']);
        } else {
            http_response_code(500);
            die(json_encode(['message' => 'Erro ao atualizar assinatura']));
        }
    }
}
