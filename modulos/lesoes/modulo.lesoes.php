<?php

switch($app_comando)
{
	case "frm_adicionar_lesoes":
		$template = "tpl.frm.lesoes.php";
		break;

	case "frm_modal_lesoes":
if($_REQUEST["app_codigo"] != "") {
		$lesoes = new Lesoes();
		$lesoes->setId($_REQUEST["app_codigo"]);
		$linha = $lesoes->Editar();
}		$template = "tpl.form.lesoes.php";
		break;

	case "adicionar_lesoes":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLesoes = new Lesoes($pdo);
			$objLesoes->setNome($_REQUEST['nome']);
			$novoId = $objLesoes->Adicionar();
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
		$template = "ajax.lesoes.php";
		break;

	case "frm_atualizar_lesoes" :
		$lesoes = new Lesoes();
		$lesoes->setId($_REQUEST["app_codigo"]);
		$linha = $lesoes->Editar();
		$template = "tpl.frm.lesoes.php";
		break;

	case "atualizar_lesoes":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLesoes = new Lesoes($pdo);
			$objLesoes->setId($_REQUEST['id']);
			$objLesoes->setNome($_REQUEST['nome']);
			$objLesoes->Modificar();
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
		$template = "ajax.lesoes.php";
		break;

	case "listar_lesoes":
		$template = "tpl.geral.lesoes.php";
		break;

	case "listar_lesoes_autocomplete":
		$objlesoes = new Lesoes();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objlesoes->BuscarAutoComplete($busca));
		$template = "ajax.lesoes.php";
		break;

	case "deletar_lesoes":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLesoes = new Lesoes($pdo);
			$objLesoes->Remover($_REQUEST['registros']);
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
		$template = "ajax.lesoes.php";
		break;

	case "ajax_listar_lesoes":
		$template = "tpl.lis.lesoes.php";
		break;

	case "lesoes_pdf":
		$template = "tpl.lis.lesoes.pdf.php";
		break;

	case "lesoes_xlsx":
		$template = "tpl.lis.lesoes.xlsx.php";
		break;

	case "lesoes_print":
		$template = "tpl.lis.lesoes.print.php";
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
			$_SESSION["configuracao_usuario"]["lesoes"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("lesoes");
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
		$template = "ajax.lesoes.php";
		break;
}
