<?php
class EscalaMensal
{
	private $id;
	private $id_usuario;
	private $id_funcao;
	private $id_local;
	private $id_equipe;
	private $data_hora_entrada;
	private $data_hora_saida;
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
 	
	public function setIdUsuario($arg)
	{
		$this->id_usuario = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdUsuario()
	{
		return $this->id_usuario;
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

    public function setIdEquipe($arg)
    {
        $this->id_equipe = ($arg == "") ? NULL : $arg;
    }

    public function getIdEequipe()
    {
        return $this->id_equipe;
    }


    public function setDataHoraEntrada($arg)
	{
		$this->data_hora_entrada = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraEntrada()
	{
		return $this->data_hora_entrada;
	}
 	
	public function setDataHoraSaida($arg)
	{
		$this->data_hora_saida = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataHoraSaida()
	{
		return $this->data_hora_saida;
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
		INSERT INTO escala_mensal SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
		 $sql .= ",id_usuario = :id_usuario";
		 $sql .= ",id_funcao = :id_funcao";
		 $sql .= ",id_local = :id_local";
		 $sql .= ",id_equipe = :id_equipe";
		 $sql .= ",data_hora_entrada = :data_hora_entrada";
		 $sql .= ",data_hora_saida = :data_hora_saida";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_funcao",$this->id_funcao,PDO::PARAM_INT);
		 $stmt->bindParam(":id_local",$this->id_local,PDO::PARAM_INT);
		 $stmt->bindParam(":id_equipe",$this->id_equipe,PDO::PARAM_INT);
		 $stmt->bindParam(":data_hora_entrada",$this->data_hora_entrada,PDO::PARAM_STR);
		 $stmt->bindParam(":data_hora_saida",$this->data_hora_saida,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE escala_mensal SET id_local = :id_local ';
		 $sql .= ",data_hora_entrada = :data_hora_entrada";
		 $sql .= ",data_hora_saida = :data_hora_saida";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_local",$this->id_local,PDO::PARAM_INT);
		 $stmt->bindParam(":data_hora_entrada",$this->data_hora_entrada,PDO::PARAM_STR);
		 $stmt->bindParam(":data_hora_saida",$this->data_hora_saida,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM escala_mensal WHERE id IN({$lista})";
		$sql = "UPDATE escala_mensal SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		INNER JOIN usuario ON(usuario.id = escala_mensal.id_usuario)
		INNER JOIN grupo ON (grupo.id = usuario.id_grupo)
		INNER JOIN funcao ON(funcao.id = escala_mensal.id_funcao)
		LEFT JOIN escala_locais ON(escala_locais.id = escala_mensal.id_local)
		LEFT JOIN `recursos` ON (recursos.id = escala_mensal.`id_local`)
		";
		
		$where = "
			WHERE escala_mensal.excluido IS NULL
		";
		
		if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
		if($busca != "") $where .= " AND (usuario.nome LIKE :busca OR funcao.nome LIKE :busca OR escala_locais.nome LIKE :busca)";
		 if (($param['data_hora_inicio']))  $where .= " AND escala_mensal.data_hora_entrada >='{$param['data_hora_inicio']}' AND escala_mensal.data_hora_saida <= '{$param['data_hora_fim']}'";
		
		$sql = "
			SELECT COUNT(*) AS total
			FROM escala_mensal
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
				escala_mensal.*
			    ,IFNULL(escala_locais.nome, CONCAT(recursos.prefixo, ' - Placa: ', recursos.placa)) as nome_local
			    ,usuario.nome as nome_usuario
			    ,funcao.nome as nome_funcao
			    ,date(escala_mensal.data_hora_entrada) as data_inicio
			FROM escala_mensal
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY escala_mensal.id DESC";
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
        $x = 0;
        foreach ($linhas as $linha) {
            $vetor[$linha['id_local']][] = $linha;
            $x++;
		}

		return [$vetor,$totalRegistros];
	}
    public function ListarCopia($idGrupo,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN usuario ON(usuario.id = escala_mensal.id_usuario)
		INNER JOIN grupo ON (grupo.id = usuario.id_grupo)
		INNER JOIN funcao ON(funcao.id = escala_mensal.id_funcao)
		INNER JOIN escala_locais ON(escala_locais.id = escala_mensal.id_local)
		";

        $where = "
			WHERE escala_mensal.excluido IS NULL
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if (($param['data_copia']))  $where .= " AND date(escala_mensal.data_hora_entrada) ='".substr($param['data_copia'],0,10)."'";


        $sql = "
			SELECT 
				escala_mensal.*
			    ,escala_locais.nome as nome_local
			    ,usuario.nome as nome_usuario
			    ,funcao.nome as nome_funcao
			    ,date(escala_mensal.data_hora_entrada) as data_inicio
			FROM escala_mensal
			$joins
			$where
		";

       $sql .=" ORDER BY escala_mensal.id DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $linhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $x = 0;
        foreach ($linhas as $linha) {
            $vetor[$linha['id_local']][] = $linha;
            $x++;
        }

        return $vetor;
    }
	public function Editar()
	{
		$pdo = $this->getConexao();
		$sql = "SELECT * FROM escala_mensal WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM escala_mensal WHERE excluido IS NULL";
            if($id != "") $sql .= " AND escala_mensal.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         escala_mensal.id,
                         escala_mensal.nome  AS text
                     FROM escala_mensal
                     WHERE escala_mensal.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (escala_mensal.nome LIKE '%$busca%' OR escala_mensal.id  LIKE '%$busca%') ";
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
    
            $objEscalaMensal= new EscalaMensal();
            $registros = $objEscalaMensal->ListarCombo($id_atual);
            return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
        }
    }
