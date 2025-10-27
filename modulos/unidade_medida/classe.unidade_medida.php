<?php
class UnidadeMedida
{
    private $id;
    private $nome;
    private $id_grupo;
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

    public function setNome($arg)
    {
        $this->nome = ($arg == "") ? NULL : $arg;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setIdGrupo($arg)
    {
        $this->id_grupo = ($arg == "") ? NULL : $arg;
    }

    public function getIdGrupo()
    {
        return $this->id_grupo;
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
		INSERT INTO unidade_medida SET  ';
        $sql .= ",nome = :nome";
        $sql .= ",id_grupo = :id_grupo";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE unidade_medida SET nome = :nome ';

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM unidade_medida WHERE id IN({$lista})";
        $sql = "UPDATE unidade_medida SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($param)
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN grupo ON(grupo.id = unidade_medida.id_grupo)
		";

        $where = "
			WHERE unidade_medida.excluido IS NULL
		";

        if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%' OR id_grupo = 1)";
        if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND unidade_medida.data_hora_cadastro >='{$param['data_hora_inicio']}' AND unidade_medida.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM unidade_medida
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
				unidade_medida.*
			FROM unidade_medida
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY unidade_medida.id DESC";
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
        $sql = "SELECT * FROM unidade_medida WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $param["id_grupo"] = $this->id_grupo;
        $pdo = $this->getConexao();
        $sql = "SELECT unidade_medida.* FROM unidade_medida INNER JOIN grupo ON (grupo.id = unidade_medida.id_grupo) WHERE unidade_medida.excluido IS NULL AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%' OR id_grupo = 1)";
        if($id != "") $sql .= " AND unidade_medida.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ListarComboMedicamento($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT unidade_medida.* FROM unidade_medida WHERE unidade_medida.excluido IS NULL";
        if($id != "") $sql .= " AND unidade_medida.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         unidade_medida.id,
                         unidade_medida.nome  AS text
                     FROM unidade_medida
                     WHERE unidade_medida.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (unidade_medida.nome LIKE '%$busca%' OR unidade_medida.id  LIKE '%$busca%') ";
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

        $objUnidadeMedida= new UnidadeMedida();
        $registros = $objUnidadeMedida->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
