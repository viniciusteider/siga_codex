<?php

switch($app_comando)
{
	case "frm_adicionar_classificacao_risco":
		$template = "tpl.frm.classificacao_risco.php";
		break;

	case "adicionar_classificacao_risco":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objClassificacaoRisco = new ClassificacaoRisco($pdo);
			$objClassificacaoRisco->setNome($_REQUEST['nome']);
			$novoId = $objClassificacaoRisco->Adicionar();
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
		$template = "ajax.classificacao_risco.php";
		break;

	case "frm_atualizar_classificacao_risco" :
		$classificacao_risco = new ClassificacaoRisco();
		$classificacao_risco->setId($_REQUEST["app_codigo"]);
		$linha = $classificacao_risco->Editar();
		$template = "tpl.frm.classificacao_risco.php";
		break;

	case "atualizar_classificacao_risco":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objClassificacaoRisco = new ClassificacaoRisco($pdo);
			$objClassificacaoRisco->setId($_REQUEST['id']);
			$objClassificacaoRisco->setNome($_REQUEST['nome']);
			$objClassificacaoRisco->Modificar();
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
		$template = "ajax.classificacao_risco.php";
		break;

	case "listar_classificacao_risco":
		$template = "tpl.geral.classificacao_risco.php";
		break;

	case "deletar_classificacao_risco":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objClassificacaoRisco = new ClassificacaoRisco($pdo);
			$objClassificacaoRisco->Remover($_REQUEST['registros']);
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
		$template = "ajax.classificacao_risco.php";
		break;

	case "ajax_listar_classificacao_risco":
		$template = "tpl.lis.classificacao_risco.php";
		break;

	case "classificacao_risco_pdf":
		$template = "tpl.lis.classificacao_risco.pdf.php";
		break;

	case "classificacao_risco_xlsx":
		$template = "tpl.lis.classificacao_risco.xlsx.php";
		break;

	case "classificacao_risco_print":
		$template = "tpl.lis.classificacao_risco.print.php";
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
			$_SESSION["configuracao_usuario"]["classificacao_risco"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("classificacao_risco");
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
		$template = "ajax.classificacao_risco.php";
		break;
}
