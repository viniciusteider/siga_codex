<?php
class OcorrenciasRecursos
{
    private $id;
    private $id_recurso;
    private $id_usuario;
    private $id_ocorrencia;
    private $data;
    private $horario_saida_base;
    private $horario_chegada_local;
    private $horario_saida_local;
    private $horario_chegada_hospital;
    private $horario_saida_hospital;
    private $horario_chegada_base;
    private $qta;
    private $ultimo_qta;
    private $conexao;
    private $ultimo_qth;
    private $viatura_confirmou;
    private $horario_confirmacao;
    public function setId($arg)
    {
        $this->id = ($arg == "") ? NULL : $arg;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdRecurso($arg)
    {
        $this->id_recurso = ($arg == "") ? NULL : $arg;
    }

    public function getIdRecurso()
    {
        return $this->id_recurso;
    }

    public function setIdUsuario($arg)
    {
        $this->id_usuario = ($arg == "") ? NULL : $arg;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdOcorrencia($arg)
    {
        $this->id_ocorrencia = ($arg == "") ? NULL : $arg;
    }

    public function getIdOcorrencia()
    {
        return $this->id_ocorrencia;
    }

    public function setData($arg)
    {
        $this->data = ($arg == "") ? NULL : $arg;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setHorarioSaidaBase($arg)
    {
        $this->horario_saida_base = ($arg == "") ? NULL : $arg;
        $this->ultimo_qth = 1;
    }

    public function getHorarioSaidaBase()
    {
        return $this->horario_saida_base;
    }

    public function setHorarioChegadaLocal($arg)
    {
        $this->horario_chegada_local = ($arg == "") ? NULL : $arg;
        $this->ultimo_qth = 2;
    }

    public function getHorarioChegadaLocal()
    {
        return $this->horario_chegada_local;
    }

    public function setHorarioSaidaLocal($arg)
    {
        $this->horario_saida_local = ($arg == "") ? NULL : $arg;
        $this->ultimo_qth = 3;
    }

    public function getHorarioSaidaLocal()
    {
        return $this->horario_saida_local;
    }

    public function setHorarioChegadaHospital($arg)
    {
        $this->horario_chegada_hospital = ($arg == "") ? NULL : $arg;
        $this->ultimo_qth = 5;
    }

    public function getHorarioChegadaHospital()
    {
        return $this->horario_chegada_hospital;
    }

    public function setHorarioSaidaHospital($arg)
    {
        $this->horario_saida_hospital = ($arg == "") ? NULL : $arg;
        $this->ultimo_qth = 6;
    }

    public function getHorarioSaidaHospital()
    {
        return $this->horario_saida_hospital;
    }

    public function setHorarioChegadaBase($arg)
    {
        $this->horario_chegada_base = ($arg == "") ? NULL : $arg;
        $this->ultimo_qth = 8;
    }


    public function getHorarioChegadaBase()
    {
        return $this->horario_chegada_base;
    }

    public function setQta($arg)
    {
        $this->qta = ($arg == "") ? NULL : $arg;
    }

    public function getQta()
    {
        return $this->qta;
    }

    public function setUltimoQta($arg)
    {
        $this->ultimo_qta = ($arg == "") ? NULL : $arg;
    }

    public function getUltimoQta()
    {
        return $this->ultimo_qta;
    }

    public function setViaturaConfirmou($arg)
    {
        $this->viatura_confirmou = ($arg == "") ? NULL : $arg;
    }

    public function getViaturaConfirmou()
    {
        return $this->viatura_confirmou;
    }

    public function setHorarioConfirmacao($arg)
    {
        $this->horario_confirmacao = ($arg == "") ? NULL : $arg;
    }

    public function getHorarioConfirmacao()
    {
        return $this->horario_confirmacao;
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
		INSERT INTO ocorrencias_recursos SET  id_recurso = :id_recurso ';
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",id_usuario = :id_usuario";
        $sql .= ",data = :data";
        $sql .= ",horario_saida_base = :horario_saida_base";
        $sql .= ",horario_chegada_local = :horario_chegada_local";
        $sql .= ",horario_saida_local = :horario_saida_local";
        $sql .= ",horario_chegada_hospital = :horario_chegada_hospital";
        $sql .= ",horario_chegada_base = :horario_chegada_base";
        $sql .= ",qta = :qta";
        $sql .= ",ultimo_qta = :ultimo_qta";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_recurso",$this->id_recurso,PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
        $stmt->bindParam(":data",$this->data,PDO::PARAM_STR);
        $stmt->bindParam(":horario_saida_base",$this->horario_saida_base,PDO::PARAM_STR);
        $stmt->bindParam(":horario_chegada_local",$this->horario_chegada_local,PDO::PARAM_STR);
        $stmt->bindParam(":horario_saida_local",$this->horario_saida_local,PDO::PARAM_STR);
        $stmt->bindParam(":horario_chegada_hospital",$this->horario_chegada_hospital,PDO::PARAM_STR);
        $stmt->bindParam(":horario_chegada_base",$this->horario_chegada_base,PDO::PARAM_STR);
        $stmt->bindParam(":qta",$this->qta,PDO::PARAM_STR);
        $stmt->bindParam(":ultimo_qta",$this->ultimo_qta,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias_recursos SET id_recurso = :id_recurso ';
        $sql .= ",id_ocorrencia = :id_ocorrencia";
        $sql .= ",data = :data";
        $sql .= ",horario_saida_base = :horario_saida_base";
        $sql .= ",horario_chegada_local = :horario_chegada_local";
        $sql .= ",horario_saida_local = :horario_saida_local";
        $sql .= ",horario_chegada_hospital = :horario_chegada_hospital";
        $sql .= ",horario_chegada_base = :horario_chegada_base";
        $sql .= ",qta = :qta";
        $sql .= ",ultimo_qta = :ultimo_qta";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_recurso",$this->id_recurso,PDO::PARAM_INT);
        $stmt->bindParam(":id_ocorrencia",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->bindParam(":data",$this->data,PDO::PARAM_STR);
        $stmt->bindParam(":horario_saida_base",$this->horario_saida_base,PDO::PARAM_STR);
        $stmt->bindParam(":horario_chegada_local",$this->horario_chegada_local,PDO::PARAM_STR);
        $stmt->bindParam(":horario_saida_local",$this->horario_saida_local,PDO::PARAM_STR);
        $stmt->bindParam(":horario_chegada_hospital",$this->horario_chegada_hospital,PDO::PARAM_STR);
        $stmt->bindParam(":horario_chegada_base",$this->horario_chegada_base,PDO::PARAM_STR);
        $stmt->bindParam(":qta",$this->qta,PDO::PARAM_STR);
        $stmt->bindParam(":ultimo_qta",$this->ultimo_qta,PDO::PARAM_INT);
        $stmt->bindParam(":ultimo_qth",$this->ultimo_qth,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function ModificarHorario()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias_recursos SET id = :id ';
        if($this->horario_saida_base != "") $sql .= ",horario_saida_base = :horario_saida_base";
        if($this->horario_chegada_local != "") $sql .= ",horario_chegada_local = :horario_chegada_local";
        if($this->horario_saida_local != "") $sql .= ",horario_saida_local = :horario_saida_local";
        if($this->horario_chegada_hospital != "") $sql .= ",horario_chegada_hospital = :horario_chegada_hospital";
        if($this->horario_saida_hospital != "") $sql .= ",horario_saida_hospital = :horario_saida_hospital";
        if($this->horario_chegada_base != "") $sql .= ",horario_chegada_base = :horario_chegada_base";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        if($this->horario_saida_base != "") $stmt->bindParam(":horario_saida_base",$this->horario_saida_base,PDO::PARAM_STR);
        if($this->horario_chegada_local != "") $stmt->bindParam(":horario_chegada_local",$this->horario_chegada_local,PDO::PARAM_STR);
        if($this->horario_saida_local != "") $stmt->bindParam(":horario_saida_local",$this->horario_saida_local,PDO::PARAM_STR);
        if($this->horario_chegada_hospital != "") $stmt->bindParam(":horario_chegada_hospital",$this->horario_chegada_hospital,PDO::PARAM_STR);
        if($this->horario_saida_hospital != "") $stmt->bindParam(":horario_saida_hospital",$this->horario_saida_hospital,PDO::PARAM_STR);
        if($this->horario_chegada_base != "") $stmt->bindParam(":horario_chegada_base",$this->horario_chegada_base,PDO::PARAM_STR);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function AtualizarLocalizacao()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE ocorrencias_recursos SET qta = :qta';
        if($this->horario_saida_base != "") $sql .= ",horario_saida_base = UTC_TIMESTAMP() ";
        if($this->horario_chegada_local != "") $sql .= ",horario_chegada_local = UTC_TIMESTAMP() ";
        if($this->horario_saida_local != "") $sql .= ",horario_saida_local = UTC_TIMESTAMP() ";
        if($this->horario_chegada_hospital != "") $sql .= ",horario_chegada_hospital = UTC_TIMESTAMP() ";
        if($this->horario_saida_hospital != "") $sql .= ",horario_saida_hospital = UTC_TIMESTAMP() ";
        if($this->horario_chegada_base != "") $sql .= ",horario_chegada_base = UTC_TIMESTAMP() ";
        if($this->ultimo_qta != "") $sql .= ",ultimo_qta = :ultimo_qta";
        if($this->ultimo_qth != "") $sql .= ",ultimo_qth = :ultimo_qth";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":qta",$this->qta,PDO::PARAM_STR);
        if($this->ultimo_qta != "")  $stmt->bindParam(":ultimo_qta",$this->ultimo_qta,PDO::PARAM_INT);
        if($this->ultimo_qth != "")  $stmt->bindParam(":ultimo_qth",$this->ultimo_qth,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM ocorrencias_recursos WHERE id IN({$lista})";
        $sql = "UPDATE ocorrencias_recursos SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function Atualizar($id)
    {
        $pdo = $this->getConexao();
        $sql = "UPDATE ocorrencias_recursos SET horario_chegada_base = UTC_TIMESTAMP() WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE ocorrencias_recursos.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND ocorrencias_recursos.data_hora_cadastro >='{$param['data_hora_inicio']}' AND ocorrencias_recursos.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM ocorrencias_recursos
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
				ocorrencias_recursos.*
			FROM ocorrencias_recursos
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY ocorrencias_recursos.id DESC";
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
        $sql = "SELECT * FROM ocorrencias_recursos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function View()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT 
                     ocorrencias_recursos. *
                     ,base.nome as nome_base
                     ,recursos.prefixo
                     ,(SELECT GROUP_CONCAT(usuario_efetivo.apelido) 
                     FROM usuario_efetivo 
                         INNER JOIN escala_mensal ON(usuario_efetivo.id_usuario = escala_mensal.id_usuario) 
                         INNER JOIN escala_locais ON(escala_locais.id = escala_mensal.id_local) 
                     WHERE ocorrencias_recursos.id_recurso = escala_locais.id_recurso 
                       AND escala_mensal.data_hora_entrada <= ocorrencias_recursos.horario_saida_base AND escala_mensal.data_hora_saida >= ocorrencias_recursos.horario_saida_base) nome_equipe
                FROM ocorrencias_recursos 
                    INNER JOIN `recursos` ON (recursos.id = ocorrencias_recursos.`id_recurso`)
                    INNER JOIN `base` ON (base.id = recursos.`id_base`)
                WHERE id_ocorrencia = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id_ocorrencia,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM ocorrencias_recursos WHERE excluido IS NULL";
        if($id != "") $sql .= " AND ocorrencias_recursos.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarDespachadas($id_ocorrencia = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT ocorrencias_recursos.*,recursos.placa,recursos.prefixo as nome_prefixo FROM ocorrencias_recursos INNER JOIN recursos ON(ocorrencias_recursos.id_recurso = recursos.id) WHERE excluido IS NULL";
        $sql .= " AND ocorrencias_recursos.id_ocorrencia = $id_ocorrencia ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         ocorrencias_recursos.id,
                         ocorrencias_recursos.nome  AS text
                     FROM ocorrencias_recursos
                     WHERE ocorrencias_recursos.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (ocorrencias_recursos.nome LIKE '%$busca%' OR ocorrencias_recursos.id  LIKE '%$busca%') ";
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

        $objOcorrenciasRecursos= new OcorrenciasRecursos();
        $registros = $objOcorrenciasRecursos->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
