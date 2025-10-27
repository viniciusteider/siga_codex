<?php

switch($app_comando)
{
	case "frm_adicionar_almoxarifado":
		$template = "tpl.frm.almoxarifado.php";
		break;

	case "frm_modal_almoxarifado":
if($_REQUEST["app_codigo"] != "") {
		$almoxarifado = new Almoxarifado();
		$almoxarifado->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado->Editar();
}		$template = "tpl.form.almoxarifado.php";
		break;

	case "adicionar_almoxarifado":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifado = new Almoxarifado($pdo);
			$objAlmoxarifado->setNome($_REQUEST['nome']);
			$objAlmoxarifado->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$novoId = $objAlmoxarifado->Adicionar();
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
		$template = "ajax.almoxarifado.php";
		break;

	case "frm_atualizar_almoxarifado" :
		$almoxarifado = new Almoxarifado();
		$almoxarifado->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado->Editar();
		$template = "tpl.frm.almoxarifado.php";
		break;

	case "atualizar_almoxarifado":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifado = new Almoxarifado($pdo);
			$objAlmoxarifado->setId($_REQUEST['id']);
			$objAlmoxarifado->setNome($_REQUEST['nome']);
			$objAlmoxarifado->Modificar();
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
		$template = "ajax.almoxarifado.php";
		break;

	case "listar_almoxarifado":
		$template = "tpl.geral.almoxarifado.simples.php";
		break;

	case "listar_almoxarifado_autocomplete":
		$objalmoxarifado = new Almoxarifado();
        $objalmoxarifado->setIdGrupo($_SESSION['usuario']['id_grupo']);
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objalmoxarifado->BuscarAutoComplete($busca));
		$template = "ajax.almoxarifado.php";
		break;

	case "deletar_almoxarifado":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifado = new Almoxarifado($pdo);
			$objAlmoxarifado->Remover($_REQUEST['registros']);
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
		$template = "ajax.almoxarifado.php";
		break;

	case "ajax_listar_almoxarifado":
		$template = "tpl.lis.almoxarifado.php";
		break;

	case "almoxarifado_pdf":
		$template = "tpl.lis.almoxarifado.pdf.php";
		break;

	case "almoxarifado_xlsx":
		$template = "tpl.lis.almoxarifado.xlsx.php";
		break;

	case "almoxarifado_print":
		$template = "tpl.lis.almoxarifado.print.php";
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
			$_SESSION["configuracao_usuario"]["almoxarifado"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("almoxarifado");
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
		$template = "ajax.almoxarifado.php";
		break;
}
