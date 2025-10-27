<?php
class PacienteProcedimentos
{
	private $id;
	private $id_paciente;
	private $id_procedimento;
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
 	
	public function setIdPaciente($arg)
	{
		$this->id_paciente = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdPaciente()
	{
		return $this->id_paciente;
	}
 	
	public function setIdProcedimento($arg)
	{
		$this->id_procedimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdProcedimento()
	{
		return $this->id_procedimento;
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
		INSERT INTO paciente_procedimentos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_paciente = :id_paciente";
		 $sql .= ",id_procedimento = :id_procedimento";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
		 $stmt->bindParam(":id_procedimento",$this->id_procedimento,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE paciente_procedimentos SET 
			';
		 $sql .= ",id_paciente = :id_paciente";
		 $sql .= ",id_procedimento = :id_procedimento";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
		 $stmt->bindParam(":id_procedimento",$this->id_procedimento,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM paciente_procedimentos WHERE id IN({$lista})";
		$sql = "UPDATE paciente_procedimentos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}
    public function RemoverAllPaciente($id_paciente)
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM paciente_procedimentos WHERE  id_paciente = $id_paciente";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE paciente_procedimentos.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND paciente_procedimentos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_procedimentos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM paciente_procedimentos
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
				paciente_procedimentos.*
			FROM paciente_procedimentos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente_procedimentos.id DESC";
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
		$sql = "SELECT * FROM paciente_procedimentos WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            if($id == "") return;

            $pdo = $this->getConexao();
            $sql = "SELECT id_procedimento FROM paciente_procedimentos WHERE excluido IS NULL";
            $sql .= " AND paciente_procedimentos.id_paciente = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         paciente_procedimentos.id,
                         paciente_procedimentos.nome  AS text
                     FROM paciente_procedimentos
                     WHERE paciente_procedimentos.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (paciente_procedimentos.nome LIKE '%$busca%' OR paciente_procedimentos.id  LIKE '%$busca%') ";
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
    
            $objPacienteProcedimentos= new PacienteProcedimentos();
            $registros = $objPacienteProcedimentos->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
