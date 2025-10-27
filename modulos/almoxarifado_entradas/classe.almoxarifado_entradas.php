<?php
class AlmoxarifadoEntradas
{
	private $id;
	private $id_grupo;
	private $id_almoxarifado;
	private $id_setor;
	private $numero_nota_fiscal;
	private $data_emissao_nota_fiscal;
	private $numero_documento;
	private $numero_empenho;
	private $numero_requisicao;
	private $data_solicitacao;
	private $data_recebimento;
	private $valor_nota;
	private $descricao;
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
 	
	public function setIdGrupo($arg)
	{
		$this->id_grupo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdGrupo()
	{
		return $this->id_grupo;
	}
 	
	public function setIdAlmoxarifado($arg)
	{
		$this->id_almoxarifado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAlmoxarifado()
	{
		return $this->id_almoxarifado;
	}
 	
	public function setIdSetor($arg)
	{
		$this->id_setor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdSetor()
	{
		return $this->id_setor;
	}
 	
	public function setNumeroNotaFiscal($arg)
	{
		$this->numero_nota_fiscal = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroNotaFiscal()
	{
		return $this->numero_nota_fiscal;
	}
 	
	public function setDataEmissaoNotaFiscal($arg)
	{
		$this->data_emissao_nota_fiscal = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataEmissaoNotaFiscal()
	{
		return $this->data_emissao_nota_fiscal;
	}
 	
	public function setNumeroDocumento($arg)
	{
		$this->numero_documento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroDocumento()
	{
		return $this->numero_documento;
	}
 	
	public function setNumeroEmpenho($arg)
	{
		$this->numero_empenho = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroEmpenho()
	{
		return $this->numero_empenho;
	}
 	
	public function setNumeroRequisicao($arg)
	{
		$this->numero_requisicao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroRequisicao()
	{
		return $this->numero_requisicao;
	}
 	
	public function setDataSolicitacao($arg)
	{
		$this->data_solicitacao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataSolicitacao()
	{
		return $this->data_solicitacao;
	}
 	
	public function setDataRecebimento($arg)
	{
		$this->data_recebimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataRecebimento()
	{
		return $this->data_recebimento;
	}
 	
	public function setValorNota($arg)
	{
		$this->valor_nota = str_replace(",", ".", str_replace(".", "", $arg));
	}
 	
	public function getValorNota()
	{
		return $this->valor_nota;
	}
 	
	public function setDescricao($arg)
	{
		$this->descricao = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDescricao()
	{
		return $this->descricao;
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
		INSERT INTO almoxarifado_entradas SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";
		 $sql .= ",id_setor = :id_setor";
		 $sql .= ",numero_nota_fiscal = :numero_nota_fiscal";
		 $sql .= ",data_emissao_nota_fiscal = :data_emissao_nota_fiscal";
		 $sql .= ",numero_documento = :numero_documento";
		 $sql .= ",numero_empenho = :numero_empenho";
		 $sql .= ",numero_requisicao = :numero_requisicao";
		 $sql .= ",data_solicitacao = :data_solicitacao";
		 $sql .= ",data_recebimento = :data_recebimento";
		 $sql .= ",valor_nota = :valor_nota";
		 $sql .= ",descricao = :descricao";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		 $stmt->bindParam(":id_setor",$this->id_setor,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_nota_fiscal",$this->numero_nota_fiscal,PDO::PARAM_INT);
		 $stmt->bindParam(":data_emissao_nota_fiscal",$this->data_emissao_nota_fiscal,PDO::PARAM_STR);
		 $stmt->bindParam(":numero_documento",$this->numero_documento,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_empenho",$this->numero_empenho,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_requisicao",$this->numero_requisicao,PDO::PARAM_INT);
		 $stmt->bindParam(":data_solicitacao",$this->data_solicitacao,PDO::PARAM_STR);
		 $stmt->bindParam(":data_recebimento",$this->data_recebimento,PDO::PARAM_STR);
		 $stmt->bindParam(":valor_nota",$this->valor_nota,PDO::PARAM_STR);
		 $stmt->bindParam(":descricao",$this->descricao,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE almoxarifado_entradas SET id_almoxarifado = :id_almoxarifado';
		 $sql .= ",id_setor = :id_setor";
		 $sql .= ",numero_nota_fiscal = :numero_nota_fiscal";
		 $sql .= ",data_emissao_nota_fiscal = :data_emissao_nota_fiscal";
		 $sql .= ",numero_documento = :numero_documento";
		 $sql .= ",numero_empenho = :numero_empenho";
		 $sql .= ",numero_requisicao = :numero_requisicao";
		 $sql .= ",data_solicitacao = :data_solicitacao";
		 $sql .= ",data_recebimento = :data_recebimento";
		 $sql .= ",valor_nota = :valor_nota";
		 $sql .= ",descricao = :descricao";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		 $stmt->bindParam(":id_setor",$this->id_setor,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_nota_fiscal",$this->numero_nota_fiscal,PDO::PARAM_INT);
		 $stmt->bindParam(":data_emissao_nota_fiscal",$this->data_emissao_nota_fiscal,PDO::PARAM_STR);
		 $stmt->bindParam(":numero_documento",$this->numero_documento,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_empenho",$this->numero_empenho,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_requisicao",$this->numero_requisicao,PDO::PARAM_INT);
		 $stmt->bindParam(":data_solicitacao",$this->data_solicitacao,PDO::PARAM_STR);
		 $stmt->bindParam(":data_recebimento",$this->data_recebimento,PDO::PARAM_STR);
		 $stmt->bindParam(":valor_nota",$this->valor_nota,PDO::PARAM_STR);
		 $stmt->bindParam(":descricao",$this->descricao,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM almoxarifado_entradas WHERE id IN({$lista})";
		$sql = "UPDATE almoxarifado_entradas SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		    INNER JOIN almoxarifado ON(almoxarifado.id = almoxarifado_entradas.id_almoxarifado)
		    INNER JOIN almoxarifado_setor ON(almoxarifado_setor.id = almoxarifado_entradas.id_setor)
		";
		
		$where = "
			WHERE almoxarifado_entradas.excluido IS NULL
		";
		
		//if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (almoxarifado.nome LIKE :busca OR almoxarifado_setor.nome LIKE :busca OR almoxarifado_entradas.numero_nota_fiscal LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND almoxarifado_entradas.data_hora_cadastro >='{$param['data_hora_inicio']}' AND almoxarifado_entradas.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM almoxarifado_entradas
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
				almoxarifado_entradas.*
			    ,almoxarifado.nome as nome_almoxarifado
			    ,almoxarifado_setor.nome as nome_setor
			,(SELECT GROUP_CONCAT(produtos.nome) FROM almoxarifado_entradas_itens INNER JOIN produtos ON(produtos.id = almoxarifado_entradas_itens.id_produto) WHERE id_entrada = almoxarifado_entradas.id AND almoxarifado_entradas_itens.excluido IS NULL)  as itens
			FROM almoxarifado_entradas
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY almoxarifado_entradas.id DESC";
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
		$sql = "SELECT * FROM almoxarifado_entradas WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM almoxarifado_entradas WHERE excluido IS NULL";
            if($id != "") $sql .= " AND almoxarifado_entradas.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         almoxarifado_entradas.id,
                         almoxarifado_entradas.nome  AS text
                     FROM almoxarifado_entradas
                     WHERE almoxarifado_entradas.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (almoxarifado_entradas.nome LIKE '%$busca%' OR almoxarifado_entradas.id  LIKE '%$busca%') ";
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
    
            $objAlmoxarifadoEntradas= new AlmoxarifadoEntradas();
            $registros = $objAlmoxarifadoEntradas->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
