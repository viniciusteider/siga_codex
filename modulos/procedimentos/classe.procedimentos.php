<?php
class Procedimentos
{
    private $id;
    private $id_procedimento_tipo;
    private $procedimento;
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

    public function setIdProcedimentoTipo($arg)
    {
        $this->id_procedimento_tipo = ($arg == "") ? NULL : $arg;
    }

    public function getIdProcedimentoTipo()
    {
        return $this->id_procedimento_tipo;
    }

    public function setProcedimento($arg)
    {
        $this->procedimento = ($arg == "") ? NULL : $arg;
    }

    public function getProcedimento()
    {
        return $this->procedimento;
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
		INSERT INTO procedimentos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_procedimento_tipo = :id_procedimento_tipo";
        $sql .= ",procedimento = :procedimento";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_procedimento_tipo",$this->id_procedimento_tipo,PDO::PARAM_INT);
        $stmt->bindParam(":procedimento",$this->procedimento,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE procedimentos SET id_procedimento_tipo = :id_procedimento_tipo ';
        $sql .= ",procedimento = :procedimento";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_procedimento_tipo",$this->id_procedimento_tipo,PDO::PARAM_INT);
        $stmt->bindParam(":procedimento",$this->procedimento,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM procedimentos WHERE id IN({$lista})";
        $sql = "UPDATE procedimentos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN procedimentos_tipo ON(procedimentos_tipo.id = procedimentos.id_procedimento_tipo)
		";

        $where = "
			WHERE procedimentos.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND procedimentos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND procedimentos.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM procedimentos
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
				procedimentos.*,
			       procedimentos_tipo.nome as nome_tipo
			FROM procedimentos
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY procedimentos.id DESC";
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
        $sql = "SELECT * FROM procedimentos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM procedimentos WHERE excluido IS NULL";
        if($id != "") $sql .= " AND procedimentos.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarComboTipo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM procedimentos WHERE excluido IS NULL";
        if($id != "") $sql .= " AND procedimentos.id_procedimento_tipo = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         procedimentos.id,
                         procedimentos.nome  AS text
                     FROM procedimentos
                     WHERE procedimentos.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (procedimentos.nome LIKE '%$busca%' OR procedimentos.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
