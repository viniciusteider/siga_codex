<?php
class EscalaLocais
{
    private $id;
    private $id_grupo;
    private $id_recurso;
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
    public function setIdGrupo($arg)
    {
        $this->id_grupo = ($arg == "") ? NULL : $arg;
    }

    public function getIdGrupo()
    {
        return $this->id_grupo;
    }
    public function setIdRecurso($arg)
    {
        $this->id_recurso = ($arg == "") ? NULL : $arg;
    }

    public function getIdRecurso()
    {
        return $this->id_recurso;
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
		INSERT INTO escala_locais SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo = :id_grupo";
        $sql .= ",nome = :nome";
        $sql .= ",id_recurso = :id_recurso";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id_recurso",$this->id_recurso,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE escala_locais SET nome = :nome ';
        $sql .= ",id_recurso = :id_recurso";
        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id_recurso",$this->id_recurso,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM escala_locais WHERE id IN({$lista})";
        $sql = "UPDATE escala_locais SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverRecurso($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM escala_locais WHERE id IN({$lista})";
        $sql = "UPDATE escala_locais SET excluido = UTC_TIMESTAMP() WHERE id_recurso IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN grupo ON(grupo.id = escala_locais.id_grupo)
		";

        $where = "
			WHERE escala_locais.excluido IS NULL
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND escala_locais.data_hora_cadastro >='{$param['data_hora_inicio']}' AND escala_locais.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM escala_locais
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
				escala_locais.*
			FROM escala_locais
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY escala_locais.id DESC";
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
        $sql = "SELECT * FROM escala_locais WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "",$idGrupo)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT escala_locais.* FROM escala_locais INNER JOIN grupo ON(grupo.id = escala_locais.id_grupo) WHERE escala_locais.excluido IS NULL AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($id != "") $sql .= " AND escala_locais.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarComboComRecursos($idGrupo)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT
                escala_locais.id,
                escala_locais.nome 
            FROM
                escala_locais
                INNER JOIN grupo ON ( grupo.id = escala_locais.id_grupo ) 
            WHERE
                escala_locais.excluido IS NULL 
                AND ( grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%' ) UNION
            SELECT
                recursos.id,
                CONCAT( recursos.prefixo, ' - Placa: ', recursos.placa ) 
            FROM
                `recursos`
                INNER JOIN grupo ON ( grupo.id = recursos.id_grupo ) 
            WHERE
                recursos.excluido IS NULL 
                AND (
                grupo.id = {$idGrupo} 
                OR grupo.arvore LIKE '%;$idGrupo;%')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         escala_locais.id,
                         escala_locais.nome  AS text
                     FROM escala_locais
                     WHERE escala_locais.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (escala_locais.nome LIKE '%$busca%' OR escala_locais.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
