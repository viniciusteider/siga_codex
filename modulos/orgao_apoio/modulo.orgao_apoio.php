<?php

switch($app_comando)
{
	case "frm_adicionar_orgao_apoio":
		$template = "tpl.frm.orgao_apoio.php";
		break;

	case "frm_modal_orgao_apoio":
if($_REQUEST["app_codigo"] != "") {
		$orgao_apoio = new OrgaoApoio();
		$orgao_apoio->setId($_REQUEST["app_codigo"]);
		$linha = $orgao_apoio->Editar();
}		$template = "tpl.form.orgao_apoio.php";
		break;

	case "adicionar_orgao_apoio":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOrgaoApoio = new OrgaoApoio($pdo);
			$objOrgaoApoio->setNome($_REQUEST['nome']);
			$objOrgaoApoio->setAtivo($_REQUEST['ativo']);
			$novoId = $objOrgaoApoio->Adicionar();
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
		$template = "ajax.orgao_apoio.php";
		break;

	case "frm_atualizar_orgao_apoio" :
		$orgao_apoio = new OrgaoApoio();
		$orgao_apoio->setId($_REQUEST["app_codigo"]);
		$linha = $orgao_apoio->Editar();
		$template = "tpl.frm.orgao_apoio.php";
		break;

	case "atualizar_orgao_apoio":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOrgaoApoio = new OrgaoApoio($pdo);
			$objOrgaoApoio->setId($_REQUEST['id']);
			$objOrgaoApoio->setNome($_REQUEST['nome']);
			$objOrgaoApoio->setAtivo($_REQUEST['ativo']);
			$objOrgaoApoio->Modificar();
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
		$template = "ajax.orgao_apoio.php";
		break;

	case "listar_orgao_apoio":
		$template = "tpl.geral.orgao_apoio.php";
		break;

	case "listar_orgao_apoio_autocomplete":
		$objorgao_apoio = new OrgaoApoio();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objorgao_apoio->BuscarAutoComplete($busca));
		$template = "ajax.orgao_apoio.php";
		break;

	case "deletar_orgao_apoio":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objOrgaoApoio = new OrgaoApoio($pdo);
			$objOrgaoApoio->Remover($_REQUEST['registros']);
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
		$template = "ajax.orgao_apoio.php";
		break;

	case "ajax_listar_orgao_apoio":
		$template = "tpl.lis.orgao_apoio.php";
		break;

	case "orgao_apoio_pdf":
		$template = "tpl.lis.orgao_apoio.pdf.php";
		break;

	case "orgao_apoio_xlsx":
		$template = "tpl.lis.orgao_apoio.xlsx.php";
		break;

	case "orgao_apoio_print":
		$template = "tpl.lis.orgao_apoio.print.php";
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
			$_SESSION["configuracao_usuario"]["orgao_apoio"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("orgao_apoio");
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
		$template = "ajax.orgao_apoio.php";
		break;
}
