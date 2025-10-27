<?php
class Recursos
{
    private $id;
    private $id_grupo;
    private $prefixo;
    private $id_tipo_recurso;
    private $placa;
    private $ufplaca;
    private $id_modelo;
    private $ano_modelo;
    private $ano_fabricacao;
    private $renavam;
    private $chassi;
    private $id_consorcio;
    private $id_base;
    private $foto_frente;
    private $foto_traseira;
    private $foto_direita;
    private $foto_esquerda;
    private $data_carga;
    private $observacao;
    private $id_tipo_combustivel;
    private $id_cor;
    private $valor_aquisicao;
    private $valor_mercado;
    private $km_aquisicao;
    private $km_atual;
    private $potencia;
    private $cilindradas;
    private $peso_liquido;
    private $tanque;
    private $disponibilidade;
    private $proprietario;
    private $data_baixa;
    private $destino_baixa;
    private $data_final_garantia;
    private $capacidade_carga;
    private $latitude;
    private $longitude;
    private $id_unidade_rastreamento;
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

    public function setPrefixo($arg)
    {
        $this->prefixo = ($arg == "") ? NULL : $arg;
    }

    public function getPrefixo()
    {
        return $this->prefixo;
    }

    public function setIdTipoRecurso($arg)
    {
        $this->id_tipo_recurso = ($arg == "") ? NULL : $arg;
    }

    public function getIdTipoRecurso()
    {
        return $this->id_tipo_recurso;
    }

    public function setPlaca($arg)
    {
        $this->placa = ($arg == "") ? NULL : $arg;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    public function setUfplaca($arg)
    {
        $this->ufplaca = ($arg == "") ? NULL : $arg;
    }

    public function getUfplaca()
    {
        return $this->ufplaca;
    }

    public function setIdModelo($arg)
    {
        $this->id_modelo = ($arg == "") ? NULL : $arg;
    }

    public function getIdModelo()
    {
        return $this->id_modelo;
    }

    public function setAnoModelo($arg)
    {
        $this->ano_modelo = ($arg == "") ? NULL : $arg;
    }

    public function getAnoModelo()
    {
        return $this->ano_modelo;
    }

    public function setAnoFabricacao($arg)
    {
        $this->ano_fabricacao = ($arg == "") ? NULL : $arg;
    }

    public function getAnoFabricacao()
    {
        return $this->ano_fabricacao;
    }

    public function setRenavam($arg)
    {
        $this->renavam = ($arg == "") ? NULL : $arg;
    }

    public function getRenavam()
    {
        return $this->renavam;
    }

    public function setChassi($arg)
    {
        $this->chassi = ($arg == "") ? NULL : $arg;
    }

    public function getChassi()
    {
        return $this->chassi;
    }

    public function setIdConsorcio($arg)
    {
        $this->id_consorcio = ($arg == "") ? NULL : $arg;
    }

    public function getIdConsorcio()
    {
        return $this->id_consorcio;
    }

    public function setIdBase($arg)
    {
        $this->id_base = ($arg == "") ? NULL : $arg;
    }

    public function getIdBase()
    {
        return $this->id_base;
    }

    public function setFotoFrente($arg)
    {
        $this->foto_frente = ($arg == "") ? NULL : $arg;
    }

    public function getFotoFrente()
    {
        return $this->foto_frente;
    }

    public function setFotoTraseira($arg)
    {
        $this->foto_traseira = ($arg == "") ? NULL : $arg;
    }

    public function getFotoTraseira()
    {
        return $this->foto_traseira;
    }

    public function setFotoDireita($arg)
    {
        $this->foto_direita = ($arg == "") ? NULL : $arg;
    }

    public function getFotoDireita()
    {
        return $this->foto_direita;
    }

    public function setFotoEsquerda($arg)
    {
        $this->foto_esquerda = ($arg == "") ? NULL : $arg;
    }

    public function getFotoEsquerda()
    {
        return $this->foto_esquerda;
    }

    public function setDataCarga($arg)
    {
        $this->data_carga = ($arg == "") ? NULL : $arg;
    }

    public function getDataCarga()
    {
        return $this->data_carga;
    }

    public function setObservacao($arg)
    {
        $this->observacao = ($arg == "") ? NULL : $arg;
    }

    public function getObservacao()
    {
        return $this->observacao;
    }

    public function setIdTipoCombustivel($arg)
    {
        $this->id_tipo_combustivel = ($arg == "") ? NULL : $arg;
    }

    public function getIdTipoCombustivel()
    {
        return $this->id_tipo_combustivel;
    }

    public function setIdCor($arg)
    {
        $this->id_cor = ($arg == "") ? NULL : $arg;
    }

    public function getIdCor()
    {
        return $this->id_cor;
    }

    public function setValorAquisicao($arg)
    {
        $this->valor_aquisicao = str_replace(",", ".", str_replace(".", "", $arg));
    }

    public function getValorAquisicao()
    {
        return $this->valor_aquisicao;
    }

    public function setValorMercado($arg)
    {
        $this->valor_mercado = str_replace(",", ".", str_replace(".", "", $arg));
    }

    public function getValorMercado()
    {
        return $this->valor_mercado;
    }

    public function setKmAquisicao($arg)
    {
        $this->km_aquisicao = ($arg == "") ? NULL : $arg;
    }

    public function getKmAquisicao()
    {
        return $this->km_aquisicao;
    }

    public function setKmAtual($arg)
    {
        $this->km_atual = ($arg == "") ? NULL : $arg;
    }

    public function getKmAtual()
    {
        return $this->km_atual;
    }

    public function setPotencia($arg)
    {
        $this->potencia = ($arg == "") ? NULL : $arg;
    }

    public function getPotencia()
    {
        return $this->potencia;
    }

    public function setCilindradas($arg)
    {
        $this->cilindradas = ($arg == "") ? NULL : $arg;
    }

    public function getCilindradas()
    {
        return $this->cilindradas;
    }

    public function setPesoLiquido($arg)
    {
        $this->peso_liquido = ($arg == "") ? NULL : $arg;
    }

    public function getPesoLiquido()
    {
        return $this->peso_liquido;
    }

    public function setTanque($arg)
    {
        $this->tanque = ($arg == "") ? NULL : $arg;
    }

    public function getTanque()
    {
        return $this->tanque;
    }

    public function setDisponibilidade($arg)
    {
        $this->disponibilidade = ($arg == "") ? NULL : $arg;
    }

    public function getDisponibilidade()
    {
        return $this->disponibilidade;
    }

    public function setProprietario($arg)
    {
        $this->proprietario = ($arg == "") ? NULL : $arg;
    }

    public function getProprietario()
    {
        return $this->proprietario;
    }

    public function setDataBaixa($arg)
    {
        $this->data_baixa = ($arg == "") ? NULL : $arg;
    }

    public function getDataBaixa()
    {
        return $this->data_baixa;
    }

    public function setDestinoBaixa($arg)
    {
        $this->destino_baixa = ($arg == "") ? NULL : $arg;
    }

    public function getDestinoBaixa()
    {
        return $this->destino_baixa;
    }

    public function setDataFinalGarantia($arg)
    {
        $this->data_final_garantia = ($arg == "") ? NULL : $arg;
    }

    public function getDataFinalGarantia()
    {
        return $this->data_final_garantia;
    }

    public function setCapacidadeCarga($arg)
    {
        $this->capacidade_carga = ($arg == "") ? NULL : $arg;
    }

    public function getCapacidadeCarga()
    {
        return $this->capacidade_carga;
    }

    public function setLatitude($arg)
    {
        $this->latitude = ($arg == "") ? NULL : $arg;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($arg)
    {
        $this->longitude = ($arg == "") ? NULL : $arg;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setIdUnidadeRastreamento($arg)
    {
        $this->id_unidade_rastreamento = ($arg == "") ? NULL : $arg;
    }

    public function getIdUnidadeRastreamento()
    {
        return $this->id_unidade_rastreamento;
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
		INSERT INTO recursos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo = :id_grupo";
        $sql .= ",prefixo = :prefixo";
        $sql .= ",id_tipo_recurso = :id_tipo_recurso";
        $sql .= ",placa = :placa";
        $sql .= ",ufplaca = :ufplaca";
        $sql .= ",id_modelo = :id_modelo";
        $sql .= ",ano_modelo = :ano_modelo";
        $sql .= ",ano_fabricacao = :ano_fabricacao";
        $sql .= ",renavam = :renavam";
        $sql .= ",chassi = :chassi";
        $sql .= ",id_consorcio = :id_consorcio";
        $sql .= ",id_base = :id_base";
        $sql .= ",foto_frente = :foto_frente";
        $sql .= ",foto_traseira = :foto_traseira";
        $sql .= ",foto_direita = :foto_direita";
        $sql .= ",foto_esquerda = :foto_esquerda";
        $sql .= ",data_carga = :data_carga";
        $sql .= ",observacao = :observacao";
        $sql .= ",id_tipo_combustivel = :id_tipo_combustivel";
        $sql .= ",id_cor = :id_cor";
        $sql .= ",valor_aquisicao = :valor_aquisicao";
        $sql .= ",valor_mercado = :valor_mercado";
        $sql .= ",km_aquisicao = :km_aquisicao";
        $sql .= ",km_atual = :km_atual";
        $sql .= ",potencia = :potencia";
        $sql .= ",cilindradas = :cilindradas";
        $sql .= ",peso_liquido = :peso_liquido";
        $sql .= ",tanque = :tanque";
        $sql .= ",disponibilidade = :disponibilidade";
        $sql .= ",proprietario = :proprietario";
        $sql .= ",data_baixa = :data_baixa";
        $sql .= ",destino_baixa = :destino_baixa";
        $sql .= ",data_final_garantia = :data_final_garantia";
        $sql .= ",capacidade_carga = :capacidade_carga";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo", $this->id_grupo, PDO::PARAM_INT);
        $stmt->bindParam(":prefixo", $this->prefixo, PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_recurso", $this->id_tipo_recurso, PDO::PARAM_INT);
        $stmt->bindParam(":placa", $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(":ufplaca", $this->ufplaca, PDO::PARAM_INT);
        $stmt->bindParam(":id_modelo", $this->id_modelo, PDO::PARAM_INT);
        $stmt->bindParam(":ano_modelo", $this->ano_modelo, PDO::PARAM_INT);
        $stmt->bindParam(":ano_fabricacao", $this->ano_fabricacao, PDO::PARAM_INT);
        $stmt->bindParam(":renavam", $this->renavam, PDO::PARAM_STR);
        $stmt->bindParam(":chassi", $this->chassi, PDO::PARAM_STR);
        $stmt->bindParam(":id_consorcio", $this->id_consorcio, PDO::PARAM_INT);
        $stmt->bindParam(":id_base", $this->id_base, PDO::PARAM_INT);
        $stmt->bindParam(":foto_frente", $this->foto_frente, PDO::PARAM_STR);
        $stmt->bindParam(":foto_traseira", $this->foto_traseira, PDO::PARAM_STR);
        $stmt->bindParam(":foto_direita", $this->foto_direita, PDO::PARAM_STR);
        $stmt->bindParam(":foto_esquerda", $this->foto_esquerda, PDO::PARAM_STR);
        $stmt->bindParam(":data_carga", $this->data_carga, PDO::PARAM_STR);
        $stmt->bindParam(":observacao", $this->observacao, PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_combustivel", $this->id_tipo_combustivel, PDO::PARAM_INT);
        $stmt->bindParam(":id_cor", $this->id_cor, PDO::PARAM_INT);
        $stmt->bindParam(":valor_aquisicao", $this->valor_aquisicao, PDO::PARAM_STR);
        $stmt->bindParam(":valor_mercado", $this->valor_mercado, PDO::PARAM_STR);
        $stmt->bindParam(":km_aquisicao", $this->km_aquisicao, PDO::PARAM_INT);
        $stmt->bindParam(":km_atual", $this->km_atual, PDO::PARAM_INT);
        $stmt->bindParam(":potencia", $this->potencia, PDO::PARAM_INT);
        $stmt->bindParam(":cilindradas", $this->cilindradas, PDO::PARAM_INT);
        $stmt->bindParam(":peso_liquido", $this->peso_liquido, PDO::PARAM_INT);
        $stmt->bindParam(":tanque", $this->tanque, PDO::PARAM_INT);
        $stmt->bindParam(":disponibilidade", $this->disponibilidade, PDO::PARAM_INT);
        $stmt->bindParam(":proprietario", $this->proprietario, PDO::PARAM_STR);
        $stmt->bindParam(":data_baixa", $this->data_baixa, PDO::PARAM_STR);
        $stmt->bindParam(":destino_baixa", $this->destino_baixa, PDO::PARAM_STR);
        $stmt->bindParam(":data_final_garantia", $this->data_final_garantia, PDO::PARAM_STR);
        $stmt->bindParam(":capacidade_carga", $this->capacidade_carga, PDO::PARAM_INT);
        $stmt->bindParam(":latitude", $this->latitude, PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $this->longitude, PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId();
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE recursos SET prefixo = :prefixo ';
        $sql .= ",id_tipo_recurso = :id_tipo_recurso";
        $sql .= ",placa = :placa";
        $sql .= ",ufplaca = :ufplaca";
        $sql .= ",id_modelo = :id_modelo";
        $sql .= ",ano_modelo = :ano_modelo";
        $sql .= ",ano_fabricacao = :ano_fabricacao";
        $sql .= ",renavam = :renavam";
        $sql .= ",chassi = :chassi";
        $sql .= ",id_consorcio = :id_consorcio";
        $sql .= ",id_base = :id_base";
        if ($this->foto_frente != "") $sql .= ",foto_frente = :foto_frente";
        if ($this->foto_traseira != "") $sql .= ",foto_traseira = :foto_traseira";
        if ($this->foto_direita != "") $sql .= ",foto_direita = :foto_direita";
        if ($this->foto_esquerda != "") $sql .= ",foto_esquerda = :foto_esquerda";
        $sql .= ",data_carga = :data_carga";
        $sql .= ",observacao = :observacao";
        $sql .= ",id_tipo_combustivel = :id_tipo_combustivel";
        $sql .= ",id_cor = :id_cor";
        $sql .= ",valor_aquisicao = :valor_aquisicao";
        $sql .= ",valor_mercado = :valor_mercado";
        $sql .= ",km_aquisicao = :km_aquisicao";
        $sql .= ",km_atual = :km_atual";
        $sql .= ",potencia = :potencia";
        $sql .= ",cilindradas = :cilindradas";
        $sql .= ",peso_liquido = :peso_liquido";
        $sql .= ",tanque = :tanque";
        $sql .= ",disponibilidade = :disponibilidade";
        $sql .= ",proprietario = :proprietario";
        $sql .= ",data_baixa = :data_baixa";
        $sql .= ",destino_baixa = :destino_baixa";
        $sql .= ",data_final_garantia = :data_final_garantia";
        $sql .= ",capacidade_carga = :capacidade_carga";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":prefixo", $this->prefixo, PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_recurso", $this->id_tipo_recurso, PDO::PARAM_INT);
        $stmt->bindParam(":placa", $this->placa, PDO::PARAM_STR);
        $stmt->bindParam(":ufplaca", $this->ufplaca, PDO::PARAM_INT);
        $stmt->bindParam(":id_modelo", $this->id_modelo, PDO::PARAM_INT);
        $stmt->bindParam(":ano_modelo", $this->ano_modelo, PDO::PARAM_INT);
        $stmt->bindParam(":ano_fabricacao", $this->ano_fabricacao, PDO::PARAM_INT);
        $stmt->bindParam(":renavam", $this->renavam, PDO::PARAM_STR);
        $stmt->bindParam(":chassi", $this->chassi, PDO::PARAM_STR);
        $stmt->bindParam(":id_consorcio", $this->id_consorcio, PDO::PARAM_INT);
        $stmt->bindParam(":id_base", $this->id_base, PDO::PARAM_INT);
        if ($this->foto_frente != "") $stmt->bindParam(":foto_frente", $this->foto_frente, PDO::PARAM_STR);
        if ($this->foto_traseira != "") $stmt->bindParam(":foto_traseira", $this->foto_traseira, PDO::PARAM_STR);
        if ($this->foto_direita != "") $stmt->bindParam(":foto_direita", $this->foto_direita, PDO::PARAM_STR);
        if ($this->foto_esquerda != "") $stmt->bindParam(":foto_esquerda", $this->foto_esquerda, PDO::PARAM_STR);
        $stmt->bindParam(":data_carga", $this->data_carga, PDO::PARAM_STR);
        $stmt->bindParam(":observacao", $this->observacao, PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_combustivel", $this->id_tipo_combustivel, PDO::PARAM_INT);
        $stmt->bindParam(":id_cor", $this->id_cor, PDO::PARAM_INT);
        $stmt->bindParam(":valor_aquisicao", $this->valor_aquisicao, PDO::PARAM_STR);
        $stmt->bindParam(":valor_mercado", $this->valor_mercado, PDO::PARAM_STR);
        $stmt->bindParam(":km_aquisicao", $this->km_aquisicao, PDO::PARAM_INT);
        $stmt->bindParam(":km_atual", $this->km_atual, PDO::PARAM_INT);
        $stmt->bindParam(":potencia", $this->potencia, PDO::PARAM_INT);
        $stmt->bindParam(":cilindradas", $this->cilindradas, PDO::PARAM_INT);
        $stmt->bindParam(":peso_liquido", $this->peso_liquido, PDO::PARAM_INT);
        $stmt->bindParam(":tanque", $this->tanque, PDO::PARAM_INT);
        $stmt->bindParam(":disponibilidade", $this->disponibilidade, PDO::PARAM_INT);
        $stmt->bindParam(":proprietario", $this->proprietario, PDO::PARAM_STR);
        $stmt->bindParam(":data_baixa", $this->data_baixa, PDO::PARAM_STR);
        $stmt->bindParam(":destino_baixa", $this->destino_baixa, PDO::PARAM_STR);
        $stmt->bindParam(":data_final_garantia", $this->data_final_garantia, PDO::PARAM_STR);
        $stmt->bindParam(":capacidade_carga", $this->capacidade_carga, PDO::PARAM_INT);
        $stmt->bindParam(":latitude", $this->latitude, PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $this->longitude, PDO::PARAM_STR);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",", $lista);
        //$sql = "DELETE FROM recursos WHERE id IN({$lista})";
        $sql = "UPDATE recursos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo, $numeroRegistros, $numeroInicioRegistro, $busca = "", $filtro = "", $ordem = "", $param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN grupo ON (grupo.id = recursos.id_grupo)
		INNER JOIN modelo ON (modelo.id = recursos.id_modelo)
		INNER JOIN marca ON (marca.id = modelo.id_marca)
		INNER JOIN disponibilidade ON (disponibilidade.id = recursos.disponibilidade)
		LEFT JOIN base ON (base.id = recursos.id_base)
		";

        $where = "
			WHERE recursos.excluido IS NULL
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if ($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND recursos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND recursos.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM recursos
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
				recursos.*
			    ,base.nome as nome_base
			    ,modelo.nome as nome_modelo
			    ,marca.nome as nome_marca
			    ,disponibilidade.nome as nome_disponiblidade
			FROM recursos
			$joins
			$where
		";

        if ($filtro != "") $sql .= " ORDER BY $filtro $ordem";
        else $sql .= " ORDER BY recursos.id DESC";
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
        $sql = "SELECT recursos.*, marca.id as id_marca  FROM recursos INNER JOIN modelo ON(modelo.id = recursos.id_modelo) INNER JOIN marca ON(marca.id = modelo.id_marca) WHERE recursos.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM recursos WHERE excluido IS NULL";
        if ($id != "") $sql .= " AND recursos.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca)
    {
        $pdo = new Conexao();
        $sql = " SELECT
                         recursos.id,
                         recursos.nome  AS text
                     FROM recursos
                     WHERE recursos.excluido IS NULL
                     ";

        if ($busca != '') {
            $sql .= " AND  (recursos.nome LIKE '%$busca%' OR recursos.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function getViatura($id)
    {
        $pdo = $this->getConexao();
        $sqlResource = "SELECT
        recursos.id,
        recursos.prefixo,
        recursos.placa,
        recursos.ufplaca,
        recursos.ano_modelo,
        recursos.ano_fabricacao,
        recursos.renavam,
        recursos.chassi,
        recursos.km_atual,
        recursos.potencia,
        recursos.cilindradas,
        recursos.peso_liquido,
        recursos.tanque,
        marca.nome AS marca,
        modelo.nome as modelo,
        tipo_combustivel.tipo_combustivel,
        base.nome as base
    FROM
        recursos
    INNER JOIN modelo ON modelo.id = recursos.id_modelo
    INNER JOIN marca ON marca.id = modelo.id_marca
    INNER JOIN tipo_combustivel ON tipo_combustivel.id = recursos.id_tipo_combustivel
    INNER JOIN base ON base.id = recursos.id_base
    WHERE recursos.id = :resourceId";

        $stmtResource = $pdo->prepare($sqlResource);
        $stmtResource->bindParam(':resourceId', $id, PDO::PARAM_INT);
        $stmtResource->execute();
        $resourceInfo = $stmtResource->fetch(PDO::FETCH_ASSOC);

        // Get current schedule
        $sqlSchedule = "SELECT
        escala_mensal.id,
        escala_mensal.data_hora_entrada,
        escala_mensal.data_hora_saida,
        usuario.nome as efetivo,
        funcao.nome as funcao
    FROM
        escala_mensal
    INNER JOIN usuario ON usuario.id = escala_mensal.id_usuario
    INNER JOIN funcao ON funcao.id = escala_mensal.id_funcao
    WHERE
        escala_mensal.id_local = :resourceId AND
        escala_mensal.data_hora_entrada <= NOW() AND
        escala_mensal.data_hora_saida >= NOW()";

        $stmtSchedule = $pdo->prepare($sqlSchedule);
        $stmtSchedule->bindParam(':resourceId', $id, PDO::PARAM_INT);
        $stmtSchedule->execute();
        $currentSchedule = $stmtSchedule->fetchAll(PDO::FETCH_ASSOC);

        $resourceInfo['escala'] = $currentSchedule;

        return $resourceInfo;
    }
}
