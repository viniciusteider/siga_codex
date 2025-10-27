<?php
class Escala
{
    private $id;
    private $id_grupo;
    private $id_equipe;
    private $nome;
    private $data_inicio;
    private $data_fim;
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

    public function setIdGrupo($arg)
    {
        $this->id_grupo = ($arg == "") ? NULL : $arg;
    }

    public function getIdGrupo()
    {
        return $this->id_grupo;
    }

    public function setIdEquipe($arg)
    {
        $this->id_equipe = ($arg == "") ? NULL : $arg;
    }

    public function getIdEquipe()
    {
        return $this->id_equipe;
    }

    public function setNome($arg)
    {
        $this->nome = ($arg == "") ? NULL : $arg;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setDataInicio($arg)
    {
        $this->data_inicio = ($arg == "") ? NULL : $arg;
    }

    public function getDataInicio()
    {
        return $this->data_inicio;
    }

    public function setDataFim($arg)
    {
        $this->data_fim = ($arg == "") ? NULL : $arg;
    }

    public function getDataFim()
    {
        return $this->data_fim;
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
		INSERT INTO escala SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_grupo = :id_grupo";
        $sql .= ",id_equipe = :id_equipe";
        $sql .= ",nome = :nome";
        $sql .= ",data_inicio = :data_inicio";
        $sql .= ",data_fim = :data_fim";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_grupo",$this->id_grupo,PDO::PARAM_INT);
        $stmt->bindParam(":id_equipe",$this->id_equipe,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
        $stmt->bindParam(":data_fim",$this->data_fim,PDO::PARAM_STR);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE escala SET id_equipe = :id_equipe ';
        $sql .= ",nome = :nome";
        $sql .= ",data_inicio = :data_inicio";
        $sql .= ",data_fim = :data_fim";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_equipe",$this->id_equipe,PDO::PARAM_INT);
        $stmt->bindParam(":nome",$this->nome,PDO::PARAM_STR);
        $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
        $stmt->bindParam(":data_fim",$this->data_fim,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM escala WHERE id IN({$lista})";
        $sql = "UPDATE escala SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		INNER JOIN grupo ON(grupo.id = escala.id_grupo)
		";

        $where = "
			WHERE escala.excluido IS NULL
		";

        if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND escala.data_hora_cadastro >='{$param['data_hora_inicio']}' AND escala.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM escala
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
				escala.*
			FROM escala
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY escala.id DESC";
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
        $sql = "SELECT escala.*,usuario.nome as nome_coordenador
                FROM escala 
                    INNER JOIN equipes ON(equipes.id = escala.id_equipe) 
                    INNER JOIN usuario ON(usuario.id = equipes.id_coordenador) 
                WHERE escala.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM escala WHERE excluido IS NULL";
        if($id != "") $sql .= " AND escala.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         escala.id,
                         escala.nome  AS text
                     FROM escala
                     WHERE escala.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (escala.nome LIKE '%$busca%' OR escala.id  LIKE '%$busca%') ";
        }
        $sql .= ' LIMIT 50';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }
    public function BuscarRecursosEscalas($idGrupo)
    {
        //if (!empty($idGrupo))  $where .= " )";
        $data_hora = Conexao::DataHoraGMTDB();
        list($data,$hora) =  explode(" ",$data_hora);
        $pdo = new Conexao();
        $sql = "SELECT DISTINCT 
                    recursos.id
                    ,recursos.prefixo
                    ,usuario.nome
                    ,tipo_recursos.nome as nome_tipo_recurso
                    ,ocorrencias_recursos.horario_saida_base
                    ,ocorrencias_recursos.horario_chegada_local
                    ,ocorrencias_recursos.horario_saida_local
                    ,ocorrencias_recursos.horario_chegada_hospital
                    ,ocorrencias_recursos.qta
                    ,base.nome as nome_base
                    ,(SELECT GROUP_CONCAT(usuario.nome) FROM escala_equipe INNER JOIN usuario ON(escala_equipe.id_efetivo = usuario.id)  WHERE escala_equipe.id_escala = escala.id) as grupo_equipe
                    ,ocorrencias_recursos.id as id_ocorrencias_recursos
                FROM `escala_equipe_horarios` 
                INNER JOIN `escala_equipe` ON (escala_equipe.id = escala_equipe_horarios.`id_escala_equipe`)
                INNER JOIN escala ON (escala.id = escala_equipe.`id_escala` AND escala.excluido IS NULL )
                INNER JOIN grupo ON (grupo.id = escala.`id_grupo`)
                INNER JOIN equipes ON (equipes.id = escala.id_equipe )
                INNER JOIN usuario ON (usuario.id = equipes.id_coordenador)
                INNER JOIN `escala_locais` ON (escala_locais.id = escala_equipe.`id_local`)
                INNER JOIN `recursos` ON (recursos.id = escala_locais.`id_recurso`)
                INNER JOIN `base` ON (base.id = recursos.`id_base`)
                INNER JOIN `tipo_recursos` ON (tipo_recursos.id = recursos.`id_tipo_recurso`)
                LEFT JOIN `ocorrencias_recursos` ON (recursos.id = ocorrencias_recursos.`id_recurso` AND ocorrencias_recursos.`horario_chegada_base` IS NULL)
                WHERE escala_equipe_horarios.data = '$data'
                  AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
                  AND escala_equipe_horarios.hora_inicio <= '$hora' 
                  AND escala_equipe_horarios.hora_fim >= '$hora'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rs;
    }

    public function BuscarRecursosEscalasMensais($idGrupo)
    {
        //if (!empty($idGrupo))  $where .= " )";
        $data_hora = Conexao::DataHoraGMTDB();
        $pdo = new Conexao();
        $sql = "SELECT 
                    recursos.id
                    ,CONCAT(recursos.prefixo, ' - Placa: ',recursos.placa) as prefixo
                    ,GROUP_CONCAT(usuario_efetivo.apelido)as nome_equipe
                    ,GROUP_CONCAT(usuario.id) as id_equipes
                    #,(SELECT GROUP_CONCAT(usuario_efetivo.apelido) FROM usuario_efetivo INNER JOIN equipes_efetivo ON(equipes_efetivo.id_efetivo = usuario_efetivo.id_usuario)  WHERE equipes_efetivo.id_equipe=escala_mensal.id_equipe)  as nome_equipe
                    ,tipo_recursos.nome as nome_tipo_recurso
                    ,ocorrencias_recursos.horario_saida_base
                    ,ocorrencias_recursos.horario_chegada_local
                    ,ocorrencias_recursos.horario_saida_local
                    ,ocorrencias_recursos.horario_chegada_hospital
                    ,ocorrencias_recursos.qta
                    ,base.nome as nome_base
                    ,ocorrencias_recursos.id as id_ocorrencias_recursos
                FROM `escala_mensal` 
                    INNER JOIN usuario ON (usuario.id = escala_mensal.id_usuario)
                    INNER JOIN usuario_efetivo  on usuario.id = usuario_efetivo.id_usuario 
                    INNER JOIN grupo ON (grupo.id = usuario.`id_grupo`)      
                    INNER JOIN `recursos` ON (recursos.id = escala_mensal.`id_local`)
                    INNER JOIN `base` ON (base.id = recursos.`id_base`)
                    INNER JOIN `tipo_recursos` ON (tipo_recursos.id = recursos.`id_tipo_recurso`)
                    LEFT JOIN `ocorrencias_recursos` ON (recursos.id = ocorrencias_recursos.`id_recurso` AND ocorrencias_recursos.`horario_chegada_base` IS NULL)
                WHERE (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')
                  AND escala_mensal.data_hora_entrada <= '$data_hora' 
                  AND escala_mensal.data_hora_saida >= '$data_hora'
                AND escala_mensal.excluido IS NULL
                GROUP BY  recursos.prefixo
                ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);

//        Conexao::pr($rs);
        return $rs;
    }
}
