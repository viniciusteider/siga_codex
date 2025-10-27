<?php
class PacienteSinaisClinicos
{
    private $id;
    private $id_paciente;
    private $id_sinais_clinicos;
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

    public function setIdPaciente($arg)
    {
        $this->id_paciente = ($arg == "") ? NULL : $arg;
    }

    public function getIdPaciente()
    {
        return $this->id_paciente;
    }

    public function setIdSinaisClinicos($arg)
    {
        $this->id_sinais_clinicos = ($arg == "") ? NULL : $arg;
    }

    public function getIdSinaisClinicos()
    {
        return $this->id_sinais_clinicos;
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
		INSERT INTO paciente_sinais_clinicos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_paciente = :id_paciente";
        $sql .= ",id_sinais_clinicos = :id_sinais_clinicos";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_sinais_clinicos",$this->id_sinais_clinicos,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE paciente_sinais_clinicos SET 
			';
        $sql .= ",id_paciente = :id_paciente";
        $sql .= ",id_sinais_clinicos = :id_sinais_clinicos";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_sinais_clinicos",$this->id_sinais_clinicos,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM paciente_sinais_clinicos WHERE id IN({$lista})";
        $sql = "UPDATE paciente_sinais_clinicos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function RemoverAll()
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM paciente_sinais_clinicos WHERE id_paciente = :id_paciente";
//        $sql = "UPDATE paciente_sinais_clinicos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ListarPaginacao($param)
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE paciente_sinais_clinicos.excluido IS NULL
		";

        //if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
        if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND paciente_sinais_clinicos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_sinais_clinicos.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM paciente_sinais_clinicos
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
				paciente_sinais_clinicos.*
			FROM paciente_sinais_clinicos
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY paciente_sinais_clinicos.id DESC";
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
        $sql = "SELECT * FROM paciente_sinais_clinicos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_sinais_clinicos WHERE excluido IS NULL";
        if($id != "") $sql .= " AND paciente_sinais_clinicos.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         paciente_sinais_clinicos.id,
                         paciente_sinais_clinicos.nome  AS text
                     FROM paciente_sinais_clinicos
                     WHERE paciente_sinais_clinicos.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (paciente_sinais_clinicos.nome LIKE '%$busca%' OR paciente_sinais_clinicos.id  LIKE '%$busca%') ";
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

        $objPacienteSinaisClinicos= new PacienteSinaisClinicos();
        $registros = $objPacienteSinaisClinicos->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
