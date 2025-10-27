<?php

switch($app_comando)
{
	case "frm_adicionar_sinais_clinicos_obstetricia":
		$template = "tpl.frm.sinais_clinicos_obstetricia.php";
		break;

	case "frm_modal_sinais_clinicos_obstetricia":
if($_REQUEST["app_codigo"] != "") {
		$sinais_clinicos_obstetricia = new SinaisClinicosObstetricia();
		$sinais_clinicos_obstetricia->setId($_REQUEST["app_codigo"]);
		$linha = $sinais_clinicos_obstetricia->Editar();
}		$template = "tpl.form.sinais_clinicos_obstetricia.php";
		break;

	case "adicionar_sinais_clinicos_obstetricia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objSinaisClinicosObstetricia = new SinaisClinicosObstetricia($pdo);
			$objSinaisClinicosObstetricia->setIdEstagioParto($_REQUEST['id_estagio_parto']);
			$objSinaisClinicosObstetricia->setProcedimentos($_REQUEST['procedimentos']);
			$novoId = $objSinaisClinicosObstetricia->Adicionar();
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
		$template = "ajax.sinais_clinicos_obstetricia.php";
		break;

	case "frm_atualizar_sinais_clinicos_obstetricia" :
		$sinais_clinicos_obstetricia = new SinaisClinicosObstetricia();
		$sinais_clinicos_obstetricia->setId($_REQUEST["app_codigo"]);
		$linha = $sinais_clinicos_obstetricia->Editar();
		$template = "tpl.frm.sinais_clinicos_obstetricia.php";
		break;

	case "atualizar_sinais_clinicos_obstetricia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objSinaisClinicosObstetricia = new SinaisClinicosObstetricia($pdo);
			$objSinaisClinicosObstetricia->setId($_REQUEST['id']);
			$objSinaisClinicosObstetricia->setIdEstagioParto($_REQUEST['id_estagio_parto']);
			$objSinaisClinicosObstetricia->setProcedimentos($_REQUEST['procedimentos']);
			$objSinaisClinicosObstetricia->Modificar();
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
		$template = "ajax.sinais_clinicos_obstetricia.php";
		break;

	case "listar_sinais_clinicos_obstetricia":
		$template = "tpl.geral.sinais_clinicos_obstetricia.php";
		break;

	case "listar_sinais_clinicos_obstetricia_autocomplete":
		$objsinais_clinicos_obstetricia = new SinaisClinicosObstetricia();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objsinais_clinicos_obstetricia->BuscarAutoComplete($busca));
		$template = "ajax.sinais_clinicos_obstetricia.php";
		break;

	case "deletar_sinais_clinicos_obstetricia":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objSinaisClinicosObstetricia = new SinaisClinicosObstetricia($pdo);
			$objSinaisClinicosObstetricia->Remover($_REQUEST['registros']);
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
		$template = "ajax.sinais_clinicos_obstetricia.php";
		break;

	case "ajax_listar_sinais_clinicos_obstetricia":
		$template = "tpl.lis.sinais_clinicos_obstetricia.php";
		break;

	case "sinais_clinicos_obstetricia_pdf":
		$template = "tpl.lis.sinais_clinicos_obstetricia.pdf.php";
		break;

	case "sinais_clinicos_obstetricia_xlsx":
		$template = "tpl.lis.sinais_clinicos_obstetricia.xlsx.php";
		break;

	case "sinais_clinicos_obstetricia_print":
		$template = "tpl.lis.sinais_clinicos_obstetricia.print.php";
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
			$_SESSION["configuracao_usuario"]["sinais_clinicos_obstetricia"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("sinais_clinicos_obstetricia");
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
		$template = "ajax.sinais_clinicos_obstetricia.php";
		break;
}
