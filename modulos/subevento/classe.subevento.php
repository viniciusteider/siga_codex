<?php
class Subevento
{
	private $id;
	private $id_evento;
	private $nome;
	private $data_hora_cadastro;
	private $excluido;
	private $conexao;

	public function setId($arg)
	{
		$this->id = ($arg == "") ? NULL : $arg;
	}
 	
	public function getId()
	{
		return $this->id;
	}
 	
	public function setIdEvento($arg)
	{
		$this->id_evento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdEvento()
	{
		return $this->id_evento;
	}
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setDataHoraCadastro($arg)
	{
		$this->data_hora_cadastro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraCadastro()
	{
		return $this->data_hora_cadastro;
	}
 	
	public function setExcluido($arg)
	{
		$this->excluido = ($arg == "") ? NULL : $arg;
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
		INSERT INTO subevento SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_evento = :id_evento";
		 $sql .= ",nome = :nome";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_evento",$this->id_evento,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE subevento SET id_evento = :id_evento';
		 $sql .= ",nome = :nome";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_evento",$this->id_evento,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM subevento WHERE id IN({$lista})";
		$sql = "UPDATE subevento SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN evento ON(evento.id = subevento.id_evento)
		";
		
		$where = "
			WHERE subevento.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND subevento.data_hora_cadastro >='{$param['data_hora_inicio']}' AND subevento.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM subevento
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
				subevento.*,
			       evento.nome as nome_evento
			FROM subevento
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY subevento.id DESC";
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
		$sql = "SELECT * FROM subevento WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
    public function ListarComboSubEventos($id)
    {
        if($id == "") return false;

        $pdo = $this->getConexao();
        $sql = "SELECT * FROM subevento WHERE id = $id ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rs;
    }
    public function ListarComboSubEventosId($id)
    {
        if($id == "") return false;

        $pdo = $this->getConexao();
        $sql = "SELECT * FROM subevento WHERE id_evento = $id ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rs;
    }
}
