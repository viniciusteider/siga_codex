<?
class MapUsuarioAcao
{
	private $id;
	private $id_usuario;
	private $id_acao;
	private $customnizada;
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
 	
	public function setIdAcao($arg)
	{
		$this->id_acao = $arg;
	}
 	
	public function getIdAcao()
	{
		return $this->id_acao;
	}
 	
	public function setConexao($arg)
	{
		$this->conexao = $arg;
	}

    /**
     * @return mixed
     */
    public function getCustomnizada()
    {
        return $this->customnizada;
    }

    /**
     * @param mixed $customnizada
     */
    public function setCustomnizada($customnizada)
    {
        $this->customnizada = $customnizada;
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
		INSERT INTO map_usuario_acao SET  id_usuario = ?';
		 $sql .= ",id_acao = ?";
		 $sql .= ",customizada = ?";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(++$x,$this->getIdUsuario(),PDO::PARAM_INT);
		 $stmt->bindParam(++$x,$this->getIdAcao(),PDO::PARAM_INT);
		 $stmt->bindParam(++$x,$this->getCustomnizada(),PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE map_usuario_acao SET id_usuario = ? ';
		$sql .= ",id_acao = ?";
        $sql .= ",customizada = ?";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(++$x,$this->getIdUsuario(),PDO::PARAM_INT);
		$stmt->bindParam(++$x,$this->getIdAcao(),PDO::PARAM_INT);
        $stmt->bindParam(++$x,$this->getCustomnizada(),PDO::PARAM_INT);
		$stmt->bindParam(++$x,$this->getId(),PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM map_usuario_acao WHERE id IN({$lista})";
		$sql = "UPDATE map_usuario_acao SET excluido = NOW() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}
    public function RemoverALLUsers($id_tipo)
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM map_usuario_acao WHERE id_usuario IN(SELECT id FROM usuario WHERE id_usuario_tipo = $id_tipo AND (`master`  IS NULL OR `master` = 0)) AND customizada != 1";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoveraAll()
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM map_usuario_acao WHERE id_usuario = ? ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(++$x,$this->getIdUsuario(),PDO::PARAM_INT);
        return $stmt->execute();
    }
	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE map_usuario_acao.id > 0
		";
		
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM map_usuario_acao
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
				map_usuario_acao.*
			FROM map_usuario_acao
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY map_usuario_acao.id DESC";
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
		$sql = "SELECT * FROM map_usuario_acao WHERE id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(1,$this->getId(),PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
    public function ChecarCustomizada($tipo_usuario,$id_acao)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT COUNT(*) as quantidade FROM acao_usuario_tipo WHERE id_acao = ? AND id_usuario_tipo = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1,$id_acao,PDO::PARAM_INT);
        $stmt->bindParam(2,$tipo_usuario,PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch();
        return $resultado['quantidade'];
    }
}
