<?php

switch($app_comando)
{
	case "frm_adicionar_ocorencias_historico":
		$template = "tpl.frm.ocorencias_historico.php";
		break;

	case "frm_modal_ocorencias_historico":
if($_REQUEST["app_codigo"] != "") {
		$ocorencias_historico = new OcorenciasHistorico();
		$ocorencias_historico->setId($_REQUEST["app_codigo"]);
		$linha = $ocorencias_historico->Editar();
}		$template = "tpl.form.ocorencias_historico.php";
		break;

	case "adicionar_ocorencias_historico":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorenciasHistorico = new OcorenciasHistorico($pdo);
			$objOcorenciasHistorico->setIdOcorrencia($_REQUEST['id_ocorrencia']);
			$objOcorenciasHistorico->setIdUsuario($_REQUEST['id_usuario']);
			$objOcorenciasHistorico->setDescricao($_REQUEST['descricao']);
			$novoId = $objOcorenciasHistorico->Adicionar();
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
		$template = "ajax.ocorencias_historico.php";
		break;

	case "frm_atualizar_ocorencias_historico" :
		$ocorencias_historico = new OcorenciasHistorico();
		$ocorencias_historico->setId($_REQUEST["app_codigo"]);
		$linha = $ocorencias_historico->Editar();
		$template = "tpl.frm.ocorencias_historico.php";
		break;

	case "atualizar_ocorencias_historico":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorenciasHistorico = new OcorenciasHistorico($pdo);
			$objOcorenciasHistorico->setId($_REQUEST['id']);
			$objOcorenciasHistorico->setIdOcorrencia($_REQUEST['id_ocorrencia']);
			$objOcorenciasHistorico->setIdUsuario($_REQUEST['id_usuario']);
			$objOcorenciasHistorico->setDescricao($_REQUEST['descricao']);
			$objOcorenciasHistorico->Modificar();
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
		$template = "ajax.ocorencias_historico.php";
		break;

	case "listar_ocorencias_historico":
		$template = "tpl.geral.ocorencias_historico.php";
		break;

	case "listar_ocorencias_historico_autocomplete":
		$objocorencias_historico = new OcorenciasHistorico();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objocorencias_historico->BuscarAutoComplete($busca));
		$template = "ajax.ocorencias_historico.php";
		break;

	case "deletar_ocorencias_historico":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorenciasHistorico = new OcorenciasHistorico($pdo);
			$objOcorenciasHistorico->Remover($_REQUEST['registros']);
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
		$template = "ajax.ocorencias_historico.php";
		break;

	case "ajax_listar_ocorencias_historico":
		$template = "tpl.lis.ocorencias_historico.php";
		break;

	case "ocorencias_historico_pdf":
		$template = "tpl.lis.ocorencias_historico.pdf.php";
		break;

	case "ocorencias_historico_xlsx":
		$template = "tpl.lis.ocorencias_historico.xlsx.php";
		break;

	case "ocorencias_historico_print":
		$template = "tpl.lis.ocorencias_historico.print.php";
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
			$_SESSION["configuracao_usuario"]["ocorencias_historico"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("ocorencias_historico");
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
		$template = "ajax.ocorencias_historico.php";
		break;
}
