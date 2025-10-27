<?php

switch($app_comando)
{
	case "frm_adicionar_formacao":
		$template = "tpl.frm.formacao.php";
		break;

	case "adicionar_formacao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFormacao = new Formacao($pdo);
			$objFormacao->setNome($_REQUEST['nome']);
			$novoId = $objFormacao->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO . " ". $e->getMessage();
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.formacao.php";
		break;

	case "frm_atualizar_formacao" :
		$formacao = new Formacao();
		$formacao->setId($_REQUEST["app_codigo"]);
		$linha = $formacao->Editar();
		$template = "tpl.frm.formacao.php";
		break;

	case "atualizar_formacao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFormacao = new Formacao($pdo);
			$objFormacao->setId($_REQUEST['id']);
			$objFormacao->setNome($_REQUEST['nome']);
			$objFormacao->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.formacao.php";
		break;

	case "listar_formacao":
		$template = "tpl.geral.formacao.php";
		break;

	case "deletar_formacao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFormacao = new Formacao($pdo);
			$objFormacao->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.formacao.php";
		break;

	case "ajax_listar_formacao":
		$template = "tpl.lis.formacao.php";
		break;

	case "formacao_pdf":
		$template = "tpl.lis.formacao.pdf.php";
		break;

	case "formacao_xlsx":
		$template = "tpl.lis.formacao.xlsx.php";
		break;

	case "formacao_print":
		$template = "tpl.lis.formacao.print.php";
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
			$_SESSION["configuracao_usuario"]["formacao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("formacao");
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
		$template = "ajax.formacao.php";
		break;
}
