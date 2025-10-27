<?php
class EquipesEfetivo
{
    private $id;
    private $id_equipe;
    private $id_efetivo;
    private $ordem;
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

    public function setIdEquipe($arg)
    {
        $this->id_equipe = ($arg == "") ? NULL : $arg;
    }

    public function getIdEquipe()
    {
        return $this->id_equipe;
    }

    public function setIdEfetivo($arg)
    {
        $this->id_efetivo = ($arg == "") ? NULL : $arg;
    }

    public function getIdEfetivo()
    {
        return $this->id_efetivo;
    }

    public function setOrdem($arg)
    {
        $this->ordem = ($arg == "") ? NULL : $arg;
    }

    public function getOrdem()
    {
        return $this->ordem;
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
		INSERT INTO equipes_efetivo SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_equipe = :id_equipe";
        $sql .= ",id_efetivo = :id_efetivo";
        $sql .= ",ordem = :ordem";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_equipe",$this->id_equipe,PDO::PARAM_INT);
        $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
        $stmt->bindParam(":ordem",$this->ordem,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE equipes_efetivo SET id_efetivo = :id_efetivo ';
        $sql .= ",ordem = :ordem";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
        $stmt->bindParam(":ordem",$this->ordem,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM equipes_efetivo WHERE id IN({$lista})";
        $sql = "UPDATE equipes_efetivo SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverAll($lista,$id)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "DELETE FROM equipes_efetivo WHERE id NOT IN({$lista}) AND id_equipe = $id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE equipes_efetivo.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND equipes_efetivo.data_hora_cadastro >='{$param['data_hora_inicio']}' AND equipes_efetivo.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM equipes_efetivo
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
				equipes_efetivo.*
			FROM equipes_efetivo
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY equipes_efetivo.id DESC";
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
        $sql = "SELECT * FROM equipes_efetivo WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM equipes_efetivo WHERE excluido IS NULL";
        if($id != "") $sql .= " AND equipes_efetivo.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarEditar($id = "")
    {
        if($id == "") return [];
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM equipes_efetivo WHERE excluido IS NULL";
        $sql .= " AND equipes_efetivo.id_equipe = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         equipes_efetivo.id,
                         equipes_efetivo.nome  AS text
                     FROM equipes_efetivo
                     WHERE equipes_efetivo.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (equipes_efetivo.nome LIKE '%$busca%' OR equipes_efetivo.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function ListarEscalaEquipe($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
                    equipes_efetivo.*,usuario.nome as nome_usuario
                    ,usuario.id as id_usuario
                    ,escala_equipe.id_local
                    ,funcao.nome as nome_cargo
                    ,escala_locais.nome as nome_local
                    ,funcao.id as id_funcao
                    ,escala_equipe.id as id_escala_equipe
                FROM equipes_efetivo 
                INNER JOIN usuario ON (usuario.id = equipes_efetivo.id_efetivo) 
                INNER JOIN usuario_efetivo ON (usuario.id = usuario_efetivo.id_usuario) 
                INNER JOIN escala ON (escala.id_equipe = equipes_efetivo.id_equipe) 
                LEFT JOIN escala_equipe ON (usuario.id = escala_equipe.id_efetivo AND escala.id = escala_equipe.id_escala) 
                LEFT JOIN escala_locais ON (escala_locais.id = escala_equipe.id_local) 
                LEFT JOIN funcao ON (funcao.id = usuario_efetivo.id_funcao) 
                WHERE equipes_efetivo.excluido IS NULL AND escala.id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
