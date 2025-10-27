<?php

switch($app_comando)
{
	case "frm_adicionar_estados":
		$template = "tpl.frm.estados.php";
		break;

	case "adicionar_estados":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEstados = new Estados($pdo);
			$objEstados->setSigla($_REQUEST['sigla']);
			$objEstados->setNome($_REQUEST['nome']);
			$objEstados->setUf($_REQUEST['uf']);
			$objEstados->setIdRegiaoUf($_REQUEST['id_regiao_uf']);
			$novoId = $objEstados->Adicionar();
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
		$template = "ajax.estados.php";
		break;

	case "frm_atualizar_estados" :
		$estados = new Estados();
		$estados->setId($_REQUEST["app_codigo"]);
		$linha = $estados->Editar();
		$template = "tpl.frm.estados.php";
		break;

	case "atualizar_estados":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEstados = new Estados($pdo);
			$objEstados->setId($_REQUEST['id']);
			$objEstados->setSigla($_REQUEST['sigla']);
			$objEstados->setNome($_REQUEST['nome']);
			$objEstados->setUf($_REQUEST['uf']);
			$objEstados->setIdRegiaoUf($_REQUEST['id_regiao_uf']);
			$objEstados->Modificar();
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
		$template = "ajax.estados.php";
		break;

	case "listar_estados":
		$template = "tpl.geral.estados.php";
		break;

	case "deletar_estados":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEstados = new Estados($pdo);
			$objEstados->Remover($_REQUEST['registros']);
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
		$template = "ajax.estados.php";
		break;

	case "ajax_listar_estados":
		$template = "tpl.lis.estados.php";
		break;

	case "estados_pdf":
		$template = "tpl.lis.estados.pdf.php";
		break;

	case "estados_xlsx":
		$template = "tpl.lis.estados.xlsx.php";
		break;

	case "estados_print":
		$template = "tpl.lis.estados.print.php";
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
			$_SESSION["configuracao_usuario"]["estados"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("estados");
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
		$template = "ajax.estados.php";
		break;
}
