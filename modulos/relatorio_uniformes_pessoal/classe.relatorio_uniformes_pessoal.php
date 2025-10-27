<?php
class RelatorioUniformesPessoal
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

	public function GerarRelatorio($param)
	{
        $pdo = $this->getConexao();
	    $sql = 'SELECT
              usuario.nome,
              uniforme_peca.nome AS nome_peca,
              uniforme_tamanho.nome AS nome_tamanho
            FROM
              `pessoal_uniforme`
                  INNER JOIN usuario ON ( usuario.id = pessoal_uniforme.`id_usuario` )
                  INNER JOIN grupo ON ( grupo.id = usuario.`id_grupo` )
                  INNER JOIN endereco ON ( endereco.id = usuario.`id_endereco` )
                  INNER JOIN cidades ON ( cidades.id = endereco.`id_cidade` )
                  INNER JOIN usuario_efetivo ON ( usuario.id = usuario_efetivo.`id_usuario` )
                  INNER JOIN uniforme_peca ON (uniforme_peca.id = pessoal_uniforme.`id_peca`)
                  INNER JOIN uniforme_tamanho ON (uniforme_tamanho.id = pessoal_uniforme.`id_tamanho`)';

        if (($param['data_hora_inicio']))  $sql.= " AND usuario.data_hora_cadastro >='{$param['data_hora_inicio']}' AND usuario.data_hora_cadastro <= '{$param['data_hora_fim']}'";
        if (($param['id_base']))  $sql.= " AND usuario_efetivo.id_base ='{$param['id_base']}' ";
        if (($param['id_estado']))  $sql.= " AND cidades.id_estado ='{$param['id_estado']}' ";
        if (($param['id_cidade']))  $sql.= " AND endereco.id ='{$param['id_cidade']}' ";


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
