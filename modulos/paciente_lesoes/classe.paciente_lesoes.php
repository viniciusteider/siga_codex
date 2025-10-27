<?php
class PacienteLesoes
{
    private $id;
    private $id_parte_corpo;
    private $id_lesao;
    private $id_paciente;
    private $conexao;

    public function setId($arg)
    {
        $this->id = ($arg == "") ? NULL : $arg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdParteCorpo($arg)
    {
        $this->id_parte_corpo = ($arg == "") ? NULL : $arg;
    }

    public function getIdParteCorpo()
    {
        return $this->id_parte_corpo;
    }

    public function setIdLesao($arg)
    {
        $this->id_lesao = ($arg == "") ? NULL : $arg;
    }

    public function getIdLesao()
    {
        return $this->id_lesao;
    }

    public function setIdPaciente($arg)
    {
        $this->id_paciente = ($arg == "") ? NULL : $arg;
    }

    public function getIdPaciente()
    {
        return $this->id_paciente;
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
		INSERT INTO paciente_lesoes SET id_parte_corpo = :id_parte_corpo ';
        $sql .= ",id_lesao = :id_lesao";
        $sql .= ",id_paciente = :id_paciente";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_parte_corpo",$this->id_parte_corpo,PDO::PARAM_INT);
        $stmt->bindParam(":id_lesao",$this->id_lesao,PDO::PARAM_INT);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE paciente_lesoes SET 
			';
        $sql .= ",id_parte_corpo = :id_parte_corpo";
        $sql .= ",id_lesao = :id_lesao";
        $sql .= ",id_paciente = :id_paciente";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_parte_corpo",$this->id_parte_corpo,PDO::PARAM_INT);
        $stmt->bindParam(":id_lesao",$this->id_lesao,PDO::PARAM_INT);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM paciente_lesoes WHERE id IN({$lista})";
        $sql = "UPDATE paciente_lesoes SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverAllPaciente($id_paciente)
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM paciente_lesoes WHERE id_paciente = $id_paciente";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE paciente_lesoes.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND paciente_lesoes.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_lesoes.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM paciente_lesoes
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
				paciente_lesoes.*
			FROM paciente_lesoes
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente_lesoes.id DESC";
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
        $sql = "SELECT * FROM paciente_lesoes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_lesoes WHERE excluido IS NULL";
        if($id != "") $sql .= " AND paciente_lesoes.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarPaciente($id = "")
    {
        if($id == "") return [];
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_lesoes WHERE  paciente_lesoes.id_paciente = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         paciente_lesoes.id,
                         paciente_lesoes.nome  AS text
                     FROM paciente_lesoes
                     WHERE paciente_lesoes.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (paciente_lesoes.nome LIKE '%$busca%' OR paciente_lesoes.id  LIKE '%$busca%') ";
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

        $objPacienteLesoes= new PacienteLesoes();
        $registros = $objPacienteLesoes->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
