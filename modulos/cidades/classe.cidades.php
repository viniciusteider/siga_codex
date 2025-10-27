<?php
class Cidades
{
    private $id;
    private $id_estado;
    private $nome;
    private $excluido;
    private $conexao;

    public function setId($arg)
    {
        $this->id = $arg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdEstado($arg)
    {
        $this->id_estado = $arg;
    }

    public function getIdEstado()
    {
        return $this->id_estado;
    }

    public function setNome($arg)
    {
        $this->nome = $arg;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setExcluido($arg)
    {
        $this->excluido = $arg;
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
		INSERT INTO cidades SET  id_estado = :id_estado ';
        $sql .= ",nome = :nome";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = ' UPDATE cidades SET id_estado = :id_estado';
        $sql .= ",nome = :nome";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM cidades WHERE id IN({$lista})";
        $sql = "UPDATE cidades SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN estados ON(estados.id = cidades.id_estado)
		";

        $where = "
			WHERE cidades.excluido IS NULL
		";

//        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (cidades.nome LIKE :busca or estados.nome LIKE :busca)";
//        if (($param['data_hora_inicio']))  $where .= " AND cidades.data_hora_cadastro >='{$param['data_hora_inicio']}' AND cidades.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM cidades
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
				cidades.*
			    ,estados.nome as nome_estado
			FROM cidades
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY cidades.id DESC";
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
        $sql = "SELECT * FROM cidades WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1,$this->getId(),PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function ComboCidade()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM cidades WHERE id_estado = :id_estado AND excluido IS NULL ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function CidadeId($busca)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT id FROM cidades WHERE id_estado = :id_estado AND cidades.nome LIKE '%$busca%' AND excluido IS NULL ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_estado",$this->id_estado,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function ListarTodas()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM cidades WHERE excluido IS NULL ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
