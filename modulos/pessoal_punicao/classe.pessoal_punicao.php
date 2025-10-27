<?php
class PessoalPunicao
{
	private $id;
	private $id_usuario;
	private $id_tipo_punicao;
	private $gradacao;
	private $nr_dias;
	private $data_punicao;
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
 	
	public function setIdTipoPunicao($arg)
	{
		$this->id_tipo_punicao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoPunicao()
	{
		return $this->id_tipo_punicao;
	}
 	
	public function setGradacao($arg)
	{
		$this->gradacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getGradacao()
	{
		return $this->gradacao;
	}
 	
	public function setNrDias($arg)
	{
		$this->nr_dias = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNrDias()
	{
		return $this->nr_dias;
	}
 	
	public function setDataPunicao($arg)
	{
		$this->data_punicao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataPunicao()
	{
		return $this->data_punicao;
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
		INSERT INTO pessoal_punicao SET  id_usuario = :id_usuario ';
		 $sql .= ",id_tipo_punicao = :id_tipo_punicao";
		 $sql .= ",gradacao = :gradacao";
		 $sql .= ",nr_dias = :nr_dias";
		 $sql .= ",data_punicao = :data_punicao";
		 $sql .= ",observacoes = :observacoes";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_punicao",$this->id_tipo_punicao,PDO::PARAM_INT);
		 $stmt->bindParam(":gradacao",$this->gradacao,PDO::PARAM_STR);
		 $stmt->bindParam(":nr_dias",$this->nr_dias,PDO::PARAM_INT);
		 $stmt->bindParam(":data_punicao",$this->data_punicao,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal_punicao SET id_usuario = :id_usuario';
		 $sql .= ",id_tipo_punicao = :id_tipo_punicao";
		 $sql .= ",gradacao = :gradacao";
		 $sql .= ",nr_dias = :nr_dias";
		 $sql .= ",data_punicao = :data_punicao";
		 $sql .= ",observacoes = :observacoes";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_punicao",$this->id_tipo_punicao,PDO::PARAM_INT);
		 $stmt->bindParam(":gradacao",$this->gradacao,PDO::PARAM_STR);
		 $stmt->bindParam(":nr_dias",$this->nr_dias,PDO::PARAM_INT);
		 $stmt->bindParam(":data_punicao",$this->data_punicao,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal_punicao WHERE id IN({$lista})";
		$sql = "UPDATE pessoal_punicao SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_usuario,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN tipo_punicao ON (pessoal_punicao.id_tipo_punicao = tipo_punicao.id)
		";
		
		$where = "
			WHERE pessoal_punicao.excluido IS NULL AND pessoal_punicao.id_usuario = $id_usuario
		";
		if($busca != "") $where .= " AND (observacoes LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal_punicao
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
				pessoal_punicao.*,
			       tipo_punicao.nome as nome_punicao
			FROM pessoal_punicao
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal_punicao.id DESC";
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
		$sql = "SELECT * FROM pessoal_punicao WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM pessoal_punicao WHERE excluido IS NULL";
            if($id != "") $sql .= " AND pessoal_punicao.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         pessoal_punicao.id,
                         pessoal_punicao.nome  AS text
                     FROM pessoal_punicao
                     WHERE pessoal_punicao.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (pessoal_punicao.nome LIKE '%$busca%' OR pessoal_punicao.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
