<?php
class OcorrenciasRecursosEquipe
{
	private $id;
	private $id_ocorrencias_recursos;
	private $id_efetivo;
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
 	
	public function setIdOcorrenciasRecursos($arg)
	{
		$this->id_ocorrencias_recursos = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdOcorrenciasRecursos()
	{
		return $this->id_ocorrencias_recursos;
	}
 	
	public function setIdEfetivo($arg)
	{
		$this->id_efetivo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdEfetivo()
	{
		return $this->id_efetivo;
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
		INSERT INTO ocorrencias_recursos_equipe SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_ocorrencias_recursos = :id_ocorrencias_recursos";
		 $sql .= ",id_efetivo = :id_efetivo";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_ocorrencias_recursos",$this->id_ocorrencias_recursos,PDO::PARAM_INT);
		 $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE ocorrencias_recursos_equipe SET 
			';
		 $sql .= ",id_ocorrencias_recursos = :id_ocorrencias_recursos";
		 $sql .= ",id_efetivo = :id_efetivo";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_ocorrencias_recursos",$this->id_ocorrencias_recursos,PDO::PARAM_INT);
		 $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM ocorrencias_recursos_equipe WHERE id IN({$lista})";
		$sql = "UPDATE ocorrencias_recursos_equipe SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE ocorrencias_recursos_equipe.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND ocorrencias_recursos_equipe.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias_recursos_equipe.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias_recursos_equipe
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
				ocorrencias_recursos_equipe.*
			FROM ocorrencias_recursos_equipe
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ocorrencias_recursos_equipe.id DESC";
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
		$sql = "SELECT * FROM ocorrencias_recursos_equipe WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM ocorrencias_recursos_equipe WHERE excluido IS NULL";
            if($id != "") $sql .= " AND ocorrencias_recursos_equipe.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         ocorrencias_recursos_equipe.id,
                         ocorrencias_recursos_equipe.nome  AS text
                     FROM ocorrencias_recursos_equipe
                     WHERE ocorrencias_recursos_equipe.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (ocorrencias_recursos_equipe.nome LIKE '%$busca%' OR ocorrencias_recursos_equipe.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
        
        public function GerarSelec($id,$nome_campo,$id_campo,$outros = '',$campo = ["id","nome"],$autocomlete = false)
        {
            if($autocomlete) $id_atual = $id;
    
            $objOcorrenciasRecursosEquipe= new OcorrenciasRecursosEquipe();
            $registros = $objOcorrenciasRecursosEquipe->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
