<?php
class OcorrenciasApoio
{
    private $id;
    private $id_ocorrencia;
    private $hora_pedido;
    private $id_orgao_apoio;
    private $responsavel_apoio;
    private $solicitacao;
    private $total_pessoas;
    private $total_veiculos;
    private $id_ocorrencias;
    private $obs_sv;
    private $despachante;
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

    public function setIdOcorrencia($arg)
    {
        $this->id_ocorrencia = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrencia()
    {
        return $this->id_ocorrencia;
    }

    public function setHoraPedido($arg)
    {
        $this->hora_pedido = ($arg == "") ? NULL : $arg;
    }

    public function getHoraPedido()
    {
        return $this->hora_pedido;
    }

    public function setIdOrgaoApoio($arg)
    {
        $this->id_orgao_apoio = ($arg == "") ? NULL : $arg;
    }

    public function getIdOrgaoApoio()
    {
        return $this->id_orgao_apoio;
    }

    public function setResponsavelApoio($arg)
    {
        $this->responsavel_apoio = ($arg == "") ? NULL : $arg;
    }

    public function getResponsavelApoio()
    {
        return $this->responsavel_apoio;
    }

    public function setSolicitacao($arg)
    {
        $this->solicitacao = ($arg == "") ? NULL : $arg;
    }

    public function getSolicitacao()
    {
        return $this->solicitacao;
    }

    public function setTotalPessoas($arg)
    {
        $this->total_pessoas = ($arg == "") ? NULL : $arg;
    }

    public function getTotalPessoas()
    {
        return $this->total_pessoas;
    }

    public function setTotalVeiculos($arg)
    {
        $this->total_veiculos = ($arg == "") ? NULL : $arg;
    }

    public function getTotalVeiculos()
    {
        return $this->total_veiculos;
    }

    public function setIdOcorrencias($arg)
    {
        $this->id_ocorrencias = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrencias()
    {
        return $this->id_ocorrencias;
    }

    public function setObsSv($arg)
    {
        $this->obs_sv = ($arg == "") ? NULL : $arg;
    }

    public function getObsSv()
    {
        return $this->obs_sv;
    }

    public function setDespachante($arg)
    {
        $this->despachante = ($arg == "") ? NULL : $arg;
    }

    public function getDespachante()
    {
        return $this->despachante;
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
		INSERT INTO ocorrencias_apoio SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",hora_pedido = :hora_pedido";
        $sql .= ",id_orgao_apoio = :id_orgao_apoio";
        $sql .= ",responsavel_apoio = :responsavel_apoio";
        $sql .= ",solicitacao = :solicitacao";
        $sql .= ",total_pessoas = :total_pessoas";
        $sql .= ",total_veiculos = :total_veiculos";
        $sql .= ",id_ocorrencias = :id_ocorrencias";
        $sql .= ",obs_sv = :obs_sv";
        $sql .= ",despachante = :despachante";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":hora_pedido",$this->hora_pedido,PDO::PARAM_STR);
        $stmt->bindParam(":id_orgao_apoio",$this->id_orgao_apoio,PDO::PARAM_INT);
        $stmt->bindParam(":responsavel_apoio",$this->responsavel_apoio,PDO::PARAM_STR);
        $stmt->bindParam(":solicitacao",$this->solicitacao,PDO::PARAM_STR);
        $stmt->bindParam(":total_pessoas",$this->total_pessoas,PDO::PARAM_INT);
        $stmt->bindParam(":total_veiculos",$this->total_veiculos,PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencias",$this->id_ocorrencias,PDO::PARAM_INT);
        $stmt->bindParam(":obs_sv",$this->obs_sv,PDO::PARAM_STR);
        $stmt->bindParam(":despachante",$this->despachante,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias_apoio SET hora_pedido = :hora_pedido ';
        $sql .= ",id_orgao_apoio = :id_orgao_apoio";
        $sql .= ",responsavel_apoio = :responsavel_apoio";
        $sql .= ",solicitacao = :solicitacao";
        $sql .= ",total_pessoas = :total_pessoas";
        $sql .= ",total_veiculos = :total_veiculos";
        $sql .= ",id_ocorrencias = :id_ocorrencias";
        $sql .= ",obs_sv = :obs_sv";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":hora_pedido",$this->hora_pedido,PDO::PARAM_STR);
        $stmt->bindParam(":id_orgao_apoio",$this->id_orgao_apoio,PDO::PARAM_INT);
        $stmt->bindParam(":responsavel_apoio",$this->responsavel_apoio,PDO::PARAM_STR);
        $stmt->bindParam(":solicitacao",$this->solicitacao,PDO::PARAM_STR);
        $stmt->bindParam(":total_pessoas",$this->total_pessoas,PDO::PARAM_INT);
        $stmt->bindParam(":total_veiculos",$this->total_veiculos,PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencias",$this->id_ocorrencias,PDO::PARAM_INT);
        $stmt->bindParam(":obs_sv",$this->obs_sv,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM ocorrencias_apoio WHERE id IN({$lista})";
        $sql = "UPDATE ocorrencias_apoio SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($id_ocorrencia,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE ocorrencias_apoio.excluido IS NULL AND ocorrencias_apoio.id_ocorrencia = $id_ocorrencia
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ocorrencias_apoio.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias_apoio.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias_apoio
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
				ocorrencias_apoio.*
			FROM ocorrencias_apoio
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ocorrencias_apoio.id DESC";
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
        $sql = "SELECT * FROM ocorrencias_apoio WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function View()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT ocorrencias_apoio.*,orgao_apoio.nome as nome_orgao FROM ocorrencias_apoio INNER JOIN orgao_apoio ON(orgao_apoio.id = ocorrencias_apoio.id_orgao_apoio) WHERE id_ocorrencia = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorrencias_apoio WHERE excluido IS NULL";
        if($id != "") $sql .= " AND ocorrencias_apoio.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ocorrencias_apoio.id,
                         ocorrencias_apoio.nome  AS text
                     FROM ocorrencias_apoio
                     WHERE ocorrencias_apoio.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ocorrencias_apoio.nome LIKE '%$busca%' OR ocorrencias_apoio.id  LIKE '%$busca%') ";
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

        $objOcorrenciasApoio= new OcorrenciasApoio();
        $registros = $objOcorrenciasApoio->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
