<?php

switch($app_comando)
{
	case "frm_adicionar_pessoal_dispensas":
		$template = "tpl.frm.pessoal_dispensas.php";
		break;

	case "frm_modal_pessoal_dispensas":
if($_REQUEST["app_codigo"] != "") {
		$pessoal_dispensas = new PessoalDispensas();
		$pessoal_dispensas->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_dispensas->Editar();
}		$template = "tpl.form.pessoal_dispensas.php";
		break;

	case "adicionar_pessoal_dispensas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalDispensas = new PessoalDispensas($pdo);
			$objPessoalDispensas->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalDispensas->setIdTipoDispensa($_REQUEST['id_tipo_dispensa']);
			$objPessoalDispensas->setMotivo($_REQUEST['motivo']);
			$objPessoalDispensas->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
			$objPessoalDispensas->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
			$objPessoalDispensas->setObservacao($_REQUEST['observacao']);
			$novoId = $objPessoalDispensas->Adicionar();
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
		$template = "ajax.pessoal_dispensas.php";
		break;

	case "frm_atualizar_pessoal_dispensas" :
		$pessoal_dispensas = new PessoalDispensas();
		$pessoal_dispensas->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_dispensas->Editar();
		$template = "tpl.frm.pessoal_dispensas.php";
		break;

	case "atualizar_pessoal_dispensas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalDispensas = new PessoalDispensas($pdo);
			$objPessoalDispensas->setId($_REQUEST['id_dispensa']);
			$objPessoalDispensas->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalDispensas->setIdTipoDispensa($_REQUEST['id_tipo_dispensa']);
			$objPessoalDispensas->setMotivo($_REQUEST['motivo']);
			$objPessoalDispensas->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
			$objPessoalDispensas->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
			$objPessoalDispensas->setObservacao($_REQUEST['observacao']);
			$objPessoalDispensas->Modificar();
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
		$template = "ajax.pessoal_dispensas.php";
		break;

	case "listar_pessoal_dispensas":
		$template = "tpl.geral.pessoal_dispensas.php";
		break;

	case "listar_pessoal_dispensas_autocomplete":
		$objpessoal_dispensas = new PessoalDispensas();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpessoal_dispensas->BuscarAutoComplete($busca));
		$template = "ajax.pessoal_dispensas.php";
		break;

	case "deletar_pessoal_dispensas":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalDispensas = new PessoalDispensas($pdo);
			$objPessoalDispensas->Remover($_REQUEST['registros']);
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
		$template = "ajax.pessoal_dispensas.php";
		break;

	case "ajax_listar_pessoal_dispensas":
		$template = "tpl.lis.pessoal_dispensas.php";
		break;

	case "pessoal_dispensas_pdf":
		$template = "tpl.lis.pessoal_dispensas.pdf.php";
		break;

	case "pessoal_dispensas_xlsx":
		$template = "tpl.lis.pessoal_dispensas.xlsx.php";
		break;

	case "pessoal_dispensas_print":
		$template = "tpl.lis.pessoal_dispensas.print.php";
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
			$_SESSION["configuracao_usuario"]["pessoal_dispensas"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pessoal_dispensas");
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
		$template = "ajax.pessoal_dispensas.php";
		break;
}
