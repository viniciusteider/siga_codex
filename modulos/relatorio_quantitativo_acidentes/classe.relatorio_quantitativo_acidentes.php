<?php
class RelatorioQuantitativoAcidentes
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
            veiculos_acidentes.id
            ,ocorrencias.data_hora
            ,ocorrencias.id_cidade as nome_cidade
            ,ocorrencias.logradouro as endereco
            ,ocorrencias.bairro
            ,ocorrencias.latitude
            ,ocorrencias.longitude
            ,subevento.nome as nome_subvevento
            ,paciente.nome as nome_vitima
            ,paciente.sexo
            ,paciente.idade
            ,paciente_situacao.nome as gravidade
            ,hospital.nome as nome_hospital
            ,tipo_veiculo.nome as nome_tipo_veiculo
            ,recursos.prefixo
        FROM veiculos_acidentes
            INNER JOIN tipo_veiculo ON(tipo_veiculo.id = veiculos_acidentes.id_tipo_veiculo)
            INNER JOIN ocorrencias ON(ocorrencias.id = veiculos_acidentes.id_ocorrencia)
            INNER JOIN grupo ON(ocorrencias.id_grupo = grupo.id)
            INNER JOIN ocorrencias_recursos ON(ocorrencias.id = ocorrencias_recursos.id_ocorrencia)
            INNER JOIN recursos ON(recursos.id = ocorrencias_recursos.id_recurso)
            INNER JOIN `evento` ON (`ocorrencias`.`id_evento` = `evento`.`id`)
            LEFT JOIN `subevento` ON (`ocorrencias`.`id_subevento` = `subevento`.`id`)
            LEFT JOIN paciente ON(paciente.id_ocorrencia = ocorrencias.id)
            LEFT JOIN hospital ON(paciente.id_hospital = hospital.id)
            LEFT JOIN paciente_situacao ON(paciente_situacao.id = paciente.id_situacao)
         WHERE  (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
          ";
        if (($param['data_hora_inicio']))  $sql.= " AND ocorrencias.data_hora >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora <= '{$param['data_hora_fim']}'";
        if (($param['id_base']))  $sql.= " AND base.id ='{$param['id_base']}' ";
        if (($param['id_estado']))  $sql.= " AND ocorrencias.id_estado ='{$param['id_estado']}' ";
        if (($param['id_cidade']))  $sql.= " AND ocorrencias.id_cidade ='{$param['id_cidade']}' ";
        if (($param['id_evento']))  $sql.= " AND evento.id ='{$param['id_evento']}' ";
        if (($param['id_subevento']))  $sql.= " AND subevento.id ='{$param['id_subevento']}' ";


//        echo nl2br($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}