<?php

switch($app_comando)
{
	case "frm_adicionar_pessoal_etnia":
		$template = "tpl.frm.pessoal_etnia.php";
		break;

	case "adicionar_pessoal_etnia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalEtnia = new PessoalEtnia($pdo);
			$objPessoalEtnia->setNome($_REQUEST['nome']);
			$novoId = $objPessoalEtnia->Adicionar();
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
		$template = "ajax.pessoal_etnia.php";
		break;

	case "frm_atualizar_pessoal_etnia" :
		$pessoal_etnia = new PessoalEtnia();
		$pessoal_etnia->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_etnia->Editar();
		$template = "tpl.frm.pessoal_etnia.php";
		break;

	case "atualizar_pessoal_etnia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalEtnia = new PessoalEtnia($pdo);
			$objPessoalEtnia->setId($_REQUEST['id']);
			$objPessoalEtnia->setNome($_REQUEST['nome']);
			$objPessoalEtnia->Modificar();
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
		$template = "ajax.pessoal_etnia.php";
		break;

	case "listar_pessoal_etnia":
		$template = "tpl.geral.pessoal_etnia.php";
		break;
    case "listar_pessoal_etnia_autocomplete":
        $objpessoal_etnia = new PessoalEtnia();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpessoal_etnia->BuscarAutoComplete($busca));
        $template = "ajax.pessoal_etnia.php";
        break;

	case "deletar_pessoal_etnia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalEtnia = new PessoalEtnia($pdo);
			$objPessoalEtnia->Remover($_REQUEST['registros']);
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
		$template = "ajax.pessoal_etnia.php";
		break;

	case "ajax_listar_pessoal_etnia":
		$template = "tpl.lis.pessoal_etnia.php";
		break;

	case "pessoal_etnia_pdf":
		$template = "tpl.lis.pessoal_etnia.pdf.php";
		break;

	case "pessoal_etnia_xlsx":
		$template = "tpl.lis.pessoal_etnia.xlsx.php";
		break;

	case "pessoal_etnia_print":
		$template = "tpl.lis.pessoal_etnia.print.php";
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
			$_SESSION["configuracao_usuario"]["pessoal_etnia"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pessoal_etnia");
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
		$template = "ajax.pessoal_etnia.php";
		break;
}
