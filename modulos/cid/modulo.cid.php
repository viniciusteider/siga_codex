<?php

switch($app_comando)
{
	case "frm_adicionar_cid":
		$template = "tpl.frm.cid.php";
		break;

	case "frm_modal_cid":
if($_REQUEST["app_codigo"] != "") {
		$cid = new Cid();
		$cid->setId($_REQUEST["app_codigo"]);
		$linha = $cid->Editar();
}		$template = "tpl.form.cid.php";
		break;

	case "adicionar_cid":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCid = new Cid($pdo);
			$objCid->setCapitulo($_REQUEST['capitulo']);
			$objCid->setAgrupamento($_REQUEST['agrupamento']);
			$objCid->setCategoria($_REQUEST['categoria']);
			$objCid->setSubCategoria($_REQUEST['sub_categoria']);
			$objCid->setCodigo($_REQUEST['codigo']);
			$objCid->setNome($_REQUEST['nome']);
			$novoId = $objCid->Adicionar();
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
		$template = "ajax.cid.php";
		break;

	case "frm_atualizar_cid" :
		$cid = new Cid();
		$cid->setId($_REQUEST["app_codigo"]);
		$linha = $cid->Editar();
		$template = "tpl.frm.cid.php";
		break;

	case "atualizar_cid":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCid = new Cid($pdo);
			$objCid->setId($_REQUEST['id']);
			$objCid->setCapitulo($_REQUEST['capitulo']);
			$objCid->setAgrupamento($_REQUEST['agrupamento']);
			$objCid->setCategoria($_REQUEST['categoria']);
			$objCid->setSubCategoria($_REQUEST['sub_categoria']);
			$objCid->setCodigo($_REQUEST['codigo']);
			$objCid->setNome($_REQUEST['nome']);
			$objCid->Modificar();
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
		$template = "ajax.cid.php";
		break;

	case "listar_cid":
		$template = "tpl.geral.cid.php";
		break;

	case "listar_cid_autocomplete":
		$objcid = new Cid();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objcid->BuscarAutoComplete($busca));
		$template = "ajax.cid.php";
		break;

	case "deletar_cid":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objCid = new Cid($pdo);
			$objCid->Remover($_REQUEST['registros']);
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
		$template = "ajax.cid.php";
		break;

	case "ajax_listar_cid":
		$template = "tpl.lis.cid.php";
		break;

	case "cid_pdf":
		$template = "tpl.lis.cid.pdf.php";
		break;

	case "cid_xlsx":
		$template = "tpl.lis.cid.xlsx.php";
		break;

	case "cid_print":
		$template = "tpl.lis.cid.print.php";
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
			$_SESSION["configuracao_usuario"]["cid"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("cid");
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
		$template = "ajax.cid.php";
		break;
}
