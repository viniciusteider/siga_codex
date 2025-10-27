<?php
class PermissaoPadrao
{
	private $id;
	private $id_acao;
	private $padrao;
	private $conexao;

	public function setId($arg)
	{
		$this->id = $arg;
	}
 	
	public function getId()
	{
		return $this->id;
	}
 	
	public function setIdAcao($arg)
	{
		$this->id_acao = $arg;
	}
 	
	public function getIdAcao()
	{
		return $this->id_acao;
	}
 	
	public function setPadrao($arg)
	{
		$this->padrao = $arg;
	}
 	
	public function getPadrao()
	{
		return $this->padrao;
	}
 	
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

	public function Adicionar()
	{
		$pdo = $this->getConexao();
		$sql = '
		INSERT INTO permissao_padrao SET  id_acao = :id_acao ';
		 $sql .= ",padrao = :padrao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_acao",$this->id_acao,PDO::PARAM_INT);
		 $stmt->bindParam(":padrao",$this->padrao,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE permissao_padrao SET id_acao = :id_acao';
		 $sql .= ",padrao = :padrao";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_acao",$this->id_acao,PDO::PARAM_INT);
		 $stmt->bindParam(":padrao",$this->padrao,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover()
	{
		$pdo = $this->getConexao();
		$sql = "DELETE FROM permissao_padrao WHERE id > 0";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}
    public function RemoverALLGrupos()
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM map_grupo_acao WHERE id_grupo IN(SELECT grupo.id FROM grupo INNER JOIN franqueado  ON(grupo.id = franqueado.id_grupo) WHERE grupo.excluido IS NULL AND franqueado.excluido IS NULL) AND customizada != 1";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function AdicionarTodosGrupos()
    {
        $pdo = $this->getConexao();
        $sql = ' INSERT INTO map_grupo_acao (id_grupo,id_acao) 
                SELECT grupo.id,permissao_padrao.id_acao FROM grupo,permissao_padrao,franqueado
                WHERE franqueado.`id_grupo` = grupo.`id` ON DUPLICATE KEY UPDATE id_grupo = grupo.id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE permissao_padrao.id > 0
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND permissao_padrao.data_hora_cadastro >='{$param['data_hora_inicio']}' AND permissao_padrao.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM permissao_padrao
			$joins
			$where
		";

		$stmt = $pdo->prepare($sql);

		if($busca != "") {
			$busca = "%".$busca."%";
			$stmt->bindParam(":busca",$busca,PDO::PARAM_STR);
		}

		$stmt->execute();
		$totalRegistros = $stmt->fetch(PDO::FETCH_OBJ)->total;

		$sql = "
			SELECT 
				permissao_padrao.*
			FROM permissao_padrao
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY permissao_padrao.id DESC";
		$sql .= " LIMIT :offset,:limit";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":offset",$numeroInicioRegistro,PDO::PARAM_INT);
		$stmt->bindParam(":limit",$numeroRegistros,PDO::PARAM_INT);

		if($busca != "") {
			$busca = "%".$busca."%";
			$stmt->bindParam(":busca",$busca,PDO::PARAM_STR);
		}

		$stmt->execute();
		$linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return [$linhas,$totalRegistros];
	}

	public function Editar()
	{
		$pdo = $this->getConexao();
		$sql = "SELECT * FROM permissao_padrao WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

    public function ListarFuncionalidades()
    {
        $pdo = $this->getConexao();

        $sql = "SELECT
                        map_acao.id,
                        map_acao.nome nome_acao,
                        map_acao.modulo,
                        map_modulo.nome nome_modulo,
                        permissao_padrao.id selecionado
                    FROM map_acao
                        INNER JOIN map_modulo ON (map_modulo.id = map_acao.modulo)
                        LEFT JOIN permissao_padrao  ON (permissao_padrao.id_acao = map_acao.id)
                    WHERE map_modulo.excluido IS NULL
                    ORDER BY map_modulo.nome, map_acao.nome ASC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $listar = $stmt->fetchAll(PDO::FETCH_OBJ);


        foreach ($listar as $acao) {
            $vetorFinal[$acao->nome_modulo][] = Array("id_acao" => $acao->id, "nome_acao" => $acao->nome_acao, "selecionado" => $acao->selecionado);
        }

        return $vetorFinal;
    }
}
