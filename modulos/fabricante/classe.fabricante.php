<?php
class Fabricante
{
	private $id;
	private $nome;
	private $cnpj;
	private $contatos_tecnicos;
	private $contatos_comerciais;
	private $observacoes;
	private $liberado;
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
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setCnpj($arg)
	{
		$this->cnpj = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCnpj()
	{
		return $this->cnpj;
	}
 	
	public function setContatosTecnicos($arg)
	{
		$this->contatos_tecnicos = ($arg == "") ? NULL : $arg;
	}
 	
	public function getContatosTecnicos()
	{
		return $this->contatos_tecnicos;
	}
 	
	public function setContatosComerciais($arg)
	{
		$this->contatos_comerciais = ($arg == "") ? NULL : $arg;
	}
 	
	public function getContatosComerciais()
	{
		return $this->contatos_comerciais;
	}
 	
	public function setObservacoes($arg)
	{
		$this->observacoes = ($arg == "") ? NULL : $arg;
	}
 	
	public function getObservacoes()
	{
		return $this->observacoes;
	}
 	
	public function setLiberado($arg)
	{
		$this->liberado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getLiberado()
	{
		return $this->liberado;
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
		INSERT INTO fabricante SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",nome = :nome";
		 $sql .= ",cnpj = :cnpj";
		 $sql .= ",contatos_tecnicos = :contatos_tecnicos";
		 $sql .= ",contatos_comerciais = :contatos_comerciais";
		 $sql .= ",observacoes = :observacoes";
		 $sql .= ",liberado = :liberado";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":cnpj",$this->cnpj,PDO::PARAM_STR);
		 $stmt->bindParam(":contatos_tecnicos",$this->contatos_tecnicos,PDO::PARAM_STR);
		 $stmt->bindParam(":contatos_comerciais",$this->contatos_comerciais,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		 $stmt->bindParam(":liberado",$this->liberado,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE fabricante SET nome = :nome';
		 $sql .= ",cnpj = :cnpj";
		 $sql .= ",contatos_tecnicos = :contatos_tecnicos";
		 $sql .= ",contatos_comerciais = :contatos_comerciais";
		 $sql .= ",observacoes = :observacoes";
		 $sql .= ",liberado = :liberado";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":cnpj",$this->cnpj,PDO::PARAM_STR);
		 $stmt->bindParam(":contatos_tecnicos",$this->contatos_tecnicos,PDO::PARAM_STR);
		 $stmt->bindParam(":contatos_comerciais",$this->contatos_comerciais,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		 $stmt->bindParam(":liberado",$this->liberado,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM fabricante WHERE id IN({$lista})";
		$sql = "UPDATE fabricante SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($param)
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE fabricante.excluido IS NULL
		";
		
		//if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
		if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND fabricante.data_hora_cadastro >='{$param['data_hora_inicio']}' AND fabricante.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM fabricante
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
				fabricante.*
			FROM fabricante
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY fabricante.id DESC";
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
		$sql = "SELECT * FROM fabricante WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM fabricante WHERE excluido IS NULL";
            if($id != "") $sql .= " AND fabricante.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         fabricante.id,
                         fabricante.nome  AS text
                     FROM fabricante
                     WHERE fabricante.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (fabricante.nome LIKE '%$busca%' OR fabricante.id  LIKE '%$busca%') ";
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
    
            $objFabricante= new Fabricante();
            $registros = $objFabricante->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
