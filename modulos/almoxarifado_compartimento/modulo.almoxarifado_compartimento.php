<?php

switch($app_comando)
{
	case "frm_adicionar_almoxarifado_compartimento":
		$template = "tpl.frm.almoxarifado_compartimento.php";
		break;

	case "frm_modal_almoxarifado_compartimento":
if($_REQUEST["app_codigo"] != "") {
		$almoxarifado_compartimento = new AlmoxarifadoCompartimento();
		$almoxarifado_compartimento->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_compartimento->Editar();
}		$template = "tpl.form.almoxarifado_compartimento.php";
		break;

	case "adicionar_almoxarifado_compartimento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoCompartimento = new AlmoxarifadoCompartimento($pdo);
			$objAlmoxarifadoCompartimento->setNome($_REQUEST['nome']);
			$objAlmoxarifadoCompartimento->setIdEstoque($_REQUEST['id_estoque']);
			$novoId = $objAlmoxarifadoCompartimento->Adicionar();
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
		$template = "ajax.almoxarifado_compartimento.php";
		break;

	case "frm_atualizar_almoxarifado_compartimento" :
		$almoxarifado_compartimento = new AlmoxarifadoCompartimento();
		$almoxarifado_compartimento->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_compartimento->Editar();
		$template = "tpl.frm.almoxarifado_compartimento.php";
		break;

	case "atualizar_almoxarifado_compartimento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoCompartimento = new AlmoxarifadoCompartimento($pdo);
			$objAlmoxarifadoCompartimento->setId($_REQUEST['id']);
			$objAlmoxarifadoCompartimento->setNome($_REQUEST['nome']);
			$objAlmoxarifadoCompartimento->setIdEstoque($_REQUEST['id_estoque']);
			$objAlmoxarifadoCompartimento->Modificar();
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
		$template = "ajax.almoxarifado_compartimento.php";
		break;

	case "listar_almoxarifado_compartimento":
		$template = "tpl.geral.almoxarifado_compartimento.php";
		break;

	case "listar_almoxarifado_compartimento_autocomplete":
		$objalmoxarifado_compartimento = new AlmoxarifadoCompartimento();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objalmoxarifado_compartimento->BuscarAutoComplete($busca));
		$template = "ajax.almoxarifado_compartimento.php";
		break;

	case "deletar_almoxarifado_compartimento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoCompartimento = new AlmoxarifadoCompartimento($pdo);
			$objAlmoxarifadoCompartimento->Remover($_REQUEST['registros']);
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
		$template = "ajax.almoxarifado_compartimento.php";
		break;

	case "ajax_listar_almoxarifado_compartimento":
		$template = "tpl.lis.almoxarifado_compartimento.php";
		break;

	case "almoxarifado_compartimento_pdf":
		$template = "tpl.lis.almoxarifado_compartimento.pdf.php";
		break;

	case "almoxarifado_compartimento_xlsx":
		$template = "tpl.lis.almoxarifado_compartimento.xlsx.php";
		break;

	case "almoxarifado_compartimento_print":
		$template = "tpl.lis.almoxarifado_compartimento.print.php";
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
			$_SESSION["configuracao_usuario"]["almoxarifado_compartimento"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("almoxarifado_compartimento");
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
		$template = "ajax.almoxarifado_compartimento.php";
		break;
}
