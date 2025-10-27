<?php
class PessoalFerias
{
	private $id;
	private $id_usuario;
	private $data_inicio;
	private $data_termino;
	private $observacoes;
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
 	
	public function setIdUsuario($arg)
	{
		$this->id_usuario = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdUsuario()
	{
		return $this->id_usuario;
	}
 	
	public function setDataInicio($arg)
	{
		$this->data_inicio = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataInicio()
	{
		return $this->data_inicio;
	}
 	
	public function setDataTermino($arg)
	{
		$this->data_termino = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataTermino()
	{
		return $this->data_termino;
	}
 	
	public function setObservacoes($arg)
	{
		$this->observacoes = ($arg == "") ? NULL : $arg;
	}
 	
	public function getObservacoes()
	{
		return $this->observacoes;
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
		INSERT INTO pessoal_ferias SET id_usuario = :id_usuario ';
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",observacoes = :observacoes";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal_ferias SET id_usuario = :id_usuario ';
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",observacoes = :observacoes";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal_ferias WHERE id IN({$lista})";
		$sql = "UPDATE pessoal_ferias SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_usuario,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE pessoal_ferias.excluido IS NULL AND pessoal_ferias.id_usuario = $id_usuario
		";

		if($busca != "") $where .= " AND (observacoes LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal_ferias
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
				pessoal_ferias.*
			FROM pessoal_ferias
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal_ferias.id DESC";
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
		$sql = "SELECT * FROM pessoal_ferias WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM pessoal_ferias WHERE excluido IS NULL";
            if($id != "") $sql .= " AND pessoal_ferias.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         pessoal_ferias.id,
                         pessoal_ferias.nome  AS text
                     FROM pessoal_ferias
                     WHERE pessoal_ferias.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (pessoal_ferias.nome LIKE '%$busca%' OR pessoal_ferias.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
