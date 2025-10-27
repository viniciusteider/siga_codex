<?php
class Produtos
{
	private $id;
	private $nome;
	private $id_produto_grupo;
	private $id_produto_subgrupo;
	private $id_tipo_produto;
	private $id_setor;
	private $id_fornecedor;
	private $id_fabricante;
	private $id_cor;
	private $id_unidade_medida;
	private $estoque_atual;
	private $estoque_minimo;
	private $custo;
	private $codigo_barras;
	private $id_marca;
	private $local;
	private $compartimento;
	private $referencia;
	private $data_cadastro;
	private $data_validade;
	private $retornavel;
	private $controla_estoque;
	private $id_almoxarifado;
	private $saldo_inicial;
	private $total;
	private $cautelado;
	private $foto;
	private $prefixo;
	private $numero_serie;
	private $numero_patrimonio;
	private $id_caracteristica;
	private $id_tipo;
	private $id_estoque;
	private $numero_tamanho;
	private $id_modelo;
	private $acabamento;
	private $comprimento;
	private $altura;
	private $profundidade;
	private $registro;
	private $visualizar_relatorios;
	private $id_grupo;
	private $id_revestimento;
	private $id_tipo_bem;
	private $codigo_interno;
	private $codigo_prefeitura;
	private $quantidade_dia_cautela;
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
 	
	public function setNome($arg)
	{
		$this->nome = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNome()
	{
		return $this->nome;
	}
 	
	public function setIdProdutoGrupo($arg)
	{
		$this->id_produto_grupo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdProdutoGrupo()
	{
		return $this->id_produto_grupo;
	}
 	
	public function setIdProdutoSubgrupo($arg)
	{
		$this->id_produto_subgrupo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdProdutoSubgrupo()
	{
		return $this->id_produto_subgrupo;
	}
 	
	public function setIdTipoProduto($arg)
	{
		$this->id_tipo_produto = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoProduto()
	{
		return $this->id_tipo_produto;
	}
 	
	public function setIdSetor($arg)
	{
		$this->id_setor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdSetor()
	{
		return $this->id_setor;
	}
 	
	public function setIdFornecedor($arg)
	{
		$this->id_fornecedor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdFornecedor()
	{
		return $this->id_fornecedor;
	}
 	
	public function setIdFabricante($arg)
	{
		$this->id_fabricante = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdFabricante()
	{
		return $this->id_fabricante;
	}
 	
	public function setIdCor($arg)
	{
		$this->id_cor = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCor()
	{
		return $this->id_cor;
	}
 	
	public function setIdUnidadeMedida($arg)
	{
		$this->id_unidade_medida = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdUnidadeMedida()
	{
		return $this->id_unidade_medida;
	}
 	
	public function setEstoqueAtual($arg)
	{
		$this->estoque_atual = ($arg == "") ? NULL : $arg;
	}
 	
	public function getEstoqueAtual()
	{
		return $this->estoque_atual;
	}
 	
	public function setEstoqueMinimo($arg)
	{
		$this->estoque_minimo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getEstoqueMinimo()
	{
		return $this->estoque_minimo;
	}
 	
	public function setCusto($arg)
	{
        $this->custo = str_replace(",", ".", str_replace(".", "", $arg));
	}
 	
	public function getCusto()
	{
		return $this->custo;
	}
 	
	public function setCodigoBarras($arg)
	{
		$this->codigo_barras = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCodigoBarras()
	{
		return $this->codigo_barras;
	}
 	
	public function setIdMarca($arg)
	{
		$this->id_marca = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdMarca()
	{
		return $this->id_marca;
	}
 	
	public function setLocal($arg)
	{
		$this->local = ($arg == "") ? NULL : $arg;
	}
 	
	public function getLocal()
	{
		return $this->local;
	}
 	
	public function setCompartimento($arg)
	{
		$this->compartimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCompartimento()
	{
		return $this->compartimento;
	}
 	
	public function setReferencia($arg)
	{
		$this->referencia = ($arg == "") ? NULL : $arg;
	}
 	
	public function getReferencia()
	{
		return $this->referencia;
	}
 	
	public function setDataCadastro($arg)
	{
		$this->data_cadastro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataCadastro()
	{
		return $this->data_cadastro;
	}
 	
	public function setDataValidade($arg)
	{
		$this->data_validade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataValidade()
	{
		return $this->data_validade;
	}
 	
	public function setRetornavel($arg)
	{
		$this->retornavel = ($arg == "") ? NULL : $arg;
	}
 	
	public function getRetornavel()
	{
		return $this->retornavel;
	}
 	
	public function setControlaEstoque($arg)
	{
		$this->controla_estoque = ($arg == "") ? NULL : $arg;
	}
 	
	public function getControlaEstoque()
	{
		return $this->controla_estoque;
	}
 	
	public function setIdAlmoxarifado($arg)
	{
		$this->id_almoxarifado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdAlmoxarifado()
	{
		return $this->id_almoxarifado;
	}
 	
	public function setSaldoInicial($arg)
	{
		$this->saldo_inicial = ($arg == "") ? NULL : $arg;
	}
 	
	public function getSaldoInicial()
	{
		return $this->saldo_inicial;
	}
 	
	public function setTotal($arg)
	{
		$this->total = ($arg == "") ? NULL : $arg;
	}
 	
	public function getTotal()
	{
		return $this->total;
	}
 	
	public function setCautelado($arg)
	{
		$this->cautelado = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCautelado()
	{
		return $this->cautelado;
	}
 	
	public function setFoto($arg)
	{
		$this->foto = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFoto()
	{
		return $this->foto;
	}
 	
	public function setPrefixo($arg)
	{
		$this->prefixo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getPrefixo()
	{
		return $this->prefixo;
	}
 	
	public function setNumeroSerie($arg)
	{
		$this->numero_serie = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroSerie()
	{
		return $this->numero_serie;
	}
 	
	public function setNumeroPatrimonio($arg)
	{
		$this->numero_patrimonio = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroPatrimonio()
	{
		return $this->numero_patrimonio;
	}
 	
	public function setIdCaracteristica($arg)
	{
		$this->id_caracteristica = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdCaracteristica()
	{
		return $this->id_caracteristica;
	}
 	
	public function setIdTipo($arg)
	{
		$this->id_tipo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipo()
	{
		return $this->id_tipo;
	}
 	
	public function setIdEstoque($arg)
	{
		$this->id_estoque = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdEstoque()
	{
		return $this->id_estoque;
	}
 	
	public function setNumeroTamanho($arg)
	{
		$this->numero_tamanho = ($arg == "") ? NULL : $arg;
	}
 	
	public function getNumeroTamanho()
	{
		return $this->numero_tamanho;
	}
 	
	public function setIdModelo($arg)
	{
		$this->id_modelo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdModelo()
	{
		return $this->id_modelo;
	}
 	
	public function setAcabamento($arg)
	{
		$this->acabamento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getAcabamento()
	{
		return $this->acabamento;
	}
 	
	public function setComprimento($arg)
	{
		$this->comprimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getComprimento()
	{
		return $this->comprimento;
	}
 	
	public function setAltura($arg)
	{
		$this->altura = ($arg == "") ? NULL : $arg;
	}
 	
	public function getAltura()
	{
		return $this->altura;
	}
 	
	public function setProfundidade($arg)
	{
		$this->profundidade = ($arg == "") ? NULL : $arg;
	}
 	
	public function getProfundidade()
	{
		return $this->profundidade;
	}
 	
	public function setRegistro($arg)
	{
		$this->registro = ($arg == "") ? NULL : $arg;
	}
 	
	public function getRegistro()
	{
		return $this->registro;
	}
 	
	public function setVisualizarRelatorios($arg)
	{
		$this->visualizar_relatorios = ($arg == "") ? NULL : $arg;
	}
 	
	public function getVisualizarRelatorios()
	{
		return $this->visualizar_relatorios;
	}
 	
	public function setIdGrupo($arg)
	{
		$this->id_grupo = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdGrupo()
	{
		return $this->id_grupo;
	}
 	
	public function setIdRevestimento($arg)
	{
		$this->id_revestimento = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdRevestimento()
	{
		return $this->id_revestimento;
	}
 	
	public function setIdTipoBem($arg)
	{
		$this->id_tipo_bem = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoBem()
	{
		return $this->id_tipo_bem;
	}
 	
	public function setCodigoInterno($arg)
	{
		$this->codigo_interno = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCodigoInterno()
	{
		return $this->codigo_interno;
	}
 	
	public function setCodigoPrefeitura($arg)
	{
		$this->codigo_prefeitura = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCodigoPrefeitura()
	{
		return $this->codigo_prefeitura;
	}
 	
	public function setQuantidadeDiaCautela($arg)
	{
		$this->quantidade_dia_cautela = ($arg == "") ? NULL : $arg;
	}
 	
	public function getQuantidadeDiaCautela()
	{
		return $this->quantidade_dia_cautela;
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
		INSERT INTO produtos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",nome = :nome";
		 $sql .= ",id_produto_grupo = :id_produto_grupo";
		 $sql .= ",id_produto_subgrupo = :id_produto_subgrupo";
		 $sql .= ",id_tipo_produto = :id_tipo_produto";
		 $sql .= ",id_setor = :id_setor";
		 $sql .= ",id_fornecedor = :id_fornecedor";
		 $sql .= ",id_fabricante = :id_fabricante";
		 $sql .= ",id_cor = :id_cor";
		 $sql .= ",id_unidade_medida = :id_unidade_medida";
		 $sql .= ",estoque_atual = :estoque_atual";
		 $sql .= ",estoque_minimo = :estoque_minimo";
		 $sql .= ",custo = :custo";
		 $sql .= ",codigo_barras = :codigo_barras";
		 $sql .= ",id_marca = :id_marca";
		 $sql .= ",local = :local";
		 $sql .= ",compartimento = :compartimento";
		 $sql .= ",referencia = :referencia";
		 $sql .= ",data_cadastro = :data_cadastro";
		 $sql .= ",data_validade = :data_validade";
		 $sql .= ",retornavel = :retornavel";
		 $sql .= ",controla_estoque = :controla_estoque";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";
		 $sql .= ",saldo_inicial = :saldo_inicial";
		 $sql .= ",total = :total";
		 $sql .= ",cautelado = :cautelado";
		 $sql .= ",foto = :foto";
		 $sql .= ",prefixo = :prefixo";
		 $sql .= ",numero_serie = :numero_serie";
		 $sql .= ",numero_patrimonio = :numero_patrimonio";
		 $sql .= ",id_caracteristica = :id_caracteristica";
		 $sql .= ",id_tipo = :id_tipo";
		 $sql .= ",id_estoque = :id_estoque";
		 $sql .= ",numero_tamanho = :numero_tamanho";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",acabamento = :acabamento";
		 $sql .= ",comprimento = :comprimento";
		 $sql .= ",altura = :altura";
		 $sql .= ",profundidade = :profundidade";
		 $sql .= ",registro = :registro";
		 $sql .= ",visualizar_relatorios = :visualizar_relatorios";
		 $sql .= ",id_grupo = :id_grupo";
		 $sql .= ",id_revestimento = :id_revestimento";
		 $sql .= ",id_tipo_bem = :id_tipo_bem";
		 $sql .= ",codigo_interno = :codigo_interno";
		 $sql .= ",codigo_prefeitura = :codigo_prefeitura";
		 $sql .= ",quantidade_dia_cautela = :quantidade_dia_cautela";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":id_produto_grupo",$this->id_produto_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_produto_subgrupo",$this->id_produto_subgrupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_produto",$this->id_tipo_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_setor",$this->id_setor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_fornecedor",$this->id_fornecedor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_fabricante",$this->id_fabricante,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cor",$this->id_cor,PDO::PARAM_STR);
		 $stmt->bindParam(":id_unidade_medida",$this->id_unidade_medida,PDO::PARAM_STR);
		 $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
		 $stmt->bindParam(":estoque_minimo",$this->estoque_minimo,PDO::PARAM_INT);
		 $stmt->bindParam(":custo",$this->custo,PDO::PARAM_STR);
		 $stmt->bindParam(":codigo_barras",$this->codigo_barras,PDO::PARAM_INT);
		 $stmt->bindParam(":id_marca",$this->id_marca,PDO::PARAM_STR);
		 $stmt->bindParam(":local",$this->local,PDO::PARAM_INT);
		 $stmt->bindParam(":compartimento",$this->compartimento,PDO::PARAM_INT);
		 $stmt->bindParam(":referencia",$this->referencia,PDO::PARAM_STR);
		 $stmt->bindParam(":data_cadastro",$this->data_cadastro,PDO::PARAM_STR);
		 $stmt->bindParam(":data_validade",$this->data_validade,PDO::PARAM_STR);
		 $stmt->bindParam(":retornavel",$this->retornavel,PDO::PARAM_INT);
		 $stmt->bindParam(":controla_estoque",$this->controla_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		 $stmt->bindParam(":saldo_inicial",$this->saldo_inicial,PDO::PARAM_INT);
		 $stmt->bindParam(":total",$this->total,PDO::PARAM_STR);
		 $stmt->bindParam(":cautelado",$this->cautelado,PDO::PARAM_INT);
		 $stmt->bindParam(":foto",$this->foto,PDO::PARAM_STR);
		 $stmt->bindParam(":prefixo",$this->prefixo,PDO::PARAM_STR);
		 $stmt->bindParam(":numero_serie",$this->numero_serie,PDO::PARAM_STR);
		 $stmt->bindParam(":numero_patrimonio",$this->numero_patrimonio,PDO::PARAM_STR);
		 $stmt->bindParam(":id_caracteristica",$this->id_caracteristica,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo",$this->id_tipo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_estoque",$this->id_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_tamanho",$this->numero_tamanho,PDO::PARAM_STR);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":acabamento",$this->acabamento,PDO::PARAM_STR);
		 $stmt->bindParam(":comprimento",$this->comprimento,PDO::PARAM_STR);
		 $stmt->bindParam(":altura",$this->altura,PDO::PARAM_INT);
		 $stmt->bindParam(":profundidade",$this->profundidade,PDO::PARAM_INT);
		 $stmt->bindParam(":registro",$this->registro,PDO::PARAM_STR);
		 $stmt->bindParam(":visualizar_relatorios",$this->visualizar_relatorios,PDO::PARAM_INT);
		 $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_revestimento",$this->id_revestimento,PDO::PARAM_STR);
		 $stmt->bindParam(":id_tipo_bem",$this->id_tipo_bem,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_interno",$this->codigo_interno,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_prefeitura",$this->codigo_prefeitura,PDO::PARAM_INT);
		 $stmt->bindParam(":quantidade_dia_cautela",$this->quantidade_dia_cautela,PDO::PARAM_INT);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE produtos SET nome = :nome';
		 $sql .= ",id_produto_grupo = :id_produto_grupo";
		 $sql .= ",id_produto_subgrupo = :id_produto_subgrupo";
		 $sql .= ",id_tipo_produto = :id_tipo_produto";
		 $sql .= ",id_setor = :id_setor";
		 $sql .= ",id_fornecedor = :id_fornecedor";
		 $sql .= ",id_fabricante = :id_fabricante";
		 $sql .= ",id_cor = :id_cor";
		 $sql .= ",id_unidade_medida = :id_unidade_medida";
		 $sql .= ",estoque_atual = :estoque_atual";
		 $sql .= ",estoque_minimo = :estoque_minimo";
		 $sql .= ",custo = :custo";
		 $sql .= ",codigo_barras = :codigo_barras";
		 $sql .= ",id_marca = :id_marca";
		 $sql .= ",local = :local";
		 $sql .= ",compartimento = :compartimento";
		 $sql .= ",referencia = :referencia";
		 $sql .= ",data_cadastro = :data_cadastro";
		 $sql .= ",data_validade = :data_validade";
		 $sql .= ",retornavel = :retornavel";
		 $sql .= ",controla_estoque = :controla_estoque";
		 $sql .= ",id_almoxarifado = :id_almoxarifado";
		 $sql .= ",saldo_inicial = :saldo_inicial";
		 $sql .= ",total = :total";
		 $sql .= ",cautelado = :cautelado";
		 $sql .= ",foto = :foto";
		 $sql .= ",prefixo = :prefixo";
		 $sql .= ",numero_serie = :numero_serie";
		 $sql .= ",numero_patrimonio = :numero_patrimonio";
		 $sql .= ",id_caracteristica = :id_caracteristica";
		 $sql .= ",id_tipo = :id_tipo";
		 $sql .= ",id_estoque = :id_estoque";
		 $sql .= ",numero_tamanho = :numero_tamanho";
		 $sql .= ",id_modelo = :id_modelo";
		 $sql .= ",acabamento = :acabamento";
		 $sql .= ",comprimento = :comprimento";
		 $sql .= ",altura = :altura";
		 $sql .= ",profundidade = :profundidade";
		 $sql .= ",registro = :registro";
		 $sql .= ",visualizar_relatorios = :visualizar_relatorios";
		 $sql .= ",id_revestimento = :id_revestimento";
		 $sql .= ",id_tipo_bem = :id_tipo_bem";
		 $sql .= ",codigo_interno = :codigo_interno";
		 $sql .= ",codigo_prefeitura = :codigo_prefeitura";
		 $sql .= ",quantidade_dia_cautela = :quantidade_dia_cautela";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
		 $stmt->bindParam(":id_produto_grupo",$this->id_produto_grupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_produto_subgrupo",$this->id_produto_subgrupo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_produto",$this->id_tipo_produto,PDO::PARAM_INT);
		 $stmt->bindParam(":id_setor",$this->id_setor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_fornecedor",$this->id_fornecedor,PDO::PARAM_INT);
		 $stmt->bindParam(":id_fabricante",$this->id_fabricante,PDO::PARAM_INT);
		 $stmt->bindParam(":id_cor",$this->id_cor,PDO::PARAM_STR);
		 $stmt->bindParam(":id_unidade_medida",$this->id_unidade_medida,PDO::PARAM_STR);
		 $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
		 $stmt->bindParam(":estoque_minimo",$this->estoque_minimo,PDO::PARAM_INT);
		 $stmt->bindParam(":custo",$this->custo,PDO::PARAM_STR);
		 $stmt->bindParam(":codigo_barras",$this->codigo_barras,PDO::PARAM_INT);
		 $stmt->bindParam(":id_marca",$this->id_marca,PDO::PARAM_STR);
		 $stmt->bindParam(":local",$this->local,PDO::PARAM_INT);
		 $stmt->bindParam(":compartimento",$this->compartimento,PDO::PARAM_INT);
		 $stmt->bindParam(":referencia",$this->referencia,PDO::PARAM_STR);
		 $stmt->bindParam(":data_cadastro",$this->data_cadastro,PDO::PARAM_STR);
		 $stmt->bindParam(":data_validade",$this->data_validade,PDO::PARAM_STR);
		 $stmt->bindParam(":retornavel",$this->retornavel,PDO::PARAM_INT);
		 $stmt->bindParam(":controla_estoque",$this->controla_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":id_almoxarifado",$this->id_almoxarifado,PDO::PARAM_INT);
		 $stmt->bindParam(":saldo_inicial",$this->saldo_inicial,PDO::PARAM_INT);
		 $stmt->bindParam(":total",$this->total,PDO::PARAM_STR);
		 $stmt->bindParam(":cautelado",$this->cautelado,PDO::PARAM_INT);
		 $stmt->bindParam(":foto",$this->foto,PDO::PARAM_STR);
		 $stmt->bindParam(":prefixo",$this->prefixo,PDO::PARAM_STR);
		 $stmt->bindParam(":numero_serie",$this->numero_serie,PDO::PARAM_STR);
		 $stmt->bindParam(":numero_patrimonio",$this->numero_patrimonio,PDO::PARAM_STR);
		 $stmt->bindParam(":id_caracteristica",$this->id_caracteristica,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo",$this->id_tipo,PDO::PARAM_INT);
		 $stmt->bindParam(":id_estoque",$this->id_estoque,PDO::PARAM_INT);
		 $stmt->bindParam(":numero_tamanho",$this->numero_tamanho,PDO::PARAM_STR);
		 $stmt->bindParam(":id_modelo",$this->id_modelo,PDO::PARAM_INT);
		 $stmt->bindParam(":acabamento",$this->acabamento,PDO::PARAM_STR);
		 $stmt->bindParam(":comprimento",$this->comprimento,PDO::PARAM_STR);
		 $stmt->bindParam(":altura",$this->altura,PDO::PARAM_INT);
		 $stmt->bindParam(":profundidade",$this->profundidade,PDO::PARAM_INT);
		 $stmt->bindParam(":registro",$this->registro,PDO::PARAM_STR);
		 $stmt->bindParam(":visualizar_relatorios",$this->visualizar_relatorios,PDO::PARAM_INT);
		 $stmt->bindParam(":id_revestimento",$this->id_revestimento,PDO::PARAM_STR);
		 $stmt->bindParam(":id_tipo_bem",$this->id_tipo_bem,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_interno",$this->codigo_interno,PDO::PARAM_INT);
		 $stmt->bindParam(":codigo_prefeitura",$this->codigo_prefeitura,PDO::PARAM_INT);
		 $stmt->bindParam(":quantidade_dia_cautela",$this->quantidade_dia_cautela,PDO::PARAM_INT);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
    public function AtualizarEstoque($anterior = 0)
    {
        $pdo = $this->getConexao();
        if($anterior > 0)
            $sql = 'UPDATE produtos SET estoque_atual = estoque_atual - '.$anterior.' + :estoque_atual';
        else
            $sql = 'UPDATE produtos SET estoque_atual = estoque_atual + :estoque_atual';

        $sql .= ",custo = :custo";
        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
        $stmt->bindParam(":custo",$this->custo,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function RemoverEstoque()
    {
        $pdo = $this->getConexao();
        $sql = 'UPDATE produtos SET estoque_atual = estoque_atual - :estoque_atual';
        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function AdcicionarEstoque()
    {
        $pdo = $this->getConexao();
        $sql = 'UPDATE produtos SET estoque_atual = estoque_atual + :estoque_atual';
        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":estoque_atual",$this->estoque_atual,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function BaixaEstoque($quantidade)
    {
        $pdo = $this->getConexao();
        $sql = 'UPDATE produtos SET estoque_atual = estoque_atual - :quantidade';
        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":quantidade",$quantidade,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM produtos WHERE id IN({$lista})";
		$sql = "UPDATE produtos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($param)
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE produtos.excluido IS NULL
		";
		
		//if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
		if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND produtos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND produtos.data_hora_cadastro <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM produtos
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
				produtos.*
			FROM produtos
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY produtos.id DESC";
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
		$sql = "SELECT * FROM produtos WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM produtos WHERE excluido IS NULL";
            if($id != "") $sql .= " AND produtos.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         produtos.id,
                         produtos.nome  AS text
                     FROM produtos
                     WHERE produtos.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (produtos.nome LIKE '%$busca%' OR produtos.id  LIKE '%$busca%') ";
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
    
            $objProdutos= new Produtos();
            $registros = $objProdutos->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
