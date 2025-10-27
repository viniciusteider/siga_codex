<?php

switch($app_comando)
{
	case "frm_adicionar_base":
		$template = "tpl.frm.base.php";
		break;

	case "adicionar_base":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
            $objEndereco = new Endereco($pdo);
            $objEndereco->setLogradouro($_REQUEST['logradouro']);
            $objEndereco->setNumero($_REQUEST['numero']);
            $objEndereco->setComplemento($_REQUEST['complemento']);
            $objEndereco->setBairro($_REQUEST['bairro']);
            $objEndereco->setCidade($_REQUEST['cidade']);
            $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            $objEndereco->setEstado($_REQUEST['estado']);
            $objEndereco->setCep($_REQUEST['cep']);
            $objEndereco->setReferencia($_REQUEST['referencia']);
            $objEndereco->setObservacao($_REQUEST['observacao']);
            $objEndereco->setTelefone($_REQUEST['telefone']);
            $objEndereco->setComercial($_REQUEST['comercial']);
            $objEndereco->setCelular($_REQUEST['celular']);
            $objEndereco->setEmail($_REQUEST['email']);
            $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            $objEndereco->setLatitude($_REQUEST['latitude']);
            $objEndereco->setLongitude($_REQUEST['longitude']);
            $idEndereco = $objEndereco->Adicionar();

			$objBase = new Base($pdo);
			$objBase->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objBase->setNome($_REQUEST['nome']);
			$objBase->setIdEndereco($idEndereco);
			$novoId = $objBase->Adicionar();

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
		$template = "ajax.base.php";
		break;

	case "frm_atualizar_base" :
		$base = new Base();
		$base->setId($_REQUEST["app_codigo"]);
		$linha = $base->Editar();
		$template = "tpl.frm.base.php";
		break;

	case "atualizar_base":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
            $objEndereco = new Endereco($pdo);
            $objEndereco->setId($_POST['id_endereco']);
            $objEndereco->setLogradouro($_REQUEST['logradouro']);
            $objEndereco->setNumero($_REQUEST['numero']);
            $objEndereco->setComplemento($_REQUEST['complemento']);
            $objEndereco->setBairro($_REQUEST['bairro']);
            $objEndereco->setCidade($_REQUEST['cidade']);
            $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            $objEndereco->setEstado($_REQUEST['estado']);
            $objEndereco->setCep($_REQUEST['cep']);
            $objEndereco->setReferencia($_REQUEST['referencia']);
            $objEndereco->setObservacao($_REQUEST['observacao']);
            $objEndereco->setTelefone($_REQUEST['telefone']);
            $objEndereco->setComercial($_REQUEST['comercial']);
            $objEndereco->setCelular($_REQUEST['celular']);
            $objEndereco->setEmail($_REQUEST['email']);
            $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            $objEndereco->setLatitude($_REQUEST['latitude']);
            $objEndereco->setLongitude($_REQUEST['longitude']);
            $objEndereco->Modificar();

			$objBase = new Base($pdo);
			$objBase->setId($_REQUEST['id']);
			$objBase->setNome($_REQUEST['nome']);
			$objBase->Modificar();
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
		$template = "ajax.base.php";
		break;
    case "listar_bases_auto_complete":
		$template = "ajax.base.php";
		break;

	case "listar_base":
		$template = "tpl.geral.base.php";
		break;

	case "deletar_base":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objBase = new Base($pdo);
			$objBase->Remover($_REQUEST['registros']);
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
		$template = "ajax.base.php";
		break;

	case "ajax_listar_base":
		$template = "tpl.lis.base.php";
		break;

	case "base_pdf":
		$template = "tpl.lis.base.pdf.php";
		break;

	case "base_xlsx":
		$template = "tpl.lis.base.xlsx.php";
		break;

	case "base_print":
		$template = "tpl.lis.base.print.php";
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
			$_SESSION["configuracao_usuario"]["base"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("base");
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
		$template = "ajax.base.php";
		break;
}
