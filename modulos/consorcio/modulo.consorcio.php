<?php

switch($app_comando)
{
	case "frm_adicionar_consorcio":
		$template = "tpl.frm.consorcio.php";
		break;

	case "adicionar_consorcio":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objConsorcio = new Consorcio($pdo);
			$objConsorcio->setIdConsorcio($_REQUEST['id_consorcio']);
			$objConsorcio->setNomeConsorcio($_REQUEST['nome_consorcio']);
			$objConsorcio->setCnpj($_REQUEST['cnpj']);
			$objConsorcio->setEndereco($_REQUEST['endereco']);
			$objConsorcio->setNrEndereco($_REQUEST['nr_endereco']);
			$objConsorcio->setLatitude($_REQUEST['latitude']);
			$objConsorcio->setLongitudde($_REQUEST['longitudde']);
			$objConsorcio->setSite($_REQUEST['site']);
			$objConsorcio->setEmail($_REQUEST['email']);
			$objConsorcio->setTeledne($_REQUEST['teledne']);
			$objConsorcio->setPresidente($_REQUEST['presidente']);
			$objConsorcio->setStatus($_REQUEST['status']);
			$novoId = $objConsorcio->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO . " ". $e->getMessage();
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.consorcio.php";
		break;

	case "frm_atualizar_consorcio" :
		$consorcio = new Consorcio();
		$consorcio->setId($_REQUEST["app_codigo"]);
		$linha = $consorcio->Editar();
		$template = "tpl.frm.consorcio.php";
		break;

	case "atualizar_consorcio":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objConsorcio = new Consorcio($pdo);
			$objConsorcio->setIdConsorcio($_REQUEST['id_consorcio']);
			$objConsorcio->setNomeConsorcio($_REQUEST['nome_consorcio']);
			$objConsorcio->setCnpj($_REQUEST['cnpj']);
			$objConsorcio->setEndereco($_REQUEST['endereco']);
			$objConsorcio->setNrEndereco($_REQUEST['nr_endereco']);
			$objConsorcio->setLatitude($_REQUEST['latitude']);
			$objConsorcio->setLongitudde($_REQUEST['longitudde']);
			$objConsorcio->setSite($_REQUEST['site']);
			$objConsorcio->setEmail($_REQUEST['email']);
			$objConsorcio->setTeledne($_REQUEST['teledne']);
			$objConsorcio->setPresidente($_REQUEST['presidente']);
			$objConsorcio->setStatus($_REQUEST['status']);
			$objConsorcio->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.consorcio.php";
		break;

	case "listar_consorcio":
		$template = "tpl.geral.consorcio.php";
		break;

	case "deletar_consorcio":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objConsorcio = new Consorcio($pdo);
			$objConsorcio->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"]["error"] = $e->getMessage();
			$msg["debug"]["file"] = $e->getFile();
			$msg["debug"]["line"] = $e->getLine();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.consorcio.php";
		break;

	case "ajax_listar_consorcio":
		$template = "tpl.lis.consorcio.php";
		break;

	case "consorcio_pdf":
		$template = "tpl.lis.consorcio.pdf.php";
		break;

	case "consorcio_xlsx":
		$template = "tpl.lis.consorcio.xlsx.php";
		break;

	case "consorcio_print":
		$template = "tpl.lis.consorcio.print.php";
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
			$_SESSION["configuracao_usuario"]["consorcio"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("consorcio");
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
				$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			} else {
				$msg["codigo"]   = 1;
				$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO;
			}
		} else {
			$msg["codigo"]   = 1;
			$msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
		}
		echo json_encode($msg);
		$template = "ajax.consorcio.php";
		break;
}
