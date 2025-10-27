<?php

switch($app_comando)
{
	case "frm_adicionar_almoxarifado_transferencia_estoque":
		$template = "tpl.frm.almoxarifado_transferencia_estoque.php";
		break;

	case "frm_modal_almoxarifado_transferencia_estoque":
if($_REQUEST["app_codigo"] != "") {
		$almoxarifado_transferencia_estoque = new AlmoxarifadoTransferenciaEstoque();
		$almoxarifado_transferencia_estoque->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_transferencia_estoque->Editar();
}		$template = "tpl.form.almoxarifado_transferencia_estoque.php";
		break;

	case "adicionar_almoxarifado_transferencia_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoTransferenciaEstoque = new AlmoxarifadoTransferenciaEstoque($pdo);
			$objAlmoxarifadoTransferenciaEstoque->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objAlmoxarifadoTransferenciaEstoque->setIdUsuario($_REQUEST['id_usuario']);
			$objAlmoxarifadoTransferenciaEstoque->setIdProduto($_REQUEST['id_produto']);
			$objAlmoxarifadoTransferenciaEstoque->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objAlmoxarifadoTransferenciaEstoque->setIdTipoMovimento($_REQUEST['id_tipo_movimento']);
			$objAlmoxarifadoTransferenciaEstoque->setIdAlmoxarifadoDestino($_REQUEST['id_almoxarifado_destino']);
			$objAlmoxarifadoTransferenciaEstoque->setEstoqueAtual($_REQUEST['estoque_atual']);
			$objAlmoxarifadoTransferenciaEstoque->setDataMovimento(Conexao::PrepararDataBD($_REQUEST['data_movimento'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoTransferenciaEstoque->setQuantidadeTranferir($_REQUEST['quantidade_tranferir']);
			$novoId = $objAlmoxarifadoTransferenciaEstoque->Adicionar();
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
		$template = "ajax.almoxarifado_transferencia_estoque.php";
		break;

	case "frm_atualizar_almoxarifado_transferencia_estoque" :
		$almoxarifado_transferencia_estoque = new AlmoxarifadoTransferenciaEstoque();
		$almoxarifado_transferencia_estoque->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_transferencia_estoque->Editar();
		$template = "tpl.frm.almoxarifado_transferencia_estoque.php";
		break;

	case "atualizar_almoxarifado_transferencia_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoTransferenciaEstoque = new AlmoxarifadoTransferenciaEstoque($pdo);
			$objAlmoxarifadoTransferenciaEstoque->setId($_REQUEST['id']);
			$objAlmoxarifadoTransferenciaEstoque->setIdUsuario($_REQUEST['id_usuario']);
			$objAlmoxarifadoTransferenciaEstoque->setIdProduto($_REQUEST['id_produto']);
			$objAlmoxarifadoTransferenciaEstoque->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objAlmoxarifadoTransferenciaEstoque->setIdTipoMovimento($_REQUEST['id_tipo_movimento']);
			$objAlmoxarifadoTransferenciaEstoque->setIdAlmoxarifadoDestino($_REQUEST['id_almoxarifado_destino']);
			$objAlmoxarifadoTransferenciaEstoque->setEstoqueAtual($_REQUEST['estoque_atual']);
			$objAlmoxarifadoTransferenciaEstoque->setDataMovimento(Conexao::PrepararDataBD($_REQUEST['data_movimento'], $_SESSION['usuario']['timezone']));
			$objAlmoxarifadoTransferenciaEstoque->setQuantidadeTranferir($_REQUEST['quantidade_tranferir']);
			$objAlmoxarifadoTransferenciaEstoque->Modificar();
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
		$template = "ajax.almoxarifado_transferencia_estoque.php";
		break;

	case "listar_almoxarifado_transferencia_estoque":
		$template = "tpl.geral.almoxarifado_transferencia_estoque.php";
		break;

	case "listar_almoxarifado_transferencia_estoque_autocomplete":
		$objalmoxarifado_transferencia_estoque = new AlmoxarifadoTransferenciaEstoque();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objalmoxarifado_transferencia_estoque->BuscarAutoComplete($busca));
		$template = "ajax.almoxarifado_transferencia_estoque.php";
		break;

	case "deletar_almoxarifado_transferencia_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoTransferenciaEstoque = new AlmoxarifadoTransferenciaEstoque($pdo);
			$objAlmoxarifadoTransferenciaEstoque->Remover($_REQUEST['registros']);
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
		$template = "ajax.almoxarifado_transferencia_estoque.php";
		break;

	case "ajax_listar_almoxarifado_transferencia_estoque":
		$template = "tpl.lis.almoxarifado_transferencia_estoque.php";
		break;

	case "almoxarifado_transferencia_estoque_pdf":
		$template = "tpl.lis.almoxarifado_transferencia_estoque.pdf.php";
		break;

	case "almoxarifado_transferencia_estoque_xlsx":
		$template = "tpl.lis.almoxarifado_transferencia_estoque.xlsx.php";
		break;

	case "almoxarifado_transferencia_estoque_print":
		$template = "tpl.lis.almoxarifado_transferencia_estoque.print.php";
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
			$_SESSION["configuracao_usuario"]["almoxarifado_transferencia_estoque"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("almoxarifado_transferencia_estoque");
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
		$template = "ajax.almoxarifado_transferencia_estoque.php";
		break;
}
