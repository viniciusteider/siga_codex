<?php
class AlmoxarifadoControleEstoque
{
	private $id;
	private $id_produto;
	private $id_modelo;
	private $id_tamanho;
	private $id_controle_estoque;
	private $quantidade_estoque;
	private $id_cor;
	private $id_revestimento;
	private $id_almoxarifado;
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
 	
	public function setIdProduto($arg)
	{
		$this->id_produto = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdProduto()
	{
		return $this->id_produto;
	}
 	
	public function setIdModelo($arg)
	{
		$this->id_modelo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdModelo()
	{
		return $this->id_modelo;
	}
 	
	public function setIdTamanho($arg)
	{
		$this->id_tamanho = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTamanho()
	{
		return $this->id_tamanho;
	}
 	
	public function setIdControleEstoque($arg)
	{
		$this->id_controle_estoque = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdControleEstoque()
	{
		return $this->id_controle_estoque;
	}
 	
	public function setQuantidadeEstoque($arg)
	{
		$this->quantidade_estoque = ($arg == "") ? NULL : $arg;
	}
 	
	public function getQuantidadeEstoque()
	{
		return $this->quantidade_estoque;
	}
 	
	public function setIdCor($arg)
	{
		$this->id_cor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCor()
	{
		return $this->id_cor;
	}
 	
	public function setIdRevestimento($arg)
	{
		$this->id_revestimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdRevestimento()
	{
		return $this->id_revestimento;
	}
 	
	public function setIdAlmoxarifado($arg)
	{
		$this->id_almoxarifado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAlmoxarifado()
	{
		return $this->id_almoxarifado;
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
		INSERT INTO almoxarifado_controle_estoque SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_produto = :id_produto";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",id_tamanho = :id_tamanho";
		 $sql .= ",id_controle_estoque = :id_controle_estoque";
		 $sql .= ",quantidade_estoque = :quantidade_estoque";
		 $sql .= ",id_cor = :id_cor";
		 $sql .= ",id_revestimento = :id_revestimento";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tamanho",$this->id_tamanho,PDO::PARAM_INT);
		 $stmt->bindParam(":id_controle_estoque",$this->id_controle_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":quantidade_estoque",$this->quantidade_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cor",$this->id_cor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_revestimento",$this->id_revestimento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE almoxarifado_controle_estoque SET 
			';
		 $sql .= ",id_produto = :id_produto";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",id_tamanho = :id_tamanho";
		 $sql .= ",id_controle_estoque = :id_controle_estoque";
		 $sql .= ",quantidade_estoque = :quantidade_estoque";
		 $sql .= ",id_cor = :id_cor";
		 $sql .= ",id_revestimento = :id_revestimento";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tamanho",$this->id_tamanho,PDO::PARAM_INT);
		 $stmt->bindParam(":id_controle_estoque",$this->id_controle_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":quantidade_estoque",$this->quantidade_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cor",$this->id_cor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_revestimento",$this->id_revestimento,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM almoxarifado_controle_estoque WHERE id IN({$lista})";
		$sql = "UPDATE almoxarifado_controle_estoque SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE almoxarifado_controle_estoque.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND almoxarifado_controle_estoque.data_hora_cadastro >='{$param['data_hora_inicio']}' AND almoxarifado_controle_estoque.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM almoxarifado_controle_estoque
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
				almoxarifado_controle_estoque.*
			FROM almoxarifado_controle_estoque
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY almoxarifado_controle_estoque.id DESC";
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
		$sql = "SELECT * FROM almoxarifado_controle_estoque WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM almoxarifado_controle_estoque WHERE excluido IS NULL";
            if($id != "") $sql .= " AND almoxarifado_controle_estoque.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         almoxarifado_controle_estoque.id,
                         almoxarifado_controle_estoque.nome  AS text
                     FROM almoxarifado_controle_estoque
                     WHERE almoxarifado_controle_estoque.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (almoxarifado_controle_estoque.nome LIKE '%$busca%' OR almoxarifado_controle_estoque.id  LIKE '%$busca%') ";
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
    
            $objAlmoxarifadoControleEstoque= new AlmoxarifadoControleEstoque();
            $registros = $objAlmoxarifadoControleEstoque->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
