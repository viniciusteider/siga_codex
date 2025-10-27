<?php

switch($app_comando)
{
	case "frm_adicionar_procedimentos":
		$template = "tpl.frm.procedimentos.php";
		break;

	case "frm_modal_procedimentos":
if($_REQUEST["app_codigo"] != "") {
		$procedimentos = new Procedimentos();
		$procedimentos->setId($_REQUEST["app_codigo"]);
		$linha = $procedimentos->Editar();
}		$template = "tpl.form.procedimentos.php";
		break;

	case "adicionar_procedimentos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProcedimentos = new Procedimentos($pdo);
			$objProcedimentos->setIdProcedimentoTipo($_REQUEST['id_procedimento_tipo']);
			$objProcedimentos->setProcedimento($_REQUEST['procedimento']);
			$novoId = $objProcedimentos->Adicionar();
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
		$template = "ajax.procedimentos.php";
		break;

	case "frm_atualizar_procedimentos" :
		$procedimentos = new Procedimentos();
		$procedimentos->setId($_REQUEST["app_codigo"]);
		$linha = $procedimentos->Editar();
		$template = "tpl.frm.procedimentos.php";
		break;

	case "atualizar_procedimentos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProcedimentos = new Procedimentos($pdo);
			$objProcedimentos->setId($_REQUEST['id']);
			$objProcedimentos->setIdProcedimentoTipo($_REQUEST['id_procedimento_tipo']);
			$objProcedimentos->setProcedimento($_REQUEST['procedimento']);
			$objProcedimentos->Modificar();
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
		$template = "ajax.procedimentos.php";
		break;

	case "listar_procedimentos":
		$template = "tpl.geral.procedimentos.php";
		break;

	case "listar_procedimentos_autocomplete":
		$objprocedimentos = new Procedimentos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprocedimentos->BuscarAutoComplete($busca));
		$template = "ajax.procedimentos.php";
		break;

	case "deletar_procedimentos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProcedimentos = new Procedimentos($pdo);
			$objProcedimentos->Remover($_REQUEST['registros']);
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
		$template = "ajax.procedimentos.php";
		break;

	case "ajax_listar_procedimentos":
		$template = "tpl.lis.procedimentos.php";
		break;

	case "procedimentos_pdf":
		$template = "tpl.lis.procedimentos.pdf.php";
		break;

	case "procedimentos_xlsx":
		$template = "tpl.lis.procedimentos.xlsx.php";
		break;

	case "procedimentos_print":
		$template = "tpl.lis.procedimentos.print.php";
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
			$_SESSION["configuracao_usuario"]["procedimentos"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("procedimentos");
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
		$template = "ajax.procedimentos.php";
		break;
}
