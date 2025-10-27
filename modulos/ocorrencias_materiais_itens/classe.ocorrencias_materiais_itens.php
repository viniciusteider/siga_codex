<?php
class OcorrenciasMateriaisItens
{
    private $id;
    private $id_ocorrencia_entrega;
    private $id_item;
    private $quantidade;
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

    public function setIdOcorenciaEntrega($arg)
    {
        $this->id_ocorrencia_entrega = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorenciaEntrega()
    {
        return $this->id_ocorrencia_entrega;
    }

    public function setIdItem($arg)
    {
        $this->id_item = ($arg == "") ? NULL : $arg;
    }

    public function getIdItem()
    {
        return $this->id_item;
    }

    public function setQuantidade($arg)
    {
        $this->quantidade = ($arg == "") ? NULL : $arg;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
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
		INSERT INTO ocorrencias_materiais_itens SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_ocorrencia_entrega = :id_ocorrencia_entrega";
        $sql .= ",id_item = :id_item";
        $sql .= ",quantidade = :quantidade";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_ocorrencia_entrega",$this->id_ocorrencia_entrega,PDO::PARAM_INT);
        $stmt->bindParam(":id_item",$this->id_item,PDO::PARAM_INT);
        $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias_materiais_itens SET id_item = :id_item ';
        $sql .= ",quantidade = :quantidade";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_item",$this->id_item,PDO::PARAM_INT);
        $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM ocorrencias_materiais_itens WHERE id IN({$lista})";
        $sql = "UPDATE ocorrencias_materiais_itens SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function RemoverAll($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "DELETE FROM ocorrencias_materiais_itens WHERE id NOT IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE ocorrencias_materiais_itens.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ocorrencias_materiais_itens.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias_materiais_itens.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias_materiais_itens
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
				ocorrencias_materiais_itens.*
			FROM ocorrencias_materiais_itens
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ocorrencias_materiais_itens.id DESC";
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
        $sql = "SELECT * FROM ocorrencias_materiais_itens WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id)
    {
        if($id == "")  return [] ;
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorrencias_materiais_itens WHERE excluido IS NULL";
        $sql .= " AND ocorrencias_materiais_itens.id_ocorrencia_entrega = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ocorrencias_materiais_itens.id,
                         ocorrencias_materiais_itens.nome  AS text
                     FROM ocorrencias_materiais_itens
                     WHERE ocorrencias_materiais_itens.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ocorrencias_materiais_itens.nome LIKE '%$busca%' OR ocorrencias_materiais_itens.id  LIKE '%$busca%') ";
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

        $objOcorrenciasMateriaisItens= new OcorrenciasMateriaisItens();
        $registros = $objOcorrenciasMateriaisItens->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
