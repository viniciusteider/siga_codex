<?php
class SinaisClinicosObstetricia
{
    private $id;
    private $id_estagio_parto;
    private $procedimentos;
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

    public function setIdEstagioParto($arg)
    {
        $this->id_estagio_parto = ($arg == "") ? NULL : $arg;
    }

    public function getIdEstagioParto()
    {
        return $this->id_estagio_parto;
    }

    public function setProcedimentos($arg)
    {
        $this->procedimentos = ($arg == "") ? NULL : $arg;
    }

    public function getProcedimentos()
    {
        return $this->procedimentos;
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
		INSERT INTO sinais_clinicos_obstetricia SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_estagio_parto = :id_estagio_parto";
        $sql .= ",procedimentos = :procedimentos";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_estagio_parto",$this->id_estagio_parto,PDO::PARAM_INT);
        $stmt->bindParam(":procedimentos",$this->procedimentos,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE sinais_clinicos_obstetricia SET id_estagio_parto = :id_estagio_parto ';
        $sql .= ",procedimentos = :procedimentos";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_estagio_parto",$this->id_estagio_parto,PDO::PARAM_INT);
        $stmt->bindParam(":procedimentos",$this->procedimentos,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM sinais_clinicos_obstetricia WHERE id IN({$lista})";
        $sql = "UPDATE sinais_clinicos_obstetricia SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE sinais_clinicos_obstetricia.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND sinais_clinicos_obstetricia.data_hora_cadastro >='{$param['data_hora_inicio']}' AND sinais_clinicos_obstetricia.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM sinais_clinicos_obstetricia
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
				sinais_clinicos_obstetricia.*
			FROM sinais_clinicos_obstetricia
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY sinais_clinicos_obstetricia.id DESC";
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
        $sql = "SELECT * FROM sinais_clinicos_obstetricia WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM sinais_clinicos_obstetricia WHERE excluido IS NULL";
        if($id != "") $sql .= " AND sinais_clinicos_obstetricia.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarComboEstagio($id = "",$id_paciente = "")
    {
         $and = " AND paciente_sinais_clinicos_obstetricia.id_paciente = '$id_paciente' ";
        $pdo = $this->getConexao();
        $sql = "SELECT sinais_clinicos_obstetricia.*,paciente_sinais_clinicos_obstetricia.id as id_paciente_sinais
                FROM sinais_clinicos_obstetricia 
                    LEFT JOIN paciente_sinais_clinicos_obstetricia ON (paciente_sinais_clinicos_obstetricia.id_sinais_clinicos_obstetrica = sinais_clinicos_obstetricia.id $and) 
                WHERE excluido IS NULL";
        if($id != "") $sql .= " AND sinais_clinicos_obstetricia.id_estagio_parto = $id ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         sinais_clinicos_obstetricia.id,
                         sinais_clinicos_obstetricia.nome  AS text
                     FROM sinais_clinicos_obstetricia
                     WHERE sinais_clinicos_obstetricia.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (sinais_clinicos_obstetricia.nome LIKE '%$busca%' OR sinais_clinicos_obstetricia.id  LIKE '%$busca%') ";
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

        $objSinaisClinicosObstetricia= new SinaisClinicosObstetricia();
        $registros = $objSinaisClinicosObstetricia->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
