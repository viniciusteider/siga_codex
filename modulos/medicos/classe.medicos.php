<?php
class Medicos
{
	private $id;
	private $crm;
	private $nome;
	private $tipo_inscricao;
	private $situacao_inscricao;
	private $especialidade;
	private $cro_crm;
	private $UF;
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
 	
	public function setCrm($arg)
	{
		$this->crm = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCrm()
	{
		return $this->crm;
	}
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setTipoInscricao($arg)
	{
		$this->tipo_inscricao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getTipoInscricao()
	{
		return $this->tipo_inscricao;
	}
 	
	public function setSituacaoInscricao($arg)
	{
		$this->situacao_inscricao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getSituacaoInscricao()
	{
		return $this->situacao_inscricao;
	}
 	
	public function setEspecialidade($arg)
	{
		$this->especialidade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getEspecialidade()
	{
		return $this->especialidade;
	}
 	
	public function setCroCrm($arg)
	{
		$this->cro_crm = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCroCrm()
	{
		return $this->cro_crm;
	}
 	
	public function setUF($arg)
	{
		$this->UF = ($arg == "") ? NULL : $arg;
	}
 	
	public function getUF()
	{
		return $this->UF;
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
		INSERT INTO medicos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",crm = :crm";
		 $sql .= ",nome = :nome";
		 $sql .= ",tipo_inscricao = :tipo_inscricao";
		 $sql .= ",situacao_inscricao = :situacao_inscricao";
		 $sql .= ",especialidade = :especialidade";
		 $sql .= ",cro_crm = :cro_crm";
		 $sql .= ",UF = :UF";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":crm",$this->crm,PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":tipo_inscricao",$this->tipo_inscricao,PDO::PARAM_STR);
		 $stmt->bindParam(":situacao_inscricao",$this->situacao_inscricao,PDO::PARAM_STR);
		 $stmt->bindParam(":especialidade",$this->especialidade,PDO::PARAM_STR);
		 $stmt->bindParam(":cro_crm",$this->cro_crm,PDO::PARAM_STR);
		 $stmt->bindParam(":UF",$this->UF,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE medicos SET crm = :crm ';
		 $sql .= ",nome = :nome";
		 $sql .= ",tipo_inscricao = :tipo_inscricao";
		 $sql .= ",situacao_inscricao = :situacao_inscricao";
		 $sql .= ",especialidade = :especialidade";
		 $sql .= ",cro_crm = :cro_crm";
		 $sql .= ",UF = :UF";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":crm",$this->crm,PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":tipo_inscricao",$this->tipo_inscricao,PDO::PARAM_STR);
		 $stmt->bindParam(":situacao_inscricao",$this->situacao_inscricao,PDO::PARAM_STR);
		 $stmt->bindParam(":especialidade",$this->especialidade,PDO::PARAM_STR);
		 $stmt->bindParam(":cro_crm",$this->cro_crm,PDO::PARAM_STR);
		 $stmt->bindParam(":UF",$this->UF,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		$sql = "UPDATE medicos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE medicos.excluido IS NULL
		";

		if($busca != "") $where .= " AND (medicos.nome LIKE :busca OR medicos.crm LIKE :busca OR medicos.especialidade LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND medicos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND medicos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM medicos
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
				medicos.*
			FROM medicos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY medicos.id DESC";
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
		$sql = "SELECT * FROM medicos WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM medicos WHERE excluido IS NULL";
            if($id != "") $sql .= " AND medicos.id = $id ";
            $sql .= " LIMIT 1 ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         medicos.id,
                            CONCAT(medicos.nome,' - CRM:',medicos.crm)  AS text
                     FROM medicos
                     WHERE medicos.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (medicos.nome LIKE '%$busca%'  OR medicos.crm  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
