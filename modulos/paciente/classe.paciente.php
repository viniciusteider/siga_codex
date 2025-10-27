<?php
class Paciente
{
    private $id;
    private $id_grupo;
    private $id_ocorrencia;
    private $id_tipo_obstetricia;
    private $id_respiracao;
    private $id_vias_aereas;
    private $id_pupilas;
    private $id_hospital;
    private $id_etnia;
    private $tipo_encaminhamento;
    private $nome;
    private $idade;
    private $sexo;
    private $rg;
    private $cpf;
    private $idade_gestacional;
    private $bcf;
    private $apgar_1;
    private $apgar_5;
    private $recusa_atendimento;
    private $recusa_transporte;
    private $profissional;
    private $data_recebimento;
    private $data_hora_cadastro;
    private $excluido;
    private $id_usuario;
    private $id_situacao;
    
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $id_cidade;
    private $estado;
    private $id_estado;
    private $endereco_completo;
    private $latitude;
    private $longitude;
    private $telefone;
    private $comercial;
    private $celular;
    private $observacao;


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

    public function setIdOcorrencia($arg)
    {
        $this->id_ocorrencia = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrencia()
    {
        return $this->id_ocorrencia;
    }

    public function setIdTipoObstetricia($arg)
    {
        $this->id_tipo_obstetricia = ($arg == "") ? NULL : $arg;
    }

    public function getIdTipoObstetricia()
    {
        return $this->id_tipo_obstetricia;
    }

    public function setIdRespiracao($arg)
    {
        $this->id_respiracao = ($arg == "") ? NULL : $arg;
    }

    public function getIdRespiracao()
    {
        return $this->id_respiracao;
    }

    public function setIdViasAereas($arg)
    {
        $this->id_vias_aereas = ($arg == "") ? NULL : $arg;
    }

    public function getIdViasAereas()
    {
        return $this->id_vias_aereas;
    }

    public function setIdPupilas($arg)
    {
        $this->id_pupilas = ($arg == "") ? NULL : $arg;
    }

    public function getIdPupilas()
    {
        return $this->id_pupilas;
    }

    public function setIdHospital($arg)
    {
        $this->id_hospital = ($arg == "") ? NULL : $arg;
    }

    public function getIdHospital()
    {
        return $this->id_hospital;
    }

    public function setIdEtnia($arg)
    {
        $this->id_etnia = ($arg == "") ? NULL : $arg;
    }

    public function getIdEtnia()
    {
        return $this->id_etnia;
    }

    public function setNome($arg)
    {
        $this->nome = ($arg == "") ? NULL : $arg;
    }
    public function setTipoEncaminhamento($arg)
    {
        $this->tipo_encaminhamento = ($arg == "") ? NULL : $arg;
    }

    public function getTipoEncaminhamento()
    {
        return $this->tipo_encaminhamento;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setIdade($arg)
    {
        $this->idade = ($arg == "") ? NULL : $arg;
    }

    public function getIdade()
    {
        return $this->idade;
    }

    public function setSexo($arg)
    {
        $this->sexo = ($arg == "") ? NULL : $arg;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setIdEndereco($arg)
    {
        $this->id_endereco = ($arg == "") ? NULL : $arg;
    }

    public function getIdEndereco()
    {
        return $this->id_endereco;
    }

    public function setRg($arg)
    {
        $this->rg = ($arg == "") ? NULL : $arg;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setCpf($arg)
    {
        $this->cpf = ($arg == "") ? NULL : $arg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setIdadeGestacional($arg)
    {
        $this->idade_gestacional = ($arg == "") ? NULL : $arg;
    }

    public function getIdadeGestacional()
    {
        return $this->idade_gestacional;
    }

    public function setBcf($arg)
    {
        $this->bcf = ($arg == "") ? NULL : $arg;
    }

    public function getBcf()
    {
        return $this->bcf;
    }

    public function setApgar1($arg)
    {
        $this->apgar_1 = ($arg == "") ? NULL : $arg;
    }

    public function getApgar1()
    {
        return $this->apgar_1;
    }

    public function setApgar5($arg)
    {
        $this->apgar_5 = ($arg == "") ? NULL : $arg;
    }

    public function getApgar5()
    {
        return $this->apgar_5;
    }

    public function setRecusaAtendimento($arg)
    {
        $this->recusa_atendimento = ($arg == "") ? NULL : $arg;
    }

    public function getRecusaAtendimento()
    {
        return $this->recusa_atendimento;
    }

    public function setRecusaTransporte($arg)
    {
        $this->recusa_transporte = ($arg == "") ? NULL : $arg;
    }

    public function getRecusaTransporte()
    {
        return $this->recusa_transporte;
    }

    public function setProfissional($arg)
    {
        $this->profissional = ($arg == "") ? NULL : $arg;
    }

    public function getProfissional()
    {
        return $this->profissional;
    }

    public function setDataRecebimento($arg)
    {
        $this->data_recebimento = ($arg == "") ? NULL : $arg;
    }

    public function getDataRecebimento()
    {
        return $this->data_recebimento;
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

    public function setIdUsuario($arg)
    {
        $this->id_usuario = ($arg == "") ? NULL : $arg;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdSituacao($arg)
    {
        $this->id_situacao = ($arg == "") ? NULL : $arg;
    }

    public function getIdSituacao()
    {
        return $this->id_situacao;
    }

    public function setLogradouro($arg)
    {
        $this->logradouro = ($arg == "") ? NULL : $arg;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }

    public function setNumero($arg)
    {
        $this->numero = ($arg == "") ? NULL : $arg;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setComplemento($arg)
    {
        $this->complemento = ($arg == "") ? NULL : $arg;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setBairro($arg)
    {
        $this->bairro = ($arg == "") ? NULL : $arg;
    }

    public function getBairro()
    {
        return $this->bairro;
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

    public function setEnderecoCompleto($arg)
    {
        $this->endereco_completo = ($arg == "") ? NULL : $arg;
    }

    public function getEnderecoCompleto()
    {
        return $this->endereco_completo;
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

    public function setTelefone($arg)
    {
        $this->telefone = ($arg == "") ? NULL : $arg;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setComercial($arg)
    {
        $this->comercial = ($arg == "") ? NULL : $arg;
    }

    public function getComercial()
    {
        return $this->comercial;
    }

    public function setCelular($arg)
    {
        $this->celular = ($arg == "") ? NULL : $arg;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setObservacao($arg)
    {
        $this->observacao = ($arg == "") ? NULL : $arg;
    }

    public function getObservacao()
    {
        return $this->observacao;
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
		INSERT INTO paciente SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo = :id_grupo";
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",id_tipo_obstetricia = :id_tipo_obstetricia";
        $sql .= ",id_respiracao = :id_respiracao";
        $sql .= ",id_vias_aereas = :id_vias_aereas";
        $sql .= ",id_pupilas = :id_pupilas";
        $sql .= ",id_hospital = :id_hospital";
        $sql .= ",id_etnia = :id_etnia";
        $sql .= ",tipo_encaminhamento = :tipo_encaminhamento";
        $sql .= ",nome = :nome";
        $sql .= ",idade = :idade";
        $sql .= ",sexo = :sexo";
        $sql .= ",rg = :rg";
        $sql .= ",cpf = :cpf";
        $sql .= ",idade_gestacional = :idade_gestacional";
        $sql .= ",bcf = :bcf";
        $sql .= ",apgar_1 = :apgar_1";
        $sql .= ",apgar_5 = :apgar_5";
        $sql .= ",recusa_atendimento = :recusa_atendimento";
        $sql .= ",recusa_transporte = :recusa_transporte";
        $sql .= ",profissional = :profissional";
        $sql .= ",data_recebimento = :data_recebimento";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",id_situacao = :id_situacao";
        $sql .= ",telefone = :telefone";
        $sql .= ",comercial = :comercial";
        $sql .= ",celular = :celular";
        $sql .= ",observacao = :observacao";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";
        $sql .= ",logradouro = :logradouro";
        $sql .= ",numero = :numero";
        $sql .= ",complemento = :complemento";
        $sql .= ",bairro = :bairro";
        $sql .= ",cidade = :cidade";
        $sql .= ",id_cidade = :id_cidade";
        $sql .= ",estado = :estado";
        $sql .= ",id_estado = :id_estado";
        $sql .= ",endereco_completo = :endereco_completo";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo_obstetricia",$this->id_tipo_obstetricia,PDO::PARAM_INT);
        $stmt->bindParam(":id_respiracao",$this->id_respiracao,PDO::PARAM_INT);
        $stmt->bindParam(":id_vias_aereas",$this->id_vias_aereas,PDO::PARAM_INT);
        $stmt->bindParam(":id_pupilas",$this->id_pupilas,PDO::PARAM_INT);
        $stmt->bindParam(":id_hospital",$this->id_hospital,PDO::PARAM_INT);
        $stmt->bindParam(":id_etnia",$this->id_etnia,PDO::PARAM_INT);
        $stmt->bindParam(":tipo_encaminhamento",$this->tipo_encaminhamento,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":idade",$this->idade,PDO::PARAM_INT);
        $stmt->bindParam(":sexo",$this->sexo,PDO::PARAM_STR);
        $stmt->bindParam(":rg",$this->rg,PDO::PARAM_STR);
        $stmt->bindParam(":cpf",$this->cpf,PDO::PARAM_STR);
        $stmt->bindParam(":idade_gestacional",$this->idade_gestacional,PDO::PARAM_INT);
        $stmt->bindParam(":bcf",$this->bcf,PDO::PARAM_INT);
        $stmt->bindParam(":apgar_1",$this->apgar_1,PDO::PARAM_INT);
        $stmt->bindParam(":apgar_5",$this->apgar_5,PDO::PARAM_INT);
        $stmt->bindParam(":recusa_atendimento",$this->recusa_atendimento,PDO::PARAM_STR);
        $stmt->bindParam(":recusa_transporte",$this->recusa_transporte,PDO::PARAM_STR);
        $stmt->bindParam(":profissional",$this->profissional,PDO::PARAM_STR);
        $stmt->bindParam(":data_recebimento",$this->data_recebimento,PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":id_situacao",$this->id_situacao,PDO::PARAM_INT);

        $stmt->bindParam(":telefone",$this->telefone,PDO::PARAM_STR);
        $stmt->bindParam(":comercial",$this->comercial,PDO::PARAM_STR);
        $stmt->bindParam(":celular",$this->celular,PDO::PARAM_STR);
        $stmt->bindParam(":observacao",$this->observacao,PDO::PARAM_STR);
        $stmt->bindParam(":latitude",$this->latitude,PDO::PARAM_STR);
        $stmt->bindParam(":longitude",$this->longitude,PDO::PARAM_STR);
        $stmt->bindParam(":logradouro",$this->logradouro,PDO::PARAM_STR);
        $stmt->bindParam(":numero",$this->numero,PDO::PARAM_STR);
        $stmt->bindParam(":complemento",$this->complemento,PDO::PARAM_STR);
        $stmt->bindParam(":bairro",$this->bairro,PDO::PARAM_STR);
        $stmt->bindParam(":cidade",$this->cidade,PDO::PARAM_STR);
        $stmt->bindParam(":id_cidade",$this->id_cidade,PDO::PARAM_INT);
        $stmt->bindParam(":estado",$this->estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
        $stmt->bindParam(":endereco_completo",$this->endereco_completo,PDO::PARAM_STR);
        
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE paciente SET id_tipo_obstetricia = :id_tipo_obstetricia ';
        $sql .= ",id_respiracao = :id_respiracao";
        $sql .= ",id_vias_aereas = :id_vias_aereas";
        $sql .= ",id_pupilas = :id_pupilas";
        $sql .= ",id_hospital = :id_hospital";
        $sql .= ",id_etnia = :id_etnia";
        $sql .= ",tipo_encaminhamento = :tipo_encaminhamento";
        $sql .= ",nome = :nome";
        $sql .= ",idade = :idade";
        $sql .= ",sexo = :sexo";
        $sql .= ",rg = :rg";
        $sql .= ",cpf = :cpf";
        $sql .= ",idade_gestacional = :idade_gestacional";
        $sql .= ",bcf = :bcf";
        $sql .= ",apgar_1 = :apgar_1";
        $sql .= ",apgar_5 = :apgar_5";
        $sql .= ",recusa_atendimento = :recusa_atendimento";
        $sql .= ",recusa_transporte = :recusa_transporte";
        $sql .= ",profissional = :profissional";
        $sql .= ",data_recebimento = :data_recebimento";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",id_situacao = :id_situacao";
        $sql .= ",telefone = :telefone";
        $sql .= ",comercial = :comercial";
        $sql .= ",celular = :celular";
        $sql .= ",observacao = :observacao";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";
        $sql .= ",logradouro = :logradouro";
        $sql .= ",numero = :numero";
        $sql .= ",complemento = :complemento";
        $sql .= ",bairro = :bairro";
        $sql .= ",cidade = :cidade";
        $sql .= ",id_cidade = :id_cidade";
        $sql .= ",estado = :estado";
        $sql .= ",id_estado = :id_estado";
        $sql .= ",endereco_completo = :endereco_completo";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_tipo_obstetricia",$this->id_tipo_obstetricia,PDO::PARAM_INT);
        $stmt->bindParam(":id_respiracao",$this->id_respiracao,PDO::PARAM_INT);
        $stmt->bindParam(":id_vias_aereas",$this->id_vias_aereas,PDO::PARAM_INT);
        $stmt->bindParam(":id_pupilas",$this->id_pupilas,PDO::PARAM_INT);
        $stmt->bindParam(":id_hospital",$this->id_hospital,PDO::PARAM_INT);
        $stmt->bindParam(":id_etnia",$this->id_etnia,PDO::PARAM_INT);
        $stmt->bindParam(":tipo_encaminhamento",$this->tipo_encaminhamento,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":idade",$this->idade,PDO::PARAM_INT);
        $stmt->bindParam(":sexo",$this->sexo,PDO::PARAM_STR);
        $stmt->bindParam(":rg",$this->rg,PDO::PARAM_STR);
        $stmt->bindParam(":cpf",$this->cpf,PDO::PARAM_STR);
        $stmt->bindParam(":idade_gestacional",$this->idade_gestacional,PDO::PARAM_INT);
        $stmt->bindParam(":bcf",$this->bcf,PDO::PARAM_INT);
        $stmt->bindParam(":apgar_1",$this->apgar_1,PDO::PARAM_INT);
        $stmt->bindParam(":apgar_5",$this->apgar_5,PDO::PARAM_INT);
        $stmt->bindParam(":recusa_atendimento",$this->recusa_atendimento,PDO::PARAM_STR);
        $stmt->bindParam(":recusa_transporte",$this->recusa_transporte,PDO::PARAM_STR);
        $stmt->bindParam(":profissional",$this->profissional,PDO::PARAM_STR);
        $stmt->bindParam(":data_recebimento",$this->data_recebimento,PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":id_situacao",$this->id_situacao,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->bindParam(":telefone",$this->telefone,PDO::PARAM_STR);
        $stmt->bindParam(":comercial",$this->comercial,PDO::PARAM_STR);
        $stmt->bindParam(":celular",$this->celular,PDO::PARAM_STR);
        $stmt->bindParam(":observacao",$this->observacao,PDO::PARAM_STR);
        $stmt->bindParam(":latitude",$this->latitude,PDO::PARAM_STR);
        $stmt->bindParam(":longitude",$this->longitude,PDO::PARAM_STR);
        $stmt->bindParam(":logradouro",$this->logradouro,PDO::PARAM_STR);
        $stmt->bindParam(":numero",$this->numero,PDO::PARAM_STR);
        $stmt->bindParam(":complemento",$this->complemento,PDO::PARAM_STR);
        $stmt->bindParam(":bairro",$this->bairro,PDO::PARAM_STR);
        $stmt->bindParam(":cidade",$this->cidade,PDO::PARAM_STR);
        $stmt->bindParam(":id_cidade",$this->id_cidade,PDO::PARAM_INT);
        $stmt->bindParam(":estado",$this->estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
        $stmt->bindParam(":endereco_completo",$this->endereco_completo,PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM paciente WHERE id IN({$lista})";
        $sql = "UPDATE paciente SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE paciente.excluido IS NULL and paciente.id_ocorrencia = {$param['id_ocorrencia']}
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND paciente.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM paciente
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
				paciente.*
			FROM paciente
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente.id DESC";
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
        paciente.*
        FROM paciente 
        WHERE paciente.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function View()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
        paciente.*,
        (SELECT GROUP_CONCAT(lesoes.nome) 
        FROM paciente_lesoes
        INNER JOIN lesoes ON (lesoes.id  = paciente_lesoes.id_lesao)
        WHERE id_paciente = paciente.id) as lista_lesoes,
        (SELECT GROUP_CONCAT(procedimentos.procedimento) 
        FROM paciente_procedimentos 
        INNER JOIN procedimentos ON(procedimentos.id = paciente_procedimentos.id_procedimento)
        WHERE id_paciente = paciente.id) as lista_procedimentos,
        hospital.`nome` as nome_hospital,
        paciente.cidade as nome_cidade,
        paciente.id_estado,
        paciente.estado as nome_estado
        FROM paciente 
        INNER JOIN hospital  on paciente.id_hospital = hospital.id
        WHERE paciente.id_ocorrencia = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ViewPacientes()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
        paciente.*,
        (
            SELECT 
                   GROUP_CONCAT(CONCAT(partes_corpo.nome, ' - ',lesoes.nome)) 
            FROM paciente_lesoes
                INNER JOIN lesoes ON (lesoes.id  = paciente_lesoes.id_lesao)
                INNER JOIN partes_corpo ON (partes_corpo.id  = paciente_lesoes.id_parte_corpo)
            WHERE id_paciente = paciente.id 
            ) as lista_lesoes,
        (
            SELECT GROUP_CONCAT(procedimentos.procedimento) 
            FROM paciente_procedimentos 
                INNER JOIN procedimentos ON(procedimentos.id = paciente_procedimentos.id_procedimento)
            WHERE id_paciente = paciente.id AND id_procedimento_tipo = 1
            ) as lista_padroes,     
       (
           SELECT GROUP_CONCAT(procedimentos.procedimento) 
            FROM paciente_procedimentos 
                INNER JOIN procedimentos ON(procedimentos.id = paciente_procedimentos.id_procedimento)
            WHERE id_paciente = paciente.id AND id_procedimento_tipo = 2
           ) as lista_sondagens,
        (
            SELECT GROUP_CONCAT(procedimentos.procedimento) 
            FROM paciente_procedimentos
                INNER JOIN procedimentos ON(procedimentos.id = paciente_procedimentos.id_procedimento)
            WHERE id_paciente = paciente.id AND id_procedimento_tipo = 3
            ) as lista_curativos,
        (
            SELECT GROUP_CONCAT(procedimentos.procedimento) 
            FROM paciente_procedimentos
                INNER JOIN procedimentos ON(procedimentos.id = paciente_procedimentos.id_procedimento)
            WHERE id_paciente = paciente.id AND id_procedimento_tipo = 4
            ) as lista_imobilizacoes,
        (
            SELECT GROUP_CONCAT(medicamentos.nome) 
            FROM paciente_medicamentos
                INNER JOIN medicamentos ON(medicamentos.id = paciente_medicamentos.id_medicamento)
            WHERE id_paciente = paciente.id 
            ) as lista_medicamentos,
       
        
        hospital.`nome` as nome_hospital,
        paciente.cidade as nome_cidade,
        paciente.id_estado,
        tipo_obstetricia.nome as nome_tipo_obstetricia,
        respiracao.nome as nome_respiracao,
        vias_aereas.nome as nome_vias_aereas,
        hospital.nome as nome_hospital,
        etnia.etnia as nome_etnia,
        paciente.estado as nome_estado
        FROM paciente 
    
        LEFT JOIN hospital  on paciente.id_hospital = hospital.id
        LEFT JOIN tipo_obstetricia  on paciente.id_tipo_obstetricia = tipo_obstetricia.id
        LEFT JOIN respiracao  on paciente.id_respiracao = respiracao.id
        LEFT JOIN vias_aereas  on paciente.id_vias_aereas = vias_aereas.id
        LEFT JOIN etnia  on paciente.id_etnia = etnia.id_etnia
        WHERE paciente.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente WHERE excluido IS NULL";
        if($id != "") $sql .= " AND paciente.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ViewEcaminhamentosHora($idGrupo,$param = array())
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
                    hospital.nome as nome_hospital
                    ,SUM(CASE WHEN tipo_encaminhamento = 1 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -7200 SECOND) AND DATE_ADD(NOW(), INTERVAL -1 SECOND) THEN 1 ELSE 0 END) AS duas_horas_1
                    ,SUM(CASE WHEN tipo_encaminhamento = 1 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -14400 SECOND) AND DATE_ADD(NOW(), INTERVAL -7199 SECOND) THEN 1 ELSE 0 END) AS quatro_horas_1
                    ,SUM(CASE WHEN tipo_encaminhamento = 1 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -21600 SECOND) AND DATE_ADD(NOW(), INTERVAL -14399 SECOND) THEN 1 ELSE 0 END) AS seis_horas_1
                    ,SUM(CASE WHEN tipo_encaminhamento = 1 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -39600 SECOND) AND DATE_ADD(NOW(), INTERVAL -21599 SECOND) THEN 1 ELSE 0 END) AS doze_horas_1
                    ,SUM(CASE WHEN tipo_encaminhamento = 1 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -79200 SECOND) AND DATE_ADD(NOW(), INTERVAL -39599 SECOND) THEN 1 ELSE 0 END) AS vinte_quatro_horas_1
                    #,SUM(CASE WHEN tipo_encaminhamento = 1 AND(paciente.data_hora_cadastro BETWEEN '02:00:01' AND '04:00:00' THEN 1 ELSE 0 END) AS quatro_horas_1
                    #,SUM(CASE WHEN tipo_encaminhamento = 1 AND(paciente.data_hora_cadastro BETWEEN '04:00:01' AND '06:00:00' THEN 1 ELSE 0 END) AS seis_horas_1
                    #,SUM(CASE WHEN tipo_encaminhamento = 1 AND(paciente.data_hora_cadastro BETWEEN '06:00:01' AND '12:00:00' THEN 1 ELSE 0 END) AS doze_horas_1
                    #,SUM(CASE WHEN tipo_encaminhamento = 1 AND(paciente.data_hora_cadastro BETWEEN '12:00:01' AND '23:59:59' THEN 1 ELSE 0 END) AS vinte_quatro_horas_1
                    ,SUM(CASE WHEN tipo_encaminhamento = 2 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -7200 SECOND) AND DATE_ADD(NOW(), INTERVAL -1 SECOND) THEN 1 ELSE 0 END) AS duas_horas_2
                    ,SUM(CASE WHEN tipo_encaminhamento = 2 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -14400 SECOND) AND DATE_ADD(NOW(), INTERVAL -7199 SECOND) THEN 1 ELSE 0 END) AS quatro_horas_2
                    ,SUM(CASE WHEN tipo_encaminhamento = 2 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -21600 SECOND) AND DATE_ADD(NOW(), INTERVAL -14399 SECOND) THEN 1 ELSE 0 END) AS seis_horas_2
                    ,SUM(CASE WHEN tipo_encaminhamento = 2 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -39600 SECOND) AND DATE_ADD(NOW(), INTERVAL -21599 SECOND) THEN 1 ELSE 0 END) AS doze_horas_2
                    ,SUM(CASE WHEN tipo_encaminhamento = 2 AND paciente.data_hora_cadastro BETWEEN DATE_ADD(NOW(), INTERVAL -79200 SECOND) AND DATE_ADD(NOW(), INTERVAL -39599 SECOND) THEN 1 ELSE 0 END) AS vinte_quatro_horas_2
                    #,SUM(CASE WHEN tipo_encaminhamento = 2 AND TIME(paciente.data_hora_cadastro) BETWEEN '00:00:00' AND '02:00:00' THEN 1 ELSE 0 END) AS duas_horas_2
                    #,SUM(CASE WHEN tipo_encaminhamento = 2 AND TIME(paciente.data_hora_cadastro) BETWEEN '02:00:01' AND '04:00:00' THEN 1 ELSE 0 END) AS quatro_horas_2
                    #,SUM(CASE WHEN tipo_encaminhamento = 2 AND TIME(paciente.data_hora_cadastro) BETWEEN '04:00:01' AND '06:00:00' THEN 1 ELSE 0 END) AS seis_horas_2
                    #,SUM(CASE WHEN tipo_encaminhamento = 2 AND TIME(paciente.data_hora_cadastro) BETWEEN '06:00:01' AND '12:00:00' THEN 1 ELSE 0 END) AS doze_horas_2
                    #,SUM(CASE WHEN tipo_encaminhamento = 2 AND TIME(paciente.data_hora_cadastro) BETWEEN '12:00:01' AND '23:59:59' THEN 1 ELSE 0 END) AS vinte_quatro_horas_2
                FROM paciente   
                    INNER JOIN hospital ON(hospital.id = paciente.id_hospital)
                    INNER JOIN grupo ON(grupo.id = paciente.id_grupo)
                WHERE paciente.excluido IS NULL AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
                    ";
        $sql .= " AND paciente.data_hora_cadastro >= DATE_ADD(NOW(), INTERVAL -24 HOUR) AND paciente.data_hora_cadastro <= NOW()";
        $sql .= " GROUP BY id_hospital";
//        Conexao::pr($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                     paciente.id,
                     paciente.nome  AS text
                 FROM paciente
                 WHERE paciente.excluido IS NULL
                 ";

        if($busca != ''){
            $sql .= " AND  (paciente.nome LIKE '%$busca%' OR paciente.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function ListarAberturaOcularCombo(){
        $pdo = new Conexao();
        $sql = "SELECT id, nome FROM respostas WHERE tipo_resposta_id = 1 AND excluido IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function ListarRespostaVerbalCombo(){
        $pdo = new Conexao();
        $sql = "SELECT id, nome FROM respostas WHERE tipo_resposta_id = 2 AND excluido IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function ListarRespostaMotoraCombo(){
        $pdo = new Conexao();
        $sql = "SELECT id, nome FROM respostas WHERE tipo_resposta_id = 3 AND excluido IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
