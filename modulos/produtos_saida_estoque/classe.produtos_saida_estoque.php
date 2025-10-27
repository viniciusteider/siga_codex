<?php
class ProdutosSaidaEstoque
{
	private $id;
	private $id_agente;
	private $id_setor;
	private $data_retirada;
	private $data_devolucao;
	private $local_uso;
	private $finalidade;
	private $id_grupo;
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
 	
	public function setIdAgente($arg)
	{
		$this->id_agente = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAgente()
	{
		return $this->id_agente;
	}
 	
	public function setIdSetor($arg)
	{
		$this->id_setor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdSetor()
	{
		return $this->id_setor;
	}
 	
	public function setDataRetirada($arg)
	{
		$this->data_retirada = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataRetirada()
	{
		return $this->data_retirada;
	}
 	
	public function setDataDevolucao($arg)
	{
		$this->data_devolucao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataDevolucao()
	{
		return $this->data_devolucao;
	}
 	
	public function setLocalUso($arg)
	{
		$this->local_uso = ($arg == "") ? NULL : $arg;
	}
 	
	public function getLocalUso()
	{
		return $this->local_uso;
	}
 	
	public function setFinalidade($arg)
	{
		$this->finalidade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFinalidade()
	{
		return $this->finalidade;
	}
 	
	public function setIdGrupo($arg)
	{
		$this->id_grupo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdGrupo()
	{
		return $this->id_grupo;
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
		INSERT INTO produtos_saida_estoque SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_agente = :id_agente";
		 $sql .= ",id_setor = :id_setor";
		 $sql .= ",data_retirada = :data_retirada";
		 $sql .= ",data_devolucao = :data_devolucao";
		 $sql .= ",local_uso = :local_uso";
		 $sql .= ",finalidade = :finalidade";
		 $sql .= ",id_grupo = :id_grupo";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_agente",$this->id_agente,PDO::PARAM_INT);
		 $stmt->bindParam(":id_setor",$this->id_setor,PDO::PARAM_INT);
		 $stmt->bindParam(":data_retirada",$this->data_retirada,PDO::PARAM_STR);
		 $stmt->bindParam(":data_devolucao",$this->data_devolucao,PDO::PARAM_STR);
		 $stmt->bindParam(":local_uso",$this->local_uso,PDO::PARAM_STR);
		 $stmt->bindParam(":finalidade",$this->finalidade,PDO::PARAM_STR);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE produtos_saida_estoque SET 
			';
		 $sql .= ",id_agente = :id_agente";
		 $sql .= ",id_setor = :id_setor";
		 $sql .= ",data_retirada = :data_retirada";
		 $sql .= ",data_devolucao = :data_devolucao";
		 $sql .= ",local_uso = :local_uso";
		 $sql .= ",finalidade = :finalidade";
		 $sql .= ",id_grupo = :id_grupo";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_agente",$this->id_agente,PDO::PARAM_INT);
		 $stmt->bindParam(":id_setor",$this->id_setor,PDO::PARAM_INT);
		 $stmt->bindParam(":data_retirada",$this->data_retirada,PDO::PARAM_STR);
		 $stmt->bindParam(":data_devolucao",$this->data_devolucao,PDO::PARAM_STR);
		 $stmt->bindParam(":local_uso",$this->local_uso,PDO::PARAM_STR);
		 $stmt->bindParam(":finalidade",$this->finalidade,PDO::PARAM_STR);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM produtos_saida_estoque WHERE id IN({$lista})";
		$sql = "UPDATE produtos_saida_estoque SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($param)
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE produtos_saida_estoque.excluido IS NULL
		";
		
		//if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
		if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND produtos_saida_estoque.data_hora_cadastro >='{$param['data_hora_inicio']}' AND produtos_saida_estoque.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM produtos_saida_estoque
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
				produtos_saida_estoque.*
			FROM produtos_saida_estoque
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY produtos_saida_estoque.id DESC";
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
		$sql = "SELECT * FROM produtos_saida_estoque WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM produtos_saida_estoque WHERE excluido IS NULL";
            if($id != "") $sql .= " AND produtos_saida_estoque.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         produtos_saida_estoque.id,
                         produtos_saida_estoque.nome  AS text
                     FROM produtos_saida_estoque
                     WHERE produtos_saida_estoque.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (produtos_saida_estoque.nome LIKE '%$busca%' OR produtos_saida_estoque.id  LIKE '%$busca%') ";
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
    
            $objProdutosSaidaEstoque= new ProdutosSaidaEstoque();
            $registros = $objProdutosSaidaEstoque->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
