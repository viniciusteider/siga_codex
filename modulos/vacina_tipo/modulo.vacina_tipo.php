<?php

switch($app_comando)
{
	case "frm_adicionar_vacina_tipo":
		$template = "tpl.frm.vacina_tipo.php";
		break;

	case "frm_modal_vacina_tipo":
if($_REQUEST["app_codigo"] != "") {
		$vacina_tipo = new VacinaTipo();
		$vacina_tipo->setId($_REQUEST["app_codigo"]);
		$linha = $vacina_tipo->Editar();
}		$template = "tpl.form.vacina_tipo.php";
		break;

	case "adicionar_vacina_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objVacinaTipo = new VacinaTipo($pdo);
			$objVacinaTipo->setNome($_REQUEST['nome']);
			$objVacinaTipo->setQtDoses($_REQUEST['qt_doses']);
			$objVacinaTipo->setIndicacao($_REQUEST['indicacao']);
			$objVacinaTipo->setIntervaloDoses($_REQUEST['intervalo_doses']);
			$novoId = $objVacinaTipo->Adicionar();
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
		$template = "ajax.vacina_tipo.php";
		break;

	case "frm_atualizar_vacina_tipo" :
		$vacina_tipo = new VacinaTipo();
		$vacina_tipo->setId($_REQUEST["app_codigo"]);
		$linha = $vacina_tipo->Editar();
		$template = "tpl.frm.vacina_tipo.php";
		break;

	case "atualizar_vacina_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objVacinaTipo = new VacinaTipo($pdo);
			$objVacinaTipo->setId($_REQUEST['id']);
			$objVacinaTipo->setNome($_REQUEST['nome']);
			$objVacinaTipo->setQtDoses($_REQUEST['qt_doses']);
			$objVacinaTipo->setIndicacao($_REQUEST['indicacao']);
			$objVacinaTipo->setIntervaloDoses($_REQUEST['intervalo_doses']);
			$objVacinaTipo->Modificar();
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
		$template = "ajax.vacina_tipo.php";
		break;

	case "listar_vacina_tipo":
		$template = "tpl.geral.vacina_tipo.php";
		break;

	case "listar_vacina_tipo_autocomplete":
		$objvacina_tipo = new VacinaTipo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objvacina_tipo->BuscarAutoComplete($busca));
		$template = "ajax.vacina_tipo.php";
		break;

	case "deletar_vacina_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objVacinaTipo = new VacinaTipo($pdo);
			$objVacinaTipo->Remover($_REQUEST['registros']);
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
		$template = "ajax.vacina_tipo.php";
		break;

	case "ajax_listar_vacina_tipo":
		$template = "tpl.lis.vacina_tipo.php";
		break;

	case "vacina_tipo_pdf":
		$template = "tpl.lis.vacina_tipo.pdf.php";
		break;

	case "vacina_tipo_xlsx":
		$template = "tpl.lis.vacina_tipo.xlsx.php";
		break;

	case "vacina_tipo_print":
		$template = "tpl.lis.vacina_tipo.print.php";
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
			$_SESSION["configuracao_usuario"]["vacina_tipo"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("vacina_tipo");
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
		$template = "ajax.vacina_tipo.php";
		break;
}
