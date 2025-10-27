<?php
class Equipes
{
    private $id;
    private $id_grupo;
    private $id_coordenador;
    private $id_escala_tipo;
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

    public function setIdCoordenador($arg)
    {
        $this->id_coordenador = ($arg == "") ? NULL : $arg;
    }

    public function getIdCoordenador()
    {
        return $this->id_coordenador;
    }

    public function setIdEscalaTipo($arg)
    {
        $this->id_escala_tipo = ($arg == "") ? NULL : $arg;
    }

    public function getIdEscalaTipo()
    {
        return $this->id_escala_tipo;
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
		INSERT INTO equipes SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo = :id_grupo";
        $sql .= ",id_coordenador = :id_coordenador";
        $sql .= ",id_escala_tipo = :id_escala_tipo";
        $sql .= ",nome = :nome";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
        $stmt->bindParam(":id_coordenador",$this->id_coordenador,PDO::PARAM_INT);
        $stmt->bindParam(":id_escala_tipo",$this->id_escala_tipo,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE equipes SET id_coordenador = :id_coordenador ';
        $sql .= ",id_escala_tipo = :id_escala_tipo";
        $sql .= ",nome = :nome";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_coordenador",$this->id_coordenador,PDO::PARAM_INT);
        $stmt->bindParam(":id_escala_tipo",$this->id_escala_tipo,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM equipes WHERE id IN({$lista})";
        $sql = "UPDATE equipes SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN grupo ON(grupo.id = equipes.id_grupo)
		";

        $where = "
			WHERE equipes.excluido IS NULL
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND equipes.data_hora_cadastro >='{$param['data_hora_inicio']}' AND equipes.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM equipes
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
				equipes.*
			FROM equipes
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY equipes.id DESC";
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
        $sql = "SELECT * FROM equipes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "",$idGrupo)
    {
        $pdo = $this->getConexao();
        $sql = "SELECT equipes.* FROM equipes INNER JOIN grupo ON(grupo.id = equipes.id_grupo) WHERE equipes.excluido IS NULL AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($id != "") $sql .= " AND equipes.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarEquipeEfetivo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT equipes_efetivo.*,usuario_efetivo.id_funcao 
                FROM equipes_efetivo 
                    INNER JOIN usuario_efetivo ON(usuario_efetivo.id_usuario = equipes_efetivo.id_efetivo) 
                WHERE equipes_efetivo.excluido IS NULL AND equipes_efetivo.id_equipe = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarAutoComplete($busca,$idGrupo){
        $pdo = new Conexao();
        $sql = " SELECT
                         equipes.id,
                         equipes.nome  AS text
                     FROM equipes
                    INNER JOIN grupo ON(grupo.id = equipes.id_grupo)
                     WHERE equipes.excluido IS NULL AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
                     ";

        if($busca != ''){
            $sql .= " AND  (equipes.nome LIKE '%$busca%' OR equipes.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
