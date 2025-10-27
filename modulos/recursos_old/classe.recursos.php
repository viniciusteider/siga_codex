<?php
class Recursos
{
	private $id;
	private $id_grupo;
	private $prefixo;
	private $id_tipo_recurso;
	private $placa;
	private $id_modelo;
	private $ano_modelo;
	private $ano_fabricacao;
	private $renavam;
	private $chassi;
	private $cor;
	private $id_consorcio;
	private $id_base;
	private $foto_frente;
	private $foto_traseira;
	private $foto_direita;
	private $foto_esquerda;
	private $data_carga;
	private $observacao;
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
 	
	public function setPrefixo($arg)
	{
		$this->prefixo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getPrefixo()
	{
		return $this->prefixo;
	}
 	
	public function setIdTipoRecurso($arg)
	{
		$this->id_tipo_recurso = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoRecurso()
	{
		return $this->id_tipo_recurso;
	}
 	
	public function setPlaca($arg)
	{
		$this->placa = ($arg == "") ? NULL : $arg;
	}
 	
	public function getPlaca()
	{
		return $this->placa;
	}
 	
	public function setIdModelo($arg)
	{
		$this->id_modelo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdModelo()
	{
		return $this->id_modelo;
	}
 	
	public function setAnoModelo($arg)
	{
		$this->ano_modelo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getAnoModelo()
	{
		return $this->ano_modelo;
	}
 	
	public function setAnoFabricacao($arg)
	{
		$this->ano_fabricacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getAnoFabricacao()
	{
		return $this->ano_fabricacao;
	}
 	
	public function setRenavam($arg)
	{
		$this->renavam = ($arg == "") ? NULL : $arg;
	}
 	
	public function getRenavam()
	{
		return $this->renavam;
	}
 	
	public function setChassi($arg)
	{
		$this->chassi = ($arg == "") ? NULL : $arg;
	}
 	
	public function getChassi()
	{
		return $this->chassi;
	}
 	
	public function setCor($arg)
	{
		$this->cor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCor()
	{
		return $this->cor;
	}
 	
	public function setIdConsorcio($arg)
	{
		$this->id_consorcio = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdConsorcio()
	{
		return $this->id_consorcio;
	}
 	
	public function setIdBase($arg)
	{
		$this->id_base = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdBase()
	{
		return $this->id_base;
	}
 	
	public function setFotoFrente($arg)
	{
		$this->foto_frente = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFotoFrente()
	{
		return $this->foto_frente;
	}
 	
	public function setFotoTraseira($arg)
	{
		$this->foto_traseira = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFotoTraseira()
	{
		return $this->foto_traseira;
	}
 	
	public function setFotoDireita($arg)
	{
		$this->foto_direita = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFotoDireita()
	{
		return $this->foto_direita;
	}
 	
	public function setFotoEsquerda($arg)
	{
		$this->foto_esquerda = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFotoEsquerda()
	{
		return $this->foto_esquerda;
	}
 	
	public function setDataCarga($arg)
	{
		$this->data_carga = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataCarga()
	{
		return $this->data_carga;
	}
 	
	public function setObservacao($arg)
	{
		$this->observacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getObservacao()
	{
		return $this->observacao;
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
		INSERT INTO recursos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",prefixo = :prefixo";
		 $sql .= ",id_tipo_recurso = :id_tipo_recurso";
		 $sql .= ",placa = :placa";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",ano_modelo = :ano_modelo";
		 $sql .= ",ano_fabricacao = :ano_fabricacao";
		 $sql .= ",renavam = :renavam";
		 $sql .= ",chassi = :chassi";
		 $sql .= ",cor = :cor";
		 $sql .= ",id_consorcio = :id_consorcio";
		 $sql .= ",id_base = :id_base";
		 $sql .= ",foto_frente = :foto_frente";
		 $sql .= ",foto_traseira = :foto_traseira";
		 $sql .= ",foto_direita = :foto_direita";
		 $sql .= ",foto_esquerda = :foto_esquerda";
		 $sql .= ",data_carga = :data_carga";
		 $sql .= ",observacao = :observacao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":prefixo",$this->prefixo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_recurso",$this->id_tipo_recurso,PDO::PARAM_INT);
		 $stmt->bindParam(":placa",$this->placa,PDO::PARAM_STR);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":ano_modelo",$this->ano_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":ano_fabricacao",$this->ano_fabricacao,PDO::PARAM_INT);
		 $stmt->bindParam(":renavam",$this->renavam,PDO::PARAM_STR);
		 $stmt->bindParam(":chassi",$this->chassi,PDO::PARAM_STR);
		 $stmt->bindParam(":cor",$this->cor,PDO::PARAM_STR);
		 $stmt->bindParam(":id_consorcio",$this->id_consorcio,PDO::PARAM_INT);
		 $stmt->bindParam(":id_base",$this->id_base,PDO::PARAM_INT);
		 $stmt->bindParam(":foto_frente",$this->foto_frente,PDO::PARAM_STR);
		 $stmt->bindParam(":foto_traseira",$this->foto_traseira,PDO::PARAM_STR);
		 $stmt->bindParam(":foto_direita",$this->foto_direita,PDO::PARAM_STR);
		 $stmt->bindParam(":foto_esquerda",$this->foto_esquerda,PDO::PARAM_STR);
		 $stmt->bindParam(":data_carga",$this->data_carga,PDO::PARAM_STR);
		 $stmt->bindParam(":observacao",$this->observacao,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE recursos SET prefixo = :prefixo';
		 $sql .= ",id_tipo_recurso = :id_tipo_recurso";
		 $sql .= ",placa = :placa";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",ano_modelo = :ano_modelo";
		 $sql .= ",ano_fabricacao = :ano_fabricacao";
		 $sql .= ",renavam = :renavam";
		 $sql .= ",chassi = :chassi";
		 $sql .= ",cor = :cor";
		 $sql .= ",id_consorcio = :id_consorcio";
		 $sql .= ",id_base = :id_base";
		 $sql .= ",foto_frente = :foto_frente";
		 $sql .= ",foto_traseira = :foto_traseira";
		 $sql .= ",foto_direita = :foto_direita";
		 $sql .= ",foto_esquerda = :foto_esquerda";
		 $sql .= ",data_carga = :data_carga";
		 $sql .= ",observacao = :observacao";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":prefixo",$this->prefixo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_recurso",$this->id_tipo_recurso,PDO::PARAM_INT);
		 $stmt->bindParam(":placa",$this->placa,PDO::PARAM_STR);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":ano_modelo",$this->ano_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":ano_fabricacao",$this->ano_fabricacao,PDO::PARAM_INT);
		 $stmt->bindParam(":renavam",$this->renavam,PDO::PARAM_STR);
		 $stmt->bindParam(":chassi",$this->chassi,PDO::PARAM_STR);
		 $stmt->bindParam(":cor",$this->cor,PDO::PARAM_STR);
		 $stmt->bindParam(":id_consorcio",$this->id_consorcio,PDO::PARAM_INT);
		 $stmt->bindParam(":id_base",$this->id_base,PDO::PARAM_INT);
		 $stmt->bindParam(":foto_frente",$this->foto_frente,PDO::PARAM_STR);
		 $stmt->bindParam(":foto_traseira",$this->foto_traseira,PDO::PARAM_STR);
		 $stmt->bindParam(":foto_direita",$this->foto_direita,PDO::PARAM_STR);
		 $stmt->bindParam(":foto_esquerda",$this->foto_esquerda,PDO::PARAM_STR);
		 $stmt->bindParam(":data_carga",$this->data_carga,PDO::PARAM_STR);
		 $stmt->bindParam(":observacao",$this->observacao,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM recursos WHERE id IN({$lista})";
		$sql = "UPDATE recursos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();

		$joins = "
		INNER JOIN prefixo ON (prefixo.id = recursos.prefixo)
		INNER JOIN grupo ON  (grupo.id = recursos.id_grupo)
		";
		
		$where = "
			WHERE recursos.id > 0
		";
		
		if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND recursos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND recursos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM recursos
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
				recursos.*,
			    prefixo.nome as nome_prefixo
			FROM recursos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY recursos.id DESC";
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
		$sql = "SELECT recursos.*, marca.id as id_marca  FROM recursos INNER JOIN modelo ON(modelo.id = recursos.id_modelo) INNER JOIN marca ON(marca.id = modelo.id_marca) WHERE recursos.id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
}
