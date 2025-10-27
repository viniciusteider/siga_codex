<?php

switch($app_comando)
{
	case "frm_adicionar_fipe_marcas":
		$template = "tpl.frm.fipe_marcas.php";
		break;

	case "frm_modal_fipe_marcas":
if($_REQUEST["app_codigo"] != "") {
		$fipe_marcas = new FipeMarcas();
		$fipe_marcas->setId($_REQUEST["app_codigo"]);
		$linha = $fipe_marcas->Editar();
}		$template = "tpl.form.fipe_marcas.php";
		break;

	case "adicionar_fipe_marcas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFipeMarcas = new FipeMarcas($pdo);
			$objFipeMarcas->setIdFipeTipo($_REQUEST['id_fipe_tipo']);
			$objFipeMarcas->setCodigoMarca($_REQUEST['codigo_marca']);
			$objFipeMarcas->setNome($_REQUEST['nome']);
			$novoId = $objFipeMarcas->Adicionar();
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
		$template = "ajax.fipe_marcas.php";
		break;

	case "frm_atualizar_fipe_marcas" :
		$fipe_marcas = new FipeMarcas();
		$fipe_marcas->setId($_REQUEST["app_codigo"]);
		$linha = $fipe_marcas->Editar();
		$template = "tpl.frm.fipe_marcas.php";
		break;

	case "atualizar_fipe_marcas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFipeMarcas = new FipeMarcas($pdo);
			$objFipeMarcas->setId($_REQUEST['id']);
			$objFipeMarcas->setIdFipeTipo($_REQUEST['id_fipe_tipo']);
			$objFipeMarcas->setCodigoMarca($_REQUEST['codigo_marca']);
			$objFipeMarcas->setNome($_REQUEST['nome']);
			$objFipeMarcas->Modificar();
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
		$template = "ajax.fipe_marcas.php";
		break;

	case "listar_fipe_marcas":
		$template = "tpl.geral.fipe_marcas.php";
		break;

	case "listar_fipe_marcas_autocomplete":
		$objfipe_marcas = new FipeMarcas();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objfipe_marcas->BuscarAutoComplete($busca,$_REQUEST['filtro']));
		$template = "ajax.fipe_marcas.php";
		break;

	case "deletar_fipe_marcas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objFipeMarcas = new FipeMarcas($pdo);
			$objFipeMarcas->Remover($_REQUEST['registros']);
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
		$template = "ajax.fipe_marcas.php";
		break;

	case "ajax_listar_fipe_marcas":
		$template = "tpl.lis.fipe_marcas.php";
		break;

	case "fipe_marcas_pdf":
		$template = "tpl.lis.fipe_marcas.pdf.php";
		break;

	case "fipe_marcas_xlsx":
		$template = "tpl.lis.fipe_marcas.xlsx.php";
		break;

	case "fipe_marcas_print":
		$template = "tpl.lis.fipe_marcas.print.php";
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
			$_SESSION["configuracao_usuario"]["fipe_marcas"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("fipe_marcas");
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
		$template = "ajax.fipe_marcas.php";
		break;
}
