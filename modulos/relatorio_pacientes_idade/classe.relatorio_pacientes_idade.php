<?php
class RelatorioPacientesIdade
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
                 COUNT(paciente.id) as total
                 ,ocorrencias.cidade as nome_cidade
                 ,base.nome as nome_base
                 ,evento.nome as nome_evento
                 , subevento.nome as nome_sub_evento
                 ,SUM(CASE WHEN idade < 1 THEN 1 ELSE 0 END) AS idade_1
                 ,SUM(CASE WHEN idade BETWEEN 1 AND 4 THEN 1 ELSE 0 END) AS idade_4
                 ,SUM(CASE WHEN idade BETWEEN 5 AND 9 THEN 1 ELSE 0 END) AS idade_9
                 ,SUM(CASE WHEN idade BETWEEN 10 AND 14 THEN 1 ELSE 0 END) AS idade_14
                 ,SUM(CASE WHEN idade BETWEEN 15 AND 19 THEN 1 ELSE 0 END) AS idade_19
                 ,SUM(CASE WHEN idade BETWEEN 20 AND 24 THEN 1 ELSE 0 END) AS idade_24
                 ,SUM(CASE WHEN idade BETWEEN 25 AND 30 THEN 1 ELSE 0 END) AS idade_30
                 ,SUM(CASE WHEN idade BETWEEN 31 AND 35 THEN 1 ELSE 0 END) AS idade_35
                 ,SUM(CASE WHEN idade BETWEEN 36 AND 40 THEN 1 ELSE 0 END) AS idade_40
                 ,SUM(CASE WHEN idade BETWEEN 41 AND 45 THEN 1 ELSE 0 END) AS idade_45
                 ,SUM(CASE WHEN idade BETWEEN 46 AND 50 THEN 1 ELSE 0 END) AS idade_50
                 ,SUM(CASE WHEN idade BETWEEN 51 AND 55 THEN 1 ELSE 0 END) AS idade_55
                 ,SUM(CASE WHEN idade BETWEEN 56 AND 60 THEN 1 ELSE 0 END) AS idade_60
                 ,SUM(CASE WHEN idade BETWEEN 61 AND 65 THEN 1 ELSE 0 END) AS idade_65
                 ,SUM(CASE WHEN idade BETWEEN 66 AND 70 THEN 1 ELSE 0 END) AS idade_70
                 ,SUM(CASE WHEN idade > 70 THEN 1 ELSE 0 END) AS idade_71
                   FROM paciente
              INNER JOIN ocorrencias ON(ocorrencias.id = paciente.id_ocorrencia)
              INNER JOIN `grupo` ON (`ocorrencias`.`id_grupo` = `grupo`.`id`)
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
        $sql .= " GROUP BY ocorrencias.id_cidade,evento.id,subevento.id  ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}