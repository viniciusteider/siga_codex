<?php
class OcorenciasHistorico
{
    private $id;
    private $id_ocorrencia;
    private $id_usuario;
    private $descricao;
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

    public function setIdOcorrencia($arg)
    {
        $this->id_ocorrencia = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrencia()
    {
        return $this->id_ocorrencia;
    }

    public function setIdUsuario($arg)
    {
        $this->id_usuario = ($arg == "") ? NULL : $arg;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setDescricao($arg)
    {
        $this->descricao = ($arg == "") ? NULL : $arg;
    }

    public function getDescricao()
    {
        return $this->descricao;
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
		INSERT INTO ocorencias_historico SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",descricao = :descricao";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":descricao",$this->descricao,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorencias_historico SET 
			';
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",descricao = :descricao";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":descricao",$this->descricao,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM ocorencias_historico WHERE id IN({$lista})";
        $sql = "UPDATE ocorencias_historico SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE ocorencias_historico.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ocorencias_historico.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorencias_historico.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorencias_historico
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
				ocorencias_historico.*
			FROM ocorencias_historico
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ocorencias_historico.id DESC";
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
        $sql = "SELECT * FROM ocorencias_historico WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function ListarHistoricos()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorencias_historico WHERE id_ocorrencia = :id_ocorrencia ORDER BY id desc";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorencias_historico WHERE excluido IS NULL";
        if($id != "") $sql .= " AND ocorencias_historico.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ocorencias_historico.id,
                         ocorencias_historico.nome  AS text
                     FROM ocorencias_historico
                     WHERE ocorencias_historico.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ocorencias_historico.nome LIKE '%$busca%' OR ocorencias_historico.id  LIKE '%$busca%') ";
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

        $objOcorenciasHistorico= new OcorenciasHistorico();
        $registros = $objOcorenciasHistorico->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
