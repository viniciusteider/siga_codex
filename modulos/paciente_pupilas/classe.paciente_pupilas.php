<?php
class PacientePupilas
{
    private $id;
    private $id_paciente;
    private $id_pupilas_sintomas;
    private $direita;
    private $esquerda;
    private $conexao;

    public function setId($arg)
    {
        $this->id = ($arg == "") ? NULL : $arg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdPaciente($arg)
    {
        $this->id_paciente = ($arg == "") ? NULL : $arg;
    }

    public function getIdPaciente()
    {
        return $this->id_paciente;
    }

    public function setIdPupilasSintomas($arg)
    {
        $this->id_pupilas_sintomas = ($arg == "") ? NULL : $arg;
    }

    public function getIdPupilasSintomas()
    {
        return $this->id_pupilas_sintomas;
    }

    public function setDireita($arg)
    {
        $this->direita = ($arg == "") ? NULL : $arg;
    }

    public function getDireita()
    {
        return $this->direita;
    }

    public function setEsquerda($arg)
    {
        $this->esquerda = ($arg == "") ? NULL : $arg;
    }

    public function getEsquerda()
    {
        return $this->esquerda;
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
		INSERT INTO paciente_pupilas SET id_paciente = :id_paciente ';
        $sql .= ",id_pupilas_sintomas = :id_pupilas_sintomas";
        $sql .= ",direita = :direita";
        $sql .= ",esquerda = :esquerda";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_pupilas_sintomas",$this->id_pupilas_sintomas,PDO::PARAM_INT);
        $stmt->bindParam(":direita",$this->direita,PDO::PARAM_STR);
        $stmt->bindParam(":esquerda",$this->esquerda,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE paciente_pupilas SET id_paciente = :id_paciente ';
        $sql .= ",id_pupilas_sintomas = :id_pupilas_sintomas";
        $sql .= ",direita = :direita";
        $sql .= ",esquerda = :esquerda";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_pupilas_sintomas",$this->id_pupilas_sintomas,PDO::PARAM_INT);
        $stmt->bindParam(":direita",$this->direita,PDO::PARAM_STR);
        $stmt->bindParam(":esquerda",$this->esquerda,PDO::PARAM_STR);
        $stmt->bindParam(":tipo",$this->tipo,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM paciente_pupilas WHERE id IN({$lista})";
        $sql = "UPDATE paciente_pupilas SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverAllPaciente($id_paciente)
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM paciente_pupilas WHERE paciente_pupilas.id_paciente = $id_paciente";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE paciente_pupilas.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND paciente_pupilas.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_pupilas.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM paciente_pupilas
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
				paciente_pupilas.*
			FROM paciente_pupilas
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente_pupilas.id DESC";
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
        $sql = "SELECT * FROM paciente_pupilas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function View()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT IF(paciente_pupilas.esquerda = 1, 'E','') as esquerda,IF(paciente_pupilas.direita = 1, 'D','') as direita, pupilas_sintomas.nome as nome_pupila FROM paciente_pupilas INNER JOIN pupilas_sintomas ON(pupilas_sintomas.id = paciente_pupilas.id_pupilas_sintomas )WHERE id_paciente = :id_paciente";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_pupilas WHERE excluido IS NULL";
        if($id != "") $sql .= " AND paciente_pupilas.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         paciente_pupilas.id,
                         paciente_pupilas.nome  AS text
                     FROM paciente_pupilas
                     WHERE paciente_pupilas.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (paciente_pupilas.nome LIKE '%$busca%' OR paciente_pupilas.id  LIKE '%$busca%') ";
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

        $objPacientePupilas= new PacientePupilas();
        $registros = $objPacientePupilas->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
