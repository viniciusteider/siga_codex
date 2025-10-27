<?php

switch($app_comando)
{
	case "frm_adicionar_pessoal_punicao":
		$template = "tpl.frm.pessoal_punicao.php";
		break;

	case "frm_modal_pessoal_punicao":
if($_REQUEST["app_codigo"] != "") {
		$pessoal_punicao = new PessoalPunicao();
		$pessoal_punicao->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_punicao->Editar();
}		$template = "tpl.form.pessoal_punicao.php";
		break;

	case "adicionar_pessoal_punicao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalPunicao = new PessoalPunicao($pdo);
			$objPessoalPunicao->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalPunicao->setIdTipoPunicao($_REQUEST['id_tipo_punicao']);
			$objPessoalPunicao->setGradacao($_REQUEST['gradacao']);
			$objPessoalPunicao->setNrDias($_REQUEST['nr_dias']);
			$objPessoalPunicao->setDataPunicao(Conexao::PrepararDataBD($_REQUEST['data_punicao'], $_SESSION['usuario']['timezone']));
			$objPessoalPunicao->setObservacoes($_REQUEST['observacoes']);
			$novoId = $objPessoalPunicao->Adicionar();
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
		$template = "ajax.pessoal_punicao.php";
		break;

	case "frm_atualizar_pessoal_punicao" :
		$pessoal_punicao = new PessoalPunicao();
		$pessoal_punicao->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal_punicao->Editar();
		$template = "tpl.frm.pessoal_punicao.php";
		break;

	case "atualizar_pessoal_punicao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalPunicao = new PessoalPunicao($pdo);
			$objPessoalPunicao->setId($_REQUEST['id_punicao']);
			$objPessoalPunicao->setIdUsuario($_SESSION['USUARIO_EDIT']);
			$objPessoalPunicao->setIdTipoPunicao($_REQUEST['id_tipo_punicao']);
			$objPessoalPunicao->setGradacao($_REQUEST['gradacao']);
			$objPessoalPunicao->setNrDias($_REQUEST['nr_dias']);
			$objPessoalPunicao->setDataPunicao(Conexao::PrepararDataBD($_REQUEST['data_punicao'], $_SESSION['usuario']['timezone']));
			$objPessoalPunicao->setObservacoes($_REQUEST['observacoes']);
			$objPessoalPunicao->Modificar();
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
		$template = "ajax.pessoal_punicao.php";
		break;

	case "listar_pessoal_punicao":
		$template = "tpl.geral.pessoal_punicao.php";
		break;

	case "listar_pessoal_punicao_autocomplete":
		$objpessoal_punicao = new PessoalPunicao();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpessoal_punicao->BuscarAutoComplete($busca));
		$template = "ajax.pessoal_punicao.php";
		break;

	case "deletar_pessoal_punicao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoalPunicao = new PessoalPunicao($pdo);
			$objPessoalPunicao->Remover($_REQUEST['registros']);
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
		$template = "ajax.pessoal_punicao.php";
		break;

	case "ajax_listar_pessoal_punicao":
		$template = "tpl.lis.pessoal_punicao.php";
		break;

	case "pessoal_punicao_pdf":
		$template = "tpl.lis.pessoal_punicao.pdf.php";
		break;

	case "pessoal_punicao_xlsx":
		$template = "tpl.lis.pessoal_punicao.xlsx.php";
		break;

	case "pessoal_punicao_print":
		$template = "tpl.lis.pessoal_punicao.print.php";
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
			$_SESSION["configuracao_usuario"]["pessoal_punicao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pessoal_punicao");
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
		$template = "ajax.pessoal_punicao.php";
		break;
}
