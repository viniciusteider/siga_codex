<?php
class Consorcio
{
	private $id_consorcio;
	private $nome_consorcio;
	private $cnpj;
	private $endereco;
	private $nr_endereco;
	private $latitude;
	private $longitudde;
	private $site;
	private $email;
	private $teledne;
	private $presidente;
	private $status;
	private $conexao;

	public function setIdConsorcio($arg)
	{
		$this->id_consorcio = $arg;
	}
 	
	public function getIdConsorcio()
	{
		return $this->id_consorcio;
	}
 	
	public function setNomeConsorcio($arg)
	{
		$this->nome_consorcio = $arg;
	}
 	
	public function getNomeConsorcio()
	{
		return $this->nome_consorcio;
	}
 	
	public function setCnpj($arg)
	{
		$this->cnpj = $arg;
	}
 	
	public function getCnpj()
	{
		return $this->cnpj;
	}
 	
	public function setEndereco($arg)
	{
		$this->endereco = $arg;
	}
 	
	public function getEndereco()
	{
		return $this->endereco;
	}
 	
	public function setNrEndereco($arg)
	{
		$this->nr_endereco = $arg;
	}
 	
	public function getNrEndereco()
	{
		return $this->nr_endereco;
	}
 	
	public function setLatitude($arg)
	{
		$this->latitude = $arg;
	}
 	
	public function getLatitude()
	{
		return $this->latitude;
	}
 	
	public function setLongitudde($arg)
	{
		$this->longitudde = $arg;
	}
 	
	public function getLongitudde()
	{
		return $this->longitudde;
	}
 	
	public function setSite($arg)
	{
		$this->site = $arg;
	}
 	
	public function getSite()
	{
		return $this->site;
	}
 	
	public function setEmail($arg)
	{
		$this->email = $arg;
	}
 	
	public function getEmail()
	{
		return $this->email;
	}
 	
	public function setTeledne($arg)
	{
		$this->teledne = $arg;
	}
 	
	public function getTeledne()
	{
		return $this->teledne;
	}
 	
	public function setPresidente($arg)
	{
		$this->presidente = $arg;
	}
 	
	public function getPresidente()
	{
		return $this->presidente;
	}
 	
	public function setStatus($arg)
	{
		$this->status = $arg;
	}
 	
	public function getStatus()
	{
		return $this->status;
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
		INSERT INTO consorcio SET  ';
		 $sql .= ",id_consorcio = :id_consorcio";
		 $sql .= ",nome_consorcio = :nome_consorcio";
		 $sql .= ",cnpj = :cnpj";
		 $sql .= ",endereco = :endereco";
		 $sql .= ",nr_endereco = :nr_endereco";
		 $sql .= ",latitude = :latitude";
		 $sql .= ",longitudde = :longitudde";
		 $sql .= ",site = :site";
		 $sql .= ",email = :email";
		 $sql .= ",teledne = :teledne";
		 $sql .= ",presidente = :presidente";
		 $sql .= ",status = :status";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_consorcio",$this->getIdConsorcio(),PDO::PARAM_INT);
		 $stmt->bindParam(":nome_consorcio",$this->getNomeConsorcio(),PDO::PARAM_STR);
		 $stmt->bindParam(":cnpj",$this->getCnpj(),PDO::PARAM_STR);
		 $stmt->bindParam(":endereco",$this->getEndereco(),PDO::PARAM_STR);
		 $stmt->bindParam(":nr_endereco",$this->getNrEndereco(),PDO::PARAM_INT);
		 $stmt->bindParam(":latitude",$this->getLatitude(),PDO::PARAM_STR);
		 $stmt->bindParam(":longitudde",$this->getLongitudde(),PDO::PARAM_STR);
		 $stmt->bindParam(":site",$this->getSite(),PDO::PARAM_STR);
		 $stmt->bindParam(":email",$this->getEmail(),PDO::PARAM_STR);
		 $stmt->bindParam(":teledne",$this->getTeledne(),PDO::PARAM_STR);
		 $stmt->bindParam(":presidente",$this->getPresidente(),PDO::PARAM_STR);
		 $stmt->bindParam(":status",$this->getStatus(),PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE consorcio SET 
			id = :id';
		 $sql .= ",id_consorcio = :id_consorcio";
		 $sql .= ",nome_consorcio = :nome_consorcio";
		 $sql .= ",cnpj = :cnpj";
		 $sql .= ",endereco = :endereco";
		 $sql .= ",nr_endereco = :nr_endereco";
		 $sql .= ",latitude = :latitude";
		 $sql .= ",longitudde = :longitudde";
		 $sql .= ",site = :site";
		 $sql .= ",email = :email";
		 $sql .= ",teledne = :teledne";
		 $sql .= ",presidente = :presidente";
		 $sql .= ",status = :status";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->getId(),PDO::PARAM_INT);
		 $stmt->bindParam(":id_consorcio",$this->getIdConsorcio(),PDO::PARAM_INT);
		 $stmt->bindParam(":nome_consorcio",$this->getNomeConsorcio(),PDO::PARAM_STR);
		 $stmt->bindParam(":cnpj",$this->getCnpj(),PDO::PARAM_STR);
		 $stmt->bindParam(":endereco",$this->getEndereco(),PDO::PARAM_STR);
		 $stmt->bindParam(":nr_endereco",$this->getNrEndereco(),PDO::PARAM_INT);
		 $stmt->bindParam(":latitude",$this->getLatitude(),PDO::PARAM_STR);
		 $stmt->bindParam(":longitudde",$this->getLongitudde(),PDO::PARAM_STR);
		 $stmt->bindParam(":site",$this->getSite(),PDO::PARAM_STR);
		 $stmt->bindParam(":email",$this->getEmail(),PDO::PARAM_STR);
		 $stmt->bindParam(":teledne",$this->getTeledne(),PDO::PARAM_STR);
		 $stmt->bindParam(":presidente",$this->getPresidente(),PDO::PARAM_STR);
		 $stmt->bindParam(":status",$this->getStatus(),PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->getId(),PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM consorcio WHERE id IN({$lista})";
		$sql = "UPDATE consorcio SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE consorcio.id > 0
		";
		
		if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND servicos.data_prevista >='{$param['data_hora_inicio']}' AND servicos.data_prevista <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM consorcio
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
				consorcio.*
			FROM consorcio
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY consorcio.id DESC";
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
		$sql = "SELECT * FROM consorcio WHERE id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(1,$this->getId(),PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
}
