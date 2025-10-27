<?php

switch($app_comando)
{
	case "frm_adicionar_respiracao":
		$template = "tpl.frm.respiracao.php";
		break;

	case "frm_modal_respiracao":
if($_REQUEST["app_codigo"] != "") {
		$respiracao = new Respiracao();
		$respiracao->setId($_REQUEST["app_codigo"]);
		$linha = $respiracao->Editar();
}		$template = "tpl.form.respiracao.php";
		break;

	case "adicionar_respiracao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRespiracao = new Respiracao($pdo);
			$objRespiracao->setNome($_REQUEST['nome']);
			$novoId = $objRespiracao->Adicionar();
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
		$template = "ajax.respiracao.php";
		break;

	case "frm_atualizar_respiracao" :
		$respiracao = new Respiracao();
		$respiracao->setId($_REQUEST["app_codigo"]);
		$linha = $respiracao->Editar();
		$template = "tpl.frm.respiracao.php";
		break;

	case "atualizar_respiracao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRespiracao = new Respiracao($pdo);
			$objRespiracao->setId($_REQUEST['id']);
			$objRespiracao->setNome($_REQUEST['nome']);
			$objRespiracao->Modificar();
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
		$template = "ajax.respiracao.php";
		break;

	case "listar_respiracao":
		$template = "tpl.geral.respiracao.php";
		break;

	case "listar_respiracao_autocomplete":
		$objrespiracao = new Respiracao();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objrespiracao->BuscarAutoComplete($busca));
		$template = "ajax.respiracao.php";
		break;

	case "deletar_respiracao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRespiracao = new Respiracao($pdo);
			$objRespiracao->Remover($_REQUEST['registros']);
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
		$template = "ajax.respiracao.php";
		break;

	case "ajax_listar_respiracao":
		$template = "tpl.lis.respiracao.php";
		break;

	case "respiracao_pdf":
		$template = "tpl.lis.respiracao.pdf.php";
		break;

	case "respiracao_xlsx":
		$template = "tpl.lis.respiracao.xlsx.php";
		break;

	case "respiracao_print":
		$template = "tpl.lis.respiracao.print.php";
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
			$_SESSION["configuracao_usuario"]["respiracao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("respiracao");
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
		$template = "ajax.respiracao.php";
		break;
}
