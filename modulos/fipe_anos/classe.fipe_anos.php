<?php
class FipeAnos
{
	private $id;
	private $id_fipe_modelos;
	private $nome;
	private $ano;
	private $combustivel;
	private $valor;
	private $mes_referencia;
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
 	
	public function setIdFipeModelos($arg)
	{
		$this->id_fipe_modelos = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdFipeModelos()
	{
		return $this->id_fipe_modelos;
	}
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setAno($arg)
	{
		$this->ano = ($arg == "") ? NULL : $arg;
	}
 	
	public function getAno()
	{
		return $this->ano;
	}
 	
	public function setCombustivel($arg)
	{
		$this->combustivel = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCombustivel()
	{
		return $this->combustivel;
	}
 	
	public function setValor($arg)
	{
		$this->valor = str_replace(",", ".", str_replace(".", "", $arg));
	}
 	
	public function getValor()
	{
		return $this->valor;
	}
 	
	public function setMesReferencia($arg)
	{
		$this->mes_referencia = ($arg == "") ? NULL : $arg;
	}
 	
	public function getMesReferencia()
	{
		return $this->mes_referencia;
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
		INSERT INTO fipe_anos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_fipe_modelos = :id_fipe_modelos";
		 $sql .= ",nome = :nome";
		 $sql .= ",ano = :ano";
		 $sql .= ",combustivel = :combustivel";
		 $sql .= ",valor = :valor";
		 $sql .= ",mes_referencia = :mes_referencia";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_fipe_modelos",$this->id_fipe_modelos,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":ano",$this->ano,PDO::PARAM_STR);
		 $stmt->bindParam(":combustivel",$this->combustivel,PDO::PARAM_STR);
		 $stmt->bindParam(":valor",$this->valor,PDO::PARAM_STR);
		 $stmt->bindParam(":mes_referencia",$this->mes_referencia,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE fipe_anos SET 
			';
		 $sql .= ",id_fipe_modelos = :id_fipe_modelos";
		 $sql .= ",nome = :nome";
		 $sql .= ",ano = :ano";
		 $sql .= ",combustivel = :combustivel";
		 $sql .= ",valor = :valor";
		 $sql .= ",mes_referencia = :mes_referencia";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_fipe_modelos",$this->id_fipe_modelos,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":ano",$this->ano,PDO::PARAM_STR);
		 $stmt->bindParam(":combustivel",$this->combustivel,PDO::PARAM_STR);
		 $stmt->bindParam(":valor",$this->valor,PDO::PARAM_STR);
		 $stmt->bindParam(":mes_referencia",$this->mes_referencia,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM fipe_anos WHERE id IN({$lista})";
		$sql = "UPDATE fipe_anos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE fipe_anos.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND fipe_anos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND fipe_anos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM fipe_anos
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
				fipe_anos.*
			FROM fipe_anos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY fipe_anos.id DESC";
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
		$sql = "SELECT * FROM fipe_anos WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM fipe_anos WHERE excluido IS NULL";
            if($id != "") $sql .= " AND fipe_anos.id = $id ";
            $sql .= " LIMIT 20";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca,$modelo){
            $pdo = new Conexao();
            $sql = " SELECT
                         fipe_anos.id,
                         fipe_anos.nome  AS text,
                         fipe_anos.nome 
                     FROM fipe_anos
                     WHERE fipe_anos.excluido IS NULL AND fipe_anos.id_fipe_modelos = $modelo
                     ";
    
            if($busca != ''){
                $sql .= " AND  (fipe_anos.nome LIKE '%$busca%' OR fipe_anos.id  LIKE '%$busca%') ";
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
    
            $objFipeAnos= new FipeAnos();
            $registros = $objFipeAnos->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
