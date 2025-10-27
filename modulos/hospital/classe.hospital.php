<?php
class Hospital
{
	private $id;
	private $id_grupo;
	private $nome;
	private $diretor;
	private $id_endereco;
	private $complexidade;
	private $status;
	private $vagas_leitos;
	private $vagas_uti;
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

	public function setIdGrupo($arg)
	{
		$this->id_grupo = ($arg == "") ? NULL : $arg;
	}

	public function getIdGrupo()
	{
		return $this->id_grupo;
	}

	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function setDiretor($arg)
	{
		$this->diretor = ($arg == "") ? NULL : $arg;
	}

	public function getDiretor()
	{
		return $this->diretor;
	}

	public function setIdEndereco($arg)
	{
		$this->id_endereco = ($arg == "") ? NULL : $arg;
	}

	public function getIdEndereco()
	{
		return $this->id_endereco;
	}

	public function setComplexidade($arg)
	{
		$this->complexidade = ($arg == "") ? NULL : $arg;
	}

	public function getComplexidade()
	{
		return $this->complexidade;
	}
	public function setVagasLeitos($arg)
	{
		$this->vagas_leitos = ($arg == "") ? NULL : $arg;
	}

	public function getVagasLeitos()
	{
		return $this->vagas_leitos;
	}

	public function setVagasUti($arg)
	{
		$this->vagas_uti = ($arg == "") ? NULL : $arg;
	}

	public function getVagasUti()
	{
		return $this->vagas_uti;
	}

	public function setStatus($arg)
	{
		$this->status = ($arg == "") ? NULL : $arg;
	}

	public function getStatus()
	{
		return $this->status;
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
		INSERT INTO hospital SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		$sql .= ",id_grupo = :id_grupo";
		$sql .= ",nome = :nome";
		$sql .= ",diretor = :diretor";
		$sql .= ",id_endereco = :id_endereco";
		$sql .= ",complexidade = :complexidade";
		$sql .= ",status = :status";
		$sql .= ",vagas_leitos = :vagas_leitos";
		$sql .= ",vagas_uti = :vagas_uti";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id_grupo", $this->id_grupo, PDO::PARAM_INT);
		$stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
		$stmt->bindParam(":diretor", $this->diretor, PDO::PARAM_STR);
		$stmt->bindParam(":id_endereco", $this->id_endereco, PDO::PARAM_INT);
		$stmt->bindParam(":complexidade", $this->complexidade, PDO::PARAM_STR);
		$stmt->bindParam(":status", $this->status, PDO::PARAM_STR);
		$stmt->bindParam(":vagas_leitos", $this->vagas_leitos, PDO::PARAM_INT);
		$stmt->bindParam(":vagas_uti", $this->vagas_uti, PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId();
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = ' UPDATE hospital SET nome = :nome';
		$sql .= ",diretor = :diretor";
		$sql .= ",complexidade = :complexidade";
		$sql .= ",vagas_leitos = :vagas_leitos";
		$sql .= ",vagas_uti = :vagas_uti";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
		$stmt->bindParam(":diretor", $this->diretor, PDO::PARAM_STR);
		$stmt->bindParam(":complexidade", $this->complexidade, PDO::PARAM_STR);
		$stmt->bindParam(":vagas_leitos", $this->vagas_leitos, PDO::PARAM_INT);
		$stmt->bindParam(":vagas_uti", $this->vagas_uti, PDO::PARAM_INT);
		$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",", $lista);
		//$sql = "DELETE FROM hospital WHERE id IN({$lista})";
		$sql = "UPDATE hospital SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo, $numeroRegistros, $numeroInicioRegistro, $busca = "", $filtro = "", $ordem = "", $param = "")
	{
		$pdo = $this->getConexao();

		$joins = "
			INNER JOIN grupo ON(grupo.id = hospital.id_grupo)
			INNER JOIN endereco ON(endereco.id = hospital.id_endereco)
			LEFT JOIN cidades ON(cidades.id = endereco.id_cidade)
		";

		$where = "
			WHERE hospital.excluido IS NULL
		";

		if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if ($busca != "") $where .= " AND (hospital.nome LIKE :busca)";
		if (($param['data_hora_inicio']))  $where .= " AND hospital.data_hora_cadastro >='{$param['data_hora_inicio']}' AND hospital.data_hora_cadastro <= '{$param['data_hora_fim']}'";

		$sql = "
			SELECT COUNT(*) AS total
			FROM hospital
			$joins
			$where
		";

		$stmt = $pdo->prepare($sql);

		if ($busca != "") {
			$busca = "%" . $busca . "%";
			$stmt->bindParam(":busca", $busca, PDO::PARAM_STR);
		}

		$stmt->execute();
		$totalRegistros = $stmt->fetch(PDO::FETCH_OBJ)->total;

		$sql = "
			SELECT 
				hospital.*
			    ,cidades.nome as nome_cidade
			FROM hospital
			$joins
			$where
		";

		if ($filtro != "") $sql .= " ORDER BY $filtro $ordem";
		else $sql .= " ORDER BY hospital.id DESC";
		$sql .= " LIMIT :offset,:limit";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":offset", $numeroInicioRegistro, PDO::PARAM_INT);
		$stmt->bindParam(":limit", $numeroRegistros, PDO::PARAM_INT);

		if ($busca != "") {
			$busca = "%" . $busca . "%";
			$stmt->bindParam(":busca", $busca, PDO::PARAM_STR);
		}

		$stmt->execute();
		$linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return [$linhas, $totalRegistros];
	}

	public function Editar()
	{
		$pdo = $this->getConexao();
		$sql = "SELECT 
        hospital.*,
        endereco.`id` as id_endereco,
        endereco.`logradouro`,
        endereco.`numero`,
        endereco.`complemento`,
        endereco.`bairro`,
        endereco.`id_cidade`,
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
        endereco.`longitude`,
        cidades.id_estado
        FROM hospital 
        INNER JOIN endereco  on hospital.id_endereco = endereco.id
        LEFT JOIN cidades  on endereco.id_cidade = cidades.id
        WHERE hospital.id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function ListarCombo($id = "")
	{
		$pdo = $this->getConexao();
		$sql = "SELECT * FROM hospital WHERE excluido IS NULL";
		if ($id != "") $sql .= " AND hospital.id = $id ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function BuscarAutoComplete($busca)
	{
		$pdo = new Conexao();
		$sql = " SELECT
                         hospital.id,
                         hospital.vagas_leitos,
                         hospital.vagas_uti,
                         hospital.complexidade,
                         IF(cidades.nome != '',CONCAT(hospital.nome,' - ',cidades.nome),hospital.nome)  AS text
                     FROM hospital 
                         LEFT JOIN endereco ON (endereco.id = hospital.id_endereco)
                         LEFT JOIN cidades ON (cidades.id = endereco.id_cidade)
                     WHERE hospital.excluido IS NULL
                     ";

		if ($busca != '') {
			$sql .= " AND  (hospital.nome LIKE '%$busca%' OR hospital.id  LIKE '%$busca%') ";
		}
		$sql .= ' LIMIT 50';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rs;
	}

	public function ListarMonitoramento($idGrupo)
	{
		$pdo = $this->getConexao();
		$sql = "SELECT
hospital.id,
hospital.nome,
endereco.logradouro,
endereco.numero,
endereco.complemento,
endereco.bairro,
endereco.cidade,
endereco.estado,
endereco.latitude,
endereco.longitude,
hospital.complexidade,
hospital.telefone,
hospital.vagas_leitos,
hospital.vagas_uti
FROM
hospital
INNER JOIN endereco ON endereco.id = hospital.id_endereco
inner join  grupo on grupo.id = hospital.id_grupo
WHERE hospital.excluido IS NULL";
		if ($idGrupo != "") $sql .= " AND hospital.id_grupo = $idGrupo ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
