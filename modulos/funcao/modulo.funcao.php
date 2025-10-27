<?php

switch($app_comando)
{
	case "frm_adicionar_funcao":
		$template = "tpl.frm.funcao.php";
		break;

	case "adicionar_funcao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFuncao = new Funcao($pdo);
			$objFuncao->setNome($_REQUEST['nome']);
			$objFuncao->setDescricao($_REQUEST['descricao']);
			$novoId = $objFuncao->Adicionar();
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
		$template = "ajax.funcao.php";
		break;

	case "frm_atualizar_funcao" :
		$funcao = new Funcao();
		$funcao->setId($_REQUEST["app_codigo"]);
		$linha = $funcao->Editar();
		$template = "tpl.frm.funcao.php";
		break;

	case "atualizar_funcao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFuncao = new Funcao($pdo);
			$objFuncao->setId($_REQUEST['id']);
			$objFuncao->setNome($_REQUEST['nome']);
			$objFuncao->setDescricao($_REQUEST['descricao']);
			$objFuncao->Modificar();
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
		$template = "ajax.funcao.php";
		break;

	case "listar_funcao":
		$template = "tpl.geral.funcao.php";
		break;

	case "deletar_funcao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFuncao = new Funcao($pdo);
			$objFuncao->Remover($_REQUEST['registros']);
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
		$template = "ajax.funcao.php";
		break;

	case "ajax_listar_funcao":
		$template = "tpl.lis.funcao.php";
		break;

	case "funcao_pdf":
		$template = "tpl.lis.funcao.pdf.php";
		break;

	case "funcao_xlsx":
		$template = "tpl.lis.funcao.xlsx.php";
		break;

	case "funcao_print":
		$template = "tpl.lis.funcao.print.php";
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
			$_SESSION["configuracao_usuario"]["funcao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("funcao");
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
		$template = "ajax.funcao.php";
		break;
}
