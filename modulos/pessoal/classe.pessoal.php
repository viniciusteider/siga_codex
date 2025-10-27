<?php
class Pessoal
{
	private $id;
	private $id_grupo;
	private $nome;
	private $apelido;
	private $nome_mae;
	private $nome_pai;
	private $data_nascimento;
	private $naturalidade;
	private $rg;
	private $cpf;
	private $pis;
	private $cnh;
	private $categoria_cnh;
	private $validade_cnh;
	private $validade_cve;
	private $genero;
	private $tipo_sangue;
	private $id_funcao;
	private $matricula_funcional;
	private $id_endereco;
	private $data_inclusao;
	private $foto;
	private $email;
	private $id_consorcio;
	private $id_base;
	private $altura;
	private $peso;
	private $id_etnia;
	private $id_romaneio;
	private $id_formacao;
	private $data_hora_cdastro;
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
 	
	public function setApelido($arg)
	{
		$this->apelido = $arg;
	}
 	
	public function getApelido()
	{
		return $this->apelido;
	}
 	
	public function setNomeMae($arg)
	{
		$this->nome_mae = $arg;
	}
 	
	public function getNomeMae()
	{
		return $this->nome_mae;
	}
 	
	public function setNomePai($arg)
	{
		$this->nome_pai = $arg;
	}
 	
	public function getNomePai()
	{
		return $this->nome_pai;
	}
 	
	public function setDataNascimento($arg)
	{
		$this->data_nascimento = $arg;
	}
 	
	public function getDataNascimento()
	{
		return $this->data_nascimento;
	}
 	
	public function setNaturalidade($arg)
	{
		$this->naturalidade = $arg;
	}
 	
	public function getNaturalidade()
	{
		return $this->naturalidade;
	}
 	
	public function setRg($arg)
	{
		$this->rg = $arg;
	}
 	
	public function getRg()
	{
		return $this->rg;
	}
 	
	public function setCpf($arg)
	{
		$this->cpf = $arg;
	}
 	
	public function getCpf()
	{
		return $this->cpf;
	}
 	
	public function setPis($arg)
	{
		$this->pis = $arg;
	}
 	
	public function getPis()
	{
		return $this->pis;
	}
 	
	public function setCnh($arg)
	{
		$this->cnh = $arg;
	}
 	
	public function getCnh()
	{
		return $this->cnh;
	}
 	
	public function setCategoriaCnh($arg)
	{
		$this->categoria_cnh = $arg;
	}
 	
	public function getCategoriaCnh()
	{
		return $this->categoria_cnh;
	}
 	
	public function setValidadeCnh($arg)
	{
		$this->validade_cnh = $arg;
	}
 	
	public function getValidadeCnh()
	{
		return $this->validade_cnh;
	}
 	
	public function setValidadeCve($arg)
	{
		$this->validade_cve = $arg;
	}
 	
	public function getValidadeCve()
	{
		return $this->validade_cve;
	}
 	
	public function setGenero($arg)
	{
		$this->genero = $arg;
	}
 	
	public function getGenero()
	{
		return $this->genero;
	}
 	
	public function setTipoSangue($arg)
	{
		$this->tipo_sangue = $arg;
	}
 	
	public function getTipoSangue()
	{
		return $this->tipo_sangue;
	}
 	
	public function setIdFuncao($arg)
	{
		$this->id_funcao = $arg;
	}
 	
	public function getIdFuncao()
	{
		return $this->id_funcao;
	}
 	
	public function setMatriculaFuncional($arg)
	{
		$this->matricula_funcional = $arg;
	}
 	
	public function getMatriculaFuncional()
	{
		return $this->matricula_funcional;
	}
 	
	public function setIdEndereco($arg)
	{
		$this->id_endereco = $arg;
	}
 	
	public function getIdEndereco()
	{
		return $this->id_endereco;
	}
 	
	public function setDataInclusao($arg)
	{
		$this->data_inclusao = $arg;
	}
 	
	public function getDataInclusao()
	{
		return $this->data_inclusao;
	}
 	
	public function setFoto($arg)
	{
		$this->foto = $arg;
	}
 	
	public function getFoto()
	{
		return $this->foto;
	}
 	
	public function setEmail($arg)
	{
		$this->email = $arg;
	}
 	
	public function getEmail()
	{
		return $this->email;
	}
 	
	public function setIdConsorcio($arg)
	{
		$this->id_consorcio = $arg;
	}
 	
	public function getIdConsorcio()
	{
		return $this->id_consorcio;
	}
 	
	public function setIdBase($arg)
	{
		$this->id_base = $arg;
	}
 	
	public function getIdBase()
	{
		return $this->id_base;
	}
 	
	public function setAltura($arg)
	{
		$this->altura = $arg;
	}
 	
	public function getAltura()
	{
		return $this->altura;
	}
 	
	public function setPeso($arg)
	{
		$this->peso = $arg;
	}
 	
	public function getPeso()
	{
		return $this->peso;
	}
 	
	public function setIdEtnia($arg)
	{
		$this->id_etnia = $arg;
	}
 	
	public function getIdEtnia()
	{
		return $this->id_etnia;
	}
 	
	public function setIdRomaneio($arg)
	{
		$this->id_romaneio = $arg;
	}
 	
	public function getIdRomaneio()
	{
		return $this->id_romaneio;
	}
 	
	public function setIdFormacao($arg)
	{
		$this->id_formacao = $arg;
	}
 	
	public function getIdFormacao()
	{
		return $this->id_formacao;
	}
 	
	public function setDataHoraCdastro($arg)
	{
		$this->data_hora_cdastro = $arg;
	}
 	
	public function getDataHoraCdastro()
	{
		return $this->data_hora_cdastro;
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
		$sql = '
		INSERT INTO pessoal SET  ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",nome = :nome";
		 $sql .= ",apelido = :apelido";
		 $sql .= ",nome_mae = :nome_mae";
		 $sql .= ",nome_pai = :nome_pai";
		 $sql .= ",data_nascimento = :data_nascimento";
		 $sql .= ",naturalidade = :naturalidade";
		 $sql .= ",rg = :rg";
		 $sql .= ",cpf = :cpf";
		 $sql .= ",pis = :pis";
		 $sql .= ",cnh = :cnh";
		 $sql .= ",categoria_cnh = :categoria_cnh";
		 $sql .= ",validade_cnh = :validade_cnh";
		 $sql .= ",validade_cve = :validade_cve";
		 $sql .= ",genero = :genero";
		 $sql .= ",tipo_sangue = :tipo_sangue";
		 $sql .= ",id_funcao = :id_funcao";
		 $sql .= ",matricula_funcional = :matricula_funcional";
		 $sql .= ",id_endereco = :id_endereco";
		 $sql .= ",data_inclusao = :data_inclusao";
		 $sql .= ",foto = :foto";
		 $sql .= ",email = :email";
		 $sql .= ",id_consorcio = :id_consorcio";
		 $sql .= ",id_base = :id_base";
		 $sql .= ",altura = :altura";
		 $sql .= ",peso = :peso";
		 $sql .= ",id_etnia = :id_etnia";
		 $sql .= ",id_romaneio = :id_romaneio";
		 $sql .= ",id_formacao = :id_formacao";
		 $sql .= ",data_hora_cdastro = :data_hora_cdastro";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":apelido",$this->apelido,PDO::PARAM_STR);
		 $stmt->bindParam(":nome_mae",$this->nome_mae,PDO::PARAM_STR);
		 $stmt->bindParam(":nome_pai",$this->nome_pai,PDO::PARAM_STR);
		 $stmt->bindParam(":data_nascimento",$this->data_nascimento,PDO::PARAM_STR);
		 $stmt->bindParam(":naturalidade",$this->naturalidade,PDO::PARAM_STR);
		 $stmt->bindParam(":rg",$this->rg,PDO::PARAM_STR);
		 $stmt->bindParam(":cpf",$this->cpf,PDO::PARAM_STR);
		 $stmt->bindParam(":pis",$this->pis,PDO::PARAM_STR);
		 $stmt->bindParam(":cnh",$this->cnh,PDO::PARAM_STR);
		 $stmt->bindParam(":categoria_cnh",$this->categoria_cnh,PDO::PARAM_STR);
		 $stmt->bindParam(":validade_cnh",$this->validade_cnh,PDO::PARAM_STR);
		 $stmt->bindParam(":validade_cve",$this->validade_cve,PDO::PARAM_STR);
		 $stmt->bindParam(":genero",$this->genero,PDO::PARAM_STR);
		 $stmt->bindParam(":tipo_sangue",$this->tipo_sangue,PDO::PARAM_STR);
		 $stmt->bindParam(":id_funcao",$this->id_funcao,PDO::PARAM_INT);
		 $stmt->bindParam(":matricula_funcional",$this->matricula_funcional,PDO::PARAM_STR);
		 $stmt->bindParam(":id_endereco",$this->id_endereco,PDO::PARAM_INT);
		 $stmt->bindParam(":data_inclusao",$this->data_inclusao,PDO::PARAM_STR);
		 $stmt->bindParam(":foto",$this->foto,PDO::PARAM_STR);
		 $stmt->bindParam(":email",$this->email,PDO::PARAM_STR);
		 $stmt->bindParam(":id_consorcio",$this->id_consorcio,PDO::PARAM_INT);
		 $stmt->bindParam(":id_base",$this->id_base,PDO::PARAM_INT);
		 $stmt->bindParam(":altura",$this->altura,PDO::PARAM_STR);
		 $stmt->bindParam(":peso",$this->peso,PDO::PARAM_INT);
		 $stmt->bindParam(":id_etnia",$this->id_etnia,PDO::PARAM_INT);
		 $stmt->bindParam(":id_romaneio",$this->id_romaneio,PDO::PARAM_INT);
		 $stmt->bindParam(":id_formacao",$this->id_formacao,PDO::PARAM_INT);
		 $stmt->bindParam(":data_hora_cdastro",$this->data_hora_cdastro,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal SET 
			id = :id';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",nome = :nome";
		 $sql .= ",apelido = :apelido";
		 $sql .= ",nome_mae = :nome_mae";
		 $sql .= ",nome_pai = :nome_pai";
		 $sql .= ",data_nascimento = :data_nascimento";
		 $sql .= ",naturalidade = :naturalidade";
		 $sql .= ",rg = :rg";
		 $sql .= ",cpf = :cpf";
		 $sql .= ",pis = :pis";
		 $sql .= ",cnh = :cnh";
		 $sql .= ",categoria_cnh = :categoria_cnh";
		 $sql .= ",validade_cnh = :validade_cnh";
		 $sql .= ",validade_cve = :validade_cve";
		 $sql .= ",genero = :genero";
		 $sql .= ",tipo_sangue = :tipo_sangue";
		 $sql .= ",id_funcao = :id_funcao";
		 $sql .= ",matricula_funcional = :matricula_funcional";
		 $sql .= ",id_endereco = :id_endereco";
		 $sql .= ",data_inclusao = :data_inclusao";
		 $sql .= ",foto = :foto";
		 $sql .= ",email = :email";
		 $sql .= ",id_consorcio = :id_consorcio";
		 $sql .= ",id_base = :id_base";
		 $sql .= ",altura = :altura";
		 $sql .= ",peso = :peso";
		 $sql .= ",id_etnia = :id_etnia";
		 $sql .= ",id_romaneio = :id_romaneio";
		 $sql .= ",id_formacao = :id_formacao";
		 $sql .= ",data_hora_cdastro = :data_hora_cdastro";

		$sql .= ' WHERE id = ?';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":apelido",$this->apelido,PDO::PARAM_STR);
		 $stmt->bindParam(":nome_mae",$this->nome_mae,PDO::PARAM_STR);
		 $stmt->bindParam(":nome_pai",$this->nome_pai,PDO::PARAM_STR);
		 $stmt->bindParam(":data_nascimento",$this->data_nascimento,PDO::PARAM_STR);
		 $stmt->bindParam(":naturalidade",$this->naturalidade,PDO::PARAM_STR);
		 $stmt->bindParam(":rg",$this->rg,PDO::PARAM_STR);
		 $stmt->bindParam(":cpf",$this->cpf,PDO::PARAM_STR);
		 $stmt->bindParam(":pis",$this->pis,PDO::PARAM_STR);
		 $stmt->bindParam(":cnh",$this->cnh,PDO::PARAM_STR);
		 $stmt->bindParam(":categoria_cnh",$this->categoria_cnh,PDO::PARAM_STR);
		 $stmt->bindParam(":validade_cnh",$this->validade_cnh,PDO::PARAM_STR);
		 $stmt->bindParam(":validade_cve",$this->validade_cve,PDO::PARAM_STR);
		 $stmt->bindParam(":genero",$this->genero,PDO::PARAM_STR);
		 $stmt->bindParam(":tipo_sangue",$this->tipo_sangue,PDO::PARAM_STR);
		 $stmt->bindParam(":id_funcao",$this->id_funcao,PDO::PARAM_INT);
		 $stmt->bindParam(":matricula_funcional",$this->matricula_funcional,PDO::PARAM_STR);
		 $stmt->bindParam(":id_endereco",$this->id_endereco,PDO::PARAM_INT);
		 $stmt->bindParam(":data_inclusao",$this->data_inclusao,PDO::PARAM_STR);
		 $stmt->bindParam(":foto",$this->foto,PDO::PARAM_STR);
		 $stmt->bindParam(":email",$this->email,PDO::PARAM_STR);
		 $stmt->bindParam(":id_consorcio",$this->id_consorcio,PDO::PARAM_INT);
		 $stmt->bindParam(":id_base",$this->id_base,PDO::PARAM_INT);
		 $stmt->bindParam(":altura",$this->altura,PDO::PARAM_STR);
		 $stmt->bindParam(":peso",$this->peso,PDO::PARAM_INT);
		 $stmt->bindParam(":id_etnia",$this->id_etnia,PDO::PARAM_INT);
		 $stmt->bindParam(":id_romaneio",$this->id_romaneio,PDO::PARAM_INT);
		 $stmt->bindParam(":id_formacao",$this->id_formacao,PDO::PARAM_INT);
		 $stmt->bindParam(":data_hora_cdastro",$this->data_hora_cdastro,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal WHERE id IN({$lista})";
		$sql = "UPDATE pessoal SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE pessoal.id > 0
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND pessoal.data_hora_cadastro >='{$param['data_hora_inicio']}' AND pessoal.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal
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
				pessoal.*
			FROM pessoal
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal.id DESC";
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
		$sql = "SELECT * FROM pessoal WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
}
