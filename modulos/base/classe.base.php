<?php
class Base
{
	private $id;
	private $id_grupo;
	private $nome;
	private $id_endereco;
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
 	
	public function setIdGrupo($arg)
	{
		$this->id_grupo = $arg;
	}
 	
	public function getIdGrupo()
	{
		return $this->id_grupo;
	}
 	
	public function setNome($arg)
	{
		$this->nome = $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setIdEndereco($arg)
	{
		$this->id_endereco = $arg;
	}
 	
	public function getIdEndereco()
	{
		return $this->id_endereco;
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
		INSERT INTO base SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",nome = :nome";
		 $sql .= ",id_endereco = :id_endereco";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":id_endereco",$this->id_endereco,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = ' UPDATE base SET nome = :nome';

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM base WHERE id IN({$lista})";
		$sql = "UPDATE base SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN grupo ON(grupo.id = base.id_grupo)
		";
		
		$where = "
			WHERE base.excluido IS NULL
		";
		
		if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND base.data_hora_cadastro >='{$param['data_hora_inicio']}' AND base.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM base
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
				base.*
			FROM base
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY base.id DESC";
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
		$sql = "
            SELECT base.nome,base.id,base.data_hora_cadastro,endereco.*,endereco.id as id_endereco,cidades.id_estado
            FROM base  
                INNER JOIN endereco ON (endereco.id = base.id_endereco) 
                INNER JOIN cidades ON (cidades.id = endereco.id_cidade) 
            WHERE base.id = :id
            ";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
    public function ComboBase()
    {
        $pdo = $this->getConexao();
        $sql = "
            SELECT base.id,base.nome
            FROM base   
            WHERE base.id = :id
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarBases($id_grupo,$busca)
    {
        $pdo = $this->getConexao();
        $sql = "
			SELECT
				base.id,
				base.nome,
				base.nome as text
			FROM base
				INNER JOIN grupo ON (grupo.id = base.id_grupo)
			WHERE base.excluido IS NULL AND (grupo.id = $id_grupo OR grupo.arvore LIKE '%;$id_grupo;%')";
        if ($busca){
            $sql .= " AND base.nome LIKE '%$busca%'";
        }
        $sql .= " ORDER BY nome DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios;
    }
}
