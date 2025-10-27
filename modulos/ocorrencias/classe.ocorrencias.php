<?php
class Ocorrencias
{
    private $id;
    private $id_grupo;
    private $data_hora;
    private $nome;
    private $telefone;
    private $numero_ocorrencia;
    private $id_endereco;
    private $descritivo;
    private $id_usuario;
    private $id_regulador;
    private $id_evento;
    private $id_subevento;
    private $id_ocorrencia_status;
    private $id_ocorrencia_classificacao;
    private $id_tipo_solicitante;
    private $raio;
    private $usa;
    private $usb;
    private $siate;
    private $vir;
    private $data_hora_cadastro;
    private $logradouro;
    private $endereco_completo;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $latitude;
    private $longitude;
    private $id_estado;
    private $id_cidade;
    private $estado;
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

    public function setDataHora($arg)
    {
        $this->data_hora = ($arg == "") ? NULL : $arg;
    }

    public function getDataHora()
    {
        return $this->data_hora;
    }

    public function setNome($arg)
    {
        $this->nome = ($arg == "") ? NULL : $arg;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setTelefone($arg)
    {
        $this->telefone = ($arg == "") ? NULL : $arg;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNumeroOcorrencia($arg)
    {
        $this->numero_ocorrencia = ($arg == "") ? NULL : $arg;
    }

    public function getNumeroOcorrencia()
    {
        return $this->numero_ocorrencia;
    }

    public function setIdEndereco($arg)
    {
        $this->id_endereco = ($arg == "") ? NULL : $arg;
    }

    public function getIdEndereco()
    {
        return $this->id_endereco;
    }

    public function setDescritivo($arg)
    {
        $this->descritivo = ($arg == "") ? NULL : $arg;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
    }

    public function setIdUsuario($arg)
    {
        $this->id_usuario = ($arg == "") ? NULL : $arg;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdRegulador($arg)
    {
        $this->id_regulador = ($arg == "") ? NULL : $arg;
    }

    public function getIdRegulador()
    {
        return $this->id_regulador;
    }

    public function setIdEvento($arg)
    {
        $this->id_evento = ($arg == "") ? NULL : $arg;
    }

    public function getIdEvento()
    {
        return $this->id_evento;
    }

    public function setIdSubevento($arg)
    {
        $this->id_subevento = ($arg == "") ? NULL : $arg;
    }

    public function getIdSubevento()
    {
        return $this->id_subevento;
    }

    public function setIdOcorrenciaStatus($arg)
    {
        $this->id_ocorrencia_status = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrenciaStatus()
    {
        return $this->id_ocorrencia_status;
    }

    public function setIdOcorrenciaClassificacao($arg)
    {
        $this->id_ocorrencia_classificacao = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrenciaClassificacao()
    {
        return $this->id_ocorrencia_classificacao;
    }

    public function setIdTipoSolicitante($arg)
    {
        $this->id_tipo_solicitante = ($arg == "") ? NULL : $arg;
    }

    public function getIdTipoSolicitante()
    {
        return $this->id_tipo_solicitante;
    }


    public function setRaio($arg)
    {
        $this->raio = ($arg == "") ? NULL : $arg;
    }

    public function getRaio()
    {
        return $this->raio;
    }

    public function setUsa($arg)
    {
        $this->usa = ($arg == "") ? NULL : $arg;
    }

    public function getUsa()
    {
        return $this->usa;
    }

    public function setUsb($arg)
    {
        $this->usb = ($arg == "") ? NULL : $arg;
    }

    public function getUsb()
    {
        return $this->usb;
    }

    public function setSiate($arg)
    {
        $this->siate = ($arg == "") ? NULL : $arg;
    }

    public function getSiate()
    {
        return $this->siate;
    }

    public function setVir($arg)
    {
        $this->vir = ($arg == "") ? NULL : $arg;
    }

    public function getVir()
    {
        return $this->vir;
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

    public function setLogradouro($arg)
    {
        $this->logradouro = ($arg == "") ? NULL : $arg;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setEnderecoCompleto($arg)
    {
        $this->endereco_completo = ($arg == "") ? NULL : $arg;
    }

    public function getEnderecoCompleto()
    {
        return $this->endereco_completo;
    }

    public function setNumero($arg)
    {
        $this->numero = ($arg == "") ? NULL : $arg;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setCidade($arg)
    {
        $this->cidade = ($arg == "") ? NULL : $arg;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setIdCidade($arg)
    {
        $this->id_cidade = ($arg == "") ? NULL : $arg;
    }

    public function getIdCidade()
    {
        return $this->id_cidade;
    }

    public function setBairro($arg)
    {
        $this->bairro = ($arg == "") ? NULL : $arg;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setComplemento($arg)
    {
        $this->complemento = ($arg == "") ? NULL : $arg;
    }

    public function getComplemento()
    {
        return $this->complemento;
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

    public function setEstado($arg)
    {
        $this->estado = ($arg == "") ? NULL : $arg;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setIdEstado($arg)
    {
        $this->id_estado = ($arg == "") ? NULL : $arg;
    }

    public function getIdEstado()
    {
        return $this->id_estado;
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
		INSERT INTO ocorrencias SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo = :id_grupo";
        $sql .= ",data_hora = :data_hora";
        $sql .= ",nome = :nome";
        $sql .= ",telefone = :telefone";
        $sql .= ",numero_ocorrencia = :numero_ocorrencia";
        $sql .= ",descritivo = :descritivo";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",id_regulador = :id_regulador";
        $sql .= ",id_evento = :id_evento";
        $sql .= ",id_subevento = :id_subevento";
        $sql .= ",id_ocorrencia_status = :id_ocorrencia_status";
        $sql .= ",id_ocorrencia_classificacao = :id_ocorrencia_classificacao";
        $sql .= ",id_tipo_solicitante = :id_tipo_solicitante";
        $sql .= ",raio = :raio";
        $sql .= ",usa = :usa";
        $sql .= ",usb = :usb";
        $sql .= ",siate = :siate";
        $sql .= ",vir = :vir";
        $sql .= ",logradouro = :logradouro";
        $sql .= ",endereco_completo = :endereco_completo";
        $sql .= ",numero = :numero";
        $sql .= ",cidade = :cidade";
        $sql .= ",bairro = :bairro";
        $sql .= ",id_estado = :id_estado";
        $sql .= ",id_cidade = :id_cidade";
        $sql .= ",estado = :estado";
        $sql .= ",complemento = :complemento";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo", $this->id_grupo, PDO::PARAM_INT);
        $stmt->bindParam(":data_hora", $this->data_hora, PDO::PARAM_STR);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(":numero_ocorrencia", $this->numero_ocorrencia, PDO::PARAM_INT);
        $stmt->bindParam(":descritivo", $this->descritivo, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":id_regulador", $this->id_regulador, PDO::PARAM_INT);
        $stmt->bindParam(":id_evento", $this->id_evento, PDO::PARAM_INT);
        $stmt->bindParam(":id_subevento", $this->id_subevento, PDO::PARAM_STR);
        $stmt->bindParam(":id_ocorrencia_status", $this->id_ocorrencia_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencia_classificacao", $this->id_ocorrencia_classificacao, PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo_solicitante", $this->id_tipo_solicitante, PDO::PARAM_INT);
        $stmt->bindParam(":raio", $this->raio, PDO::PARAM_INT);
        $stmt->bindParam(":usa", $this->usa, PDO::PARAM_STR);
        $stmt->bindParam(":usb", $this->usb, PDO::PARAM_STR);
        $stmt->bindParam(":siate", $this->siate, PDO::PARAM_STR);
        $stmt->bindParam(":vir", $this->vir, PDO::PARAM_STR);
        $stmt->bindParam(":logradouro", $this->logradouro, PDO::PARAM_STR);
        $stmt->bindParam(":endereco_completo", $this->endereco_completo, PDO::PARAM_STR);
        $stmt->bindParam(":numero", $this->numero, PDO::PARAM_INT);
        $stmt->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
        $stmt->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $this->id_estado, PDO::PARAM_INT);
        $stmt->bindParam(":id_cidade", $this->id_cidade, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(":complemento", $this->complemento, PDO::PARAM_STR);
        $stmt->bindParam(":latitude", $this->latitude, PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $this->longitude, PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();
    }
    public function Atualizar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias SET id_evento = :id_evento';
        $sql .= ",id_subevento = :id_subevento";
        if ($this->id_ocorrencia_status != "") $sql .= ",id_ocorrencia_status = :id_ocorrencia_status";
        $sql .= ",id_ocorrencia_classificacao = :id_ocorrencia_classificacao";
        $sql .= ",usa = :usa";
        $sql .= ",usb = :usb";
        $sql .= ",siate = :siate";
        $sql .= ",vir = :vir";
        if ($this->id_regulador != "") $sql .= ",id_regulador = :id_regulador";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_evento", $this->id_evento, PDO::PARAM_INT);
        $stmt->bindParam(":id_subevento", $this->id_subevento, PDO::PARAM_STR);
        if ($this->id_ocorrencia_status != "") $stmt->bindParam(":id_ocorrencia_status", $this->id_ocorrencia_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencia_classificacao", $this->id_ocorrencia_classificacao, PDO::PARAM_INT);
        $stmt->bindParam(":usa", $this->usa, PDO::PARAM_STR);
        $stmt->bindParam(":usb", $this->usb, PDO::PARAM_STR);
        $stmt->bindParam(":siate", $this->siate, PDO::PARAM_STR);
        $stmt->bindParam(":vir", $this->vir, PDO::PARAM_STR);
        if ($this->id_regulador != "") $stmt->bindParam(":id_regulador", $this->id_regulador, PDO::PARAM_INT);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias SET data_hora = :data_hora';
        $sql .= ",nome = :nome";
        $sql .= ",telefone = :telefone";
        $sql .= ",numero_ocorrencia = :numero_ocorrencia";
        $sql .= ",descritivo = :descritivo";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",id_regulador = :id_regulador";
        $sql .= ",id_evento = :id_evento";
        $sql .= ",id_subevento = :id_subevento";
        $sql .= ",id_ocorrencia_status = :id_ocorrencia_status";
        $sql .= ",id_ocorrencia_classificacao = :id_ocorrencia_classificacao";
        $sql .= ",id_tipo_solicitante = :id_tipo_solicitante";
        $sql .= ",raio = :raio";
        $sql .= ",usa = :usa";
        $sql .= ",usb = :usb";
        $sql .= ",siate = :siate";
        $sql .= ",vir = :vir";
        $sql .= ",logradouro = :logradouro";
        $sql .= ",endereco_completo = :endereco_completo";
        $sql .= ",numero = :numero";
        $sql .= ",cidade = :cidade";
        $sql .= ",bairro = :bairro";
        $sql .= ",complemento = :complemento";
        $sql .= ",id_estado = :id_estado";
        $sql .= ",id_cidade = :id_cidade";
        $sql .= ",estado = :estado";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":data_hora", $this->data_hora, PDO::PARAM_STR);
        $stmt->bindParam(":nome", $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(":numero_ocorrencia", $this->numero_ocorrencia, PDO::PARAM_INT);
        $stmt->bindParam(":descritivo", $this->descritivo, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":id_regulador", $this->id_regulador, PDO::PARAM_INT);
        $stmt->bindParam(":id_evento", $this->id_evento, PDO::PARAM_INT);
        $stmt->bindParam(":id_subevento", $this->id_subevento, PDO::PARAM_STR);
        $stmt->bindParam(":id_ocorrencia_status", $this->id_ocorrencia_status, PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencia_classificacao", $this->id_ocorrencia_classificacao, PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo_solicitante", $this->id_tipo_solicitante, PDO::PARAM_INT);
        $stmt->bindParam(":raio", $this->raio, PDO::PARAM_INT);
        $stmt->bindParam(":usa", $this->usa, PDO::PARAM_STR);
        $stmt->bindParam(":usb", $this->usb, PDO::PARAM_STR);
        $stmt->bindParam(":siate", $this->siate, PDO::PARAM_STR);
        $stmt->bindParam(":vir", $this->vir, PDO::PARAM_STR);
        $stmt->bindParam(":logradouro", $this->logradouro, PDO::PARAM_STR);
        $stmt->bindParam(":endereco_completo", $this->endereco_completo, PDO::PARAM_STR);
        $stmt->bindParam(":numero", $this->numero, PDO::PARAM_INT);
        $stmt->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
        $stmt->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
        $stmt->bindParam(":complemento", $this->complemento, PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $this->id_estado, PDO::PARAM_INT);
        $stmt->bindParam(":id_cidade", $this->id_cidade, PDO::PARAM_INT);
        $stmt->bindParam(":estado", $this->estado, PDO::PARAM_STR);
        $stmt->bindParam(":latitude", $this->latitude, PDO::PARAM_STR);
        $stmt->bindParam(":longitude", $this->longitude, PDO::PARAM_STR);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",", $lista);
        //$sql = "DELETE FROM ocorrencias WHERE id IN({$lista})";
        $sql = "UPDATE ocorrencias SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function AtualizarStatus($id)
    {
        $pdo = $this->getConexao();
        $sql = "UPDATE ocorrencias SET id_ocorrencia_status = 3 WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function ListarOcorrenciasStatus($idGrupo, $param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
                INNER JOIN evento ON (evento.id = ocorrencias.id_evento) 
                LEFT JOIN subevento ON (subevento.id = ocorrencias.id_subevento) 
                INNER JOIN ocorrencias_status ON (ocorrencias_status.id = ocorrencias.id_ocorrencia_status) 
                INNER JOIN grupo ON (grupo.id = ocorrencias.id_grupo) 
                LEFT JOIN grupo AS grupo_pai ON (grupo_pai.id = grupo.id_grupo_pai)
                LEFT JOIN classificacao_risco ON ( classificacao_risco.id = ocorrencias.id_ocorrencia_classificacao ) 
		";

        $where = "
			WHERE ocorrencias.id > 0
		";
        $lista = implode(",", $param['id_ocorrencia_status']);
        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if (($param['data_hora_inicio']))  $where .= " AND ocorrencias.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora_cadastro <= '{$param['data_hora_fim']}'";
        if (is_array($param['id_ocorrencia_status']) && count($param['id_ocorrencia_status']) > 0)  $where .= " AND ocorrencias.id_ocorrencia_status IN({$lista})";
        if ($param['com_recursos'])  $where .= " AND (ocorrencias.usa > 0 OR ocorrencias.usb > 0 OR ocorrencias.siate > 0 OR ocorrencias.vir > 0 ) ";
        if ($param['tipo_usuario'] == 7)  $where .= " AND ocorrencias.id IN (SELECT id_ocorrencia FROM ocorrencias_recursos INNER JOIN ocorrencias_recursos_equipe ON(ocorrencias_recursos_equipe.id_ocorrencias_recursos = ocorrencias_recursos.id)  WHERE ocorrencias_recursos_equipe.id_efetivo = {$param['id_usuario']}) ";

        if ($param['finalizada'] === true) {
            $where .= " AND (SELECT COUNT(id) FROM ocorrencias_recursos WHERE id_ocorrencia = ocorrencias.id AND horario_chegada_base IS NOT NULL) > 0";
            $where .= " AND (SELECT COUNT(id) FROM ocorrencias_recursos WHERE id_ocorrencia = ocorrencias.id AND horario_chegada_base IS NULL) = 0";
        }
        if ($param['finalizada'] === false) {
            $where .= " AND (SELECT COUNT(id) FROM ocorrencias_recursos WHERE id_ocorrencia = ocorrencias.id AND horario_chegada_base IS NULL) > 0";
        }

        $stmt = $pdo->prepare($sql);

        if ($busca != "") {
            $busca = "%" . $busca . "%";
            $stmt->bindParam(":busca", $busca, PDO::PARAM_STR);
        }

        $sql = "
			SELECT 
				ocorrencias.*,
			       subevento.nome as nome_subevento,
			       evento.nome as nome_evento,
			        ocorrencias_status.nome as nome_status,
			        (SELECT COUNT(id) FROM ocorrencias_recursos WHERE id_ocorrencia = ocorrencias.id AND horario_chegada_base IS NULL) as incompleto,
			        (SELECT COUNT(id) FROM ocorrencias_recursos WHERE id_ocorrencia = ocorrencias.id AND horario_chegada_base IS NOT NULL) as completo,
                    grupo.id_grupo_pai,
                    grupo_pai.nome AS nome_grupo_pai,
                    classificacao_risco.nome as nome_classificacao_risco,
                    classificacao_risco.prioridade as prioridade_classificacao_risco,
                    classificacao_risco.cor as cor_classificacao_risco
			FROM ocorrencias

			$joins
			$where
		";

        //$sql .=" ORDER BY ocorrencias.data_hora DESC";
        $sql .= " ORDER BY ocorrencias.id_ocorrencia_status ASC, classificacao_risco.prioridade, ocorrencias.data_hora DESC";
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $linhas;
    }

    public function ListarPaginacao($idGrupo, $numeroRegistros, $numeroInicioRegistro, $busca = "", $filtro = "", $ordem = "", $param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		    INNER JOIN grupo ON (grupo.id = ocorrencias.id_grupo) 
            INNER JOIN `evento` ON (`ocorrencias`.`id_evento` = `evento`.`id`)
            INNER JOIN `ocorrencias_status` ON (`ocorrencias_status`.`id` = `ocorrencias`.`id_ocorrencia_status`)
            LEFT JOIN `subevento` ON (`ocorrencias`.`id_subevento` = `subevento`.`id`)
            LEFT JOIN grupo AS grupo_pai ON (grupo_pai.id = grupo.id_grupo_pai)
		";

        $where = "
			WHERE ocorrencias.id > 0
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if ($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ocorrencias.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias
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
				ocorrencias.*,
                    evento.nome as nome_evento        
                    ,evento.id as id_evento        
                    ,subevento.id as id_subevento        
                    ,subevento.nome as nome_sub_evento   
                    ,ocorrencias_status.nome as nome_status   
                    ,grupo.id_grupo_pai
                    ,grupo_pai.nome AS nome_grupo_pai
			FROM ocorrencias

			$joins
			$where
		";

        if ($filtro != "") $sql .= " ORDER BY $filtro $ordem";
        else $sql .= " ORDER BY ocorrencias.id DESC";
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
    public function ListarPaginacaoMapa($idGrupo, $numeroRegistros, $numeroInicioRegistro, $busca = "", $filtro = "", $ordem = "", $param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		    INNER JOIN grupo ON (grupo.id = ocorrencias.id_grupo) 
            INNER JOIN endereco ON (endereco.id = ocorrencias.id_endereco) 
            INNER JOIN `evento` ON (`ocorrencias`.`id_evento` = `evento`.`id`)
            INNER JOIN `ocorrencias_status` ON (`ocorrencias_status`.`id` = `ocorrencias`.`id_ocorrencia_status`)
            LEFT JOIN `subevento` ON (`ocorrencias`.`id_subevento` = `subevento`.`id`)
            LEFT JOIN cidades ON (cidades.id = endereco.id_cidade) 
            LEFT JOIN estados  ON (estados.id = cidades.id_estado) 
            LEFT JOIN grupo AS grupo_pai ON (grupo_pai.id = grupo.id_grupo_pai)
		";

        $where = "
			WHERE ocorrencias.id > 0
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if ($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ocorrencias.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias
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
				ocorrencias.*,
			        endereco.`id` as id_endereco,
                    endereco.`logradouro`,
                    endereco.`numero`,
                    endereco.`complemento`,
                    endereco.`bairro`,
                    endereco.`cidade`,
                    endereco.`id_cidade`,
                    cidades.id_estado,
                    cidades.nome as nome_cidade,
			        estados.nome as nome_estado,
                    endereco.`cep`,
                    endereco.`referencia`,
                    endereco.`observacao`,
                    endereco.`telefone`,
                    evento.nome as nome_evento        
                    ,evento.id as id_evento        
                    ,subevento.id as id_subevento        
                    ,subevento.nome as nome_sub_evento   
                    ,ocorrencias_status.nome as nome_status   
                    ,endereco.`comercial`,
                    endereco.`celular`,
                    endereco.`email`,
                    endereco.`email_mkt`,
                    endereco.`email_mkt2`,
                    endereco.`latitude`,
                    endereco.`longitude`,
                    endereco.`latitude` AS lat,
                    endereco.`longitude` AS lng,
                    ocorrencias.id AS title,
                    grupo.id_grupo_pai,
                    grupo_pai.nome AS nome_grupo_pai
			FROM ocorrencias

			$joins
			$where
		";

        if ($filtro != "") $sql .= " ORDER BY $filtro $ordem";
        else $sql .= " ORDER BY ocorrencias.id DESC";
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
                    ocorrencias.*,
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
        FROM ocorrencias 
        INNER JOIN grupo ON (grupo.id = ocorrencias.id_grupo) 
        INNER JOIN endereco ON (endereco.id = ocorrencias.id_endereco) 
        LEFT JOIN cidades ON (cidades.id = endereco.id_cidade) 
        LEFT JOIN grupo AS grupo_pai ON (grupo_pai.id = grupo.id_grupo_pai)
        WHERE ocorrencias.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function View()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
                    ocorrencias.*,
                    CONCAT(ocorrencias.`logradouro`,',',ocorrencias.`numero`,' ',ocorrencias.`bairro`,' ', ocorrencias.`cidade`) AS endereco,
                    ocorrencias.`logradouro`,
                    ocorrencias.`numero`,
                    ocorrencias.`complemento`,
                    ocorrencias.`bairro`,
                    ocorrencias.`cidade`,
                    ocorrencias.`latitude`,
                    ocorrencias.`longitude`,
                    grupo.id_grupo_pai,
       	            subevento.nome as nome_subevento,
       	            base.nome as nome_base,
       	            classificacao_risco.nome as nome_classificacao,
			        evento.nome as nome_evento,
			        regulador.nome as nome_regulador,
			        (SELECT GROUP_CONCAT(nome) FROM usuario INNER JOIN ocorrencias_recursos ON(ocorrencias_recursos.id_usuario = usuario.id) WHERE ocorrencias_recursos.id_ocorrencia = ocorrencias.id ) as nome_radio_operador,
			        usuario.nome as nome_atendente,
			        tipo_solicitante.nome as nome_tipo_solicitante,
                    grupo_pai.nome AS nome_grupo_pai
        FROM ocorrencias 
        INNER JOIN evento ON (evento.id = ocorrencias.id_evento) 
        LEFT JOIN subevento ON (subevento.id = ocorrencias.id_subevento) 
        INNER JOIN tipo_solicitante ON (tipo_solicitante.id = ocorrencias.id_tipo_solicitante) 
        INNER JOIN grupo ON (grupo.id = ocorrencias.id_grupo) 
        INNER JOIN usuario ON (usuario.id = ocorrencias.id_usuario) 
        INNER JOIN usuario_efetivo ON (usuario.id = usuario_efetivo.id_usuario) 
        INNER JOIN base ON (base.id = usuario_efetivo.id_base) 
        LEFT JOIN classificacao_risco ON (classificacao_risco.id = ocorrencias.id_ocorrencia_classificacao)     
        LEFT JOIN grupo AS grupo_pai ON (grupo_pai.id = grupo.id_grupo_pai)
        LEFT JOIN usuario as regulador ON (regulador.id = ocorrencias.id_regulador) 
        WHERE ocorrencias.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorrencias WHERE excluido IS NULL";
        if ($id != "") $sql .= " AND ocorrencias.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca)
    {
        $pdo = new Conexao();
        $sql = " SELECT
                         ocorrencias.id,
                         ocorrencias.nome  AS text
                     FROM ocorrencias
                     WHERE ocorrencias.excluido IS NULL
                     ";

        if ($busca != '') {
            $sql .= " AND  (ocorrencias.nome LIKE '%$busca%' OR ocorrencias.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function GerarSelec($id, $nome_campo, $id_campo, $outros = '', $campo = ["id", "nome"], $autocomlete = false)
    {
        if ($autocomlete) $id_atual = $id;

        $objOcorrencias = new Ocorrencias();
        $registros = $objOcorrencias->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select', $outros);
    }

    public function GetQuantitativosStatus($idGrupo, $param)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT COUNT(ocorrencias.id) as total, ocorrencias_status.nome,ocorrencias.id_ocorrencia_status
                FROM ocorrencias 
		        INNER JOIN grupo ON (grupo.id = ocorrencias.id_grupo)
                INNER JOIN ocorrencias_status ON (ocorrencias_status.id = ocorrencias.id_ocorrencia_status)
                WHERE ocorrencias.excluido IS NULL ";
        if (!empty($idGrupo))  $sql .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if (($param['data_hora_inicio']))  $sql .= " AND ocorrencias.data_hora >='{$param['data_hora_inicio']}' AND ocorrencias.data_hora <= '{$param['data_hora_fim']}'";
        $sql .= "GROUP BY ocorrencias_status.id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarMonitoramento($idGrupo)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT
        ocorrencias.id AS id,
        ocorrencias.data_hora AS data_hora,
        ocorrencias.nome AS solicitante,
        ocorrencias.telefone AS telefone,
        ocorrencias.numero_ocorrencia AS numero,
        ocorrencias.descritivo AS descritivo,
        evento.id AS id_evento,
        evento.nome AS evento,
        subevento.id AS id_subevento,
        subevento.nome AS subevento,
        ocorrencias.id_ocorrencia_status AS status_id,
        ocorrencias.endereco_completo AS endereco,
        classificacao_risco.id AS id_risco,
        classificacao_risco.nome AS risco,
        classificacao_risco.prioridade AS prioridade,
        classificacao_risco.cor AS cor,
        ocorrencias.latitude AS lat,
        ocorrencias.longitude AS lng
    FROM ocorrencias
    INNER JOIN grupo ON grupo.id = ocorrencias.id_grupo
    INNER JOIN evento ON evento.id = ocorrencias.id_evento
    INNER JOIN subevento ON subevento.id = ocorrencias.id_subevento
    LEFT JOIN classificacao_risco ON classificacao_risco.id = ocorrencias.id_ocorrencia_classificacao
    WHERE ocorrencias.excluido IS NULL
      AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
      AND ocorrencias.id_ocorrencia_status IN (1,2)
    ORDER BY ocorrencias.data_hora DESC
            
            ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
