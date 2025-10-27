<?php

switch($app_comando)
{
	case "frm_adicionar_ocorrencias_materiais_itens":
		$template = "tpl.frm.ocorrencias_materiais_itens.php";
		break;

	case "frm_modal_ocorrencias_materiais_itens":
if($_REQUEST["app_codigo"] != "") {
		$ocorrencias_materiais_itens = new OcorrenciasMateriaisItens();
		$ocorrencias_materiais_itens->setId($_REQUEST["app_codigo"]);
		$linha = $ocorrencias_materiais_itens->Editar();
}		$template = "tpl.form.ocorrencias_materiais_itens.php";
		break;

	case "adicionar_ocorrencias_materiais_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasMateriaisItens = new OcorrenciasMateriaisItens($pdo);
			$objOcorrenciasMateriaisItens->setIdOcorenciaEntrega($_REQUEST['id_ocorencia_entrega']);
			$objOcorrenciasMateriaisItens->setIdItem($_REQUEST['id_item']);
			$objOcorrenciasMateriaisItens->setQuantidade($_REQUEST['quantidade']);
			$novoId = $objOcorrenciasMateriaisItens->Adicionar();
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
		$template = "ajax.ocorrencias_materiais_itens.php";
		break;

	case "frm_atualizar_ocorrencias_materiais_itens" :
		$ocorrencias_materiais_itens = new OcorrenciasMateriaisItens();
		$ocorrencias_materiais_itens->setId($_REQUEST["app_codigo"]);
		$linha = $ocorrencias_materiais_itens->Editar();
		$template = "tpl.frm.ocorrencias_materiais_itens.php";
		break;

	case "atualizar_ocorrencias_materiais_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasMateriaisItens = new OcorrenciasMateriaisItens($pdo);
			$objOcorrenciasMateriaisItens->setId($_REQUEST['id']);
			$objOcorrenciasMateriaisItens->setIdOcorenciaEntrega($_REQUEST['id_ocorencia_entrega']);
			$objOcorrenciasMateriaisItens->setIdItem($_REQUEST['id_item']);
			$objOcorrenciasMateriaisItens->setQuantidade($_REQUEST['quantidade']);
			$objOcorrenciasMateriaisItens->Modificar();
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
		$template = "ajax.ocorrencias_materiais_itens.php";
		break;

	case "listar_ocorrencias_materiais_itens":
		$template = "tpl.geral.ocorrencias_materiais_itens.php";
		break;

	case "listar_ocorrencias_materiais_itens_autocomplete":
		$objocorrencias_materiais_itens = new OcorrenciasMateriaisItens();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objocorrencias_materiais_itens->BuscarAutoComplete($busca));
		$template = "ajax.ocorrencias_materiais_itens.php";
		break;

	case "deletar_ocorrencias_materiais_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasMateriaisItens = new OcorrenciasMateriaisItens($pdo);
			$objOcorrenciasMateriaisItens->Remover($_REQUEST['registros']);
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
		$template = "ajax.ocorrencias_materiais_itens.php";
		break;

	case "ajax_listar_ocorrencias_materiais_itens":
		$template = "tpl.lis.ocorrencias_materiais_itens.php";
		break;

	case "ocorrencias_materiais_itens_pdf":
		$template = "tpl.lis.ocorrencias_materiais_itens.pdf.php";
		break;

	case "ocorrencias_materiais_itens_xlsx":
		$template = "tpl.lis.ocorrencias_materiais_itens.xlsx.php";
		break;

	case "ocorrencias_materiais_itens_print":
		$template = "tpl.lis.ocorrencias_materiais_itens.print.php";
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
			$_SESSION["configuracao_usuario"]["ocorrencias_materiais_itens"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("ocorrencias_materiais_itens");
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
		$template = "ajax.ocorrencias_materiais_itens.php";
		break;
}
