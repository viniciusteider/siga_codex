<?php

switch($app_comando)
{
	case "frm_adicionar_escala_equipe":
		$template = "tpl.frm.escala_equipe.php";
		break;

	case "frm_modal_escala_equipe":
if($_REQUEST["app_codigo"] != "") {
		$escala_equipe = new EscalaEquipe();
		$escala_equipe->setId($_REQUEST["app_codigo"]);
		$linha = $escala_equipe->Editar();
}		$template = "tpl.form.escala_equipe.php";
		break;

	case "adicionar_escala_equipe":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaEquipe = new EscalaEquipe($pdo);
			$objEscalaEquipe->setIdEscala($_REQUEST['id_escala']);
			$objEscalaEquipe->setIdEfetivo($_REQUEST['id_efetivo']);
			$objEscalaEquipe->setIdFuncao($_REQUEST['id_funcao']);
			$objEscalaEquipe->setIdBase($_REQUEST['id_base']);
			$novoId = $objEscalaEquipe->Adicionar();
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
		$template = "ajax.escala_equipe.php";
		break;

	case "frm_atualizar_escala_equipe" :
		$escala_equipe = new EscalaEquipe();
		$escala_equipe->setId($_REQUEST["app_codigo"]);
		$linha = $escala_equipe->Editar();
		$template = "tpl.frm.escala_equipe.php";
		break;

	case "atualizar_escala_equipe":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaEquipe = new EscalaEquipe($pdo);
			$objEscalaEquipe->setId($_REQUEST['id']);
			$objEscalaEquipe->setIdEscala($_REQUEST['id_escala']);
			$objEscalaEquipe->setIdEfetivo($_REQUEST['id_efetivo']);
			$objEscalaEquipe->setIdFuncao($_REQUEST['id_funcao']);
			$objEscalaEquipe->setIdBase($_REQUEST['id_base']);
			$objEscalaEquipe->Modificar();
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
		$template = "ajax.escala_equipe.php";
		break;

	case "listar_escala_equipe":
		$template = "tpl.geral.escala_equipe.php";
		break;

	case "listar_escala_equipe_autocomplete":
		$objescala_equipe = new EscalaEquipe();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objescala_equipe->BuscarAutoComplete($busca));
		$template = "ajax.escala_equipe.php";
		break;

	case "deletar_escala_equipe":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaEquipe = new EscalaEquipe($pdo);
			$objEscalaEquipe->Remover($_REQUEST['registros']);
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
		$template = "ajax.escala_equipe.php";
		break;

	case "ajax_listar_escala_equipe":
		$template = "tpl.lis.escala_equipe.php";
		break;

	case "escala_equipe_pdf":
		$template = "tpl.lis.escala_equipe.pdf.php";
		break;

	case "escala_equipe_xlsx":
		$template = "tpl.lis.escala_equipe.xlsx.php";
		break;

	case "escala_equipe_print":
		$template = "tpl.lis.escala_equipe.print.php";
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
			$_SESSION["configuracao_usuario"]["escala_equipe"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("escala_equipe");
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
		$template = "ajax.escala_equipe.php";
		break;
}
