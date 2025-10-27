<?php
class PacienteSinaisVitais
{
    private $id;
    private $id_paciente;
    private $horario;
    private $pressao_arterial_minima;
    private $pressao_arterial_maxima;
    private $frequencia_cardiaca;
    private $frequencia_respiratoria;
    private $saturacao_o2;
    private $glasgow;
    private $temperatura;
    private $hgt;
    private $escala_trauma;
    private $abertura_ocular_id;
    private $resposta_verbal_id;
    private $resposta_motora_id;
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

    public function setIdPaciente($arg)
    {
        $this->id_paciente = ($arg == "") ? NULL : $arg;
    }

    public function getIdPaciente()
    {
        return $this->id_paciente;
    }

    public function setHorario($arg)
    {
        $this->horario = ($arg == "") ? NULL : $arg;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setPressaoArterialMinima($arg)
    {
        $this->pressao_arterial_minima = ($arg == "") ? NULL : $arg;
    }

    public function getPressaoArterialMinima()
    {
        return $this->pressao_arterial_minima;
    }

    public function setPressaoArterialMaxima($arg)
    {
        $this->pressao_arterial_maxima = ($arg == "") ? NULL : $arg;
    }

    public function getPressaoArterialMaxima()
    {
        return $this->pressao_arterial_maxima;
    }

    public function setFrequenciaCardiaca($arg)
    {
        $this->frequencia_cardiaca = ($arg == "") ? NULL : $arg;
    }

    public function getFrequenciaCardiaca()
    {
        return $this->frequencia_cardiaca;
    }

    public function setFrequenciaRespiratoria($arg)
    {
        $this->frequencia_respiratoria = ($arg == "") ? NULL : $arg;
    }

    public function getFrequenciaRespiratoria()
    {
        return $this->frequencia_respiratoria;
    }

    public function setSaturacaoO2($arg)
    {
        $this->saturacao_o2 = ($arg == "") ? NULL : $arg;
    }

    public function getSaturacaoO2()
    {
        return $this->saturacao_o2;
    }

    public function setGlasgow($arg)
    {
        $this->glasgow = ($arg == "") ? NULL : $arg;
    }

    public function getGlasgow()
    {
        return $this->glasgow;
    }

    public function setTemperatura($arg)
    {
        $this->temperatura = ($arg == "") ? NULL : $arg;
    }

    public function getTemperatura()
    {
        return $this->temperatura;
    }

    public function setHgt($arg)
    {
        $this->hgt = ($arg == "") ? NULL : $arg;
    }

    public function getHgt()
    {
        return $this->hgt;
    }

    public function setEscalaTrauma($arg)
    {
        $this->escala_trauma = ($arg == "") ? NULL : $arg;
    }

    public function getEscalaTrauma()
    {
        return $this->escala_trauma;
    }

    public function setDataHoraCadastro($arg)
    {
        $this->data_hora_cadastro = ($arg == "") ? NULL : $arg;
    }

    public function getDataHoraCadastro()
    {
        return $this->data_hora_cadastro;
    }

    public function setRespostaVerbal($arg)
    {
        $this->resposta_verbal_id = ($arg == "") ? NULL : $arg;
    }

    public function getRespostaVerbal()
    {
        return $this->resposta_verbal_id;
    }

    public function setRespostaMotora($arg)
    {
        $this->resposta_motora_id = ($arg == "") ? NULL : $arg;
    }

    public function getRespostaMotora()
    {
        return $this->resposta_motora_id;
    }

    public function setAberturaOcular($arg)
    {
        $this->abertura_ocular_id = ($arg == "") ? NULL : $arg;
    }

    public function getAberturaOcular()
    {
        return $this->abertura_ocular_id;
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
		INSERT INTO paciente_sinais_vitais SET data_hora_cadastro = UTC_TIMESTAMP() 
 ';
        $sql .= ",id_paciente = :id_paciente";
        $sql .= ",horario = :horario";
        $sql .= ",pressao_arterial_minima = :pressao_arterial_minima";
        $sql .= ",pressao_arterial_maxima = :pressao_arterial_maxima";
        $sql .= ",frequencia_cardiaca = :frequencia_cardiaca";
        $sql .= ",frequencia_respiratoria = :frequencia_respiratoria";
        $sql .= ",saturacao_o2 = :saturacao_o2";
        $sql .= ",glasgow = :glasgow";
        $sql .= ",temperatura = :temperatura";
        $sql .= ",hgt = :hgt";
        $sql .= ",escala_trauma = :escala_trauma";
        $sql .= ",abertura_ocular_id = :abertura_ocular_id";
        $sql .= ",resposta_verbal_id = :resposta_verbal_id";
        $sql .= ",resposta_motora_id = :resposta_motora_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":horario",$this->horario,PDO::PARAM_STR);
        $stmt->bindParam(":pressao_arterial_minima",$this->pressao_arterial_minima,PDO::PARAM_INT);
        $stmt->bindParam(":pressao_arterial_maxima",$this->pressao_arterial_maxima,PDO::PARAM_INT);
        $stmt->bindParam(":frequencia_cardiaca",$this->frequencia_cardiaca,PDO::PARAM_INT);
        $stmt->bindParam(":frequencia_respiratoria",$this->frequencia_respiratoria,PDO::PARAM_INT);
        $stmt->bindParam(":saturacao_o2",$this->saturacao_o2,PDO::PARAM_INT);
        $stmt->bindParam(":glasgow",$this->glasgow,PDO::PARAM_INT);
        $stmt->bindParam(":temperatura",$this->temperatura,PDO::PARAM_INT);
        $stmt->bindParam(":hgt",$this->hgt,PDO::PARAM_INT);
        $stmt->bindParam(":escala_trauma",$this->escala_trauma,PDO::PARAM_INT);
        $stmt->bindParam(":abertura_ocular_id",$this->abertura_ocular_id,PDO::PARAM_INT);
        $stmt->bindParam(":resposta_verbal_id",$this->resposta_verbal_id,PDO::PARAM_INT);
        $stmt->bindParam(":resposta_motora_id",$this->resposta_motora_id,PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId() ;
    }
    public function Modificar()
    {
        $pdo = $this->getConexao();
        $sql = '
		UPDATE paciente_sinais_vitais SET id_paciente = :id_paciente ';
        $sql .= ",horario = :horario";
        $sql .= ",pressao_arterial_minima = :pressao_arterial_minima";
        $sql .= ",pressao_arterial_maxima = :pressao_arterial_maxima";
        $sql .= ",frequencia_cardiaca = :frequencia_cardiaca";
        $sql .= ",frequencia_respiratoria = :frequencia_respiratoria";
        $sql .= ",saturacao_o2 = :saturacao_o2";
        $sql .= ",glasgow = :glasgow";
        $sql .= ",temperatura = :temperatura";
        $sql .= ",hgt = :hgt";
        $sql .= ",escala_trauma = :escala_trauma";
        $sql .= ",abertura_ocular_id = :abertura_ocular_id";
        $sql .= ",resposta_verbal_id = :resposta_verbal_id";
        $sql .= ",resposta_motora_id = :resposta_motora_id";

        $sql .= ' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->bindParam(":horario",$this->horario,PDO::PARAM_STR);
        $stmt->bindParam(":pressao_arterial_minima",$this->pressao_arterial_minima,PDO::PARAM_INT);
        $stmt->bindParam(":pressao_arterial_maxima",$this->pressao_arterial_maxima,PDO::PARAM_INT);
        $stmt->bindParam(":frequencia_cardiaca",$this->frequencia_cardiaca,PDO::PARAM_INT);
        $stmt->bindParam(":frequencia_respiratoria",$this->frequencia_respiratoria,PDO::PARAM_INT);
        $stmt->bindParam(":saturacao_o2",$this->saturacao_o2,PDO::PARAM_INT);
        $stmt->bindParam(":glasgow",$this->glasgow,PDO::PARAM_INT);
        $stmt->bindParam(":temperatura",$this->temperatura,PDO::PARAM_INT);
        $stmt->bindParam(":hgt",$this->hgt,PDO::PARAM_INT);
        $stmt->bindParam(":escala_trauma",$this->escala_trauma,PDO::PARAM_INT);
        $stmt->bindParam(":abertura_ocular_id",$this->abertura_ocular_id,PDO::PARAM_INT);
        $stmt->bindParam(":resposta_verbal_id",$this->resposta_verbal_id,PDO::PARAM_INT);
        $stmt->bindParam(":resposta_motora_id",$this->resposta_motora_id,PDO::PARAM_INT);
        $stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function Remover($lista)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        //$sql = "DELETE FROM paciente_sinais_vitais WHERE id IN({$lista})";
        $sql = "UPDATE paciente_sinais_vitais SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
    public function RemoverNotIn($lista,$id_paciente)
    {
        $pdo = $this->getConexao();
        $lista = implode(",",$lista);
        $sql = "DELETE FROM paciente_sinais_vitais WHERE id NOT IN({$lista}) AND id_paciente = $id_paciente";
//        $sql = "UPDATE paciente_sinais_vitais SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }


    public function ListarPaginacao($idGrupo,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
    {
        $pdo = $this->getConexao();

        $joins = "
		
		";

        $where = "
			WHERE paciente_sinais_vitais.excluido IS NULL
		";

        //if (!empty($idGrupo))  $where .= " AND (grupo.id = {$idGrupo} OR grupo.arvore LIKE '%;$idGrupo;%')";
        if($busca != "") $where .= " AND (nome LIKE :busca)";
        if (($param['data_hora_inicio']))  $where .= " AND paciente_sinais_vitais.data_hora_cadastro >='{$param['data_hora_inicio']}' AND paciente_sinais_vitais.data_hora_cadastro <= '{$param['data_hora_fim']}'";

        $sql = "
			SELECT COUNT(*) AS total
			FROM paciente_sinais_vitais
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
				paciente_sinais_vitais.*
			FROM paciente_sinais_vitais
			$joins
			$where
		";

        if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY paciente_sinais_vitais.id DESC";
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
        $sql = "SELECT * FROM paciente_sinais_vitais WHERE id_paciente = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id",$this->id_paciente,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ListarCombo($id = "")
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_sinais_vitais WHERE excluido IS NULL";
        if($id != "") $sql .= " AND paciente_sinais_vitais.id = $id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function ListarSinaisPaciente()
    {
        $pdo = $this->getConexao();
        $sql = "SELECT * FROM paciente_sinais_vitais WHERE excluido IS NULL ";
        $sql .= " AND paciente_sinais_vitais.id_paciente = :id_paciente ORDER BY id DESC  LIMIT 1 ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_paciente",$this->id_paciente,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function BuscarAutoComplete($busca){
        $pdo = new Conexao();
        $sql = " SELECT
                         paciente_sinais_vitais.id,
                         paciente_sinais_vitais.nome  AS text
                     FROM paciente_sinais_vitais
                     WHERE paciente_sinais_vitais.excluido IS NULL
                     ";

        if($busca != ''){
            $sql .= " AND  (paciente_sinais_vitais.nome LIKE '%$busca%' OR paciente_sinais_vitais.id  LIKE '%$busca%') ";
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

        $objPacienteSinaisVitais= new PacienteSinaisVitais();
        $registros = $objPacienteSinaisVitais->ListarCombo($id_atual);
        return Componente::GerarSelectPDO($nome_campo, $id_campo, "", $registros, array($id), array('', ''), array($campo[0], $campo[1]), false, 'form-select',$outros );
    }
}
