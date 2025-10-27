<?php
class OcorrenciasMateriais
{
    private $id;
    private $id_ocorrencia;
    private $id_paciente;
    private $id_hospital;
    private $id_responsavel;
    private $responsavel_hospital;
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

    public function setIdPaciente($arg)
    {
        $this->id_paciente = ($arg == "") ? NULL : $arg;
    }

    public function getIdPaciente()
    {
        return $this->id_paciente;
    }

    public function setIdHospital($arg)
    {
        $this->id_hospital = ($arg == "") ? NULL : $arg;
    }

    public function getIdHospital()
    {
        return $this->id_hospital;
    }

    public function setIdResponsavel($arg)
    {
        $this->id_responsavel = ($arg == "") ? NULL : $arg;
    }

    public function getIdResponsavel()
    {
        return $this->id_responsavel;
    }

    public function setResponsavelHospital($arg)
    {
        $this->responsavel_hospital = ($arg == "") ? NULL : $arg;
    }

    public function getResponsavelHospital()
    {
        return $this->responsavel_hospital;
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
		INSERT INTO ocorrencias_materiais SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",id_paciente = :id_paciente";
        $sql .= ",id_hospital = :id_hospital";
        $sql .= ",id_responsavel = :id_responsavel";
        $sql .= ",responsavel_hospital = :responsavel_hospital";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_hospital",$this->id_hospital,PDO::PARAM_INT);
        $stmt->bindParam(":id_responsavel",$this->id_responsavel,PDO::PARAM_INT);
        $stmt->bindParam(":responsavel_hospital",$this->responsavel_hospital,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias_materiais SET id_hospital = :id_hospital ';
        $sql .= ",responsavel_hospital = :responsavel_hospital";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_hospital",$this->id_hospital,PDO::PARAM_INT);
        $stmt->bindParam(":responsavel_hospital",$this->responsavel_hospital,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM ocorrencias_materiais WHERE id IN({$lista})";
        $sql = "UPDATE ocorrencias_materiais SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		  
		";

        $where = "
			WHERE ocorrencias_materiais.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if ($param['data_hora_inicio'])  $where .= " AND ocorrencias_materiais.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias_materiais.data_hora_cadastro <= '{$param['data_hora_fim']}'";
        if ($param['id_paciente'])  $where .= " AND ocorrencias_materiais.id_paciente ='{$param['id_paciente']}' ";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias_materiais
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
				ocorrencias_materiais.*
			    ,(SELECT GROUP_CONCAT(materiais_itens.nome) 
			        FROM ocorrencias_materiais_itens 
			            INNER JOIN materiais_itens ON(materiais_itens.id = ocorrencias_materiais_itens.id_item)
			            WHERE ocorrencias_materiais_itens.id_ocorrencia_entrega = ocorrencias_materiais.id
			        ) AS materiais
			FROM ocorrencias_materiais
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ocorrencias_materiais.id DESC";
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
        $sql = "SELECT * FROM ocorrencias_materiais WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorrencias_materiais WHERE excluido IS NULL";
        if($id != "") $sql .= " AND ocorrencias_materiais.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ocorrencias_materiais.id,
                         ocorrencias_materiais.nome  AS text
                     FROM ocorrencias_materiais
                     WHERE ocorrencias_materiais.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ocorrencias_materiais.nome LIKE '%$busca%' OR ocorrencias_materiais.id  LIKE '%$busca%') ";
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

        $objOcorrenciasMateriais= new OcorrenciasMateriais();
        $registros = $objOcorrenciasMateriais->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
