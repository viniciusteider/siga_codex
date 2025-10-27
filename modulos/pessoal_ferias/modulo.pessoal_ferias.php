<?php

switch($app_comando)
{
	case "frm_adicionar_pessoal_ferias":
		$template = "tpl.frm.pessoal_ferias.php";
		break;

	case "frm_modal_pessoal_ferias":
    if($_REQUEST["app_codigo"] != "") {
            $pessoal_ferias = new PessoalFerias();
            $pessoal_ferias->setId($_REQUEST["app_codigo"]);
            $linha = $pessoal_ferias->Editar();
    }
    $template = "tpl.form.pessoal_ferias.php";
		break;

	case "adicionar_pessoal_ferias":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalFerias = new PessoalFerias($pdo);
			$objPessoalFerias->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalFerias->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
			$objPessoalFerias->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
			$objPessoalFerias->setObservacoes($_REQUEST['observacoes']);
			$novoId = $objPessoalFerias->Adicionar();
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
		$template = "ajax.pessoal_ferias.php";
		break;

	case "frm_atualizar_pessoal_ferias" :
		$pessoal_ferias = new PessoalFerias();
		$pessoal_ferias->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_ferias->Editar();
		$template = "tpl.frm.pessoal_ferias.php";
		break;

	case "atualizar_pessoal_ferias":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalFerias = new PessoalFerias($pdo);
			$objPessoalFerias->setId($_REQUEST['id_ferias']);
			$objPessoalFerias->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalFerias->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
			$objPessoalFerias->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
			$objPessoalFerias->setObservacoes($_REQUEST['observacoes']);
			$objPessoalFerias->Modificar();
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
		$template = "ajax.pessoal_ferias.php";
		break;

	case "listar_pessoal_ferias":
		$template = "tpl.geral.pessoal_ferias.php";
		break;

	case "listar_pessoal_ferias_autocomplete":
		$objpessoal_ferias = new PessoalFerias();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpessoal_ferias->BuscarAutoComplete($busca));
		$template = "ajax.pessoal_ferias.php";
		break;

	case "deletar_pessoal_ferias":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalFerias = new PessoalFerias($pdo);
			$objPessoalFerias->Remover($_REQUEST['registros']);
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
		$template = "ajax.pessoal_ferias.php";
		break;

	case "ajax_listar_pessoal_ferias":
		$template = "tpl.lis.pessoal_ferias.php";
		break;

	case "pessoal_ferias_pdf":
		$template = "tpl.lis.pessoal_ferias.pdf.php";
		break;

	case "pessoal_ferias_xlsx":
		$template = "tpl.lis.pessoal_ferias.xlsx.php";
		break;

	case "pessoal_ferias_print":
		$template = "tpl.lis.pessoal_ferias.print.php";
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
			$_SESSION["configuracao_usuario"]["pessoal_ferias"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pessoal_ferias");
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
		$template = "ajax.pessoal_ferias.php";
		break;
}
