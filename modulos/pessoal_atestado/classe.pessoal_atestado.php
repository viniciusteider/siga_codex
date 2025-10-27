<?php
class PessoalAtestado
{
	private $id;
	private $id_usuario;
	private $id_cid;
	private $id_tipo_afastamento;
	private $id_medico;
	private $data_inicio;
	private $data_termino;
	private $texto_homologacao;
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
 	
	public function setIdCid($arg)
	{
		$this->id_cid = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCid()
	{
		return $this->id_cid;
	}
 	
	public function setIdTipoAfastamento($arg)
	{
		$this->id_tipo_afastamento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoAfastamento()
	{
		return $this->id_tipo_afastamento;
	}
 	
	public function setIdMedico($arg)
	{
		$this->id_medico = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdMedico()
	{
		return $this->id_medico;
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
 	
	public function setTextoHomologacao($arg)
	{
		$this->texto_homologacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getTextoHomologacao()
	{
		return $this->texto_homologacao;
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
		INSERT INTO pessoal_atestado SET  id_usuario = :id_usuario ';
		 $sql .= ",id_cid = :id_cid";
		 $sql .= ",id_tipo_afastamento = :id_tipo_afastamento";
		 $sql .= ",id_medico = :id_medico";
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",texto_homologacao = :texto_homologacao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cid",$this->id_cid,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_afastamento",$this->id_tipo_afastamento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_medico",$this->id_medico,PDO::PARAM_INT);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":texto_homologacao",$this->texto_homologacao,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal_atestado SET id_usuario = :id_usuario ';
		 $sql .= ",id_cid = :id_cid";
		 $sql .= ",id_tipo_afastamento = :id_tipo_afastamento";
		 $sql .= ",id_medico = :id_medico";
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",texto_homologacao = :texto_homologacao";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cid",$this->id_cid,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_afastamento",$this->id_tipo_afastamento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_medico",$this->id_medico,PDO::PARAM_INT);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":texto_homologacao",$this->texto_homologacao,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal_atestado WHERE id IN({$lista})";
		$sql = "UPDATE pessoal_atestado SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_usuario,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN medicos ON(medicos.id = pessoal_atestado.id_medico)
		INNER JOIN cid ON(cid.id = pessoal_atestado.id_cid)
		INNER JOIN tipo_afastamento ON(tipo_afastamento.id = pessoal_atestado.id_tipo_afastamento)
		";
		
		$where = "
			WHERE pessoal_atestado.excluido IS NULL and pessoal_atestado.id_usuario = $id_usuario
		";

		if($busca != "") $where .= " AND (pessoal_atestado.texto_homologacao LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal_atestado
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
				pessoal_atestado.*,
			       cid.nome as nome_cid,
			       medicos.nome as nome_medico,
			       medicos.crm ,
			       tipo_afastamento.nome as nome_tipo_afastamento
			FROM pessoal_atestado
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal_atestado.id DESC";
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
		$sql = "SELECT * FROM pessoal_atestado WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM pessoal_atestado WHERE excluido IS NULL";
            if($id != "") $sql .= " AND pessoal_atestado.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         pessoal_atestado.id,
                         pessoal_atestado.nome  AS text
                     FROM pessoal_atestado
                     WHERE pessoal_atestado.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (pessoal_atestado.nome LIKE '%$busca%' OR pessoal_atestado.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
