<?php
class FipeModelos
{
	private $id;
	private $id_fipe_marcas;
	private $codigo_modelo;
	private $codigo_fipe;
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
 	
	public function setIdFipeMarcas($arg)
	{
		$this->id_fipe_marcas = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdFipeMarcas()
	{
		return $this->id_fipe_marcas;
	}
 	
	public function setCodigoModelo($arg)
	{
		$this->codigo_modelo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCodigoModelo()
	{
		return $this->codigo_modelo;
	}
 	
	public function setCodigoFipe($arg)
	{
		$this->codigo_fipe = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCodigoFipe()
	{
		return $this->codigo_fipe;
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
		INSERT INTO fipe_modelos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_fipe_marcas = :id_fipe_marcas";
		 $sql .= ",codigo_modelo = :codigo_modelo";
		 $sql .= ",codigo_fipe = :codigo_fipe";
		 $sql .= ",nome = :nome";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_fipe_marcas",$this->id_fipe_marcas,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_modelo",$this->codigo_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_fipe",$this->codigo_fipe,PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE fipe_modelos SET 
			';
		 $sql .= ",id_fipe_marcas = :id_fipe_marcas";
		 $sql .= ",codigo_modelo = :codigo_modelo";
		 $sql .= ",codigo_fipe = :codigo_fipe";
		 $sql .= ",nome = :nome";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_fipe_marcas",$this->id_fipe_marcas,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_modelo",$this->codigo_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_fipe",$this->codigo_fipe,PDO::PARAM_STR);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM fipe_modelos WHERE id IN({$lista})";
		$sql = "UPDATE fipe_modelos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE fipe_modelos.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND fipe_modelos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND fipe_modelos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM fipe_modelos
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
				fipe_modelos.*
			FROM fipe_modelos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY fipe_modelos.id DESC";
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
		$sql = "SELECT * FROM fipe_modelos WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM fipe_modelos WHERE excluido IS NULL";
            if($id != "") $sql .= " AND fipe_modelos.id = $id ";
            $sql .= " LIMIT 20";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca,$marca){
            $pdo = new Conexao();
            $sql = " SELECT
                         fipe_modelos.id,
                         fipe_modelos.nome  AS text,
                         fipe_modelos.nome 
                     FROM fipe_modelos
                     WHERE fipe_modelos.excluido IS NULL AND fipe_modelos.id_fipe_marcas = $marca
                     ";
    
            if($busca != ''){
                $sql .= " AND  (fipe_modelos.nome LIKE '%$busca%' OR fipe_modelos.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
        
        public function GerarSelec($id,$nome_campo,$id_campo,$outros = '',$campo = ["id","nome"],$autocomlete = true)
        {
            if($autocomlete) $id_atual = $id;
    
            $objFipeModelos= new FipeModelos();
            $registros = $objFipeModelos->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
