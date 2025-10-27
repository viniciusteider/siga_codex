<?php
class AlmoxarifadoTransferenciaEstoque
{
	private $id;
	private $id_grupo;
	private $id_usuario;
	private $id_produto;
	private $id_almoxarifado;
	private $id_tipo_movimento;
	private $id_almoxarifado_destino;
	private $estoque_atual;
	private $data_movimento;
	private $quantidade_tranferir;
	private $excluido;
	private $data_hora_cadastro;
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
 	
	public function setIdUsuario($arg)
	{
		$this->id_usuario = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdUsuario()
	{
		return $this->id_usuario;
	}
 	
	public function setIdProduto($arg)
	{
		$this->id_produto = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdProduto()
	{
		return $this->id_produto;
	}
 	
	public function setIdAlmoxarifado($arg)
	{
		$this->id_almoxarifado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAlmoxarifado()
	{
		return $this->id_almoxarifado;
	}
 	
	public function setIdTipoMovimento($arg)
	{
		$this->id_tipo_movimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoMovimento()
	{
		return $this->id_tipo_movimento;
	}
 	
	public function setIdAlmoxarifadoDestino($arg)
	{
		$this->id_almoxarifado_destino = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAlmoxarifadoDestino()
	{
		return $this->id_almoxarifado_destino;
	}
 	
	public function setEstoqueAtual($arg)
	{
		$this->estoque_atual = ($arg == "") ? NULL : $arg;
	}
 	
	public function getEstoqueAtual()
	{
		return $this->estoque_atual;
	}
 	
	public function setDataMovimento($arg)
	{
		$this->data_movimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataMovimento()
	{
		return $this->data_movimento;
	}
 	
	public function setQuantidadeTranferir($arg)
	{
		$this->quantidade_tranferir = ($arg == "") ? NULL : $arg;
	}
 	
	public function getQuantidadeTranferir()
	{
		return $this->quantidade_tranferir;
	}
 	
	public function setExcluido($arg)
	{
		$this->excluido = ($arg == "") ? NULL : $arg;
	}
 	
	public function getExcluido()
	{
		return $this->excluido;
	}
 	
	public function setDataHoraCadastro($arg)
	{
		$this->data_hora_cadastro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraCadastro()
	{
		return $this->data_hora_cadastro;
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
		INSERT INTO almoxarifado_transferencia_estoque SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",id_usuario = :id_usuario";
		 $sql .= ",id_produto = :id_produto";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";
		 $sql .= ",id_tipo_movimento = :id_tipo_movimento";
		 $sql .= ",id_almoxarifado_destino = :id_almoxarifado_destino";
		 $sql .= ",estoque_atual = :estoque_atual";
		 $sql .= ",data_movimento = :data_movimento";
		 $sql .= ",quantidade_tranferir = :quantidade_tranferir";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_movimento",$this->id_tipo_movimento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado_destino",$this->id_almoxarifado_destino,PDO::PARAM_INT);
		 $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
		 $stmt->bindParam(":data_movimento",$this->data_movimento,PDO::PARAM_STR);
		 $stmt->bindParam(":quantidade_tranferir",$this->quantidade_tranferir,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE almoxarifado_transferencia_estoque SET 
			';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",id_usuario = :id_usuario";
		 $sql .= ",id_produto = :id_produto";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";
		 $sql .= ",id_tipo_movimento = :id_tipo_movimento";
		 $sql .= ",id_almoxarifado_destino = :id_almoxarifado_destino";
		 $sql .= ",estoque_atual = :estoque_atual";
		 $sql .= ",data_movimento = :data_movimento";
		 $sql .= ",quantidade_tranferir = :quantidade_tranferir";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_movimento",$this->id_tipo_movimento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado_destino",$this->id_almoxarifado_destino,PDO::PARAM_INT);
		 $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
		 $stmt->bindParam(":data_movimento",$this->data_movimento,PDO::PARAM_STR);
		 $stmt->bindParam(":quantidade_tranferir",$this->quantidade_tranferir,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM almoxarifado_transferencia_estoque WHERE id IN({$lista})";
		$sql = "UPDATE almoxarifado_transferencia_estoque SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE almoxarifado_transferencia_estoque.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND almoxarifado_transferencia_estoque.data_hora_cadastro >='{$param['data_hora_inicio']}' AND almoxarifado_transferencia_estoque.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM almoxarifado_transferencia_estoque
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
				almoxarifado_transferencia_estoque.*
			FROM almoxarifado_transferencia_estoque
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY almoxarifado_transferencia_estoque.id DESC";
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
		$sql = "SELECT * FROM almoxarifado_transferencia_estoque WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM almoxarifado_transferencia_estoque WHERE excluido IS NULL";
            if($id != "") $sql .= " AND almoxarifado_transferencia_estoque.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         almoxarifado_transferencia_estoque.id,
                         almoxarifado_transferencia_estoque.nome  AS text
                     FROM almoxarifado_transferencia_estoque
                     WHERE almoxarifado_transferencia_estoque.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (almoxarifado_transferencia_estoque.nome LIKE '%$busca%' OR almoxarifado_transferencia_estoque.id  LIKE '%$busca%') ";
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
    
            $objAlmoxarifadoTransferenciaEstoque= new AlmoxarifadoTransferenciaEstoque();
            $registros = $objAlmoxarifadoTransferenciaEstoque->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
