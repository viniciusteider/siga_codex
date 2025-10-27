<?php
require_once __DIR__ . "/../../api/src/Controllers/OccurrenceController.php";
require_once __DIR__ . "/../../api/src/Classes/Connection.php";
use App\Controllers\OccurrenceController;

$webSocketHandler = new WebSocketHandler();
$webSocketHandler->enviarMensagem("dispatchVehicle", 4, 8, null);

switch ($app_comando) {
	case "frm_adicionar_ocorrencias_recursos":
		$template = "tpl.frm.ocorrencias_recursos.php";
		break;

	case "frm_modal_ocorrencias_recursos":
		if ($_REQUEST["app_codigo"] != "") {
			$ocorrencias_recursos = new OcorrenciasRecursos();
			$ocorrencias_recursos->setId($_REQUEST["app_codigo"]);
			$linha = $ocorrencias_recursos->Editar();
		}
		$template = "tpl.form.ocorrencias_recursos.php";
		break;

	case "adicionar_ocorrencias_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			if (is_array($_REQUEST['lista_recuros']) && count($_REQUEST['lista_recuros']) > 0) {
				foreach ($_REQUEST['lista_recuros'] as $lista_recuro) {

					$objOcorrenciasRecursos = new OcorrenciasRecursos($pdo);
					($_REQUEST['id_ocorrencias_recursos'][$lista_recuro] != "") ? $objOcorrenciasRecursos->Atualizar($_REQUEST['id_ocorrencias_recursos'][$lista_recuro]) : '';
					$objOcorrenciasRecursos->setIdRecurso($lista_recuro);
					$objOcorrenciasRecursos->setIdOcorrencia($_REQUEST['id']);
					$objOcorrenciasRecursos->setIdUsuario($_SESSION['usuario']['id']);
					$objOcorrenciasRecursos->setData(Conexao::PrepararDataBD(Conexao::DataHoraGMTPHP(), $_SESSION['usuario']['timezone']));
					$novoId = $objOcorrenciasRecursos->Adicionar();
					$integrantes = explode(",", $_REQUEST['id_equipes'][$lista_recuro]);
					if (is_array($integrantes) && count($integrantes) > 0) {
						foreach ($integrantes as $integrante) {
							$objOcorrenciasRecursosEquipe = new OcorrenciasRecursosEquipe($pdo);
							$objOcorrenciasRecursosEquipe->setIdOcorrenciasRecursos($novoId);
							$objOcorrenciasRecursosEquipe->setIdEfetivo($integrante);
							$objOcorrenciasRecursosEquipe->Adicionar();
						}
					}
				}
				$objOcorrencias = new Ocorrencias($pdo);
				$objOcorrencias->AtualizarStatus($_REQUEST['id']);
			}

			$msg["codigo"] = 0;
			$msg["mensagem"] = "Sucesso ao Adicionar registro";
			$pdo->commit();

			if (is_array($_REQUEST['lista_recuros']) && count($_REQUEST['lista_recuros']) > 0) {
				foreach ($_REQUEST['lista_recuros'] as $lista_recuro) {
					$occurrenceController = new OccurrenceController();
					$webSocketHandler = new WebSocketHandler();
					$actualOccurrence = $occurrenceController->getActualOccurrence(['id' => $lista_recuro, 'id_grupo' => $_SESSION['usuario']['id_grupo']], true);
					$webSocketHandler->enviarMensagem("dispatchVehicle", $_SESSION['usuario']['id_grupo'], $lista_recuro, $actualOccurrence);
				}
			}
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.ocorrencias_recursos.php";
		break;

	case "frm_atualizar_ocorrencias_recursos":
		$ocorrencias_recursos = new OcorrenciasRecursos();
		$ocorrencias_recursos->setId($_REQUEST["app_codigo"]);
		$linha = $ocorrencias_recursos->Editar();
		$template = "tpl.frm.ocorrencias_recursos.php";
		break;

	case "atualizar_ocorrencias_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasRecursos = new OcorrenciasRecursos($pdo);
			$objOcorrenciasRecursos->setId($_REQUEST['id']);
			$objOcorrenciasRecursos->setIdRecurso($_REQUEST['id_recurso']);
			$objOcorrenciasRecursos->setIdOcorrencia($_REQUEST['id_ocorrencia']);
			$objOcorrenciasRecursos->setData(Conexao::PrepararDataBD($_REQUEST['data'], $_SESSION['usuario']['timezone']));
			$objOcorrenciasRecursos->setHorarioSaidaBase(Conexao::PrepararDataBD($_REQUEST['horario_saida_base'], $_SESSION['usuario']['timezone']));
			$objOcorrenciasRecursos->setHorarioChegadaLocal(Conexao::PrepararDataBD($_REQUEST['horario_chegada_local'], $_SESSION['usuario']['timezone']));
			$objOcorrenciasRecursos->setHorarioSaidaLocal(Conexao::PrepararDataBD($_REQUEST['horario_saida_local'], $_SESSION['usuario']['timezone']));
			$objOcorrenciasRecursos->setHorarioChegadaHospital(Conexao::PrepararDataBD($_REQUEST['horario_chegada_hospital'], $_SESSION['usuario']['timezone']));
			$objOcorrenciasRecursos->setHorarioChegadaBase(Conexao::PrepararDataBD($_REQUEST['horario_chegada_base'], $_SESSION['usuario']['timezone']));
			$objOcorrenciasRecursos->setQta($_REQUEST['qta']);
			$objOcorrenciasRecursos->setUltimoQta($_REQUEST['ultimo_qta']);
			$objOcorrenciasRecursos->Modificar();

			// $webSocketHandler = new WebSocketHandler();
			
			// // $occurrenceController = new OccurrenceController();
			// // $actualOccurrence = $occurrenceController->getActualOccurrence(['id' => $_REQUEST['id_recurso'], 'id_grupo' => $_SESSION['usuario']['id_grupo']]);
			// $webSocketHandler->enviarMensagem("updateOccurrence", $_REQUEST['id_recurso'], null);

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
		$template = "ajax.ocorrencias_recursos.php";
		break;

	case "listar_ocorrencias_recursos":
		$template = "tpl.geral.ocorrencias_recursos.php";
		break;

	case "listar_ocorrencias_recursos_autocomplete":
		$objocorrencias_recursos = new OcorrenciasRecursos();
		$busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objocorrencias_recursos->BuscarAutoComplete($busca));
		$template = "ajax.ocorrencias_recursos.php";
		break;

	case "deletar_ocorrencias_recursos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOcorrenciasRecursos = new OcorrenciasRecursos($pdo);
			$objOcorrenciasRecursos->Remover($_REQUEST['registros']);
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
		$template = "ajax.ocorrencias_recursos.php";
		break;

	case "ajax_listar_ocorrencias_recursos":
		$template = "tpl.lis.ocorrencias_recursos.php";
		break;

	case "ocorrencias_recursos_pdf":
		$template = "tpl.lis.ocorrencias_recursos.pdf.php";
		break;

	case "ocorrencias_recursos_xlsx":
		$template = "tpl.lis.ocorrencias_recursos.xlsx.php";
		break;

	case "ocorrencias_recursos_print":
		$template = "tpl.lis.ocorrencias_recursos.print.php";
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
			$_SESSION["configuracao_usuario"]["ocorrencias_recursos"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("ocorrencias_recursos");
			$usuarioConfiguracao->LimparConfiguracoes();
			foreach ($colunasSelecionadas as $nomeCampo => $idCampo) {
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
		$template = "ajax.ocorrencias_recursos.php";
		break;
}
