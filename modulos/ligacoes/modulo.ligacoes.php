<?php

switch($app_comando)
{
	case "frm_adicionar_ligacoes":
		$template = "tpl.frm.ligacoes.php";
		break;

	case "frm_modal_ligacoes":
if($_REQUEST["app_codigo"] != "") {
		$ligacoes = new Ligacoes();
		$ligacoes->setId($_REQUEST["app_codigo"]);
		$linha = $ligacoes->Editar();
}		$template = "tpl.form.ligacoes.php";
		break;

	case "adicionar_ligacoes":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLigacoes = new Ligacoes($pdo);
			$objLigacoes->setIdUsuario($_REQUEST['id_usuario']);
			$objLigacoes->setNumero($_REQUEST['numero']);
			$objLigacoes->setTempo($_REQUEST['tempo']);
			$objLigacoes->setIdClassificacao($_REQUEST['id_classificacao']);
			$objLigacoes->setLatitude($_REQUEST['latitude']);
			$objLigacoes->setLongitude($_REQUEST['longitude']);
			$objLigacoes->setDescritivo($_REQUEST['descritivo']);
			$novoId = $objLigacoes->Adicionar();
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
		$template = "ajax.ligacoes.php";
		break;

	case "frm_atualizar_ligacoes" :
		$ligacoes = new Ligacoes();
		$ligacoes->setId($_REQUEST["app_codigo"]);
		$linha = $ligacoes->Editar();
		$template = "tpl.frm.ligacoes.php";
		break;

	case "atualizar_ligacoes":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLigacoes = new Ligacoes($pdo);
			$objLigacoes->setId($_REQUEST['id']);
			$objLigacoes->setIdUsuario($_REQUEST['id_usuario']);
			$objLigacoes->setNumero($_REQUEST['numero']);
			$objLigacoes->setTempo($_REQUEST['tempo']);
			$objLigacoes->setIdClassificacao($_REQUEST['id_classificacao']);
			$objLigacoes->setLatitude($_REQUEST['latitude']);
			$objLigacoes->setLongitude($_REQUEST['longitude']);
			$objLigacoes->setDescritivo($_REQUEST['descritivo']);
			$objLigacoes->Modificar();
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
		$template = "ajax.ligacoes.php";
		break;

	case "listar_ligacoes":
		$template = "tpl.geral.ligacoes.php";
		break;

	case "listar_ligacoes_autocomplete":
		$objligacoes = new Ligacoes();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objligacoes->BuscarAutoComplete($busca));
		$template = "ajax.ligacoes.php";
		break;
    case "listar_ligacoes_existentes":
        $objligacoes = new Ligacoes();
        $busca = $_REQUEST['telefone'] ;
        echo json_encode($objligacoes->BuscarLigacoes($busca));
        $template = "ajax.ligacoes.php";
        break;

	case "deletar_ligacoes":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLigacoes = new Ligacoes($pdo);
			$objLigacoes->Remover($_REQUEST['registros']);
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
		$template = "ajax.ligacoes.php";
		break;

	case "ajax_listar_ligacoes":
		$template = "tpl.lis.ligacoes.php";
		break;

	case "ligacoes_pdf":
		$template = "tpl.lis.ligacoes.pdf.php";
		break;

	case "ligacoes_xlsx":
		$template = "tpl.lis.ligacoes.xlsx.php";
		break;

	case "ligacoes_print":
		$template = "tpl.lis.ligacoes.print.php";
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
			$_SESSION["configuracao_usuario"]["ligacoes"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("ligacoes");
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
		$template = "ajax.ligacoes.php";
		break;
}
