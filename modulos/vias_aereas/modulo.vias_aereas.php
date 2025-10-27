<?php

switch($app_comando)
{
	case "frm_adicionar_vias_aereas":
		$template = "tpl.frm.vias_aereas.php";
		break;

	case "frm_modal_vias_aereas":
if($_REQUEST["app_codigo"] != "") {
		$vias_aereas = new ViasAereas();
		$vias_aereas->setId($_REQUEST["app_codigo"]);
		$linha = $vias_aereas->Editar();
}		$template = "tpl.form.vias_aereas.php";
		break;

	case "adicionar_vias_aereas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objViasAereas = new ViasAereas($pdo);
			$objViasAereas->setNome($_REQUEST['nome']);
			$novoId = $objViasAereas->Adicionar();
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
		$template = "ajax.vias_aereas.php";
		break;

	case "frm_atualizar_vias_aereas" :
		$vias_aereas = new ViasAereas();
		$vias_aereas->setId($_REQUEST["app_codigo"]);
		$linha = $vias_aereas->Editar();
		$template = "tpl.frm.vias_aereas.php";
		break;

	case "atualizar_vias_aereas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objViasAereas = new ViasAereas($pdo);
			$objViasAereas->setId($_REQUEST['id']);
			$objViasAereas->setNome($_REQUEST['nome']);
			$objViasAereas->Modificar();
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
		$template = "ajax.vias_aereas.php";
		break;

	case "listar_vias_aereas":
		$template = "tpl.geral.vias_aereas.php";
		break;

	case "listar_vias_aereas_autocomplete":
		$objvias_aereas = new ViasAereas();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objvias_aereas->BuscarAutoComplete($busca));
		$template = "ajax.vias_aereas.php";
		break;

	case "deletar_vias_aereas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objViasAereas = new ViasAereas($pdo);
			$objViasAereas->Remover($_REQUEST['registros']);
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
		$template = "ajax.vias_aereas.php";
		break;

	case "ajax_listar_vias_aereas":
		$template = "tpl.lis.vias_aereas.php";
		break;

	case "vias_aereas_pdf":
		$template = "tpl.lis.vias_aereas.pdf.php";
		break;

	case "vias_aereas_xlsx":
		$template = "tpl.lis.vias_aereas.xlsx.php";
		break;

	case "vias_aereas_print":
		$template = "tpl.lis.vias_aereas.print.php";
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
			$_SESSION["configuracao_usuario"]["vias_aereas"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("vias_aereas");
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
		$template = "ajax.vias_aereas.php";
		break;
}
