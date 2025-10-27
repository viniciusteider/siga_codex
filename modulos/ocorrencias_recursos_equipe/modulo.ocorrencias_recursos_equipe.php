<?php

switch($app_comando)
{
	case "frm_adicionar_ocorrencias_recursos_equipe":
		$template = "tpl.frm.ocorrencias_recursos_equipe.php";
		break;

	case "frm_modal_ocorrencias_recursos_equipe":
if($_REQUEST["app_codigo"] != "") {
		$ocorrencias_recursos_equipe = new OcorrenciasRecursosEquipe();
		$ocorrencias_recursos_equipe->setId($_REQUEST["app_codigo"]);
		$linha = $ocorrencias_recursos_equipe->Editar();
}		$template = "tpl.form.ocorrencias_recursos_equipe.php";
		break;

	case "adicionar_ocorrencias_recursos_equipe":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasRecursosEquipe = new OcorrenciasRecursosEquipe($pdo);
			$objOcorrenciasRecursosEquipe->setIdOcorrenciasRecursos($_REQUEST['id_ocorrencias_recursos']);
			$objOcorrenciasRecursosEquipe->setIdEfetivo($_REQUEST['id_efetivo']);
			$novoId = $objOcorrenciasRecursosEquipe->Adicionar();
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
		$template = "ajax.ocorrencias_recursos_equipe.php";
		break;

	case "frm_atualizar_ocorrencias_recursos_equipe" :
		$ocorrencias_recursos_equipe = new OcorrenciasRecursosEquipe();
		$ocorrencias_recursos_equipe->setId($_REQUEST["app_codigo"]);
		$linha = $ocorrencias_recursos_equipe->Editar();
		$template = "tpl.frm.ocorrencias_recursos_equipe.php";
		break;

	case "atualizar_ocorrencias_recursos_equipe":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasRecursosEquipe = new OcorrenciasRecursosEquipe($pdo);
			$objOcorrenciasRecursosEquipe->setId($_REQUEST['id']);
			$objOcorrenciasRecursosEquipe->setIdOcorrenciasRecursos($_REQUEST['id_ocorrencias_recursos']);
			$objOcorrenciasRecursosEquipe->setIdEfetivo($_REQUEST['id_efetivo']);
			$objOcorrenciasRecursosEquipe->Modificar();
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
		$template = "ajax.ocorrencias_recursos_equipe.php";
		break;

	case "listar_ocorrencias_recursos_equipe":
		$template = "tpl.geral.ocorrencias_recursos_equipe.php";
		break;

	case "listar_ocorrencias_recursos_equipe_autocomplete":
		$objocorrencias_recursos_equipe = new OcorrenciasRecursosEquipe();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objocorrencias_recursos_equipe->BuscarAutoComplete($busca));
		$template = "ajax.ocorrencias_recursos_equipe.php";
		break;

	case "deletar_ocorrencias_recursos_equipe":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasRecursosEquipe = new OcorrenciasRecursosEquipe($pdo);
			$objOcorrenciasRecursosEquipe->Remover($_REQUEST['registros']);
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
		$template = "ajax.ocorrencias_recursos_equipe.php";
		break;

	case "ajax_listar_ocorrencias_recursos_equipe":
		$template = "tpl.lis.ocorrencias_recursos_equipe.php";
		break;

	case "ocorrencias_recursos_equipe_pdf":
		$template = "tpl.lis.ocorrencias_recursos_equipe.pdf.php";
		break;

	case "ocorrencias_recursos_equipe_xlsx":
		$template = "tpl.lis.ocorrencias_recursos_equipe.xlsx.php";
		break;

	case "ocorrencias_recursos_equipe_print":
		$template = "tpl.lis.ocorrencias_recursos_equipe.print.php";
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
			$_SESSION["configuracao_usuario"]["ocorrencias_recursos_equipe"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("ocorrencias_recursos_equipe");
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
		$template = "ajax.ocorrencias_recursos_equipe.php";
		break;
}
