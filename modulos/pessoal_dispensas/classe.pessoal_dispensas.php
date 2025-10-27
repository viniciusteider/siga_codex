<?php
class PessoalDispensas
{
	private $id;
	private $id_usuario;
	private $id_tipo_dispensa;
	private $motivo;
	private $data_inicio;
	private $data_termino;
	private $observacao;
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
 	
	public function setIdTipoDispensa($arg)
	{
		$this->id_tipo_dispensa = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoDispensa()
	{
		return $this->id_tipo_dispensa;
	}
 	
	public function setMotivo($arg)
	{
		$this->motivo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getMotivo()
	{
		return $this->motivo;
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
 	
	public function setObservacao($arg)
	{
		$this->observacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getObservacao()
	{
		return $this->observacao;
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
		INSERT INTO pessoal_dispensas SET id_usuario = :id_usuario ';
		 $sql .= ",id_tipo_dispensa = :id_tipo_dispensa";
		 $sql .= ",motivo = :motivo";
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",observacao = :observacao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_dispensa",$this->id_tipo_dispensa,PDO::PARAM_INT);
		 $stmt->bindParam(":motivo",$this->motivo,PDO::PARAM_STR);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":observacao",$this->observacao,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal_dispensas SET id_usuario = :id_usuario';
		 $sql .= ",id_tipo_dispensa = :id_tipo_dispensa";
		 $sql .= ",motivo = :motivo";
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",observacao = :observacao";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_dispensa",$this->id_tipo_dispensa,PDO::PARAM_INT);
		 $stmt->bindParam(":motivo",$this->motivo,PDO::PARAM_STR);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":observacao",$this->observacao,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal_dispensas WHERE id IN({$lista})";
		$sql = "UPDATE pessoal_dispensas SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_usuario,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN tipo_dispensa ON(tipo_dispensa.id = pessoal_dispensas.id_tipo_dispensa)
		";
		
		$where = "
			WHERE pessoal_dispensas.excluido IS NULL AND pessoal_dispensas.id_usuario = $id_usuario
		";

		if($busca != "") $where .= " AND (nome LIKE :busca)";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal_dispensas
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
				pessoal_dispensas.*,
			       tipo_dispensa.nome as nome_dispensa
			FROM pessoal_dispensas
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal_dispensas.id DESC";
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
		$sql = "SELECT * FROM pessoal_dispensas WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM pessoal_dispensas WHERE excluido IS NULL";
            if($id != "") $sql .= " AND pessoal_dispensas.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         pessoal_dispensas.id,
                         pessoal_dispensas.nome  AS text
                     FROM pessoal_dispensas
                     WHERE pessoal_dispensas.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (pessoal_dispensas.nome LIKE '%$busca%' OR pessoal_dispensas.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
