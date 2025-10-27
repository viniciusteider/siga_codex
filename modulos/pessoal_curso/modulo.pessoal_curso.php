<?php

switch($app_comando)
{
	case "frm_adicionar_pessoal_curso":
		$template = "tpl.frm.pessoal_curso.php";
		break;

	case "frm_modal_pessoal_curso":
if($_REQUEST["app_codigo"] != "") {
		$pessoal_curso = new PessoalCurso();
		$pessoal_curso->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_curso->Editar();
}		$template = "tpl.form.pessoal_curso.php";
		break;

	case "adicionar_pessoal_curso":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalCurso = new PessoalCurso($pdo);
			$objPessoalCurso->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalCurso->setIdTipoCurso($_REQUEST['id_tipo_curso']);
			$objPessoalCurso->setIdInstituicaoEnsino($_REQUEST['id_instituicao_ensino']);
			$objPessoalCurso->setDataMatricula(Conexao::PrepararDataBD($_REQUEST['data_matricula'], $_SESSION['usuario']['timezone']));
			$objPessoalCurso->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
			$objPessoalCurso->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
			$objPessoalCurso->setMediaFinal($_REQUEST['media_final']);
			$objPessoalCurso->setCargaHoraria($_REQUEST['carga_horaria']);
			$objPessoalCurso->setFormatoCurso($_REQUEST['formato_curso']);
			$objPessoalCurso->setObservacoes($_REQUEST['observacoes']);
			$novoId = $objPessoalCurso->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao Adicionar registro";
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.pessoal_curso.php";
		break;

	case "frm_atualizar_pessoal_curso" :
		$pessoal_curso = new PessoalCurso();
		$pessoal_curso->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_curso->Editar();
		$template = "tpl.frm.pessoal_curso.php";
		break;

	case "atualizar_pessoal_curso":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalCurso = new PessoalCurso($pdo);
			$objPessoalCurso->setId($_REQUEST['id_curso']);
			$objPessoalCurso->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalCurso->setIdTipoCurso($_REQUEST['id_tipo_curso']);
			$objPessoalCurso->setIdInstituicaoEnsino($_REQUEST['id_instituicao_ensino']);
			$objPessoalCurso->setDataMatricula(Conexao::PrepararDataBD($_REQUEST['data_matricula'], $_SESSION['usuario']['timezone']));
			$objPessoalCurso->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
			$objPessoalCurso->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
			$objPessoalCurso->setMediaFinal($_REQUEST['media_final']);
			$objPessoalCurso->setCargaHoraria($_REQUEST['carga_horaria']);
			$objPessoalCurso->setFormatoCurso($_REQUEST['formato_curso']);
			$objPessoalCurso->setObservacoes($_REQUEST['observacoes']);
			$objPessoalCurso->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao modificar registro";
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.pessoal_curso.php";
		break;

	case "listar_pessoal_curso":
		$template = "tpl.geral.pessoal_curso.php";
		break;

	case "listar_pessoal_curso_autocomplete":
		$objpessoal_curso = new PessoalCurso();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpessoal_curso->BuscarAutoComplete($busca));
		$template = "ajax.pessoal_curso.php";
		break;

	case "deletar_pessoal_curso":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalCurso = new PessoalCurso($pdo);
			$objPessoalCurso->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao executar operação";
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.pessoal_curso.php";
		break;

	case "ajax_listar_pessoal_curso":
		$template = "tpl.lis.pessoal_curso.php";
		break;

	case "pessoal_curso_pdf":
		$template = "tpl.lis.pessoal_curso.pdf.php";
		break;

	case "pessoal_curso_xlsx":
		$template = "tpl.lis.pessoal_curso.xlsx.php";
		break;

	case "pessoal_curso_print":
		$template = "tpl.lis.pessoal_curso.print.php";
		break;

	case "frm_configurar_listagem":
		$template = "configuracao_listagem.php";
		break;

	case "configurar_listagem":
		$usuarioConfiguracao = new UsuarioConfiguracao();
		foreach ($_POST as $checkbox => $idCampo) {
			if ($checkbox == "limite_colunas") {
				continue;
			}
			if (is_array($idCampo)) {
				if ($idCampo["valor"] == "") {
					continue;
				} else {
					$colunasSelecionadas[$checkbox] = ["id_campo" => $idCampo["id"], "valor_campo" => $idCampo["valor"]];
				}
			} else {
				$colunasSelecionadas[$checkbox] = $idCampo;
			}
		}
		$countColunasSelecionadas = count($colunasSelecionadas);
		if ($countColunasSelecionadas > 0) {
			if (($countColunasSelecionadas > $_REQUEST["limite_colunas"]) && $_REQUEST["limite_colunas"] != "0" && $_REQUEST["limite_colunas"] != "") {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = TXT_LIMITE_COLUNAS_EXCEDIDO_RESOLUCAO;
				echo json_encode($msg);
				die();
			}
			$_SESSION["configuracao_usuario"]["pessoal_curso"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pessoal_curso");
			$usuarioConfiguracao->LimparConfiguracoes();
			foreach ($colunasSelecionadas AS $nomeCampo => $idCampo) {
				if (is_array($idCampo)) {
					$usuarioConfiguracao->setIdCampoModulo($idCampo["id_campo"]);
					$usuarioConfiguracao->setValorCampo($idCampo["valor_campo"]);
				} else {
					$usuarioConfiguracao->setIdCampoModulo($idCampo);
				}
				$resultado = $usuarioConfiguracao->AdicionarUsuarioConfiguracao();
				if (!$resultado) {
					break;
				}
			}
			if ($resultado) {
				$msg["codigo"]   = 0;
				$msg["mensagem"] = "Sucesso ao executar operação";
			} else {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = "Erro ao executar operação";
			}
		} else {
			$msg["codigo"]   = 1;
			$msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
		}
		echo json_encode($msg);
		$template = "ajax.pessoal_curso.php";
		break;
}
