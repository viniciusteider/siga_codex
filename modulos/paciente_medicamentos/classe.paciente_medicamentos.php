<?php
class PacienteMedicamentos
{
	private $id;
	private $id_paciente;
	private $id_medicamento;
	private $id_via;
	private $id_efetivo;
	private $horario;
	private $dose;
	private $unidade_medida_id;
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
 	
	public function setIdMedicamento($arg)
	{
		$this->id_medicamento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdMedicamento()
	{
		return $this->id_medicamento;
	}
 	
	public function setIdVia($arg)
	{
		$this->id_via = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdVia()
	{
		return $this->id_via;
	}
 	
	public function setIdEfetivo($arg)
	{
		$this->id_efetivo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdEfetivo()
	{
		return $this->id_efetivo;
	}
 	
	public function setHorario($arg)
	{
		$this->horario = ($arg == "") ? NULL : $arg;
	}
 	
	public function getHorario()
	{
		return $this->horario;
	}
 	
	public function setDose($arg)
	{
		$this->dose = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDose()
	{
		return $this->dose;
	}

	public function setUnidadeMedida($arg)
	{
		$this->unidade_medida_id = ($arg == "") ? NULL : $arg;
	}
 	
	public function getUnidadeMedida()
	{
		return $this->unidade_medida_id;
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
		INSERT INTO paciente_medicamentos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_paciente = :id_paciente";
		 $sql .= ",id_medicamento = :id_medicamento";
		 $sql .= ",id_via = :id_via";
		 $sql .= ",id_efetivo = :id_efetivo";
		 $sql .= ",horario = :horario";
		 $sql .= ",dose = :dose";
		 $sql .= ",unidade_medida_id = :unidade_medida_id";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
		 $stmt->bindParam(":id_medicamento",$this->id_medicamento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_via",$this->id_via,PDO::PARAM_INT);
		 $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
		 $stmt->bindParam(":horario",$this->horario,PDO::PARAM_STR);
		 $stmt->bindParam(":dose",$this->dose,PDO::PARAM_INT);
		 $stmt->bindParam(":unidade_medida_id",$this->unidade_medida_id,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE paciente_medicamentos SET id_paciente = :id_paciente';
		 $sql .= ",id_medicamento = :id_medicamento";
		 $sql .= ",id_via = :id_via";
		 $sql .= ",id_efetivo = :id_efetivo";
		 $sql .= ",horario = :horario";
		 $sql .= ",dose = :dose";
		 $sql .= ",unidade_medida_id = :unidade_medida_id";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
		 $stmt->bindParam(":id_medicamento",$this->id_medicamento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_via",$this->id_via,PDO::PARAM_INT);
		 $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
		 $stmt->bindParam(":horario",$this->horario,PDO::PARAM_STR);
		 $stmt->bindParam(":dose",$this->dose,PDO::PARAM_INT);
		 $stmt->bindParam(":unidade_medida_id",$this->unidade_medida_id,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM paciente_medicamentos WHERE id IN({$lista})";
		$sql = "UPDATE paciente_medicamentos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}
    public function RemoverNotIn($lista,$id_paciente)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "UPDATE paciente_medicamentos SET excluido = UTC_TIMESTAMP() WHERE id NOT IN({$lista}) AND id_paciente = $id_paciente";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE paciente_medicamentos.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND paciente_medicamentos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_medicamentos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM paciente_medicamentos
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
				paciente_medicamentos.*
			FROM paciente_medicamentos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente_medicamentos.id DESC";
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
		$sql = "SELECT * FROM paciente_medicamentos WHERE id_paciente = :id AND excluido IS NULL";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id_paciente,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM paciente_medicamentos WHERE excluido IS NULL";
            if($id != "") $sql .= " AND paciente_medicamentos.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         paciente_medicamentos.id,
                         paciente_medicamentos.nome  AS text
                     FROM paciente_medicamentos
                     WHERE paciente_medicamentos.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (paciente_medicamentos.nome LIKE '%$busca%' OR paciente_medicamentos.id  LIKE '%$busca%') ";
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
    
            $objPacienteMedicamentos= new PacienteMedicamentos();
            $registros = $objPacienteMedicamentos->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
