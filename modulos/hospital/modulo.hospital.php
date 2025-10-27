<?php

switch($app_comando)
{
	case "frm_adicionar_hospital":
		$template = "tpl.frm.hospital.php";
		break;

	case "adicionar_hospital":
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

			$objHospital = new Hospital($pdo);
			$objHospital->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objHospital->setNome($_REQUEST['nome']);
			$objHospital->setDiretor($_REQUEST['diretor']);
			$objHospital->setIdEndereco($idEndereco);
            $objHospital->setVagasLeitos($_REQUEST['vagas_leitos']);
            $objHospital->setVagasUti($_REQUEST['vagas_uti']);
			$objHospital->setComplexidade($_REQUEST['complexidade']);
			$objHospital->setStatus($_REQUEST['status']);
			$novoId = $objHospital->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
		$template = "ajax.hospital.php";
		break;

	case "frm_atualizar_hospital" :
		$hospital = new Hospital();
		$hospital->setId($_REQUEST["app_codigo"]);
		$linha = $hospital->Editar();
		$template = "tpl.frm.hospital.php";
		break;

	case "atualizar_hospital":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {

            $objEndereco = new Endereco($pdo);
            $objEndereco->setId($_REQUEST['id_endereco']);
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

			$objHospital = new Hospital($pdo);
			$objHospital->setId($_REQUEST['id']);
			$objHospital->setNome($_REQUEST['nome']);
			$objHospital->setDiretor($_REQUEST['diretor']);
            $objHospital->setVagasLeitos($_REQUEST['vagas_leitos']);
            $objHospital->setVagasUti($_REQUEST['vagas_uti']);
			$objHospital->setComplexidade($_REQUEST['complexidade']);
			$objHospital->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
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
		$template = "ajax.hospital.php";
		break;

	case "listar_hospital":
		$template = "tpl.geral.hospital.php";
		break;
    case "listar_hospital_autocomplete":
        $objhospital = new Hospital();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objhospital->BuscarAutoComplete($busca));
        $template = "ajax.hospital.php";
        break;

	case "deletar_hospital":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objHospital = new Hospital($pdo);
			$objHospital->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
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
		$template = "ajax.hospital.php";
		break;

	case "ajax_listar_hospital":
		$template = "tpl.lis.hospital.php";
		break;

	case "hospital_pdf":
		$template = "tpl.lis.hospital.pdf.php";
		break;

	case "hospital_xlsx":
		$template = "tpl.lis.hospital.xlsx.php";
		break;

	case "hospital_print":
		$template = "tpl.lis.hospital.print.php";
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
			$_SESSION["configuracao_usuario"]["hospital"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("hospital");
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
		$template = "ajax.hospital.php";
		break;
}
