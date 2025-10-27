<?php
class Marca
{
	private $id;
	private $nome;
	private $data_hora_cadastro;
	private $excluido;
	private $conexao;

	public function setId($arg)
	{
		$this->id = $arg;
	}
 	
	public function getId()
	{
		return $this->id;
	}
 	
	public function setNome($arg)
	{
		$this->nome = $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setDataHoraCadastro($arg)
	{
		$this->data_hora_cadastro = $arg;
	}
 	
	public function getDataHoraCadastro()
	{
		return $this->data_hora_cadastro;
	}
 	
	public function setExcluido($arg)
	{
		$this->excluido = $arg;
	}
 	
	public function getExcluido()
	{
		return $this->excluido;
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
		INSERT INTO marca SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",nome = :nome";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE marca SET 
			id = :id';
		 $sql .= ",nome = :nome";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM marca WHERE id IN({$lista})";
		$sql = "UPDATE marca SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE marca.id > 0
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND marca.data_hora_cadastro >='{$param['data_hora_inicio']}' AND marca.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM marca
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
				marca.*
			FROM marca
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY marca.id DESC";
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
		$sql = "SELECT * FROM marca WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
    public function ListarComboMarcas($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM marca WHERE excluido IS NULL";
        if($id != "") $sql .= " marca.id = $id";
        $sql .= " ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rs;
    }
}
