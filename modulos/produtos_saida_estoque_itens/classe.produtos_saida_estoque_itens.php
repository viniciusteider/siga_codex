<?php
class ProdutosSaidaEstoqueItens
{
	private $id;
	private $id_produto;
	private $id_cautela;
	private $quantidade;
	private $id_modelo;
	private $id_tamanho;
	private $id_cor;
	private $id_almoxarifado;
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
 	
	public function setIdProduto($arg)
	{
		$this->id_produto = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdProduto()
	{
		return $this->id_produto;
	}
 	
	public function setIdCautela($arg)
	{
		$this->id_cautela = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCautela()
	{
		return $this->id_cautela;
	}
 	
	public function setQuantidade($arg)
	{
		$this->quantidade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getQuantidade()
	{
		return $this->quantidade;
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
 	
	public function setIdCor($arg)
	{
		$this->id_cor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCor()
	{
		return $this->id_cor;
	}
 	
	public function setIdAlmoxarifado($arg)
	{
		$this->id_almoxarifado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAlmoxarifado()
	{
		return $this->id_almoxarifado;
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
		INSERT INTO produtos_saida_estoque_itens SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_produto = :id_produto";
		 $sql .= ",id_cautela = :id_cautela";
		 $sql .= ",quantidade = :quantidade";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",id_tamanho = :id_tamanho";
		 $sql .= ",id_cor = :id_cor";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cautela",$this->id_cautela,PDO::PARAM_INT);
		 $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tamanho",$this->id_tamanho,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cor",$this->id_cor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE produtos_saida_estoque_itens SET 
			';
		 $sql .= ",id_produto = :id_produto";
		 $sql .= ",id_cautela = :id_cautela";
		 $sql .= ",quantidade = :quantidade";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",id_tamanho = :id_tamanho";
		 $sql .= ",id_cor = :id_cor";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cautela",$this->id_cautela,PDO::PARAM_INT);
		 $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tamanho",$this->id_tamanho,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cor",$this->id_cor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM produtos_saida_estoque_itens WHERE id IN({$lista})";
		$sql = "UPDATE produtos_saida_estoque_itens SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($param)
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE produtos_saida_estoque_itens.excluido IS NULL
		";
		
		//if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
		if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND produtos_saida_estoque_itens.data_hora_cadastro >='{$param['data_hora_inicio']}' AND produtos_saida_estoque_itens.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM produtos_saida_estoque_itens
			$joins
			$where
		";

		$stmt = $pdo->prepare($sql);

		if($param["busca"] != "") {
			$busca = "%".$param["busca"]."%";
			$stmt->bindParam(":busca",$busca,PDO::PARAM_STR);
		}

		$stmt->execute();
		$totalRegistros = $stmt->fetch(PDO::FETCH_OBJ)->total;

		$sql = "
			SELECT 
				produtos_saida_estoque_itens.*
			FROM produtos_saida_estoque_itens
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY produtos_saida_estoque_itens.id DESC";
		$sql .= " LIMIT :offset,:limit";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":offset",$param["numero_inicio_registro"],PDO::PARAM_INT);
		$stmt->bindParam(":limit",$param["numero_registros"],PDO::PARAM_INT);

		if($param["busca"] != "") {
			$busca = "%".$param["busca"]."%";
			$stmt->bindParam(":busca",$busca,PDO::PARAM_STR);
		}

		$stmt->execute();
		$linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return [$linhas,$totalRegistros];
	}

	public function Editar()
	{
		$pdo = $this->getConexao();
		$sql = "SELECT * FROM produtos_saida_estoque_itens WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM produtos_saida_estoque_itens WHERE excluido IS NULL";
            if($id != "") $sql .= " AND produtos_saida_estoque_itens.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         produtos_saida_estoque_itens.id,
                         produtos_saida_estoque_itens.nome  AS text
                     FROM produtos_saida_estoque_itens
                     WHERE produtos_saida_estoque_itens.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (produtos_saida_estoque_itens.nome LIKE '%$busca%' OR produtos_saida_estoque_itens.id  LIKE '%$busca%') ";
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
    
            $objProdutosSaidaEstoqueItens= new ProdutosSaidaEstoqueItens();
            $registros = $objProdutosSaidaEstoqueItens->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
