<?php
class EscalaEquipe
{
    private $id;
    private $id_escala;
    private $id_efetivo;
    private $id_funcao;
    private $id_local;
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

    public function setIdEscala($arg)
    {
        $this->id_escala = ($arg == "") ? NULL : $arg;
    }

    public function getIdEscala()
    {
        return $this->id_escala;
    }

    public function setIdEfetivo($arg)
    {
        $this->id_efetivo = ($arg == "") ? NULL : $arg;
    }

    public function getIdEfetivo()
    {
        return $this->id_efetivo;
    }

    public function setIdFuncao($arg)
    {
        $this->id_funcao = ($arg == "") ? NULL : $arg;
    }

    public function getIdFuncao()
    {
        return $this->id_funcao;
    }

    public function setIdLocal($arg)
    {
        $this->id_local = ($arg == "") ? NULL : $arg;
    }

    public function getIdLocal()
    {
        return $this->id_local;
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
		INSERT INTO escala_equipe SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_escala = :id_escala";
        $sql .= ",id_efetivo = :id_efetivo";
        $sql .= ",id_funcao = :id_funcao";
        $sql .= ",id_local = :id_local";

        $sql .= " ON DUPLICATE KEY UPDATE ";

        $sql .= "id_escala = :id_escala";
        $sql .= ",id_efetivo = :id_efetivo";
        $sql .= ",id_funcao = :id_funcao";
        $sql .= ",id_local = :id_local";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_escala",$this->id_escala,PDO::PARAM_INT);
        $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
        $stmt->bindParam(":id_funcao",$this->id_funcao,PDO::PARAM_INT);
        $stmt->bindParam(":id_local",$this->id_local,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE escala_equipe SET 
			';
        $sql .= ",id_escala = :id_escala";
        $sql .= ",id_efetivo = :id_efetivo";
        $sql .= ",id_funcao = :id_funcao";
        $sql .= ",id_local = :id_local";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_escala",$this->id_escala,PDO::PARAM_INT);
        $stmt->bindParam(":id_efetivo",$this->id_efetivo,PDO::PARAM_INT);
        $stmt->bindParam(":id_funcao",$this->id_funcao,PDO::PARAM_INT);
        $stmt->bindParam(":id_local",$this->id_local,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM escala_equipe WHERE id IN({$lista})";
        $sql = "UPDATE escala_equipe SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE escala_equipe.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND escala_equipe.data_hora_cadastro >='{$param['data_hora_inicio']}' AND escala_equipe.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM escala_equipe
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
				escala_equipe.*
			FROM escala_equipe
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY escala_equipe.id DESC";
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
        $sql = "SELECT * FROM escala_equipe WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM escala_equipe WHERE excluido IS NULL";
        if($id != "") $sql .= " AND escala_equipe.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarEquipeEscala($id_escala = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM escala_equipe WHERE excluido IS NULL";
        $sql .= " AND escala_equipe.id_escala = $id_escala ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarEscalaEquipe($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
                    escala_equipe.*,usuario.nome as nome_usuario 
                FROM escala_equipe 
                INNER JOIN usuario ON (usuario.id = escala_equipe.id_efetivo) 
                WHERE escala_equipe.excluido IS NULL AND escala_equipe.id_escala = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         escala_equipe.id,
                         escala_equipe.nome  AS text
                     FROM escala_equipe
                     WHERE escala_equipe.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (escala_equipe.nome LIKE '%$busca%' OR escala_equipe.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
