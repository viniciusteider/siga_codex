<?php
class PessoalCurso
{
	private $id;
	private $id_usuario;
	private $id_tipo_curso;
	private $id_instituicao_ensino;
	private $data_matricula;
	private $data_inicio;
	private $data_termino;
	private $media_final;
	private $carga_horaria;
	private $formato_curso;
	private $observacoes;
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
 	
	public function setIdTipoCurso($arg)
	{
		$this->id_tipo_curso = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdTipoCurso()
	{
		return $this->id_tipo_curso;
	}
 	
	public function setIdInstituicaoEnsino($arg)
	{
		$this->id_instituicao_ensino = ($arg == "") ? NULL : $arg;
	}
 	
	public function getIdInstituicaoEnsino()
	{
		return $this->id_instituicao_ensino;
	}
 	
	public function setDataMatricula($arg)
	{
		$this->data_matricula = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataMatricula()
	{
		return $this->data_matricula;
	}
 	
	public function setDataInicio($arg)
	{
		$this->data_inicio = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataInicio()
	{
		return $this->data_inicio;
	}
 	
	public function setDataTermino($arg)
	{
		$this->data_termino = ($arg == "") ? NULL : $arg;
	}
 	
	public function getDataTermino()
	{
		return $this->data_termino;
	}
 	
	public function setMediaFinal($arg)
	{
		$this->media_final = ($arg == "") ? NULL : str_replace(",", ".", str_replace(".", "", $arg));
	}
 	
	public function getMediaFinal()
	{
		return $this->media_final;
	}
 	
	public function setCargaHoraria($arg)
	{
		$this->carga_horaria = ($arg == "") ? NULL : $arg;
	}
 	
	public function getCargaHoraria()
	{
		return $this->carga_horaria;
	}
 	
	public function setFormatoCurso($arg)
	{
		$this->formato_curso = ($arg == "") ? NULL : $arg;
	}
 	
	public function getFormatoCurso()
	{
		return $this->formato_curso;
	}
 	
	public function setObservacoes($arg)
	{
		$this->observacoes = ($arg == "") ? NULL : $arg;
	}
 	
	public function getObservacoes()
	{
		return $this->observacoes;
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
		INSERT INTO pessoal_curso SET  id_usuario = :id_usuario ';
		 $sql .= ",id_tipo_curso = :id_tipo_curso";
		 $sql .= ",id_instituicao_ensino = :id_instituicao_ensino";
		 $sql .= ",data_matricula = :data_matricula";
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",media_final = :media_final";
		 $sql .= ",carga_horaria = :carga_horaria";
		 $sql .= ",formato_curso = :formato_curso";
		 $sql .= ",observacoes = :observacoes";

		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_curso",$this->id_tipo_curso,PDO::PARAM_INT);
		 $stmt->bindParam(":id_instituicao_ensino",$this->id_instituicao_ensino,PDO::PARAM_INT);
		 $stmt->bindParam(":data_matricula",$this->data_matricula,PDO::PARAM_STR);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":media_final",$this->media_final,PDO::PARAM_STR);
		 $stmt->bindParam(":carga_horaria",$this->carga_horaria,PDO::PARAM_INT);
		 $stmt->bindParam(":formato_curso",$this->formato_curso,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		$stmt->execute();
		return $pdo->lastInsertId() ;
	}
	public function Modificar()
	{
		$pdo = $this->getConexao();
		$sql = '
		UPDATE pessoal_curso SET id_usuario = :id_usuario ';
		 $sql .= ",id_tipo_curso = :id_tipo_curso";
		 $sql .= ",id_instituicao_ensino = :id_instituicao_ensino";
		 $sql .= ",data_matricula = :data_matricula";
		 $sql .= ",data_inicio = :data_inicio";
		 $sql .= ",data_termino = :data_termino";
		 $sql .= ",media_final = :media_final";
		 $sql .= ",carga_horaria = :carga_horaria";
		 $sql .= ",formato_curso = :formato_curso";
		 $sql .= ",observacoes = :observacoes";

		$sql .= ' WHERE id = :id';
		$stmt = $pdo->prepare($sql);
		 $stmt->bindParam(":id_usuario",$this->id_usuario,PDO::PARAM_INT);
		 $stmt->bindParam(":id_tipo_curso",$this->id_tipo_curso,PDO::PARAM_INT);
		 $stmt->bindParam(":id_instituicao_ensino",$this->id_instituicao_ensino,PDO::PARAM_INT);
		 $stmt->bindParam(":data_matricula",$this->data_matricula,PDO::PARAM_STR);
		 $stmt->bindParam(":data_inicio",$this->data_inicio,PDO::PARAM_STR);
		 $stmt->bindParam(":data_termino",$this->data_termino,PDO::PARAM_STR);
		 $stmt->bindParam(":media_final",$this->media_final,PDO::PARAM_STR);
		 $stmt->bindParam(":carga_horaria",$this->carga_horaria,PDO::PARAM_INT);
		 $stmt->bindParam(":formato_curso",$this->formato_curso,PDO::PARAM_STR);
		 $stmt->bindParam(":observacoes",$this->observacoes,PDO::PARAM_STR);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		return $stmt->execute();
	}
	public function Remover($lista)
	{
		$pdo = $this->getConexao();
		$lista = implode(",",$lista);
		//$sql = "DELETE FROM pessoal_curso WHERE id IN({$lista})";
		$sql = "UPDATE pessoal_curso SET excluido = UTC_TIMESTAMP() WHERE id IN({$lista})";
		$stmt = $pdo->prepare($sql);
		return $stmt->execute();
	}

	public function ListarPaginacao($id_usuario,$numeroRegistros,$numeroInicioRegistro,$busca = "",$filtro = "",$ordem = "" ,$param = "")
	{
		$pdo = $this->getConexao();
		
		$joins = "
		
		";
		
		$where = "
			WHERE pessoal_curso.excluido IS NULL AND pessoal_curso.id_usuario = $id_usuario
		";

		if($busca != "") $where .= " AND (nome LIKE :busca)";

		$sql = "
			SELECT COUNT(*) AS total
			FROM pessoal_curso
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
				pessoal_curso.*
			FROM pessoal_curso
			$joins
			$where
		";

		if($filtro != "") $sql .=" ORDER BY $filtro $ordem"; else $sql .=" ORDER BY pessoal_curso.id DESC";
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
		$sql = "SELECT * FROM pessoal_curso WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(":id",$this->id,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

        public function ListarCombo($id = "")
        {
            $pdo = $this->getConexao();
            $sql = "SELECT * FROM pessoal_curso WHERE excluido IS NULL";
            if($id != "") $sql .= " AND pessoal_curso.id = $id ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function BuscarAutoComplete($busca){
            $pdo = new Conexao();
            $sql = " SELECT
                         pessoal_curso.id,
                         pessoal_curso.nome  AS text
                     FROM pessoal_curso
                     WHERE pessoal_curso.excluido IS NULL
                     ";
    
            if($busca != ''){
                $sql .= " AND  (pessoal_curso.nome LIKE '%$busca%' OR pessoal_curso.id  LIKE '%$busca%') ";
            }
            $sql .= ' LIMIT 50';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        }
    }
