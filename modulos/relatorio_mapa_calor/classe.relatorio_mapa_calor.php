<?php
class RelatorioMapaCalor
{
    private $conexao;

    public function setConexao($arg)
    {
        $this->conexao = $arg;
    }

    public function getConexao()
    {
        return $this->conexao;
    }

    public function __construct($conexao = "")
    {
        if ($conexao) {
            $this->conexao = $conexao;
        } else {
            $this->conexao = new Conexao();
        }
    }

    public function GetCidades()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT
                    ocorrencias.id_cidade AS id,
                    ocorrencias.cidade AS nome 
                FROM
                    ocorrencias 
                WHERE
                    ocorrencias.id_cidade IS NOT NULL 
                GROUP BY
                    ocorrencias.id_cidade";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetEventos()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT id,nome FROM evento where excluido is NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetSubEventos($eventoId)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT id,nome FROM subevento where excluido is NULL and id_evento = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $eventoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetOcorrencias($eventoId, $subeventoId, $cidadeId, $dataInicio, $dataFim)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT
                ocorrencias.id,
                ocorrencias.nome,
                ocorrencias.telefone,
                evento.id as id_evento,
                evento.nome as nome_evento,
                subevento.id as id_subevento,
                subevento.nome as nome_subevento,
                ocorrencias.logradouro,
                ocorrencias.numero,
                ocorrencias.bairro,
                ocorrencias.cidade,
                ocorrencias.latitude,
                ocorrencias.longitude
                FROM
                ocorrencias
                INNER JOIN evento ON evento.id = ocorrencias.id_evento
                INNER JOIN subevento ON subevento.id = ocorrencias.id_subevento
                WHERE true";
        if ($eventoId) {
            $sql .= " and evento.id = :eventoId";
        }

        if ($subeventoId) {
            $sql .= " and subevento.id = :subeventoId";
        }
        if ($cidadeId) {
            $sql .= " and ocorrencias.id_cidade = :cidadeId";
        }
        if ($dataInicio) {
            $sql .= " and ocorrencias.data_hora >= :dataInicio";
        }
        if ($dataFim) {
            $sql .= " and ocorrencias.data_hora <= :dataFim";
        }
        $stmt = $pdo->prepare($sql);

        if ($subeventoId) {
            $stmt->bindParam(':subeventoId', $subeventoId);
        }
        if ($eventoId) {
            $stmt->bindParam(':eventoId', $eventoId);
        }
        if ($cidadeId) {
            $stmt->bindParam(':cidadeId', $cidadeId);
        }
        if ($dataInicio) {
            $stmt->bindParam(':dataInicio', $dataInicio);
        }
        if ($dataFim) {
            $stmt->bindParam(':dataFim', $dataFim);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetHospitais()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT
                hospital.id,
                hospital.nome,
                endereco.latitude,
                endereco.longitude
            FROM
                hospital
            INNER JOIN endereco ON endereco.id = hospital.id_endereco
            inner join  grupo on grupo.id = hospital.id_grupo
            WHERE hospital.excluido IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetBases()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT
                base.id,
                base.nome,
                base.latitude,
                base.longitude 
            FROM
                base where excluido is NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
