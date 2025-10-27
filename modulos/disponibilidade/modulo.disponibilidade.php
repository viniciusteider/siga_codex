<?php

switch($app_comando)
{
	case "frm_adicionar_disponibilidade":
		$template = "tpl.frm.disponibilidade.php";
		break;

	case "frm_modal_disponibilidade":
if($_REQUEST["app_codigo"] != "") {
		$disponibilidade = new Disponibilidade();
		$disponibilidade->setId($_REQUEST["app_codigo"]);
		$linha = $disponibilidade->Editar();
}		$template = "tpl.form.disponibilidade.php";
		break;

	case "adicionar_disponibilidade":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objDisponibilidade = new Disponibilidade($pdo);
			$objDisponibilidade->setNome($_REQUEST['nome']);
			$novoId = $objDisponibilidade->Adicionar();
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
		$template = "ajax.disponibilidade.php";
		break;

	case "frm_atualizar_disponibilidade" :
		$disponibilidade = new Disponibilidade();
		$disponibilidade->setId($_REQUEST["app_codigo"]);
		$linha = $disponibilidade->Editar();
		$template = "tpl.frm.disponibilidade.php";
		break;

	case "atualizar_disponibilidade":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objDisponibilidade = new Disponibilidade($pdo);
			$objDisponibilidade->setId($_REQUEST['id']);
			$objDisponibilidade->setNome($_REQUEST['nome']);
			$objDisponibilidade->Modificar();
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
		$template = "ajax.disponibilidade.php";
		break;

	case "listar_disponibilidade":
		$template = "tpl.geral.disponibilidade.simples.php";
		break;

	case "listar_disponibilidade_autocomplete":
		$objdisponibilidade = new Disponibilidade();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objdisponibilidade->BuscarAutoComplete($busca));
		$template = "ajax.disponibilidade.php";
		break;

	case "deletar_disponibilidade":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objDisponibilidade = new Disponibilidade($pdo);
			$objDisponibilidade->Remover($_REQUEST['registros']);
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
		$template = "ajax.disponibilidade.php";
		break;

	case "ajax_listar_disponibilidade":
		$template = "tpl.lis.disponibilidade.php";
		break;

	case "disponibilidade_pdf":
		$template = "tpl.lis.disponibilidade.pdf.php";
		break;

	case "disponibilidade_xlsx":
		$template = "tpl.lis.disponibilidade.xlsx.php";
		break;

	case "disponibilidade_print":
		$template = "tpl.lis.disponibilidade.print.php";
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
			$_SESSION["configuracao_usuario"]["disponibilidade"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("disponibilidade");
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
		$template = "ajax.disponibilidade.php";
		break;
}
