<?php

switch($app_comando)
{
	case "frm_adicionar_almoxarifado_controle_estoque":
		$template = "tpl.frm.almoxarifado_controle_estoque.php";
		break;

	case "frm_modal_almoxarifado_controle_estoque":
if($_REQUEST["app_codigo"] != "") {
		$almoxarifado_controle_estoque = new AlmoxarifadoControleEstoque();
		$almoxarifado_controle_estoque->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_controle_estoque->Editar();
}		$template = "tpl.form.almoxarifado_controle_estoque.php";
		break;

	case "adicionar_almoxarifado_controle_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoControleEstoque = new AlmoxarifadoControleEstoque($pdo);
			$objAlmoxarifadoControleEstoque->setIdProduto($_REQUEST['id_produto']);
			$objAlmoxarifadoControleEstoque->setIdModelo($_REQUEST['id_modelo']);
			$objAlmoxarifadoControleEstoque->setIdTamanho($_REQUEST['id_tamanho']);
			$objAlmoxarifadoControleEstoque->setIdControleEstoque($_REQUEST['id_controle_estoque']);
			$objAlmoxarifadoControleEstoque->setQuantidadeEstoque($_REQUEST['quantidade_estoque']);
			$objAlmoxarifadoControleEstoque->setIdCor($_REQUEST['id_cor']);
			$objAlmoxarifadoControleEstoque->setIdRevestimento($_REQUEST['id_revestimento']);
			$objAlmoxarifadoControleEstoque->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$novoId = $objAlmoxarifadoControleEstoque->Adicionar();
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
		$template = "ajax.almoxarifado_controle_estoque.php";
		break;

	case "frm_atualizar_almoxarifado_controle_estoque" :
		$almoxarifado_controle_estoque = new AlmoxarifadoControleEstoque();
		$almoxarifado_controle_estoque->setId($_REQUEST["app_codigo"]);
		$linha = $almoxarifado_controle_estoque->Editar();
		$template = "tpl.frm.almoxarifado_controle_estoque.php";
		break;

	case "atualizar_almoxarifado_controle_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoControleEstoque = new AlmoxarifadoControleEstoque($pdo);
			$objAlmoxarifadoControleEstoque->setId($_REQUEST['id']);
			$objAlmoxarifadoControleEstoque->setIdProduto($_REQUEST['id_produto']);
			$objAlmoxarifadoControleEstoque->setIdModelo($_REQUEST['id_modelo']);
			$objAlmoxarifadoControleEstoque->setIdTamanho($_REQUEST['id_tamanho']);
			$objAlmoxarifadoControleEstoque->setIdControleEstoque($_REQUEST['id_controle_estoque']);
			$objAlmoxarifadoControleEstoque->setQuantidadeEstoque($_REQUEST['quantidade_estoque']);
			$objAlmoxarifadoControleEstoque->setIdCor($_REQUEST['id_cor']);
			$objAlmoxarifadoControleEstoque->setIdRevestimento($_REQUEST['id_revestimento']);
			$objAlmoxarifadoControleEstoque->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objAlmoxarifadoControleEstoque->Modificar();
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
		$template = "ajax.almoxarifado_controle_estoque.php";
		break;

	case "listar_almoxarifado_controle_estoque":
		$template = "tpl.geral.almoxarifado_controle_estoque.php";
		break;

	case "listar_almoxarifado_controle_estoque_autocomplete":
		$objalmoxarifado_controle_estoque = new AlmoxarifadoControleEstoque();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objalmoxarifado_controle_estoque->BuscarAutoComplete($busca));
		$template = "ajax.almoxarifado_controle_estoque.php";
		break;

	case "deletar_almoxarifado_controle_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objAlmoxarifadoControleEstoque = new AlmoxarifadoControleEstoque($pdo);
			$objAlmoxarifadoControleEstoque->Remover($_REQUEST['registros']);
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
		$template = "ajax.almoxarifado_controle_estoque.php";
		break;

	case "ajax_listar_almoxarifado_controle_estoque":
		$template = "tpl.lis.almoxarifado_controle_estoque.php";
		break;

	case "almoxarifado_controle_estoque_pdf":
		$template = "tpl.lis.almoxarifado_controle_estoque.pdf.php";
		break;

	case "almoxarifado_controle_estoque_xlsx":
		$template = "tpl.lis.almoxarifado_controle_estoque.xlsx.php";
		break;

	case "almoxarifado_controle_estoque_print":
		$template = "tpl.lis.almoxarifado_controle_estoque.print.php";
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
			$_SESSION["configuracao_usuario"]["almoxarifado_controle_estoque"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("almoxarifado_controle_estoque");
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
		$template = "ajax.almoxarifado_controle_estoque.php";
		break;
}
