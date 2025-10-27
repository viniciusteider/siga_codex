<?php
class Ligacoes
{
    private $id;
    private $id_usuario;
    private $numero;
    private $tempo;
    private $id_classificacao;
    private $latitude;
    private $longitude;
    private $data_hora_cadastro;
    private $excluido;
    private $descritivo;
    private $conexao;

    public function setId($arg)
    {
        $this->id = ($arg == "") ? NULL : $arg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdUsuario($arg)
    {
        $this->id_usuario = ($arg == "") ? NULL : $arg;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setNumero($arg)
    {
        $this->numero = ($arg == "") ? NULL : $arg;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setTempo($arg)
    {
        $this->tempo = ($arg == "") ? NULL : $arg;
    }

    public function getTempo()
    {
        return $this->tempo;
    }

    public function setIdClassificacao($arg)
    {
        $this->id_classificacao = ($arg == "") ? NULL : $arg;
    }

    public function getIdClassificacao()
    {
        return $this->id_classificacao;
    }

    public function setLatitude($arg)
    {
        $this->latitude = ($arg == "") ? NULL : $arg;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($arg)
    {
        $this->longitude = ($arg == "") ? NULL : $arg;
    }

    public function getLongitude()
    {
        return $this->longitude;
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

    public function setDescritivo($arg)
    {
        $this->descritivo = ($arg == "") ? NULL : $arg;
    }

    public function getDescritivo()
    {
        return $this->descritivo;
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
		INSERT INTO ligacoes SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",numero = :numero";
        $sql .= ",tempo = :tempo";
        $sql .= ",id_classificacao = :id_classificacao";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";
        $sql .= ",descritivo = :descritivo";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":numero",$this->numero,PDO::PARAM_STR);
        $stmt->bindParam(":tempo",$this->tempo,PDO::PARAM_STR);
        $stmt->bindParam(":id_classificacao",$this->id_classificacao,PDO::PARAM_INT);
        $stmt->bindParam(":latitude",$this->latitude,PDO::PARAM_STR);
        $stmt->bindParam(":longitude",$this->longitude,PDO::PARAM_STR);
        $stmt->bindParam(":descritivo",$this->descritivo,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ligacoes SET numero = :numero';
        $sql .= ",tempo = :tempo";
        $sql .= ",id_classificacao = :id_classificacao";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";
        $sql .= ",descritivo = :descritivo";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":numero",$this->numero,PDO::PARAM_STR);
        $stmt->bindParam(":tempo",$this->tempo,PDO::PARAM_STR);
        $stmt->bindParam(":id_classificacao",$this->id_classificacao,PDO::PARAM_INT);
        $stmt->bindParam(":latitude",$this->latitude,PDO::PARAM_STR);
        $stmt->bindParam(":longitude",$this->longitude,PDO::PARAM_STR);
        $stmt->bindParam(":descritivo",$this->descritivo,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM ligacoes WHERE id IN({$lista})";
        $sql = "UPDATE ligacoes SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE ligacoes.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ligacoes.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ligacoes.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ligacoes
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
				ligacoes.*
			FROM ligacoes
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ligacoes.id DESC";
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
        $sql = "SELECT * FROM ligacoes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ligacoes WHERE excluido IS NULL";
        if($id != "") $sql .= " AND ligacoes.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ligacoes.id,
                         ligacoes.nome  AS text
                     FROM ligacoes
                     WHERE ligacoes.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ligacoes.nome LIKE '%$busca%' OR ligacoes.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function BuscarLigacoes($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ligacoes.id,
                         CONCAT(classificacao_ligacao.nome,' ',ligacoes.numero)  AS nome
                     FROM ligacoes INNER JOIN classificacao_ligacao ON(classificacao_ligacao.id = ligacoes.id_classificacao)
                     WHERE ligacoes.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ligacoes.numero LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
}
