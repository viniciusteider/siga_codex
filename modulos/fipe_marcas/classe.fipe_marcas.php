<?php
class FipeMarcas
{
    private $id;
    private $id_fipe_tipo;
    private $codigo_marca;
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

    public function setIdFipeTipo($arg)
    {
        $this->id_fipe_tipo = ($arg == "") ? NULL : $arg;
    }

    public function getIdFipeTipo()
    {
        return $this->id_fipe_tipo;
    }

    public function setCodigoMarca($arg)
    {
        $this->codigo_marca = ($arg == "") ? NULL : $arg;
    }

    public function getCodigoMarca()
    {
        return $this->codigo_marca;
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
		INSERT INTO fipe_marcas SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_fipe_tipo = :id_fipe_tipo";
        $sql .= ",codigo_marca = :codigo_marca";
        $sql .= ",nome = :nome";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_fipe_tipo",$this->id_fipe_tipo,PDO::PARAM_INT);
        $stmt->bindParam(":codigo_marca",$this->codigo_marca,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE fipe_marcas SET 
			';
        $sql .= ",id_fipe_tipo = :id_fipe_tipo";
        $sql .= ",codigo_marca = :codigo_marca";
        $sql .= ",nome = :nome";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_fipe_tipo",$this->id_fipe_tipo,PDO::PARAM_INT);
        $stmt->bindParam(":codigo_marca",$this->codigo_marca,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM fipe_marcas WHERE id IN({$lista})";
        $sql = "UPDATE fipe_marcas SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE fipe_marcas.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND fipe_marcas.data_hora_cadastro >='{$param['data_hora_inicio']}' AND fipe_marcas.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM fipe_marcas
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
				fipe_marcas.*
			FROM fipe_marcas
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY fipe_marcas.id DESC";
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
        $sql = "SELECT * FROM fipe_marcas WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM fipe_marcas WHERE excluido IS NULL";
        if($id != "") $sql .= " AND fipe_marcas.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca,$tipo){
        $pdo = new Conexao();
        $sql = " SELECT
                         fipe_marcas.id,
                         fipe_marcas.nome  AS text,
                         fipe_marcas.nome 
                     FROM fipe_marcas
                     WHERE fipe_marcas.excluido IS NULL AND fipe_marcas.id_fipe_tipo = $tipo
                     ";

        if($busca != ''){
            $sql .= " AND  (fipe_marcas.nome LIKE '%$busca%' OR fipe_marcas.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function GerarSelec($id,$nome_campo,$id_campo,$outros = '',$campo = ["id","nome"],$autocomlete = true)
    {
        if($autocomlete) $id_atual = $id;

        $objFipeMarcas= new FipeMarcas();
        $registros = $objFipeMarcas->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
