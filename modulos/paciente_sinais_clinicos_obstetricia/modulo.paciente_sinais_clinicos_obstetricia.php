<?php

switch($app_comando)
{
	case "frm_adicionar_paciente_sinais_clinicos_obstetricia":
		$template = "tpl.frm.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "frm_modal_paciente_sinais_clinicos_obstetricia":
if($_REQUEST["app_codigo"] != "") {
		$paciente_sinais_clinicos_obstetricia = new PacienteSinaisClinicosObstetricia();
		$paciente_sinais_clinicos_obstetricia->setId($_REQUEST["app_codigo"]);
		$linha = $paciente_sinais_clinicos_obstetricia->Editar();
}		$template = "tpl.form.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "adicionar_paciente_sinais_clinicos_obstetricia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPacienteSinaisClinicosObstetricia = new PacienteSinaisClinicosObstetricia($pdo);
			$objPacienteSinaisClinicosObstetricia->setIdPaciente($_REQUEST['id_paciente']);
			$objPacienteSinaisClinicosObstetricia->setIdSinaisClinicosObstetrica($_REQUEST['id_sinais_clinicos_obstetrica']);
			$novoId = $objPacienteSinaisClinicosObstetricia->Adicionar();
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
		$template = "ajax.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "frm_atualizar_paciente_sinais_clinicos_obstetricia" :
		$paciente_sinais_clinicos_obstetricia = new PacienteSinaisClinicosObstetricia();
		$paciente_sinais_clinicos_obstetricia->setId($_REQUEST["app_codigo"]);
		$linha = $paciente_sinais_clinicos_obstetricia->Editar();
		$template = "tpl.frm.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "atualizar_paciente_sinais_clinicos_obstetricia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPacienteSinaisClinicosObstetricia = new PacienteSinaisClinicosObstetricia($pdo);
			$objPacienteSinaisClinicosObstetricia->setId($_REQUEST['id']);
			$objPacienteSinaisClinicosObstetricia->setIdPaciente($_REQUEST['id_paciente']);
			$objPacienteSinaisClinicosObstetricia->setIdSinaisClinicosObstetrica($_REQUEST['id_sinais_clinicos_obstetrica']);
			$objPacienteSinaisClinicosObstetricia->Modificar();
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
		$template = "ajax.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "listar_paciente_sinais_clinicos_obstetricia":
		$template = "tpl.geral.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "listar_paciente_sinais_clinicos_obstetricia_autocomplete":
		$objpaciente_sinais_clinicos_obstetricia = new PacienteSinaisClinicosObstetricia();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpaciente_sinais_clinicos_obstetricia->BuscarAutoComplete($busca));
		$template = "ajax.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "deletar_paciente_sinais_clinicos_obstetricia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPacienteSinaisClinicosObstetricia = new PacienteSinaisClinicosObstetricia($pdo);
			$objPacienteSinaisClinicosObstetricia->Remover($_REQUEST['registros']);
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
		$template = "ajax.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "ajax_listar_paciente_sinais_clinicos_obstetricia":
		$template = "tpl.lis.paciente_sinais_clinicos_obstetricia.php";
		break;

	case "paciente_sinais_clinicos_obstetricia_pdf":
		$template = "tpl.lis.paciente_sinais_clinicos_obstetricia.pdf.php";
		break;

	case "paciente_sinais_clinicos_obstetricia_xlsx":
		$template = "tpl.lis.paciente_sinais_clinicos_obstetricia.xlsx.php";
		break;

	case "paciente_sinais_clinicos_obstetricia_print":
		$template = "tpl.lis.paciente_sinais_clinicos_obstetricia.print.php";
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
			$_SESSION["configuracao_usuario"]["paciente_sinais_clinicos_obstetricia"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("paciente_sinais_clinicos_obstetricia");
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
		$template = "ajax.paciente_sinais_clinicos_obstetricia.php";
		break;
}
