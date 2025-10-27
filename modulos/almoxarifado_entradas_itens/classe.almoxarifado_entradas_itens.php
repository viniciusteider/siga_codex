<?php
class AlmoxarifadoEntradasItens
{
    private $id;
    private $id_entrada;
    private $id_produto;
    private $quantidade;
    private $valor;
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

    public function setIdEntrada($arg)
    {
        $this->id_entrada = ($arg == "") ? NULL : $arg;
    }

    public function getIdEntrada()
    {
        return $this->id_entrada;
    }

    public function setIdProduto($arg)
    {
        $this->id_produto = ($arg == "") ? NULL : $arg;
    }

    public function getIdProduto()
    {
        return $this->id_produto;
    }

    public function setQuantidade($arg)
    {
        $this->quantidade = ($arg == "") ? NULL : $arg;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setValor($arg)
    {
        $this->valor = str_replace(",", ".", str_replace(".", "", $arg));
    }

    public function getValor()
    {
        return $this->valor;
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
		INSERT INTO almoxarifado_entradas_itens SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_entrada = :id_entrada";
        $sql .= ",id_produto = :id_produto";
        $sql .= ",quantidade = :quantidade";
        $sql .= ",valor = :valor";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_entrada",$this->id_entrada,PDO::PARAM_INT);
        $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
        $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
        $stmt->bindParam(":valor",$this->valor,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE almoxarifado_entradas_itens SET id_entrada = :id_entrada';
        $sql .= ",id_produto = :id_produto";
        $sql .= ",quantidade = :quantidade";
        $sql .= ",valor = :valor";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_entrada",$this->id_entrada,PDO::PARAM_INT);
        $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
        $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
        $stmt->bindParam(":valor",$this->valor,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM almoxarifado_entradas_itens WHERE id IN({$lista})";
        $sql = "UPDATE almoxarifado_entradas_itens SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverAll($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "UPDATE almoxarifado_entradas_itens SET excluido = UTC_TIMESTAMP() WHERE id NOT IN({$lista}) AND id_entrada = :id_entrada";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_entrada",$this->id_entrada,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function ListarRemovidos($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "SELECT * FROM almoxarifado_entradas_itens WHERE excluido IS NULL AND id NOT IN({$lista}) AND id_entrada = :id_entrada";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_entrada",$this->id_entrada,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE almoxarifado_entradas_itens.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND almoxarifado_entradas_itens.data_hora_cadastro >='{$param['data_hora_inicio']}' AND almoxarifado_entradas_itens.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM almoxarifado_entradas_itens
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
				almoxarifado_entradas_itens.*
			FROM almoxarifado_entradas_itens
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY almoxarifado_entradas_itens.id DESC";
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
        $sql = "SELECT * FROM almoxarifado_entradas_itens WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM almoxarifado_entradas_itens WHERE excluido IS NULL";
        if($id != "") $sql .= " AND almoxarifado_entradas_itens.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarItensEntrada()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM almoxarifado_entradas_itens WHERE excluido IS NULL";
        $sql .= " AND almoxarifado_entradas_itens.id_entrada = :id_entrada ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_entrada",$this->id_entrada,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         almoxarifado_entradas_itens.id,
                         almoxarifado_entradas_itens.nome  AS text
                     FROM almoxarifado_entradas_itens
                     WHERE almoxarifado_entradas_itens.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (almoxarifado_entradas_itens.nome LIKE '%$busca%' OR almoxarifado_entradas_itens.id  LIKE '%$busca%') ";
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

        $objAlmoxarifadoEntradasItens= new AlmoxarifadoEntradasItens();
        $registros = $objAlmoxarifadoEntradasItens->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
