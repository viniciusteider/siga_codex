<?php
class UniformeTamanho
{
    private $id;
    private $id_grupo_tamanhos;
    private $nome;
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

    public function setIdGrupoTamanhos($arg)
    {
        $this->id_grupo_tamanhos = ($arg == "") ? NULL : $arg;
    }

    public function getIdGrupoTamanhos()
    {
        return $this->id_grupo_tamanhos;
    }

    public function setNome($arg)
    {
        $this->nome = ($arg == "") ? NULL : $arg;
    }

    public function getNome()
    {
        return $this->nome;
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
		INSERT INTO uniforme_tamanho SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo_tamanhos = :id_grupo_tamanhos";
        $sql .= ",nome = :nome";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo_tamanhos",$this->id_grupo_tamanhos,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE uniforme_tamanho SET id_grupo_tamanhos = :id_grupo_tamanhos ';
        $sql .= ",nome = :nome";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo_tamanhos",$this->id_grupo_tamanhos,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM uniforme_tamanho WHERE id IN({$lista})";
        $sql = "UPDATE uniforme_tamanho SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN uniforme_grupo_tamanho ON(uniforme_grupo_tamanho.id = uniforme_tamanho.id_grupo_tamanhos)
		";

        $where = "
			WHERE uniforme_tamanho.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (uniforme_grupo_tamanho.nome LIKE :busca OR uniforme_tamanho.nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND uniforme_tamanho.data_hora_cadastro >='{$param['data_hora_inicio']}' AND uniforme_tamanho.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM uniforme_tamanho
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
				uniforme_tamanho.*,
			       uniforme_grupo_tamanho.nome as nome_grupo
			FROM uniforme_tamanho
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY uniforme_tamanho.id DESC";
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
        $sql = "SELECT * FROM uniforme_tamanho WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM uniforme_tamanho WHERE excluido IS NULL";
        if($id != "") $sql .= " AND uniforme_tamanho.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         uniforme_tamanho.id,
                         uniforme_tamanho.nome  AS text
                     FROM uniforme_tamanho
                     WHERE uniforme_tamanho.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (uniforme_tamanho.nome LIKE '%$busca%' OR uniforme_tamanho.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function BuscarPorIdTamanho($id){
        $pdo = new Conexao();
        $sql = " SELECT
                         uniforme_tamanho.id,
                         uniforme_tamanho.nome 
                     FROM uniforme_tamanho
                     INNER JOIN uniforme_grupo_tamanho  ON (uniforme_tamanho.id_grupo_tamanhos = uniforme_grupo_tamanho.id)
                     INNER JOIN uniforme_peca  ON (uniforme_grupo_tamanho.id = uniforme_peca.id_uniforme_grupo)
                     WHERE uniforme_tamanho.excluido IS NULL 
                     ";
        if($id != "") $sql .= "AND uniforme_peca.id = $id";
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

}
