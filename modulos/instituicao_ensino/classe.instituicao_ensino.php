<?php
class InstituicaoEnsino
{
	private $id;
	private $id_endereco;
	private $id_estado;
	private $id_cidade;
	private $nome_instituicao;
	private $dependencia;
	private $instituicao;
	private $excluido;
	private $data_hora_cadastro;
	private $conexao;

	public function setId($arg)
	{
		$this->id = ($arg == "") ? NULL : $arg;
	}
 	
	public function getId()
	{
		return $this->id;
	}
 	
	public function setIdEndereco($arg)
	{
		$this->id_endereco = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdEndereco()
	{
		return $this->id_endereco;
	}
 	
	public function setIdEstado($arg)
	{
		$this->id_estado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdEstado()
	{
		return $this->id_estado;
	}
 	
	public function setIdCidade($arg)
	{
		$this->id_cidade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCidade()
	{
		return $this->id_cidade;
	}
 	
	public function setNomeInstituicao($arg)
	{
		$this->nome_instituicao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNomeInstituicao()
	{
		return $this->nome_instituicao;
	}
 	
	public function setDependencia($arg)
	{
		$this->dependencia = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDependencia()
	{
		return $this->dependencia;
	}
 	
	public function setInstituicao($arg)
	{
		$this->instituicao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getInstituicao()
	{
		return $this->instituicao;
	}
 	
	public function setExcluido($arg)
	{
		$this->excluido = ($arg == "") ? NULL : $arg;
	}
 	
	public function getExcluido()
	{
		return $this->excluido;
	}
 	
	public function setDataHoraCadastro($arg)
	{
		$this->data_hora_cadastro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraCadastro()
	{
		return $this->data_hora_cadastro;
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
		INSERT INTO instituicao_ensino SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_endereco = :id_endereco";
		 $sql .= ",id_estado = :id_estado";
		 $sql .= ",id_cidade = :id_cidade";
		 $sql .= ",nome_instituicao = :nome_instituicao";
		 $sql .= ",dependencia = :dependencia";
		 $sql .= ",instituicao = :instituicao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_endereco",$this->id_endereco,PDO::PARAM_INT);
		 $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cidade",$this->id_cidade,PDO::PARAM_INT);
		 $stmt->bindParam(":nome_instituicao",$this->nome_instituicao,PDO::PARAM_STR);
		 $stmt->bindParam(":dependencia",$this->dependencia,PDO::PARAM_STR);
		 $stmt->bindParam(":instituicao",$this->instituicao,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE instituicao_ensino SET id_endereco = :id_endereco';
		 $sql .= ",id_estado = :id_estado";
		 $sql .= ",id_cidade = :id_cidade";
		 $sql .= ",nome_instituicao = :nome_instituicao";
		 $sql .= ",dependencia = :dependencia";
		 $sql .= ",instituicao = :instituicao";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_endereco",$this->id_endereco,PDO::PARAM_INT);
		 $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cidade",$this->id_cidade,PDO::PARAM_INT);
		 $stmt->bindParam(":nome_instituicao",$this->nome_instituicao,PDO::PARAM_STR);
		 $stmt->bindParam(":dependencia",$this->dependencia,PDO::PARAM_STR);
		 $stmt->bindParam(":instituicao",$this->instituicao,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM instituicao_ensino WHERE id IN({$lista})";
		$sql = "UPDATE instituicao_ensino SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE instituicao_ensino.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome_instituicao LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND instituicao_ensino.data_hora_cadastro >='{$param['data_hora_inicio']}' AND instituicao_ensino.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM instituicao_ensino
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
				instituicao_ensino.*
			FROM instituicao_ensino
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY instituicao_ensino.id DESC";
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
		$sql = "SELECT * FROM instituicao_ensino WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM instituicao_ensino WHERE excluido IS NULL";
            if($id != "") $sql .= " AND instituicao_ensino.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         instituicao_ensino.id,
                         instituicao_ensino.nome_instituicao  AS text
                     FROM instituicao_ensino
                     WHERE instituicao_ensino.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (instituicao_ensino.nome_instituicao LIKE '%$busca%' OR instituicao_ensino.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
