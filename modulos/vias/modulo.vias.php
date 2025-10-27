<?php

switch($app_comando)
{
	case "frm_adicionar_vias":
		$template = "tpl.frm.vias.php";
		break;

	case "frm_modal_vias":
if($_REQUEST["app_codigo"] != "") {
		$vias = new Vias();
		$vias->setId($_REQUEST["app_codigo"]);
		$linha = $vias->Editar();
}		$template = "tpl.form.vias.php";
		break;

	case "adicionar_vias":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objVias = new Vias($pdo);
			$objVias->setNome($_REQUEST['nome']);
			$novoId = $objVias->Adicionar();
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
		$template = "ajax.vias.php";
		break;

	case "frm_atualizar_vias" :
		$vias = new Vias();
		$vias->setId($_REQUEST["app_codigo"]);
		$linha = $vias->Editar();
		$template = "tpl.frm.vias.php";
		break;

	case "atualizar_vias":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objVias = new Vias($pdo);
			$objVias->setId($_REQUEST['id']);
			$objVias->setNome($_REQUEST['nome']);
			$objVias->Modificar();
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
		$template = "ajax.vias.php";
		break;

	case "listar_vias":
		$template = "tpl.geral.vias.php";
		break;

	case "listar_vias_autocomplete":
		$objvias = new Vias();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objvias->BuscarAutoComplete($busca));
		$template = "ajax.vias.php";
		break;

	case "deletar_vias":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objVias = new Vias($pdo);
			$objVias->Remover($_REQUEST['registros']);
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
		$template = "ajax.vias.php";
		break;

	case "ajax_listar_vias":
		$template = "tpl.lis.vias.php";
		break;

	case "vias_pdf":
		$template = "tpl.lis.vias.pdf.php";
		break;

	case "vias_xlsx":
		$template = "tpl.lis.vias.xlsx.php";
		break;

	case "vias_print":
		$template = "tpl.lis.vias.print.php";
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
			$_SESSION["configuracao_usuario"]["vias"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("vias");
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
		$template = "ajax.vias.php";
		break;
}
