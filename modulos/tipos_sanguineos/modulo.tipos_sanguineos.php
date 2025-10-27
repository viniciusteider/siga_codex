<?php

switch($app_comando)
{
	case "frm_adicionar_tipos_sanguineos":
		$template = "tpl.frm.tipos_sanguineos.php";
		break;

	case "frm_modal_tipos_sanguineos":
if($_REQUEST["app_codigo"] != "") {
		$tipos_sanguineos = new TiposSanguineos();
		$tipos_sanguineos->setId($_REQUEST["app_codigo"]);
		$linha = $tipos_sanguineos->Editar();
}		$template = "tpl.form.tipos_sanguineos.php";
		break;

	case "adicionar_tipos_sanguineos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTiposSanguineos = new TiposSanguineos($pdo);
			$objTiposSanguineos->setNome($_REQUEST['nome']);
			$novoId = $objTiposSanguineos->Adicionar();
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
		$template = "ajax.tipos_sanguineos.php";
		break;

	case "frm_atualizar_tipos_sanguineos" :
		$tipos_sanguineos = new TiposSanguineos();
		$tipos_sanguineos->setId($_REQUEST["app_codigo"]);
		$linha = $tipos_sanguineos->Editar();
		$template = "tpl.frm.tipos_sanguineos.php";
		break;

	case "atualizar_tipos_sanguineos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTiposSanguineos = new TiposSanguineos($pdo);
			$objTiposSanguineos->setId($_REQUEST['id']);
			$objTiposSanguineos->setNome($_REQUEST['nome']);
			$objTiposSanguineos->Modificar();
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
		$template = "ajax.tipos_sanguineos.php";
		break;

	case "listar_tipos_sanguineos":
		$template = "tpl.geral.tipos_sanguineos.php";
		break;

	case "listar_tipos_sanguineos_autocomplete":
		$objtipos_sanguineos = new TiposSanguineos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objtipos_sanguineos->BuscarAutoComplete($busca));
		$template = "ajax.tipos_sanguineos.php";
		break;

	case "deletar_tipos_sanguineos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTiposSanguineos = new TiposSanguineos($pdo);
			$objTiposSanguineos->Remover($_REQUEST['registros']);
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
		$template = "ajax.tipos_sanguineos.php";
		break;

	case "ajax_listar_tipos_sanguineos":
		$template = "tpl.lis.tipos_sanguineos.php";
		break;

	case "tipos_sanguineos_pdf":
		$template = "tpl.lis.tipos_sanguineos.pdf.php";
		break;

	case "tipos_sanguineos_xlsx":
		$template = "tpl.lis.tipos_sanguineos.xlsx.php";
		break;

	case "tipos_sanguineos_print":
		$template = "tpl.lis.tipos_sanguineos.print.php";
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
			$_SESSION["configuracao_usuario"]["tipos_sanguineos"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("tipos_sanguineos");
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
		$template = "ajax.tipos_sanguineos.php";
		break;
}
