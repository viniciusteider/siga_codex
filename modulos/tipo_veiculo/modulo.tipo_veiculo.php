<?php

switch($app_comando)
{
	case "frm_adicionar_tipo_veiculo":
		$template = "tpl.frm.tipo_veiculo.php";
		break;

	case "frm_modal_tipo_veiculo":
if($_REQUEST["app_codigo"] != "") {
		$tipo_veiculo = new TipoVeiculo();
		$tipo_veiculo->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_veiculo->Editar();
}		$template = "tpl.form.tipo_veiculo.php";
		break;

	case "adicionar_tipo_veiculo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoVeiculo = new TipoVeiculo($pdo);
			$objTipoVeiculo->setNome($_REQUEST['nome']);
			$novoId = $objTipoVeiculo->Adicionar();
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
		$template = "ajax.tipo_veiculo.php";
		break;

	case "frm_atualizar_tipo_veiculo" :
		$tipo_veiculo = new TipoVeiculo();
		$tipo_veiculo->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_veiculo->Editar();
		$template = "tpl.frm.tipo_veiculo.php";
		break;

	case "atualizar_tipo_veiculo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoVeiculo = new TipoVeiculo($pdo);
			$objTipoVeiculo->setId($_REQUEST['id']);
			$objTipoVeiculo->setNome($_REQUEST['nome']);
			$objTipoVeiculo->Modificar();
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
		$template = "ajax.tipo_veiculo.php";
		break;

	case "listar_tipo_veiculo":
		$template = "tpl.geral.tipo_veiculo.php";
		break;

	case "listar_tipo_veiculo_autocomplete":
		$objtipo_veiculo = new TipoVeiculo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objtipo_veiculo->BuscarAutoComplete($busca));
		$template = "ajax.tipo_veiculo.php";
		break;

	case "deletar_tipo_veiculo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoVeiculo = new TipoVeiculo($pdo);
			$objTipoVeiculo->Remover($_REQUEST['registros']);
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
		$template = "ajax.tipo_veiculo.php";
		break;

	case "ajax_listar_tipo_veiculo":
		$template = "tpl.lis.tipo_veiculo.php";
		break;

	case "tipo_veiculo_pdf":
		$template = "tpl.lis.tipo_veiculo.pdf.php";
		break;

	case "tipo_veiculo_xlsx":
		$template = "tpl.lis.tipo_veiculo.xlsx.php";
		break;

	case "tipo_veiculo_print":
		$template = "tpl.lis.tipo_veiculo.print.php";
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
			$_SESSION["configuracao_usuario"]["tipo_veiculo"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("tipo_veiculo");
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
		$template = "ajax.tipo_veiculo.php";
		break;
}
