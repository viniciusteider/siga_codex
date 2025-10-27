<?php
class Fornecedor
{
    private $id;
    private $id_grupo;
    private $nome;
    private $latitude;
    private $longitude;
    private $excluido;
    private $id_endereco;
    private $cpf;
    private $cnpj;
    private $qualificacao;
    private $ramo_atividde;
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

    public function setNome($arg)
    {
        $this->nome = ($arg == "") ? NULL : $arg;
    }

    public function getNome()
    {
        return $this->nome;
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

    public function setExcluido($arg)
    {
        $this->excluido = ($arg == "") ? NULL : $arg;
    }

    public function getExcluido()
    {
        return $this->excluido;
    }

    public function setIdEndereco($arg)
    {
        $this->id_endereco = ($arg == "") ? NULL : $arg;
    }

    public function getIdEndereco()
    {
        return $this->id_endereco;
    }

    public function setCpf($arg)
    {
        $this->cpf = ($arg == "") ? NULL : $arg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCnpj($arg)
    {
        $this->cnpj = ($arg == "") ? NULL : $arg;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setQualificacao($arg)
    {
        $this->qualificacao = ($arg == "") ? NULL : $arg;
    }

    public function getQualificacao()
    {
        return $this->qualificacao;
    }

    public function setRamoAtividde($arg)
    {
        $this->ramo_atividde = ($arg == "") ? NULL : $arg;
    }

    public function getRamoAtividde()
    {
        return $this->ramo_atividde;
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
		INSERT INTO fornecedor SET  id_grupo = :id_grupo ';
        $sql .= ",nome = :nome";
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";
        $sql .= ",id_endereco = :id_endereco";
        $sql .= ",cpf = :cpf";
        $sql .= ",cnpj = :cnpj";
        $sql .= ",qualificacao = :qualificacao";
        $sql .= ",ramo_atividde = :ramo_atividde";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":latitude",$this->latitude,PDO::PARAM_STR);
        $stmt->bindParam(":longitude",$this->longitude,PDO::PARAM_STR);
        $stmt->bindParam(":id_endereco",$this->id_endereco,PDO::PARAM_INT);
        $stmt->bindParam(":cpf",$this->cpf,PDO::PARAM_STR);
        $stmt->bindParam(":cnpj",$this->cnpj,PDO::PARAM_STR);
        $stmt->bindParam(":qualificacao",$this->qualificacao,PDO::PARAM_INT);
        $stmt->bindParam(":ramo_atividde",$this->ramo_atividde,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE fornecedor SET nome = :nome ';
        $sql .= ",latitude = :latitude";
        $sql .= ",longitude = :longitude";
        $sql .= ",cpf = :cpf";
        $sql .= ",cnpj = :cnpj";
        $sql .= ",qualificacao = :qualificacao";
        $sql .= ",ramo_atividde = :ramo_atividde";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":latitude",$this->latitude,PDO::PARAM_STR);
        $stmt->bindParam(":longitude",$this->longitude,PDO::PARAM_STR);
        $stmt->bindParam(":cpf",$this->cpf,PDO::PARAM_STR);
        $stmt->bindParam(":cnpj",$this->cnpj,PDO::PARAM_STR);
        $stmt->bindParam(":qualificacao",$this->qualificacao,PDO::PARAM_INT);
        $stmt->bindParam(":ramo_atividde",$this->ramo_atividde,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM fornecedor WHERE id IN({$lista})";
        $sql = "UPDATE fornecedor SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($param)
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN grupo ON(grupo.id = fornecedor.id_grupo)
		";

        $where = "
			WHERE fornecedor.excluido IS NULL
		";

        if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
        if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND fornecedor.data_hora_cadastro >='{$param['data_hora_inicio']}' AND fornecedor.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM fornecedor
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
				fornecedor.*
			FROM fornecedor
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY fornecedor.id DESC";
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
        $sql = "SELECT fornecedor.*, 
        endereco.`id` as id_endereco,
        endereco.`logradouro`,
        endereco.`numero`,
        endereco.`complemento`,
        endereco.`bairro`,
        endereco.`id_cidade`,
        endereco.`cidade`,
        endereco.`estado`,
        endereco.`cep`,
        endereco.`referencia`,
        endereco.`observacao`,
        endereco.`telefone`,
        endereco.`comercial`,
        endereco.`celular`,
        endereco.`email`,
        endereco.`email_mkt`,
        endereco.`email_mkt2`,
        endereco.`latitude`,
        endereco.`longitude`,
        cidades.id_estado
        FROM fornecedor 
            INNER JOIN endereco ON (endereco.id = fornecedor.id_endereco) 
            INNER JOIN cidades ON (cidades.id = endereco.id_cidade) 
        WHERE fornecedor.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $param["id_grupo"] = $this->id_grupo;
        $pdo = $this->getConexao();
        $sql = "SELECT fornecedor.* FROM fornecedor INNER JOIN grupo ON (grupo.id = fornecedor.id_grupo) WHERE fornecedor.excluido IS NULL  AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
        if($id != "") $sql .= " AND fornecedor.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $param["id_grupo"] = $this->id_grupo;
        $pdo = new Conexao();
        $sql = " SELECT
                         fornecedor.id,
                         fornecedor.nome  AS text
                     FROM fornecedor
                        INNER JOIN grupo ON (grupo.id = fornecedor.id_grupo)
                     WHERE fornecedor.excluido IS NULL  AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')
                     ";

        if($busca != ''){
            $sql .= " AND  (fornecedor.nome LIKE '%$busca%' OR fornecedor.id  LIKE '%$busca%') ";
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

        $objFornecedor= new Fornecedor();
        $registros = $objFornecedor->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
