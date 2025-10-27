<?
class LogAcessoUsuarios
{
	private $id;
	private $id_usuario;
	private $nome_usuario;
	private $pagina;
	private $ip;
	private $dados;
	private $data_hora;
	private $aplicativo;
	private $conexao;

	public function setId($arg)
	{
		$this->id = $arg;
	}
 	
	public function getId()
	{
		return $this->id;
	}
 	
	public function setIdUsuario($arg)
	{
		$this->id_usuario = $arg;
	}
 	
	public function getIdUsuario()
	{
		return $this->id_usuario;
	}
 	
	public function setNomeUsuario($arg)
	{
		$this->nome_usuario = $arg;
	}
 	
	public function getNomeUsuario()
	{
		return $this->nome_usuario;
	}
 	
	public function setPagina($arg)
	{
		$this->pagina = $arg;
	}
 	
	public function getPagina()
	{
		return $this->pagina;
	}
 	
	public function setIp($arg)
	{
		$this->ip = $arg;
	}
 	
	public function getIp()
	{
		return $this->ip;
	}
 	
	public function setDados($arg)
	{
		$this->dados = $arg;
	}
 	
	public function getDados()
	{
		return $this->dados;
	}
 	
	public function setDataHora($arg)
	{
		$this->data_hora = $arg;
	}
 	
	public function getDataHora()
	{
		return $this->data_hora;
	}
 	
	public function setAplicativo($arg)
	{
		$this->aplicativo = $arg;
	}
 	
	public function getAplicativo()
	{
		return $this->aplicativo;
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
		INSERT INTO log_acesso_usuarios SET  id_usuario = ?';
		 $sql .= ",nome_usuario = ?";
		 $sql .= ",pagina = ?";
		 $sql .= ",ip = ?";
		 $sql .= ",dados = ?";
		 $sql .= ",data_hora = ?";
		 $sql .= ",aplicativo = ?";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(++$x,$this->getIdUsuario(),PDO::PARAM_INT);
		 $stmt->bindParam(++$x,$this->getNomeUsuario(),PDO::PARAM_STR);
		 $stmt->bindParam(++$x,$this->getPagina(),PDO::PARAM_STR);
		 $stmt->bindParam(++$x,$this->getIp(),PDO::PARAM_STR);
		 $stmt->bindParam(++$x,$this->getDados(),PDO::PARAM_STR);
		 $stmt->bindParam(++$x,$this->getDataHora(),PDO::PARAM_STR);
		 $stmt->bindParam(++$x,$this->getAplicativo(),PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE log_acesso_usuarios SET id_usuario = ?';
		$sql .= ",nome_usuario = ?";
		$sql .= ",pagina = ?";
		$sql .= ",ip = ?";
		$sql .= ",dados = ?";
		$sql .= ",data_hora = ?";
		$sql .= ",aplicativo = ?";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(++$x,$this->getIdUsuario(),PDO::PARAM_INT);
		$stmt->bindParam(++$x,$this->getNomeUsuario(),PDO::PARAM_STR);
		$stmt->bindParam(++$x,$this->getPagina(),PDO::PARAM_STR);
		$stmt->bindParam(++$x,$this->getIp(),PDO::PARAM_STR);
		$stmt->bindParam(++$x,$this->getDados(),PDO::PARAM_STR);
		$stmt->bindParam(++$x,$this->getDataHora(),PDO::PARAM_STR);
		$stmt->bindParam(++$x,$this->getAplicativo(),PDO::PARAM_STR);
		$stmt->bindParam(++$x,$this->getId(),PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM log_acesso_usuarios WHERE id IN({$lista})";
		$sql = "UPDATE log_acesso_usuarios SET excluido = NOW() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "",$param = array())
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE log_acesso_usuarios.id > 0 
		";

		if($param['usuario'] != '')  $where .= "AND id_usuario = {$param['usuario']} ";
        if (($param['data_hora_inicio']))  $where .= " AND log_acesso_usuarios.data_hora >='{$param['data_hora_inicio']}' AND log_acesso_usuarios.data_hora <= '{$param['data_hora_fim']}'";
		if($busca != "") $where .= " AND (dados LIKE :busca OR nome_usuario LIKE :busca OR id_usuario LIKE :busca OR log_acesso_usuarios.dados LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM log_acesso_usuarios
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
				log_acesso_usuarios.*
			FROM log_acesso_usuarios
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY log_acesso_usuarios.id DESC";
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
		$sql = "SELECT * FROM log_acesso_usuarios WHERE id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(1,$this->getId(),PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
}
