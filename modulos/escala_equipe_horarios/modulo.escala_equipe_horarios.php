<?php

switch($app_comando)
{
	case "frm_adicionar_escala_equipe_horarios":
		$template = "tpl.frm.escala_equipe_horarios.php";
		break;

	case "frm_modal_escala_equipe_horarios":
if($_REQUEST["app_codigo"] != "") {
		$escala_equipe_horarios = new EscalaEquipeHorarios();
		$escala_equipe_horarios->setId($_REQUEST["app_codigo"]);
		$linha = $escala_equipe_horarios->Editar();
}		$template = "tpl.form.escala_equipe_horarios.php";
		break;

	case "adicionar_escala_equipe_horarios":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaEquipeHorarios = new EscalaEquipeHorarios($pdo);
			$objEscalaEquipeHorarios->setIdEscalaEquipe($_REQUEST['id_escala_equipe']);
			$objEscalaEquipeHorarios->setIdEscalaHorarios($_REQUEST['id_escala_horarios']);
			$objEscalaEquipeHorarios->setData(Conexao::PrepararDataBD($_REQUEST['data'], $_SESSION['usuario']['timezone']));
			$objEscalaEquipeHorarios->setHoraInicio($_REQUEST['hora_inicio']);
			$objEscalaEquipeHorarios->setHoraFim($_REQUEST['hora_fim']);
			$novoId = $objEscalaEquipeHorarios->Adicionar();
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
		$template = "ajax.escala_equipe_horarios.php";
		break;

	case "frm_atualizar_escala_equipe_horarios" :
		$escala_equipe_horarios = new EscalaEquipeHorarios();
		$escala_equipe_horarios->setId($_REQUEST["app_codigo"]);
		$linha = $escala_equipe_horarios->Editar();
		$template = "tpl.frm.escala_equipe_horarios.php";
		break;

	case "atualizar_escala_equipe_horarios":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaEquipeHorarios = new EscalaEquipeHorarios($pdo);
			$objEscalaEquipeHorarios->setId($_REQUEST['id']);
			$objEscalaEquipeHorarios->setIdEscalaEquipe($_REQUEST['id_escala_equipe']);
			$objEscalaEquipeHorarios->setIdEscalaHorarios($_REQUEST['id_escala_horarios']);
			$objEscalaEquipeHorarios->setData(Conexao::PrepararDataBD($_REQUEST['data'], $_SESSION['usuario']['timezone']));
			$objEscalaEquipeHorarios->setHoraInicio($_REQUEST['hora_inicio']);
			$objEscalaEquipeHorarios->setHoraFim($_REQUEST['hora_fim']);
			$objEscalaEquipeHorarios->Modificar();
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
		$template = "ajax.escala_equipe_horarios.php";
		break;

	case "listar_escala_equipe_horarios":
		$template = "tpl.geral.escala_equipe_horarios.php";
		break;

	case "listar_escala_equipe_horarios_autocomplete":
		$objescala_equipe_horarios = new EscalaEquipeHorarios();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objescala_equipe_horarios->BuscarAutoComplete($busca));
		$template = "ajax.escala_equipe_horarios.php";
		break;

	case "deletar_escala_equipe_horarios":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaEquipeHorarios = new EscalaEquipeHorarios($pdo);
			$objEscalaEquipeHorarios->Remover($_REQUEST['registros']);
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
		$template = "ajax.escala_equipe_horarios.php";
		break;

	case "ajax_listar_escala_equipe_horarios":
		$template = "tpl.lis.escala_equipe_horarios.php";
		break;

	case "escala_equipe_horarios_pdf":
		$template = "tpl.lis.escala_equipe_horarios.pdf.php";
		break;

	case "escala_equipe_horarios_xlsx":
		$template = "tpl.lis.escala_equipe_horarios.xlsx.php";
		break;

	case "escala_equipe_horarios_print":
		$template = "tpl.lis.escala_equipe_horarios.print.php";
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
			$_SESSION["configuracao_usuario"]["escala_equipe_horarios"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("escala_equipe_horarios");
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
		$template = "ajax.escala_equipe_horarios.php";
		break;
}
