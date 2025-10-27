<?php
class PacienteCirculacao
{
    private $id;
    private $id_paciente;
    private $id_circulacao;
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

    public function setIdCirculacao($arg)
    {
        $this->id_circulacao = ($arg == "") ? NULL : $arg;
    }

    public function getIdCirculacao()
    {
        return $this->id_circulacao;
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
		INSERT INTO paciente_circulacao SET  id_paciente = :id_paciente';
        $sql .= ",id_circulacao = :id_circulacao";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_circulacao",$this->id_circulacao,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE paciente_circulacao SET id_paciente = :id_paciente';
        $sql .= ",id_circulacao = :id_circulacao";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":id_circulacao",$this->id_circulacao,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM paciente_circulacao WHERE id IN({$lista})";
        $sql = "UPDATE paciente_circulacao SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverAllPaciente($id_paciente)
    {
        $pdo = $this->getConexao();
        $sql = "DELETE FROM paciente_circulacao WHERE id_paciente IN($id_paciente)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE paciente_circulacao.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND paciente_circulacao.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_circulacao.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM paciente_circulacao
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
				paciente_circulacao.*
			FROM paciente_circulacao
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente_circulacao.id DESC";
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
        $sql = "SELECT * FROM paciente_circulacao WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_circulacao WHERE excluido IS NULL";
        if($id != "") $sql .= " AND paciente_circulacao.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarCirculacaoPaciente()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT circulacao_local.nome as nome_local,circulacao.nome as nome_circulacao FROM paciente_circulacao 
                    INNER JOIN circulacao ON(circulacao.id = paciente_circulacao.id_circulacao) 
                    INNER JOIN circulacao_local ON(circulacao_local.id = circulacao.id_circulacao_local) 
                WHERE paciente_circulacao.id_paciente = :id_paciente ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rs as $r) {
            $vetor[$r['nome_local']] = $r['nome_circulacao'];
        }
        return $vetor;
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         paciente_circulacao.id,
                         paciente_circulacao.nome  AS text
                     FROM paciente_circulacao
                     WHERE paciente_circulacao.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (paciente_circulacao.nome LIKE '%$busca%' OR paciente_circulacao.id  LIKE '%$busca%') ";
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

        $objPacienteCirculacao= new PacienteCirculacao();
        $registros = $objPacienteCirculacao->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
