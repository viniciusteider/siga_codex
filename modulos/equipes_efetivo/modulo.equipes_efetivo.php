<?php

switch($app_comando)
{
	case "frm_adicionar_equipes_efetivo":
		$template = "tpl.frm.equipes_efetivo.php";
		break;

	case "frm_modal_equipes_efetivo":
if($_REQUEST["app_codigo"] != "") {
		$equipes_efetivo = new EquipesEfetivo();
		$equipes_efetivo->setId($_REQUEST["app_codigo"]);
		$linha = $equipes_efetivo->Editar();
}		$template = "tpl.form.equipes_efetivo.php";
		break;

	case "adicionar_equipes_efetivo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEquipesEfetivo = new EquipesEfetivo($pdo);
			$objEquipesEfetivo->setIdEquipe($_REQUEST['id_equipe']);
			$objEquipesEfetivo->setIdEfetivo($_REQUEST['id_efetivo']);
			$objEquipesEfetivo->setOrdem($_REQUEST['ordem']);
			$novoId = $objEquipesEfetivo->Adicionar();
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
		$template = "ajax.equipes_efetivo.php";
		break;

	case "frm_atualizar_equipes_efetivo" :
		$equipes_efetivo = new EquipesEfetivo();
		$equipes_efetivo->setId($_REQUEST["app_codigo"]);
		$linha = $equipes_efetivo->Editar();
		$template = "tpl.frm.equipes_efetivo.php";
		break;

	case "atualizar_equipes_efetivo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEquipesEfetivo = new EquipesEfetivo($pdo);
			$objEquipesEfetivo->setId($_REQUEST['id']);
			$objEquipesEfetivo->setIdEquipe($_REQUEST['id_equipe']);
			$objEquipesEfetivo->setIdEfetivo($_REQUEST['id_efetivo']);
			$objEquipesEfetivo->setOrdem($_REQUEST['ordem']);
			$objEquipesEfetivo->Modificar();
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
		$template = "ajax.equipes_efetivo.php";
		break;

	case "listar_equipes_efetivo":
		$template = "tpl.geral.equipes_efetivo.php";
		break;

	case "listar_equipes_efetivo_autocomplete":
		$objequipes_efetivo = new EquipesEfetivo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objequipes_efetivo->BuscarAutoComplete($busca));
		$template = "ajax.equipes_efetivo.php";
		break;

	case "deletar_equipes_efetivo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEquipesEfetivo = new EquipesEfetivo($pdo);
			$objEquipesEfetivo->Remover($_REQUEST['registros']);
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
		$template = "ajax.equipes_efetivo.php";
		break;

	case "ajax_listar_equipes_efetivo":
		$template = "tpl.lis.equipes_efetivo.php";
		break;

	case "equipes_efetivo_pdf":
		$template = "tpl.lis.equipes_efetivo.pdf.php";
		break;

	case "equipes_efetivo_xlsx":
		$template = "tpl.lis.equipes_efetivo.xlsx.php";
		break;

	case "equipes_efetivo_print":
		$template = "tpl.lis.equipes_efetivo.print.php";
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
			$_SESSION["configuracao_usuario"]["equipes_efetivo"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("equipes_efetivo");
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
		$template = "ajax.equipes_efetivo.php";
		break;
}
