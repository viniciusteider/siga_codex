<?php
class RelatorioTempoResposta
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
        $sql = " SELECT
                COUNT(ocorrencias_recursos.id) as total
                ,ocorrencias.cidade as nome_cidade
                ,base.nome as nome_base
                ,evento.nome as nome_evento
                ,tipo_recursos.nome as nome_tipo_recurso
                ,recursos.prefixo 
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias.data_hora,ocorrencias_recursos.horario_saida_base)) AS saida_base
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias_recursos.horario_saida_base,ocorrencias_recursos.horario_chegada_local)) AS chegada_local
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias_recursos.horario_chegada_local,ocorrencias_recursos.horario_saida_local)) AS saida_local
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias_recursos.horario_saida_local,ocorrencias_recursos.horario_chegada_hospital)) AS chegada_hospital
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias_recursos.horario_chegada_hospital,ocorrencias_recursos.horario_saida_hospital)) AS saida_hospital
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias_recursos.horario_saida_hospital,ocorrencias_recursos.horario_chegada_base)) AS chegada_base
                ,SUM(TIMESTAMPDIFF(SECOND,ocorrencias_recursos.horario_saida_base,ocorrencias_recursos.horario_chegada_base)) AS total_operacao
                FROM ocorrencias_recursos
                INNER JOIN ocorrencias ON(ocorrencias.id = ocorrencias_recursos.id_ocorrencia)
                INNER JOIN `grupo` ON (`ocorrencias`.`id_grupo` = `grupo`.`id`)
                INNER JOIN `recursos` ON (`recursos`.`id` = `ocorrencias_recursos`.`id_recurso`)
                INNER JOIN `tipo_recursos` ON (`tipo_recursos`.`id` = `recursos`.`id_tipo_recurso`)
                INNER JOIN `base` ON (`base`.`id` = `recursos`.`id_base`)
                INNER JOIN `evento` ON (`ocorrencias`.`id_evento` = `evento`.`id`)
                WHERE ocorrencias_recursos.horario_chegada_base IS NOT NULL
                AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
            
          ";
        if (($param['data_hora_inicio']))  $sql.= " AND ocorrencias.data_hora >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora <= '{$param['data_hora_fim']}'";
        if (($param['id_base']))    $sql.= " AND base.id ='{$param['id_base']}' ";
        if (($param['id_estado']))  $sql.= " AND ocorrencias.id_estado ='{$param['id_estado']}' ";
        if (($param['id_cidade']))  $sql.= " AND ocorrencias.id_cidade ='{$param['id_cidade']}' ";
        if (($param['id_evento']))  $sql.= " AND evento.id ='{$param['id_evento']}' ";
        $sql .= " GROUP BY ocorrencias.id_cidade,base.id,evento.id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}