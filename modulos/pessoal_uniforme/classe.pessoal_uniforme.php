<?php
class PessoalUniforme
{
	private $id;
	private $id_usuario;
	private $id_peca;
	private $id_tamanho;
	private $data_hora_cadastro;
	private $resp_casdastro;
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
 	
	public function setIdUsuario($arg)
	{
		$this->id_usuario = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdUsuario()
	{
		return $this->id_usuario;
	}
 	
	public function setIdPeca($arg)
	{
		$this->id_peca = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdPeca()
	{
		return $this->id_peca;
	}
 	
	public function setIdTamanho($arg)
	{
		$this->id_tamanho = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTamanho()
	{
		return $this->id_tamanho;
	}
 	
	public function setDataHoraCadastro($arg)
	{
		$this->data_hora_cadastro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraCadastro()
	{
		return $this->data_hora_cadastro;
	}
 	
	public function setRespCasdastro($arg)
	{
		$this->resp_casdastro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getRespCasdastro()
	{
		return $this->resp_casdastro;
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
		INSERT INTO pessoal_uniforme SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_usuario = :id_usuario";
		 $sql .= ",id_peca = :id_peca";
		 $sql .= ",id_tamanho = :id_tamanho";
		 $sql .= ",resp_casdastro = :resp_casdastro";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_peca",$this->id_peca,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tamanho",$this->id_tamanho,PDO::PARAM_INT);
		 $stmt->bindParam(":resp_casdastro",$this->resp_casdastro,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal_uniforme SET id_usuario = :id_usuario';
		 $sql .= ",id_peca = :id_peca";
		 $sql .= ",id_tamanho = :id_tamanho";
		 $sql .= ",resp_casdastro = :resp_casdastro";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_peca",$this->id_peca,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tamanho",$this->id_tamanho,PDO::PARAM_INT);
		 $stmt->bindParam(":resp_casdastro",$this->resp_casdastro,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal_uniforme WHERE id IN({$lista})";
		$sql = "UPDATE pessoal_uniforme SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_usuario,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN uniforme_peca ON(uniforme_peca.id = pessoal_uniforme.id_peca)
		INNER JOIN uniforme_tamanho ON(uniforme_tamanho.id = pessoal_uniforme.id_tamanho)
		INNER JOIN usuario ON(usuario.id = pessoal_uniforme.resp_casdastro)
		";
		
		$where = "
			WHERE pessoal_uniforme.excluido IS NULL AND pessoal_uniforme.id_usuario = $id_usuario
		";
		if($busca != "") $where .= " AND (nome LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal_uniforme
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
				pessoal_uniforme.*,
			uniforme_peca.nome as nome_peca,
			uniforme_tamanho.nome as nome_tamanho,
			usuario.nome as responsavel
			FROM pessoal_uniforme
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal_uniforme.id DESC";
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
		$sql = "SELECT * FROM pessoal_uniforme WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM pessoal_uniforme WHERE excluido IS NULL";
            if($id != "") $sql .= " AND pessoal_uniforme.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         pessoal_uniforme.id,
                         pessoal_uniforme.nome  AS text
                     FROM pessoal_uniforme
                     WHERE pessoal_uniforme.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (pessoal_uniforme.nome LIKE '%$busca%' OR pessoal_uniforme.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
