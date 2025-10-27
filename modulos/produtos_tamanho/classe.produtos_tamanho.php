<?php
class ProdutosTamanho
{
	private $id;
	private $nome;
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
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
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
		INSERT INTO produtos_tamanho SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",nome = :nome";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE produtos_tamanho SET nome = :nome ';

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM produtos_tamanho WHERE id IN({$lista})";
		$sql = "UPDATE produtos_tamanho SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($param)
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE produtos_tamanho.excluido IS NULL
		";
		
		//if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
		if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND produtos_tamanho.data_hora_cadastro >='{$param['data_hora_inicio']}' AND produtos_tamanho.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM produtos_tamanho
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
				produtos_tamanho.*
			FROM produtos_tamanho
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY produtos_tamanho.id DESC";
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
		$sql = "SELECT * FROM produtos_tamanho WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM produtos_tamanho WHERE excluido IS NULL";
            if($id != "") $sql .= " AND produtos_tamanho.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         produtos_tamanho.id,
                         produtos_tamanho.nome  AS text
                     FROM produtos_tamanho
                     WHERE produtos_tamanho.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (produtos_tamanho.nome LIKE '%$busca%' OR produtos_tamanho.id  LIKE '%$busca%') ";
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
    
            $objProdutosTamanho= new ProdutosTamanho();
            $registros = $objProdutosTamanho->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
