<?php
class RelatorioQuantitativoHospital
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

    public function Gerar($idGrupo,$param)
    {
        $pdo = $this->getConexao();
        $sql = "
        SELECT
            COUNT(*) as total
             ,group_concat(ocorrencias.id) as ocorrencias_id
             ,SUM((SELECT SUM(1) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL )) as total_paciente
             ,SUM((SELECT COUNT(*) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL  AND sexo = 'M')) as total_masculino
             ,SUM((SELECT COUNT(*) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL  AND sexo = 'F')) as total_feminino
             ,SUM((SELECT COUNT(*) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL  AND id_situacao = '1')) as leve
             ,SUM((SELECT COUNT(*) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL  AND id_situacao = '2')) as medio
             ,SUM((SELECT COUNT(*) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL  AND id_situacao = '3')) as grave
             ,SUM((SELECT COUNT(*) FROM paciente WHERE paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL  AND id_situacao = '4')) as obito
             ,(SELECT hospital.nome FROM paciente INNER JOIN hospital ON(hospital.id = paciente.id_hospital) where paciente.id_ocorrencia = ocorrencias.id AND paciente.excluido IS NULL GROUP BY ocorrencias.id) AS nome_hospital
             ,classificacao_risco.id as id_classificao
             ,classificacao_risco.nome as nome_classificao
             ,evento.nome as nome_evento
             ,evento.id as id_evento
             ,subevento.id as id_subevento
             ,subevento.nome as nome_sub_evento
             ,base.nome as nome_base
             ,ocorrencias.cidade as nome_cidade
             ,base.id as id_base
        FROM
            ocorrencias
                INNER JOIN `grupo` ON (`ocorrencias`.`id_grupo` = `grupo`.`id`)
                INNER JOIN `classificacao_risco` ON (`ocorrencias`.`id_ocorrencia_classificacao` = `classificacao_risco`.`id`)
                INNER JOIN `ocorrencias_recursos` ON (`ocorrencias`.`id` = `ocorrencias_recursos`.`id_ocorrencia`)
                INNER JOIN `recursos` ON (`recursos`.`id` = `ocorrencias_recursos`.`id_recurso`)
                INNER JOIN `base` ON (`base`.`id` = `recursos`.`id_base`)
                INNER JOIN `evento` ON (`ocorrencias`.`id_evento` = `evento`.`id`)
                LEFT JOIN `subevento` ON (`ocorrencias`.`id_subevento` = `subevento`.`id`)
         WHERE  (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
          ";
        if (($param['data_hora_inicio']))  $sql.= " AND ocorrencias.data_hora >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora <= '{$param['data_hora_fim']}'";
        if (($param['id_base']))  $sql.= " AND base.id ='{$param['id_base']}' ";
        if (($param['id_estado']))  $sql.= " AND ocorrencias.id_estado ='{$param['id_estado']}' ";
        if (($param['id_cidade']))  $sql.= " AND ocorrencias.id_cidade ='{$param['id_cidade']}' ";
        if (($param['id_evento']))  $sql.= " AND evento.id ='{$param['id_evento']}' ";
        if (($param['id_subevento']))  $sql.= " AND subevento.id ='{$param['id_subevento']}' ";

        $sql .= "GROUP BY  ocorrencias.id_cidade,evento.id,subevento.id ,classificacao_risco.id,nome_hospital ";

//        echo nl2br($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

