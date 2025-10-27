<?php
class AlmoxarifadoRequisicaoItens
{
    private $id;
    private $id_requisicao;
    private $id_produto;
    private $quantidade;
    private $descricao;
    private $cautela;
    private $id_usuario_baixa;
    private $data_hora_retorno;
    private $data_hora_entrega;
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

    public function setIdRequisicao($arg)
    {
        $this->id_requisicao = ($arg == "") ? NULL : $arg;
    }

    public function getIdRequisicao()
    {
        return $this->id_requisicao;
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

    public function setDescricao($arg)
    {
        $this->descricao = ($arg == "") ? NULL : $arg;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setCautela($arg)
    {
        $this->cautela = ($arg == "") ? NULL : $arg;
    }

    public function getCautela()
    {
        return $this->cautela;
    }

    public function setIdUsuarioBaixa($arg)
    {
        $this->id_usuario_baixa = ($arg == "") ? NULL : $arg;
    }

    public function getIdUsuarioBaixa()
    {
        return $this->id_usuario_baixa;
    }

    public function setDataHoraRetorno($arg)
    {
        $this->data_hora_retorno = ($arg == "") ? NULL : $arg;
    }

    public function getDataHoraRetorno()
    {
        return $this->data_hora_retorno;
    }

    public function setDataHoraEntrega($arg)
    {
        $this->data_hora_entrega = ($arg == "") ? NULL : $arg;
    }

    public function getDataHoraEntrega()
    {
        return $this->data_hora_entrega;
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
		INSERT INTO almoxarifado_requisicao_itens SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_requisicao = :id_requisicao";
        $sql .= ",id_produto = :id_produto";
        $sql .= ",quantidade = :quantidade";
        $sql .= ",descricao = :descricao";
        $sql .= ",cautela = :cautela";
        $sql .= ",data_hora_retorno = :data_hora_retorno";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_requisicao",$this->id_requisicao,PDO::PARAM_INT);
        $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
        $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
        $stmt->bindParam(":descricao",$this->descricao,PDO::PARAM_STR);
        $stmt->bindParam(":cautela",$this->cautela,PDO::PARAM_STR);
        $stmt->bindParam(":data_hora_retorno",$this->data_hora_retorno,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE almoxarifado_requisicao_itens SET id_produto = :id_produto';
        $sql .= ",quantidade = :quantidade";
        $sql .= ",descricao = :descricao";
        $sql .= ",cautela = :cautela";
        $sql .= ",data_hora_retorno = :data_hora_retorno";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_produto",$this->id_produto,PDO::PARAM_INT);
        $stmt->bindParam(":quantidade",$this->quantidade,PDO::PARAM_INT);
        $stmt->bindParam(":descricao",$this->descricao,PDO::PARAM_STR);
        $stmt->bindParam(":cautela",$this->cautela,PDO::PARAM_STR);
        $stmt->bindParam(":data_hora_retorno",$this->data_hora_retorno,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM almoxarifado_requisicao_itens WHERE id IN({$lista})";
        $sql = "UPDATE almoxarifado_requisicao_itens SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverAll($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "UPDATE almoxarifado_requisicao_itens SET excluido = UTC_TIMESTAMP() WHERE id NOT IN({$lista}) AND id_requisicao = :id_requisicao";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_requisicao",$this->id_requisicao,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function ListarRemovidos($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "SELECT * FROM almoxarifado_requisicao_itens WHERE excluido IS NULL AND id NOT IN({$lista}) AND id_requisicao = :id_requisicao";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_requisicao",$this->id_requisicao,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE almoxarifado_requisicao_itens.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND almoxarifado_requisicao_itens.data_hora_cadastro >='{$param['data_hora_inicio']}' AND almoxarifado_requisicao_itens.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM almoxarifado_requisicao_itens
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
				almoxarifado_requisicao_itens.*
			FROM almoxarifado_requisicao_itens
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY almoxarifado_requisicao_itens.id DESC";
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
        $sql = "SELECT * FROM almoxarifado_requisicao_itens WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo()
    {
        if($this->id_requisicao == "") return [];
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM almoxarifado_requisicao_itens WHERE excluido IS NULL AND almoxarifado_requisicao_itens.id_requisicao = :id_requisicao ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_requisicao",$this->id_requisicao,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         almoxarifado_requisicao_itens.id,
                         almoxarifado_requisicao_itens.nome  AS text
                     FROM almoxarifado_requisicao_itens
                     WHERE almoxarifado_requisicao_itens.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (almoxarifado_requisicao_itens.nome LIKE '%$busca%' OR almoxarifado_requisicao_itens.id  LIKE '%$busca%') ";
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

        $objAlmoxarifadoRequisicaoItens= new AlmoxarifadoRequisicaoItens();
        $registros = $objAlmoxarifadoRequisicaoItens->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
