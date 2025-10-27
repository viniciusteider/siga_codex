<?php

switch($app_comando)
{
	case "frm_adicionar_circulacao":
		$template = "tpl.frm.circulacao.php";
		break;

	case "frm_modal_circulacao":
if($_REQUEST["app_codigo"] != "") {
		$circulacao = new Circulacao();
		$circulacao->setId($_REQUEST["app_codigo"]);
		$linha = $circulacao->Editar();
}		$template = "tpl.form.circulacao.php";
		break;

	case "adicionar_circulacao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCirculacao = new Circulacao($pdo);
			$objCirculacao->setIdCirculacaoLocal($_REQUEST['id_circulacao_local']);
			$objCirculacao->setNome($_REQUEST['nome']);
			$novoId = $objCirculacao->Adicionar();
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
		$template = "ajax.circulacao.php";
		break;

	case "frm_atualizar_circulacao" :
		$circulacao = new Circulacao();
		$circulacao->setId($_REQUEST["app_codigo"]);
		$linha = $circulacao->Editar();
		$template = "tpl.frm.circulacao.php";
		break;

	case "atualizar_circulacao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCirculacao = new Circulacao($pdo);
			$objCirculacao->setId($_REQUEST['id']);
			$objCirculacao->setIdCirculacaoLocal($_REQUEST['id_circulacao_local']);
			$objCirculacao->setNome($_REQUEST['nome']);
			$objCirculacao->Modificar();
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
		$template = "ajax.circulacao.php";
		break;

	case "listar_circulacao":
		$template = "tpl.geral.circulacao.php";
		break;

	case "listar_circulacao_autocomplete":
		$objcirculacao = new Circulacao();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objcirculacao->BuscarAutoComplete($busca));
		$template = "ajax.circulacao.php";
		break;

	case "deletar_circulacao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCirculacao = new Circulacao($pdo);
			$objCirculacao->Remover($_REQUEST['registros']);
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
		$template = "ajax.circulacao.php";
		break;

	case "ajax_listar_circulacao":
		$template = "tpl.lis.circulacao.php";
		break;

	case "circulacao_pdf":
		$template = "tpl.lis.circulacao.pdf.php";
		break;

	case "circulacao_xlsx":
		$template = "tpl.lis.circulacao.xlsx.php";
		break;

	case "circulacao_print":
		$template = "tpl.lis.circulacao.print.php";
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
			$_SESSION["configuracao_usuario"]["circulacao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("circulacao");
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
		$template = "ajax.circulacao.php";
		break;
}
