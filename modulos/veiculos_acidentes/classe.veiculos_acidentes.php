<?php
class VeiculosAcidentes
{
	private $id;
	private $id_ocorrencia;
	private $id_tipo_veiculo;
	private $condutor;
	private $cnh_condutor;
	private $proprietario;
	private $id_tipo_destruicao;
	private $destruicao_descricao;
	private $seguradora;
	private $carga_perigosa;
	private $placa_veiculo;
	private $id_marca;
	private $id_modelo;
	private $id_ano;
	private $cor;
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
 	
	public function setIdOcorrencia($arg)
	{
		$this->id_ocorrencia = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdOcorrencia()
	{
		return $this->id_ocorrencia;
	}
 	
	public function setIdTipoVeiculo($arg)
	{
		$this->id_tipo_veiculo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoVeiculo()
	{
		return $this->id_tipo_veiculo;
	}
 	
	public function setCondutor($arg)
	{
		$this->condutor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCondutor()
	{
		return $this->condutor;
	}
 	
	public function setCnhCondutor($arg)
	{
		$this->cnh_condutor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCnhCondutor()
	{
		return $this->cnh_condutor;
	}
 	
	public function setProprietario($arg)
	{
		$this->proprietario = ($arg == "") ? NULL : $arg;
	}
 	
	public function getProprietario()
	{
		return $this->proprietario;
	}
 	
	public function setIdTipoDestruicao($arg)
	{
		$this->id_tipo_destruicao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoDestruicao()
	{
		return $this->id_tipo_destruicao;
	}
 	
	public function setDestruicaoDescricao($arg)
	{
		$this->destruicao_descricao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDestruicaoDescricao()
	{
		return $this->destruicao_descricao;
	}
 	
	public function setSeguradora($arg)
	{
		$this->seguradora = ($arg == "") ? NULL : $arg;
	}
 	
	public function getSeguradora()
	{
		return $this->seguradora;
	}
 	
	public function setCargaPerigosa($arg)
	{
		$this->carga_perigosa = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCargaPerigosa()
	{
		return $this->carga_perigosa;
	}
 	
	public function setPlacaVeiculo($arg)
	{
		$this->placa_veiculo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getPlacaVeiculo()
	{
		return $this->placa_veiculo;
	}
 	
	public function setIdMarca($arg)
	{
		$this->id_marca = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdMarca()
	{
		return $this->id_marca;
	}
 	
	public function setIdModelo($arg)
	{
		$this->id_modelo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdModelo()
	{
		return $this->id_modelo;
	}
 	
	public function setIdAno($arg)
	{
		$this->id_ano = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAno()
	{
		return $this->id_ano;
	}
 	
	public function setCor($arg)
	{
		$this->cor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCor()
	{
		return $this->cor;
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
		INSERT INTO veiculos_acidentes SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_ocorrencia = :id_ocorrencia";
		 $sql .= ",id_tipo_veiculo = :id_tipo_veiculo";
		 $sql .= ",condutor = :condutor";
		 $sql .= ",cnh_condutor = :cnh_condutor";
		 $sql .= ",proprietario = :proprietario";
		 $sql .= ",id_tipo_destruicao = :id_tipo_destruicao";
		 $sql .= ",destruicao_descricao = :destruicao_descricao";
		 $sql .= ",seguradora = :seguradora";
		 $sql .= ",carga_perigosa = :carga_perigosa";
		 $sql .= ",placa_veiculo = :placa_veiculo";
		 $sql .= ",id_marca = :id_marca";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",id_ano = :id_ano";
		 $sql .= ",cor = :cor";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_veiculo",$this->id_tipo_veiculo,PDO::PARAM_INT);
		 $stmt->bindParam(":condutor",$this->condutor,PDO::PARAM_STR);
		 $stmt->bindParam(":cnh_condutor",$this->cnh_condutor,PDO::PARAM_STR);
		 $stmt->bindParam(":proprietario",$this->proprietario,PDO::PARAM_STR);
		 $stmt->bindParam(":id_tipo_destruicao",$this->id_tipo_destruicao,PDO::PARAM_INT);
		 $stmt->bindParam(":destruicao_descricao",$this->destruicao_descricao,PDO::PARAM_STR);
		 $stmt->bindParam(":seguradora",$this->seguradora,PDO::PARAM_STR);
		 $stmt->bindParam(":carga_perigosa",$this->carga_perigosa,PDO::PARAM_STR);
		 $stmt->bindParam(":placa_veiculo",$this->placa_veiculo,PDO::PARAM_STR);
		 $stmt->bindParam(":id_marca",$this->id_marca,PDO::PARAM_INT);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_ano",$this->id_ano,PDO::PARAM_INT);
		 $stmt->bindParam(":cor",$this->cor,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE veiculos_acidentes SET id_tipo_veiculo = :id_tipo_veiculo ';
		 $sql .= ",condutor = :condutor";
		 $sql .= ",cnh_condutor = :cnh_condutor";
		 $sql .= ",proprietario = :proprietario";
		 $sql .= ",id_tipo_destruicao = :id_tipo_destruicao";
		 $sql .= ",destruicao_descricao = :destruicao_descricao";
		 $sql .= ",seguradora = :seguradora";
		 $sql .= ",carga_perigosa = :carga_perigosa";
		 $sql .= ",placa_veiculo = :placa_veiculo";
		 $sql .= ",id_marca = :id_marca";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",id_ano = :id_ano";
		 $sql .= ",cor = :cor";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_tipo_veiculo",$this->id_tipo_veiculo,PDO::PARAM_INT);
		 $stmt->bindParam(":condutor",$this->condutor,PDO::PARAM_STR);
		 $stmt->bindParam(":cnh_condutor",$this->cnh_condutor,PDO::PARAM_STR);
		 $stmt->bindParam(":proprietario",$this->proprietario,PDO::PARAM_STR);
		 $stmt->bindParam(":id_tipo_destruicao",$this->id_tipo_destruicao,PDO::PARAM_INT);
		 $stmt->bindParam(":destruicao_descricao",$this->destruicao_descricao,PDO::PARAM_STR);
		 $stmt->bindParam(":seguradora",$this->seguradora,PDO::PARAM_STR);
		 $stmt->bindParam(":carga_perigosa",$this->carga_perigosa,PDO::PARAM_STR);
		 $stmt->bindParam(":placa_veiculo",$this->placa_veiculo,PDO::PARAM_STR);
		 $stmt->bindParam(":id_marca",$this->id_marca,PDO::PARAM_INT);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_ano",$this->id_ano,PDO::PARAM_INT);
		 $stmt->bindParam(":cor",$this->cor,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM veiculos_acidentes WHERE id IN({$lista})";
		$sql = "UPDATE veiculos_acidentes SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_ocorrencia,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE veiculos_acidentes.excluido IS NULL AND veiculos_acidentes.id_ocorrencia = $id_ocorrencia
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND veiculos_acidentes.data_hora_cadastro >='{$param['data_hora_inicio']}' AND veiculos_acidentes.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM veiculos_acidentes
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
				veiculos_acidentes.*
			FROM veiculos_acidentes
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY veiculos_acidentes.id DESC";
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
		$sql = "SELECT * FROM veiculos_acidentes WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM veiculos_acidentes WHERE excluido IS NULL";
            if($id != "") $sql .= " AND veiculos_acidentes.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         veiculos_acidentes.id,
                         veiculos_acidentes.nome  AS text
                     FROM veiculos_acidentes
                     WHERE veiculos_acidentes.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (veiculos_acidentes.nome LIKE '%$busca%' OR veiculos_acidentes.id  LIKE '%$busca%') ";
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
    
            $objVeiculosAcidentes= new VeiculosAcidentes();
            $registros = $objVeiculosAcidentes->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
