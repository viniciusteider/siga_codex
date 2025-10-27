<?php

switch($app_comando)
{
	case "frm_adicionar_procedimentos_tipo":
		$template = "tpl.frm.procedimentos_tipo.php";
		break;

	case "frm_modal_procedimentos_tipo":
if($_REQUEST["app_codigo"] != "") {
		$procedimentos_tipo = new ProcedimentosTipo();
		$procedimentos_tipo->setId($_REQUEST["app_codigo"]);
		$linha = $procedimentos_tipo->Editar();
}		$template = "tpl.form.procedimentos_tipo.php";
		break;

	case "adicionar_procedimentos_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProcedimentosTipo = new ProcedimentosTipo($pdo);
			$objProcedimentosTipo->setNome($_REQUEST['nome']);
			$novoId = $objProcedimentosTipo->Adicionar();
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
		$template = "ajax.procedimentos_tipo.php";
		break;

	case "frm_atualizar_procedimentos_tipo" :
		$procedimentos_tipo = new ProcedimentosTipo();
		$procedimentos_tipo->setId($_REQUEST["app_codigo"]);
		$linha = $procedimentos_tipo->Editar();
		$template = "tpl.frm.procedimentos_tipo.php";
		break;

	case "atualizar_procedimentos_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProcedimentosTipo = new ProcedimentosTipo($pdo);
			$objProcedimentosTipo->setId($_REQUEST['id']);
			$objProcedimentosTipo->setNome($_REQUEST['nome']);
			$objProcedimentosTipo->Modificar();
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
		$template = "ajax.procedimentos_tipo.php";
		break;

	case "listar_procedimentos_tipo":
		$template = "tpl.geral.procedimentos_tipo.php";
		break;

	case "listar_procedimentos_tipo_autocomplete":
		$objprocedimentos_tipo = new ProcedimentosTipo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprocedimentos_tipo->BuscarAutoComplete($busca));
		$template = "ajax.procedimentos_tipo.php";
		break;

	case "deletar_procedimentos_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProcedimentosTipo = new ProcedimentosTipo($pdo);
			$objProcedimentosTipo->Remover($_REQUEST['registros']);
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
		$template = "ajax.procedimentos_tipo.php";
		break;

	case "ajax_listar_procedimentos_tipo":
		$template = "tpl.lis.procedimentos_tipo.php";
		break;

	case "procedimentos_tipo_pdf":
		$template = "tpl.lis.procedimentos_tipo.pdf.php";
		break;

	case "procedimentos_tipo_xlsx":
		$template = "tpl.lis.procedimentos_tipo.xlsx.php";
		break;

	case "procedimentos_tipo_print":
		$template = "tpl.lis.procedimentos_tipo.print.php";
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
			$_SESSION["configuracao_usuario"]["procedimentos_tipo"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("procedimentos_tipo");
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
		$template = "ajax.procedimentos_tipo.php";
		break;
}
