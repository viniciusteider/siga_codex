<?php

switch($app_comando)
{
	case "frm_adicionar_tipo_solicitante":
		$template = "tpl.frm.tipo_solicitante.php";
		break;

	case "frm_modal_tipo_solicitante":
if($_REQUEST["app_codigo"] != "") {
		$tipo_solicitante = new TipoSolicitante();
		$tipo_solicitante->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_solicitante->Editar();
}		$template = "tpl.form.tipo_solicitante.php";
		break;

	case "adicionar_tipo_solicitante":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoSolicitante = new TipoSolicitante($pdo);
			$objTipoSolicitante->setNome($_REQUEST['nome']);
			$novoId = $objTipoSolicitante->Adicionar();
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
		$template = "ajax.tipo_solicitante.php";
		break;

	case "frm_atualizar_tipo_solicitante" :
		$tipo_solicitante = new TipoSolicitante();
		$tipo_solicitante->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_solicitante->Editar();
		$template = "tpl.frm.tipo_solicitante.php";
		break;

	case "atualizar_tipo_solicitante":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoSolicitante = new TipoSolicitante($pdo);
			$objTipoSolicitante->setId($_REQUEST['id']);
			$objTipoSolicitante->setNome($_REQUEST['nome']);
			$objTipoSolicitante->Modificar();
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
		$template = "ajax.tipo_solicitante.php";
		break;

	case "listar_tipo_solicitante":
		$template = "tpl.geral.tipo_solicitante.simples.php";
		break;

	case "listar_tipo_solicitante_autocomplete":
		$objtipo_solicitante = new TipoSolicitante();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objtipo_solicitante->BuscarAutoComplete($busca));
		$template = "ajax.tipo_solicitante.php";
		break;

	case "deletar_tipo_solicitante":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoSolicitante = new TipoSolicitante($pdo);
			$objTipoSolicitante->Remover($_REQUEST['registros']);
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
		$template = "ajax.tipo_solicitante.php";
		break;

	case "ajax_listar_tipo_solicitante":
		$template = "tpl.lis.tipo_solicitante.php";
		break;

	case "tipo_solicitante_pdf":
		$template = "tpl.lis.tipo_solicitante.pdf.php";
		break;

	case "tipo_solicitante_xlsx":
		$template = "tpl.lis.tipo_solicitante.xlsx.php";
		break;

	case "tipo_solicitante_print":
		$template = "tpl.lis.tipo_solicitante.print.php";
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
			$_SESSION["configuracao_usuario"]["tipo_solicitante"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("tipo_solicitante");
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
		$template = "ajax.tipo_solicitante.php";
		break;
}
