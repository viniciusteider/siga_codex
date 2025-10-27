<?php
class VacinaTipo
{
	private $id;
	private $nome;
	private $qt_doses;
	private $indicacao;
	private $intervalo_doses;
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
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setQtDoses($arg)
	{
		$this->qt_doses = ($arg == "") ? NULL : $arg;
	}
 	
	public function getQtDoses()
	{
		return $this->qt_doses;
	}
 	
	public function setIndicacao($arg)
	{
		$this->indicacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIndicacao()
	{
		return $this->indicacao;
	}
 	
	public function setIntervaloDoses($arg)
	{
		$this->intervalo_doses = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIntervaloDoses()
	{
		return $this->intervalo_doses;
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
		INSERT INTO vacina_tipo SET  nome = :nome';
		 $sql .= ",qt_doses = :qt_doses";
		 $sql .= ",indicacao = :indicacao";
		 $sql .= ",intervalo_doses = :intervalo_doses";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":qt_doses",$this->qt_doses,PDO::PARAM_INT);
		 $stmt->bindParam(":indicacao",$this->indicacao,PDO::PARAM_STR);
		 $stmt->bindParam(":intervalo_doses",$this->intervalo_doses,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE vacina_tipo SET nome = :nome';
		 $sql .= ",qt_doses = :qt_doses";
		 $sql .= ",indicacao = :indicacao";
		 $sql .= ",intervalo_doses = :intervalo_doses";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":qt_doses",$this->qt_doses,PDO::PARAM_INT);
		 $stmt->bindParam(":indicacao",$this->indicacao,PDO::PARAM_STR);
		 $stmt->bindParam(":intervalo_doses",$this->intervalo_doses,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM vacina_tipo WHERE id IN({$lista})";
		$sql = "UPDATE vacina_tipo SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE vacina_tipo.excluido IS NULL
		";

		if($busca != "") $where .= " AND (nome LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM vacina_tipo
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
				vacina_tipo.*
			FROM vacina_tipo
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY vacina_tipo.id DESC";
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
		$sql = "SELECT * FROM vacina_tipo WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM vacina_tipo WHERE excluido IS NULL";
            if($id != "") $sql .= " AND vacina_tipo.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         vacina_tipo.id,
                         vacina_tipo.nome  AS text
                     FROM vacina_tipo
                     WHERE vacina_tipo.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (vacina_tipo.nome LIKE '%$busca%' OR vacina_tipo.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
