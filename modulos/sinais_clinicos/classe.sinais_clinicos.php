<?php
class SinaisClinicos
{
    private $id;
    private $sinais;
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

    public function setSinais($arg)
    {
        $this->sinais = ($arg == "") ? NULL : $arg;
    }

    public function getSinais()
    {
        return $this->sinais;
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
		INSERT INTO sinais_clinicos SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",sinais = :sinais";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":sinais",$this->sinais,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE sinais_clinicos SET 
			';
        $sql .= ",sinais = :sinais";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":sinais",$this->sinais,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM sinais_clinicos WHERE id IN({$lista})";
        $sql = "UPDATE sinais_clinicos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($param)
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE sinais_clinicos.excluido IS NULL
		";

        //if (!empty($param["id_grupo"]))  $where .= " AND (grupo.id = {$param["id_grupo"]} OR grupo.arvore LIKE '%;{$param['id_grupo']}%')";
        if($param["busca"] != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND sinais_clinicos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND sinais_clinicos.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM sinais_clinicos
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
				sinais_clinicos.*
			FROM sinais_clinicos
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY {$param['filtro']} {$param['ordem']}"; else $sql .=" ORDER BY sinais_clinicos.id DESC";
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
        $sql = "SELECT * FROM sinais_clinicos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function PacienteSinais($id_paciente = "")
    {
        $pdo = $this->getConexao();
        if($id_paciente != "")
        {
            $sql = "SELECT sinais_clinicos.*,paciente_sinais_clinicos.id as checked FROM sinais_clinicos  
                LEFT JOIN paciente_sinais_clinicos ON (paciente_sinais_clinicos.id_sinais_clinicos = sinais_clinicos.id AND paciente_sinais_clinicos.id_paciente = $id_paciente )
                WHERE sinais_clinicos.excluido IS NULL ORDER BY sinais ASC";
        }
        else
        {
            $sql = "SELECT sinais_clinicos.*,'' as checked FROM sinais_clinicos  
                     WHERE sinais_clinicos.excluido IS NULL ORDER BY sinais ASC";
        }


        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM sinais_clinicos WHERE excluido IS NULL ORDER BY sinais ASC";
        if($id != "") $sql .= " AND sinais_clinicos.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         sinais_clinicos.id,
                         sinais_clinicos.nome  AS text
                     FROM sinais_clinicos
                     WHERE sinais_clinicos.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (sinais_clinicos.nome LIKE '%$busca%' OR sinais_clinicos.id  LIKE '%$busca%') ";
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

        $objSinaisClinicos= new SinaisClinicos();
        $registros = $objSinaisClinicos->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
