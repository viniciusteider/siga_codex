<?
class Franqueado
{
	private $id;
	private $id_endereco;
	private $id_grupo;
	private $nome;
	private $codigo;
	private $cnpj;
	private $inscricao_estadual;
	private $responsavel;
	private $cpf_responsavel;
	private $status;
	private $acesso_bloqueado;
	private $data_hora_cadastro;
	private $excluido;
	private $conexao;

	public function setId($arg)
	{
		$this->id = $arg;
	}
 	
	public function getId()
	{
		return $this->id;
	}
 	
	public function setIdEndereco($arg)
	{
		$this->id_endereco = $arg;
	}
 	
	public function getIdEndereco()
	{
		return $this->id_endereco;
	}
 	
	public function setIdGrupo($arg)
	{
		$this->id_grupo = $arg;
	}
 	
	public function getIdGrupo()
	{
		return $this->id_grupo;
	}
 	
	public function setNome($arg)
	{
		$this->nome = $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setCodigo($arg)
	{
		$this->codigo = $arg;
	}
 	
	public function getCodigo()
	{
		return $this->codigo;
	}
 	
	public function setCnpj($arg)
	{
		$this->cnpj = $arg;
	}
 	
	public function getCnpj()
	{
		return $this->cnpj;
	}
 	
	public function setInscricaoEstadual($arg)
	{
		$this->inscricao_estadual = $arg;
	}
 	
	public function getInscricaoEstadual()
	{
		return $this->inscricao_estadual;
	}
 	
	public function setResponsavel($arg)
	{
		$this->responsavel = $arg;
	}
 	
	public function getResponsavel()
	{
		return $this->responsavel;
	}
 	
	public function setCpfResponsavel($arg)
	{
		$this->cpf_responsavel = $arg;
	}
 	
	public function getCpfResponsavel()
	{
		return $this->cpf_responsavel;
	}
 	
	public function setStatus($arg)
	{
		$this->status = $arg;
	}
 	
	public function getStatus()
	{
		return $this->status;
	}
 	
	public function setAcessoBloqueado($arg)
	{
		$this->acesso_bloqueado = $arg;
	}
 	
	public function getAcessoBloqueado()
	{
		return $this->acesso_bloqueado;
	}
 	
	public function setDataHoraCadastro($arg)
	{
		$this->data_hora_cadastro = $arg;
	}
 	
	public function getDataHoraCadastro()
	{
		return $this->data_hora_cadastro;
	}
 	
	public function setExcluido($arg)
	{
		$this->excluido = $arg;
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
		$sql = 'INSERT INTO franqueado SET data_hora_cadastro = NOW(),id_endereco = :id_endereco ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",nome = :nome";
		 $sql .= ",codigo = :codigo";
		 $sql .= ",cnpj = :cnpj";
		 $sql .= ",inscricao_estadual = :inscricao_estadual";
		 $sql .= ",responsavel = :responsavel";
		 $sql .= ",cpf_responsavel = :cpf_responsavel";
		 $sql .= ",status = 1";
		 $sql .= ",acesso_bloqueado = :acesso_bloqueado";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_endereco",$this->getIdEndereco(),PDO::PARAM_INT);
		 $stmt->bindParam(":id_grupo",$this->getIdGrupo(),PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->getNome(),PDO::PARAM_STR);
		 $stmt->bindParam(":codigo",$this->getCodigo(),PDO::PARAM_STR);
		 $stmt->bindParam(":cnpj",$this->getCnpj(),PDO::PARAM_STR);
		 $stmt->bindParam(":inscricao_estadual",$this->getInscricaoEstadual(),PDO::PARAM_STR);
		 $stmt->bindParam(":responsavel",$this->getResponsavel(),PDO::PARAM_STR);
		 $stmt->bindParam(":cpf_responsavel",$this->getCpfResponsavel(),PDO::PARAM_STR);
//		 $stmt->bindParam(":status",$this->getStatus(),PDO::PARAM_STR);
		 $stmt->bindParam(":acesso_bloqueado",$this->getAcessoBloqueado(),PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE franqueado SET nome = :nome';
		 $sql .= ",codigo = :codigo";
		 $sql .= ",cnpj = :cnpj";
		 $sql .= ",inscricao_estadual = :inscricao_estadual";
		 $sql .= ",responsavel = :responsavel";
		 $sql .= ",cpf_responsavel = :cpf_responsavel";
//		 $sql .= ",status = :status";
//		 $sql .= ",acesso_bloqueado = :acesso_bloqueado";

		$sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome",$this->getNome(),PDO::PARAM_STR);
        $stmt->bindParam(":codigo",$this->getCodigo(),PDO::PARAM_STR);
        $stmt->bindParam(":cnpj",$this->getCnpj(),PDO::PARAM_STR);
        $stmt->bindParam(":inscricao_estadual",$this->getInscricaoEstadual(),PDO::PARAM_STR);
        $stmt->bindParam(":responsavel",$this->getResponsavel(),PDO::PARAM_STR);
        $stmt->bindParam(":cpf_responsavel",$this->getCpfResponsavel(),PDO::PARAM_STR);
//        $stmt->bindParam(":status",$this->getStatus(),PDO::PARAM_STR);
//        $stmt->bindParam(":acesso_bloqueado",$this->getAcessoBloqueado(),PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->getId(),PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM franqueado WHERE id IN({$lista})";
		$sql = "UPDATE franqueado SET excluido = NOW() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "")
	{
		$pdo = $this->getConexao();

		$joins = "
		INNER JOIN endereco ON ( franqueado.id_endereco = endereco.id )
		";

		$where = "
			WHERE franqueado.id > 0
		";

		if($busca != "") $where .= " AND (nome LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM franqueado
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
				franqueado.*,
                endereco.`id` as id_endereco,
                endereco.`logradouro`,
                endereco.`numero`,
                endereco.`complemento`,
                endereco.`bairro`,
                endereco.`cidade`,
                endereco.`estado`,
                endereco.`cep`,
                endereco.`referencia`,
                endereco.`observacao`,
                endereco.`telefone`,
                endereco.`comercial`,
                endereco.`celular`,
                endereco.`email`,
                endereco.`email_mkt`,
                endereco.`email_mkt2`,
                endereco.`latitude`,
                endereco.`longitude`
			FROM franqueado
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY franqueado.id DESC";
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
        $sql = "SELECT 
                    franqueado.*,
                    endereco.`id` as id_endereco,
                    endereco.`logradouro`,
                    endereco.`numero`,
                    endereco.`complemento`,
                    endereco.`bairro`,
                    endereco.`cidade`,
                    endereco.`id_cidade`,
                    cidades.id_estado,
                    endereco.`estado`,
                    endereco.`cep`,
                    endereco.`referencia`,
                    endereco.`observacao`,
                    endereco.`telefone`,
                    endereco.`comercial`,
                    endereco.`celular`,
                    endereco.`email`,
                    endereco.`email_mkt`,
                    endereco.`email_mkt2`,
                    endereco.`latitude`,
                    endereco.`longitude`,
                    grupo.id_grupo_pai,
                    grupo_pai.nome AS nome_grupo_pai
        FROM franqueado 
        INNER JOIN grupo ON (grupo.id = franqueado.id_grupo) 
        INNER JOIN endereco ON (endereco.id = franqueado.id_endereco) 
        INNER JOIN cidades ON (cidades.id = endereco.id_cidade) 
        LEFT JOIN grupo AS grupo_pai ON (grupo_pai.id = grupo.id_grupo_pai)
        WHERE franqueado.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1,$this->getId(),PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
	}
    public function ListarCombo($id)
    {
        if($id == "") return;
        $pdo = $this->getConexao();
        $sql = "SELECT id,CONCAT(franqueado.codigo,' ',franqueado.nome) as codigo FROM franqueado WHERE id = $id ORDER BY codigo ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function ComboFranqueado()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
                id, 
                id_grupo, 
                CONCAT(franqueado.codigo,' ',franqueado.nome) AS codigo 
                FROM franqueado WHERE excluido IS NULL ";
        $sql .= " ORDER BY codigo ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function ListarFranqueadosJson($id_grupo, $busca = "", $omitir = "")
    {
        $pdo = $this->getConexao();
        $sql = "
            SELECT
                franqueado.id,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as label,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as nome,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as text,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as rotulo,
                franqueado.id_grupo,
                franqueado.id as value
            FROM
                franqueado
                INNER JOIN grupo  ON (grupo.id = franqueado.id_grupo)
            WHERE
                (grupo.id = $id_grupo OR grupo.arvore LIKE '%;$id_grupo;%')
                AND grupo.excluido IS NULL
                AND grupo.nome != ''";

        if (trim($busca) != "") {
            $sql .= " AND (franqueado.nome LIKE '%" . trim($busca) . "%' OR franqueado.codigo LIKE '%" . trim($busca) . "%')";
        }
        if ($omitir) {
            $sql .= " AND franqueado.id != $omitir";
        }

        $sql .= " LIMIT 200";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($lista) <= 0) {
            $lista[] = ["id" => '', "label" => 'Nenhum registro encontrato', "text" => 'Nenhum registro encontrato', "value" => ""];
        }

        return $lista;
    }
    public function ListarFranqueadosJsonTodos($id_grupo, $busca = "", $omitir = "")
    {
        $pdo = $this->getConexao();
        $sql = "
            SELECT
                franqueado.id,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as label,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as nome,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as text,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as rotulo,
                franqueado.id as value
            FROM
                franqueado
                INNER JOIN grupo  ON (grupo.id = franqueado.id_grupo)
            WHERE
                grupo.excluido IS NULL
                AND grupo.nome != ''";

        if (trim($busca) != "") {
            $sql .= " AND (franqueado.nome LIKE '%" . trim($busca) . "%' OR franqueado.codigo LIKE '%" . trim($busca) . "%')";
        }
        if ($omitir) {
            $sql .= " AND franqueado.id != $omitir";
        }

        $sql .= " LIMIT 200";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($lista) <= 0) {
            $lista[] = ["id" => '', "label" => 'Nenhum registro encontrato', "text" => 'Nenhum registro encontrato', "value" => ""];
        }

        return $lista;
    }

    public function ListarFranqueadosApi($idGrupo)
    {
        $pdo = $this->getConexao();
        $sql = "
            SELECT
                franqueado.id,
                franqueado.nome,
                franqueado.codigo AS codigo_franqueado,
                grupo.id AS id_grupo
            FROM
                franqueado
                INNER JOIN grupo  ON (grupo.id = franqueado.id_grupo)
            WHERE
                (grupo.id = $idGrupo OR grupo.arvore LIKE '%;$idGrupo;%')
                AND grupo.excluido IS NULL";

        $sql .= " LIMIT 200";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function ListarFranqueadosJsonFranquia($id_franquia, $busca = "", $omitir = "")
    {
        $pdo = $this->getConexao();
        $sql = "
            SELECT
                franqueado.id,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as label,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as nome,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as text,
                CONCAT(franqueado.codigo,' ',franqueado.nome) as rotulo,
                franqueado.id as value
            FROM
                franqueado
            WHERE franqueado.id = $id_franquia
                    ";

        if (trim($busca) != "") {
            $sql .= " AND (franqueado.nome LIKE '%" . trim($busca) . "%' OR franqueado.codigo LIKE '%" . trim($busca) . "%')";
        }
        if ($omitir) {
            $sql .= " AND franqueado.id != $omitir";
        }

        $sql .= " LIMIT 200";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($lista) <= 0) {
            $lista[] = ["id" => '', "label" => 'Nenhum registro encontrato', "text" => 'Nenhum registro encontrato', "value" => ""];
        }

        return $lista;
    }
    public function BuscaAcoesPadrao()
    {
        $pdo = $this->getConexao();
        $sql = " SELECT * FROM permissao_padrao";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    }
    public function AdicionarGrupoAcaoPadrao($id_grupo, $permissao, $customizada)
    {
        $pdo = $this->getConexao();

        $sql  = "INSERT INTO map_grupo_acao SET id_grupo = ?, id_acao = ?, customizada = ?";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(1, $id_grupo, PDO::PARAM_INT);
        $stmt->bindParam(2, $permissao, PDO::PARAM_INT);
        $stmt->bindParam(3, $customizada, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
