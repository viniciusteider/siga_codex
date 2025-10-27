<?php

switch($app_comando)
{
	case "frm_adicionar_partes_corpo":
		$template = "tpl.frm.partes_corpo.php";
		break;

	case "frm_modal_partes_corpo":
if($_REQUEST["app_codigo"] != "") {
		$partes_corpo = new PartesCorpo();
		$partes_corpo->setId($_REQUEST["app_codigo"]);
		$linha = $partes_corpo->Editar();
}		$template = "tpl.form.partes_corpo.php";
		break;

	case "adicionar_partes_corpo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPartesCorpo = new PartesCorpo($pdo);
			$objPartesCorpo->setNome($_REQUEST['nome']);
			$novoId = $objPartesCorpo->Adicionar();
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
		$template = "ajax.partes_corpo.php";
		break;

	case "frm_atualizar_partes_corpo" :
		$partes_corpo = new PartesCorpo();
		$partes_corpo->setId($_REQUEST["app_codigo"]);
		$linha = $partes_corpo->Editar();
		$template = "tpl.frm.partes_corpo.php";
		break;

	case "atualizar_partes_corpo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPartesCorpo = new PartesCorpo($pdo);
			$objPartesCorpo->setId($_REQUEST['id']);
			$objPartesCorpo->setNome($_REQUEST['nome']);
			$objPartesCorpo->Modificar();
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
		$template = "ajax.partes_corpo.php";
		break;

	case "listar_partes_corpo":
		$template = "tpl.geral.partes_corpo.php";
		break;

	case "listar_partes_corpo_autocomplete":
		$objpartes_corpo = new PartesCorpo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpartes_corpo->BuscarAutoComplete($busca));
		$template = "ajax.partes_corpo.php";
		break;

	case "deletar_partes_corpo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPartesCorpo = new PartesCorpo($pdo);
			$objPartesCorpo->Remover($_REQUEST['registros']);
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
		$template = "ajax.partes_corpo.php";
		break;

	case "ajax_listar_partes_corpo":
		$template = "tpl.lis.partes_corpo.php";
		break;

	case "partes_corpo_pdf":
		$template = "tpl.lis.partes_corpo.pdf.php";
		break;

	case "partes_corpo_xlsx":
		$template = "tpl.lis.partes_corpo.xlsx.php";
		break;

	case "partes_corpo_print":
		$template = "tpl.lis.partes_corpo.print.php";
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
			$_SESSION["configuracao_usuario"]["partes_corpo"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("partes_corpo");
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
		$template = "ajax.partes_corpo.php";
		break;
}
