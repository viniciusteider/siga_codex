<?php
class EscalaEquipeHorarios
{
    private $id;
    private $id_escala_equipe;
    private $id_escala_horarios;
    private $data;
    private $hora_inicio;
    private $hora_fim;
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

    public function setIdEscalaEquipe($arg)
    {
        $this->id_escala_equipe = ($arg == "") ? NULL : $arg;
    }

    public function getIdEscalaEquipe()
    {
        return $this->id_escala_equipe;
    }

    public function setIdEscalaHorarios($arg)
    {
        $this->id_escala_horarios = ($arg == "") ? NULL : $arg;
    }

    public function getIdEscalaHorarios()
    {
        return $this->id_escala_horarios;
    }

    public function setData($arg)
    {
        $this->data = ($arg == "") ? NULL : $arg;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setHoraInicio($arg)
    {
        $this->hora_inicio = ($arg == "") ? NULL : $arg;
    }

    public function getHoraInicio()
    {
        return $this->hora_inicio;
    }

    public function setHoraFim($arg)
    {
        $this->hora_fim = ($arg == "") ? NULL : $arg;
    }

    public function getHoraFim()
    {
        return $this->hora_fim;
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
		INSERT INTO escala_equipe_horarios SET  id_escala_equipe = :id_escala_equipe ';
        $sql .= ",id_escala_horarios = :id_escala_horarios";
        $sql .= ",data = :data";
        $sql .= ",hora_inicio = :hora_inicio";
        $sql .= ",hora_fim = :hora_fim";

        $sql .= " ON DUPLICATE KEY UPDATE ";
        $sql .= "id_escala_horarios = :id_escala_horarios";
        $sql .= ",data = :data";
        $sql .= ",hora_inicio = :hora_inicio";
        $sql .= ",hora_fim = :hora_fim";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_escala_equipe",$this->id_escala_equipe,PDO::PARAM_INT);
        $stmt->bindParam(":id_escala_horarios",$this->id_escala_horarios,PDO::PARAM_INT);
        $stmt->bindParam(":data",$this->data,PDO::PARAM_STR);
        $stmt->bindParam(":hora_inicio",$this->hora_inicio,PDO::PARAM_STR);
        $stmt->bindParam(":hora_fim",$this->hora_fim,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE escala_equipe_horarios SET id_escala_equipe = :id_escala_equipe ';
        $sql .= ",id_escala_horarios = :id_escala_horarios";
        $sql .= ",data = :data";
        $sql .= ",hora_inicio = :hora_inicio";
        $sql .= ",hora_fim = :hora_fim";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_escala_equipe",$this->id_escala_equipe,PDO::PARAM_INT);
        $stmt->bindParam(":id_escala_horarios",$this->id_escala_horarios,PDO::PARAM_INT);
        $stmt->bindParam(":data",$this->data,PDO::PARAM_STR);
        $stmt->bindParam(":hora_inicio",$this->hora_inicio,PDO::PARAM_STR);
        $stmt->bindParam(":hora_fim",$this->hora_fim,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM escala_equipe_horarios WHERE id IN({$lista})";
        $sql = "UPDATE escala_equipe_horarios SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE escala_equipe_horarios.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND escala_equipe_horarios.data_hora_cadastro >='{$param['data_hora_inicio']}' AND escala_equipe_horarios.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM escala_equipe_horarios
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
				escala_equipe_horarios.*
			FROM escala_equipe_horarios
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY escala_equipe_horarios.id DESC";
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
        $sql = "SELECT * FROM escala_equipe_horarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM escala_equipe_horarios WHERE excluido IS NULL";
        if($id != "") $sql .= " AND escala_equipe_horarios.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarEscalaHorarios($id = "",$usuario)
    {
        if($id == "") return;
        $pdo = $this->getConexao();
        $sql = "SELECT escala_equipe_horarios.*, escala_horarios.cor
                FROM escala_equipe_horarios  
                    INNER JOIN escala_horarios ON(escala_horarios.id = escala_equipe_horarios.id_escala_horarios) 
                    INNER JOIN escala_equipe ON(escala_equipe.id = escala_equipe_horarios.id_escala_equipe) 
                WHERE escala_equipe_horarios.excluido IS NULL AND escala_equipe.id_escala = $id AND escala_equipe.id_efetivo = $usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rs as $r)
            $vetor[$r['data']] = $r;
        return $vetor;
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         escala_equipe_horarios.id,
                         escala_equipe_horarios.nome  AS text
                     FROM escala_equipe_horarios
                     WHERE escala_equipe_horarios.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (escala_equipe_horarios.nome LIKE '%$busca%' OR escala_equipe_horarios.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
