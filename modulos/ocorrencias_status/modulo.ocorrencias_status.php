<?php

switch($app_comando)
{
	case "frm_adicionar_ocorrencias_status":
		$template = "tpl.frm.ocorrencias_status.php";
		break;

	case "adicionar_ocorrencias_status":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasStatus = new OcorrenciasStatus($pdo);
			$objOcorrenciasStatus->setNome($_REQUEST['nome']);
			$novoId = $objOcorrenciasStatus->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
		$template = "ajax.ocorrencias_status.php";
		break;

	case "frm_atualizar_ocorrencias_status" :
		$ocorrencias_status = new OcorrenciasStatus();
		$ocorrencias_status->setId($_REQUEST["app_codigo"]);
		$linha = $ocorrencias_status->Editar();
		$template = "tpl.frm.ocorrencias_status.php";
		break;

	case "atualizar_ocorrencias_status":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasStatus = new OcorrenciasStatus($pdo);
			$objOcorrenciasStatus->setId($_REQUEST['id']);
			$objOcorrenciasStatus->setNome($_REQUEST['nome']);
			$objOcorrenciasStatus->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
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
		$template = "ajax.ocorrencias_status.php";
		break;

	case "listar_ocorrencias_status":
		$template = "tpl.geral.ocorrencias_status.php";
		break;

	case "deletar_ocorrencias_status":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasStatus = new OcorrenciasStatus($pdo);
			$objOcorrenciasStatus->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
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
		$template = "ajax.ocorrencias_status.php";
		break;

	case "ajax_listar_ocorrencias_status":
		$template = "tpl.lis.ocorrencias_status.php";
		break;

	case "ocorrencias_status_pdf":
		$template = "tpl.lis.ocorrencias_status.pdf.php";
		break;

	case "ocorrencias_status_xlsx":
		$template = "tpl.lis.ocorrencias_status.xlsx.php";
		break;

	case "ocorrencias_status_print":
		$template = "tpl.lis.ocorrencias_status.print.php";
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
			$_SESSION["configuracao_usuario"]["ocorrencias_status"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("ocorrencias_status");
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
				$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			} else {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO;
			}
		} else {
			$msg["codigo"]   = 1;
			$msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
		}
		echo json_encode($msg);
		$template = "ajax.ocorrencias_status.php";
		break;
}
