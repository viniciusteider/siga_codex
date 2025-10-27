<?php
class HospitalDisponibilidade
{
	private $id;
	private $id_grupo;
	private $id_hospital;
	private $complexidade;
	private $total_leitos;
	private $leitos_disponiveis;
	private $vagas_uti;
	private $uti_disponiveis;
	private $data_hora_atualizacao;
	private $id_usuario_atualizacao;
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
 	
	public function setIdGrupo($arg)
	{
		$this->id_grupo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdGrupo()
	{
		return $this->id_grupo;
	}
 	
	public function setIdHospital($arg)
	{
		$this->id_hospital = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdHospital()
	{
		return $this->id_hospital;
	}
 	
	public function setComplexidade($arg)
	{
		$this->complexidade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getComplexidade()
	{
		return $this->complexidade;
	}
 	
	public function setTotalLeitos($arg)
	{
		$this->total_leitos = ($arg == "") ? NULL : $arg;
	}
 	
	public function getTotalLeitos()
	{
		return $this->total_leitos;
	}
 	
	public function setLeitosDisponiveis($arg)
	{
		$this->leitos_disponiveis = ($arg == "") ? NULL : $arg;
	}
 	
	public function getLeitosDisponiveis()
	{
		return $this->leitos_disponiveis;
	}
 	
	public function setVagasUti($arg)
	{
		$this->vagas_uti = ($arg == "") ? NULL : $arg;
	}
 	
	public function getVagasUti()
	{
		return $this->vagas_uti;
	}
 	
	public function setUtiDisponiveis($arg)
	{
		$this->uti_disponiveis = ($arg == "") ? NULL : $arg;
	}
 	
	public function getUtiDisponiveis()
	{
		return $this->uti_disponiveis;
	}
 	
	public function setDataHoraAtualizacao($arg)
	{
		$this->data_hora_atualizacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraAtualizacao()
	{
		return $this->data_hora_atualizacao;
	}
 	
	public function setIdUsuarioAtualizacao($arg)
	{
		$this->id_usuario_atualizacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdUsuarioAtualizacao()
	{
		return $this->id_usuario_atualizacao;
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
		INSERT INTO hospital_disponibilidade SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",id_hospital = :id_hospital";
		 $sql .= ",complexidade = :complexidade";
		 $sql .= ",total_leitos = :total_leitos";
		 $sql .= ",leitos_disponiveis = :leitos_disponiveis";
		 $sql .= ",vagas_uti = :vagas_uti";
		 $sql .= ",uti_disponiveis = :uti_disponiveis";
		 $sql .= ",data_hora_atualizacao = UTC_TIMESTAMP()";
		 $sql .= ",id_usuario_atualizacao = :id_usuario_atualizacao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_hospital",$this->id_hospital,PDO::PARAM_INT);
		 $stmt->bindParam(":complexidade",$this->complexidade,PDO::PARAM_STR);
		 $stmt->bindParam(":total_leitos",$this->total_leitos,PDO::PARAM_INT);
		 $stmt->bindParam(":leitos_disponiveis",$this->leitos_disponiveis,PDO::PARAM_INT);
		 $stmt->bindParam(":vagas_uti",$this->vagas_uti,PDO::PARAM_INT);
		 $stmt->bindParam(":uti_disponiveis",$this->uti_disponiveis,PDO::PARAM_INT);
		 $stmt->bindParam(":id_usuario_atualizacao",$this->id_usuario_atualizacao,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE hospital_disponibilidade SET id_hospital = :id_hospital ';
		 $sql .= ",complexidade = :complexidade";
		 $sql .= ",total_leitos = :total_leitos";
		 $sql .= ",leitos_disponiveis = :leitos_disponiveis";
		 $sql .= ",vagas_uti = :vagas_uti";
		 $sql .= ",uti_disponiveis = :uti_disponiveis";
		 $sql .= ",data_hora_atualizacao = UTC_TIMESTAMP()";
		 $sql .= ",id_usuario_atualizacao = :id_usuario_atualizacao";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_hospital",$this->id_hospital,PDO::PARAM_INT);
		 $stmt->bindParam(":complexidade",$this->complexidade,PDO::PARAM_STR);
		 $stmt->bindParam(":total_leitos",$this->total_leitos,PDO::PARAM_INT);
		 $stmt->bindParam(":leitos_disponiveis",$this->leitos_disponiveis,PDO::PARAM_INT);
		 $stmt->bindParam(":vagas_uti",$this->vagas_uti,PDO::PARAM_INT);
		 $stmt->bindParam(":uti_disponiveis",$this->uti_disponiveis,PDO::PARAM_INT);
		 $stmt->bindParam(":id_usuario_atualizacao",$this->id_usuario_atualizacao,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM hospital_disponibilidade WHERE id IN({$lista})";
		$sql = "UPDATE hospital_disponibilidade SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN hospital ON(hospital.id = hospital_disponibilidade.id_hospital)
		INNER JOIN usuario ON(usuario.id = hospital_disponibilidade.id_usuario_atualizacao)
		";
		
		$where = "
			WHERE hospital_disponibilidade.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (hospital.nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND hospital_disponibilidade.data_hora_cadastro >='{$param['data_hora_inicio']}' AND hospital_disponibilidade.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM hospital_disponibilidade
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
				hospital_disponibilidade.*
			    ,hospital.nome as nome_hospital
			    ,usuario.nome as nome_usuario
			FROM hospital_disponibilidade
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY hospital_disponibilidade.id DESC";
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
		$sql = "SELECT * FROM hospital_disponibilidade WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM hospital_disponibilidade WHERE excluido IS NULL";
            if($id != "") $sql .= " AND hospital_disponibilidade.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         hospital_disponibilidade.id,
                         hospital_disponibilidade.nome  AS text
                     FROM hospital_disponibilidade
                     WHERE hospital_disponibilidade.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (hospital_disponibilidade.nome LIKE '%$busca%' OR hospital_disponibilidade.id  LIKE '%$busca%') ";
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
    
            $objHospitalDisponibilidade= new HospitalDisponibilidade();
            $registros = $objHospitalDisponibilidade->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
