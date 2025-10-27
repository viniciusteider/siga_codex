<?php
class PartesCorpo
{
	private $id;
	private $nome;
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
		INSERT INTO partes_corpo SET data_hora_cadastro = UTC_TIMESTAMP() 
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
		UPDATE partes_corpo SET 
			';
		 $sql .= ",nome = :nome";

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
		//$sql = "DELETE FROM partes_corpo WHERE id IN({$lista})";
		$sql = "UPDATE partes_corpo SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();

		$joins = "
		
		";

		$where = "
			WHERE partes_corpo.excluido IS NULL
		";

		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND partes_corpo.data_hora_cadastro >='{$param['data_hora_inicio']}' AND partes_corpo.data_hora_cadastro <= '{$param['data_hora_fim']}'";

		$sql = "
			SELECT COUNT(*) AS total
			FROM partes_corpo
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
				partes_corpo.*
			FROM partes_corpo
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY partes_corpo.id DESC";
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
		$sql = "SELECT * FROM partes_corpo WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM partes_corpo WHERE excluido IS NULL";
            if($id != "") $sql .= " AND partes_corpo.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         partes_corpo.id,
                         partes_corpo.nome  AS text
                     FROM partes_corpo
                     WHERE partes_corpo.excluido IS NULL
                     ";

            if($busca != ''){
                $sql .= " AND  (partes_corpo.nome LIKE '%$busca%' OR partes_corpo.id  LIKE '%$busca%') ";
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

            $objPartesCorpo= new PartesCorpo();
            $registros = $objPartesCorpo->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
