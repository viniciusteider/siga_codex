<?php

switch($app_comando)
{
	case "frm_adicionar_pupilas_sintomas":
		$template = "tpl.frm.pupilas_sintomas.php";
		break;

	case "frm_modal_pupilas_sintomas":
if($_REQUEST["app_codigo"] != "") {
		$pupilas_sintomas = new PupilasSintomas();
		$pupilas_sintomas->setId($_REQUEST["app_codigo"]);
		$linha = $pupilas_sintomas->Editar();
}		$template = "tpl.form.pupilas_sintomas.php";
		break;

	case "adicionar_pupilas_sintomas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPupilasSintomas = new PupilasSintomas($pdo);
			$objPupilasSintomas->setNome($_REQUEST['nome']);
			$novoId = $objPupilasSintomas->Adicionar();
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
		$template = "ajax.pupilas_sintomas.php";
		break;

	case "frm_atualizar_pupilas_sintomas" :
		$pupilas_sintomas = new PupilasSintomas();
		$pupilas_sintomas->setId($_REQUEST["app_codigo"]);
		$linha = $pupilas_sintomas->Editar();
		$template = "tpl.frm.pupilas_sintomas.php";
		break;

	case "atualizar_pupilas_sintomas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPupilasSintomas = new PupilasSintomas($pdo);
			$objPupilasSintomas->setId($_REQUEST['id']);
			$objPupilasSintomas->setNome($_REQUEST['nome']);
			$objPupilasSintomas->Modificar();
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
		$template = "ajax.pupilas_sintomas.php";
		break;

	case "listar_pupilas_sintomas":
		$template = "tpl.geral.pupilas_sintomas.php";
		break;

	case "listar_pupilas_sintomas_autocomplete":
		$objpupilas_sintomas = new PupilasSintomas();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpupilas_sintomas->BuscarAutoComplete($busca));
		$template = "ajax.pupilas_sintomas.php";
		break;

	case "deletar_pupilas_sintomas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPupilasSintomas = new PupilasSintomas($pdo);
			$objPupilasSintomas->Remover($_REQUEST['registros']);
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
		$template = "ajax.pupilas_sintomas.php";
		break;

	case "ajax_listar_pupilas_sintomas":
		$template = "tpl.lis.pupilas_sintomas.php";
		break;

	case "pupilas_sintomas_pdf":
		$template = "tpl.lis.pupilas_sintomas.pdf.php";
		break;

	case "pupilas_sintomas_xlsx":
		$template = "tpl.lis.pupilas_sintomas.xlsx.php";
		break;

	case "pupilas_sintomas_print":
		$template = "tpl.lis.pupilas_sintomas.print.php";
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
			$_SESSION["configuracao_usuario"]["pupilas_sintomas"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pupilas_sintomas");
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
		$template = "ajax.pupilas_sintomas.php";
		break;
}
