<?php

switch($app_comando)
{
	case "frm_adicionar_almoxarifado_entradas_itens":
		$template = "tpl.frm.almoxarifado_entradas_itens.php";
		break;

	case "frm_modal_almoxarifado_entradas_itens":
if($_REQUEST["app_codigo"] != "") {
		$almoxarifado_entradas_itens = new AlmoxarifadoEntradasItens();
		$almoxarifado_entradas_itens->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_entradas_itens->Editar();
}		$template = "tpl.form.almoxarifado_entradas_itens.php";
		break;

	case "adicionar_almoxarifado_entradas_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens($pdo);
			$objAlmoxarifadoEntradasItens->setIdEntrada($_REQUEST['id_entrada']);
			$objAlmoxarifadoEntradasItens->setIdProduto($_REQUEST['id_produto']);
			$objAlmoxarifadoEntradasItens->setQuantidade($_REQUEST['quantidade']);
			$objAlmoxarifadoEntradasItens->setValor($_REQUEST['valor']);
			$novoId = $objAlmoxarifadoEntradasItens->Adicionar();
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
		$template = "ajax.almoxarifado_entradas_itens.php";
		break;

	case "frm_atualizar_almoxarifado_entradas_itens" :
		$almoxarifado_entradas_itens = new AlmoxarifadoEntradasItens();
		$almoxarifado_entradas_itens->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_entradas_itens->Editar();
		$template = "tpl.frm.almoxarifado_entradas_itens.php";
		break;

	case "atualizar_almoxarifado_entradas_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens($pdo);
			$objAlmoxarifadoEntradasItens->setId($_REQUEST['id']);
			$objAlmoxarifadoEntradasItens->setIdEntrada($_REQUEST['id_entrada']);
			$objAlmoxarifadoEntradasItens->setIdProduto($_REQUEST['id_produto']);
			$objAlmoxarifadoEntradasItens->setQuantidade($_REQUEST['quantidade']);
			$objAlmoxarifadoEntradasItens->setValor($_REQUEST['valor']);
			$objAlmoxarifadoEntradasItens->Modificar();
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
		$template = "ajax.almoxarifado_entradas_itens.php";
		break;

	case "listar_almoxarifado_entradas_itens":
		$template = "tpl.geral.almoxarifado_entradas_itens.php";
		break;

	case "listar_almoxarifado_entradas_itens_autocomplete":
		$objalmoxarifado_entradas_itens = new AlmoxarifadoEntradasItens();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objalmoxarifado_entradas_itens->BuscarAutoComplete($busca));
		$template = "ajax.almoxarifado_entradas_itens.php";
		break;

	case "deletar_almoxarifado_entradas_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoEntradasItens = new AlmoxarifadoEntradasItens($pdo);
			$objAlmoxarifadoEntradasItens->Remover($_REQUEST['registros']);
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
		$template = "ajax.almoxarifado_entradas_itens.php";
		break;

	case "ajax_listar_almoxarifado_entradas_itens":
		$template = "tpl.lis.almoxarifado_entradas_itens.php";
		break;

	case "almoxarifado_entradas_itens_pdf":
		$template = "tpl.lis.almoxarifado_entradas_itens.pdf.php";
		break;

	case "almoxarifado_entradas_itens_xlsx":
		$template = "tpl.lis.almoxarifado_entradas_itens.xlsx.php";
		break;

	case "almoxarifado_entradas_itens_print":
		$template = "tpl.lis.almoxarifado_entradas_itens.print.php";
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
			$_SESSION["configuracao_usuario"]["almoxarifado_entradas_itens"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("almoxarifado_entradas_itens");
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
		$template = "ajax.almoxarifado_entradas_itens.php";
		break;
}
