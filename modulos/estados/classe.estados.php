<?php
class Estados
{
	private $id;
	private $sigla;
	private $nome;
	private $uf;
	private $id_regiao_uf;
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
 	
	public function setSigla($arg)
	{
		$this->sigla = $arg;
	}
 	
	public function getSigla()
	{
		return $this->sigla;
	}
 	
	public function setNome($arg)
	{
		$this->nome = $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setUf($arg)
	{
		$this->uf = $arg;
	}
 	
	public function getUf()
	{
		return $this->uf;
	}
 	
	public function setIdRegiaoUf($arg)
	{
		$this->id_regiao_uf = $arg;
	}
 	
	public function getIdRegiaoUf()
	{
		return $this->id_regiao_uf;
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
		INSERT INTO estados SET  ';
		 $sql .= ",sigla = :sigla";
		 $sql .= ",nome = :nome";
		 $sql .= ",uf = :uf";
		 $sql .= ",id_regiao_uf = :id_regiao_uf";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":sigla",$this->getSigla(),PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->getNome(),PDO::PARAM_STR);
		 $stmt->bindParam(":uf",$this->getUf(),PDO::PARAM_STR);
		 $stmt->bindParam(":id_regiao_uf",$this->getIdRegiaoUf(),PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE estados SET 
			id = :id';
		 $sql .= ",sigla = :sigla";
		 $sql .= ",nome = :nome";
		 $sql .= ",uf = :uf";
		 $sql .= ",id_regiao_uf = :id_regiao_uf";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->getId(),PDO::PARAM_INT);
		 $stmt->bindParam(":sigla",$this->getSigla(),PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->getNome(),PDO::PARAM_STR);
		 $stmt->bindParam(":uf",$this->getUf(),PDO::PARAM_STR);
		 $stmt->bindParam(":id_regiao_uf",$this->getIdRegiaoUf(),PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->getId(),PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM estados WHERE id IN({$lista})";
		$sql = "UPDATE estados SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE estados.id > 0
		";
		
		if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND servicos.data_prevista >='{$param['data_hora_inicio']}' AND servicos.data_prevista <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM estados
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
				estados.*
			FROM estados
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY estados.id DESC";
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
		$sql = "SELECT * FROM estados WHERE id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(1,$this->getId(),PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
    public function ComboEstados()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT id,nome,sigla FROM estados WHERE excluido IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(pdo::PARAM_STR);
    }
}
