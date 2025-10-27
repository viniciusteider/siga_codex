<?php

switch($app_comando)
{
	case "frm_adicionar_circulacao_local":
		$template = "tpl.frm.circulacao_local.php";
		break;

	case "frm_modal_circulacao_local":
if($_REQUEST["app_codigo"] != "") {
		$circulacao_local = new CirculacaoLocal();
		$circulacao_local->setId($_REQUEST["app_codigo"]);
		$linha = $circulacao_local->Editar();
}		$template = "tpl.form.circulacao_local.php";
		break;

	case "adicionar_circulacao_local":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCirculacaoLocal = new CirculacaoLocal($pdo);
			$objCirculacaoLocal->setNome($_REQUEST['nome']);
			$novoId = $objCirculacaoLocal->Adicionar();
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
		$template = "ajax.circulacao_local.php";
		break;

	case "frm_atualizar_circulacao_local" :
		$circulacao_local = new CirculacaoLocal();
		$circulacao_local->setId($_REQUEST["app_codigo"]);
		$linha = $circulacao_local->Editar();
		$template = "tpl.frm.circulacao_local.php";
		break;

	case "atualizar_circulacao_local":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCirculacaoLocal = new CirculacaoLocal($pdo);
			$objCirculacaoLocal->setId($_REQUEST['id']);
			$objCirculacaoLocal->setNome($_REQUEST['nome']);
			$objCirculacaoLocal->Modificar();
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
		$template = "ajax.circulacao_local.php";
		break;

	case "listar_circulacao_local":
		$template = "tpl.geral.circulacao_local.php";
		break;

	case "listar_circulacao_local_autocomplete":
		$objcirculacao_local = new CirculacaoLocal();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objcirculacao_local->BuscarAutoComplete($busca));
		$template = "ajax.circulacao_local.php";
		break;

	case "deletar_circulacao_local":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCirculacaoLocal = new CirculacaoLocal($pdo);
			$objCirculacaoLocal->Remover($_REQUEST['registros']);
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
		$template = "ajax.circulacao_local.php";
		break;

	case "ajax_listar_circulacao_local":
		$template = "tpl.lis.circulacao_local.php";
		break;

	case "circulacao_local_pdf":
		$template = "tpl.lis.circulacao_local.pdf.php";
		break;

	case "circulacao_local_xlsx":
		$template = "tpl.lis.circulacao_local.xlsx.php";
		break;

	case "circulacao_local_print":
		$template = "tpl.lis.circulacao_local.print.php";
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
			$_SESSION["configuracao_usuario"]["circulacao_local"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("circulacao_local");
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
		$template = "ajax.circulacao_local.php";
		break;
}
