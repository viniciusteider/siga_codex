<?php

switch($app_comando)
{
	case "frm_adicionar_tipo_combustivel":
		$template = "tpl.frm.tipo_combustivel.php";
		break;

	case "frm_modal_tipo_combustivel":
if($_REQUEST["app_codigo"] != "") {
		$tipo_combustivel = new TipoCombustivel();
		$tipo_combustivel->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_combustivel->Editar();
}		$template = "tpl.form.tipo_combustivel.php";
		break;

	case "adicionar_tipo_combustivel":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoCombustivel = new TipoCombustivel($pdo);
			$objTipoCombustivel->setTipoCombustivel($_REQUEST['tipo_combustivel']);
			$novoId = $objTipoCombustivel->Adicionar();
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
		$template = "ajax.tipo_combustivel.php";
		break;

	case "frm_atualizar_tipo_combustivel" :
		$tipo_combustivel = new TipoCombustivel();
		$tipo_combustivel->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_combustivel->Editar();
		$template = "tpl.frm.tipo_combustivel.php";
		break;

	case "atualizar_tipo_combustivel":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoCombustivel = new TipoCombustivel($pdo);
			$objTipoCombustivel->setId($_REQUEST['id']);
			$objTipoCombustivel->setTipoCombustivel($_REQUEST['tipo_combustivel']);
			$objTipoCombustivel->Modificar();
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
		$template = "ajax.tipo_combustivel.php";
		break;

	case "listar_tipo_combustivel":
		$template = "tpl.geral.tipo_combustivel.php";
		break;

	case "listar_tipo_combustivel_autocomplete":
		$objtipo_combustivel = new TipoCombustivel();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objtipo_combustivel->BuscarAutoComplete($busca));
		$template = "ajax.tipo_combustivel.php";
		break;

	case "deletar_tipo_combustivel":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoCombustivel = new TipoCombustivel($pdo);
			$objTipoCombustivel->Remover($_REQUEST['registros']);
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
		$template = "ajax.tipo_combustivel.php";
		break;

	case "ajax_listar_tipo_combustivel":
		$template = "tpl.lis.tipo_combustivel.php";
		break;

	case "tipo_combustivel_pdf":
		$template = "tpl.lis.tipo_combustivel.pdf.php";
		break;

	case "tipo_combustivel_xlsx":
		$template = "tpl.lis.tipo_combustivel.xlsx.php";
		break;

	case "tipo_combustivel_print":
		$template = "tpl.lis.tipo_combustivel.print.php";
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
			$_SESSION["configuracao_usuario"]["tipo_combustivel"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("tipo_combustivel");
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
		$template = "ajax.tipo_combustivel.php";
		break;
}
