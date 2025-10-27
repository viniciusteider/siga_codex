<?php

switch($app_comando)
{
	case "frm_adicionar_instituicao_ensino":
		$template = "tpl.frm.instituicao_ensino.php";
		break;

	case "frm_modal_instituicao_ensino":
if($_REQUEST["app_codigo"] != "") {
		$instituicao_ensino = new InstituicaoEnsino();
		$instituicao_ensino->setId($_REQUEST["app_codigo"]);
		$linha = $instituicao_ensino->Editar();
}		$template = "tpl.form.instituicao_ensino.php";
		break;

	case "adicionar_instituicao_ensino":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objInstituicaoEnsino = new InstituicaoEnsino($pdo);
			$objInstituicaoEnsino->setIdEndereco($_REQUEST['id_endereco']);
			$objInstituicaoEnsino->setIdEstado($_REQUEST['id_estado']);
			$objInstituicaoEnsino->setIdCidade($_REQUEST['id_cidade']);
			$objInstituicaoEnsino->setNomeInstituicao($_REQUEST['nome_instituicao']);
			$objInstituicaoEnsino->setDependencia($_REQUEST['dependencia']);
			$objInstituicaoEnsino->setInstituicao($_REQUEST['instituicao']);
			$novoId = $objInstituicaoEnsino->Adicionar();
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
		$template = "ajax.instituicao_ensino.php";
		break;

	case "frm_atualizar_instituicao_ensino" :
		$instituicao_ensino = new InstituicaoEnsino();
		$instituicao_ensino->setId($_REQUEST["app_codigo"]);
		$linha = $instituicao_ensino->Editar();
		$template = "tpl.frm.instituicao_ensino.php";
		break;

	case "atualizar_instituicao_ensino":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objInstituicaoEnsino = new InstituicaoEnsino($pdo);
			$objInstituicaoEnsino->setId($_REQUEST['id']);
			$objInstituicaoEnsino->setIdEndereco($_REQUEST['id_endereco']);
			$objInstituicaoEnsino->setIdEstado($_REQUEST['id_estado']);
			$objInstituicaoEnsino->setIdCidade($_REQUEST['id_cidade']);
			$objInstituicaoEnsino->setNomeInstituicao($_REQUEST['nome_instituicao']);
			$objInstituicaoEnsino->setDependencia($_REQUEST['dependencia']);
			$objInstituicaoEnsino->setInstituicao($_REQUEST['instituicao']);
			$objInstituicaoEnsino->Modificar();
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
		$template = "ajax.instituicao_ensino.php";
		break;

	case "listar_instituicao_ensino":
		$template = "tpl.geral.instituicao_ensino.php";
		break;

	case "listar_instituicao_ensino_autocomplete":
		$objinstituicao_ensino = new InstituicaoEnsino();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objinstituicao_ensino->BuscarAutoComplete($busca));
		$template = "ajax.instituicao_ensino.php";
		break;

	case "deletar_instituicao_ensino":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objInstituicaoEnsino = new InstituicaoEnsino($pdo);
			$objInstituicaoEnsino->Remover($_REQUEST['registros']);
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
		$template = "ajax.instituicao_ensino.php";
		break;

	case "ajax_listar_instituicao_ensino":
		$template = "tpl.lis.instituicao_ensino.php";
		break;

	case "instituicao_ensino_pdf":
		$template = "tpl.lis.instituicao_ensino.pdf.php";
		break;

	case "instituicao_ensino_xlsx":
		$template = "tpl.lis.instituicao_ensino.xlsx.php";
		break;

	case "instituicao_ensino_print":
		$template = "tpl.lis.instituicao_ensino.print.php";
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
			$_SESSION["configuracao_usuario"]["instituicao_ensino"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("instituicao_ensino");
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
		$template = "ajax.instituicao_ensino.php";
		break;
}
