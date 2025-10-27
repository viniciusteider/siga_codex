<?php
class Cid
{
	private $id;
	private $capitulo;
	private $agrupamento;
	private $categoria;
	private $sub_categoria;
	private $codigo;
	private $nome;
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
 	
	public function setCapitulo($arg)
	{
		$this->capitulo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCapitulo()
	{
		return $this->capitulo;
	}
 	
	public function setAgrupamento($arg)
	{
		$this->agrupamento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getAgrupamento()
	{
		return $this->agrupamento;
	}
 	
	public function setCategoria($arg)
	{
		$this->categoria = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCategoria()
	{
		return $this->categoria;
	}
 	
	public function setSubCategoria($arg)
	{
		$this->sub_categoria = ($arg == "") ? NULL : $arg;
	}
 	
	public function getSubCategoria()
	{
		return $this->sub_categoria;
	}
 	
	public function setCodigo($arg)
	{
		$this->codigo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCodigo()
	{
		return $this->codigo;
	}
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
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
		INSERT INTO cid SET  ';
		 $sql .= ",capitulo = :capitulo";
		 $sql .= ",agrupamento = :agrupamento";
		 $sql .= ",categoria = :categoria";
		 $sql .= ",sub_categoria = :sub_categoria";
		 $sql .= ",codigo = :codigo";
		 $sql .= ",nome = :nome";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":capitulo",$this->capitulo,PDO::PARAM_STR);
		 $stmt->bindParam(":agrupamento",$this->agrupamento,PDO::PARAM_STR);
		 $stmt->bindParam(":categoria",$this->categoria,PDO::PARAM_STR);
		 $stmt->bindParam(":sub_categoria",$this->sub_categoria,PDO::PARAM_STR);
		 $stmt->bindParam(":codigo",$this->codigo,PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE cid SET 
			';
		 $sql .= ",capitulo = :capitulo";
		 $sql .= ",agrupamento = :agrupamento";
		 $sql .= ",categoria = :categoria";
		 $sql .= ",sub_categoria = :sub_categoria";
		 $sql .= ",codigo = :codigo";
		 $sql .= ",nome = :nome";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":capitulo",$this->capitulo,PDO::PARAM_STR);
		 $stmt->bindParam(":agrupamento",$this->agrupamento,PDO::PARAM_STR);
		 $stmt->bindParam(":categoria",$this->categoria,PDO::PARAM_STR);
		 $stmt->bindParam(":sub_categoria",$this->sub_categoria,PDO::PARAM_STR);
		 $stmt->bindParam(":codigo",$this->codigo,PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM cid WHERE id IN({$lista})";
		$sql = "UPDATE cid SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE cid.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca OR codigo LIKE :busca OR capitulo LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND cid.data_hora_cadastro >='{$param['data_hora_inicio']}' AND cid.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM cid
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
				cid.*
			FROM cid
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY cid.id DESC";
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
		$sql = "SELECT * FROM cid WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT id,CONCAT( cid.codigo ,' ',cid.nome)  AS nome FROM cid WHERE excluido IS NULL";
            if($id != "") $sql .= " AND cid.id = $id ";
            $sql .= " LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         cid.id,
                         CONCAT( cid.codigo ,' ',cid.nome)  AS text
                     FROM cid
                     WHERE cid.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (cid.nome LIKE '%$busca%' OR cid.id  LIKE '%$busca%' OR cid.codigo  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
