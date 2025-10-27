<?php

switch($app_comando)
{
	case "frm_adicionar_pessoal":
		$template = "tpl.frm.pessoal.php";
		break;

	case "adicionar_pessoal":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoal = new Pessoal($pdo);
			$objPessoal->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objPessoal->setNome($_REQUEST['nome']);
			$objPessoal->setApelido($_REQUEST['apelido']);
			$objPessoal->setNomeMae($_REQUEST['nome_mae']);
			$objPessoal->setNomePai($_REQUEST['nome_pai']);
			$objPessoal->setDataNascimento($_REQUEST['data_nascimento']);
			$objPessoal->setNaturalidade($_REQUEST['naturalidade']);
			$objPessoal->setRg($_REQUEST['rg']);
			$objPessoal->setCpf($_REQUEST['cpf']);
			$objPessoal->setPis($_REQUEST['pis']);
			$objPessoal->setCnh($_REQUEST['cnh']);
			$objPessoal->setCategoriaCnh($_REQUEST['categoria_cnh']);
			$objPessoal->setValidadeCnh($_REQUEST['validade_cnh']);
			$objPessoal->setValidadeCve($_REQUEST['validade_cve']);
			$objPessoal->setGenero($_REQUEST['genero']);
			$objPessoal->setTipoSangue($_REQUEST['tipo_sangue']);
			$objPessoal->setIdFuncao($_REQUEST['id_funcao']);
			$objPessoal->setMatriculaFuncional($_REQUEST['matricula_funcional']);
			$objPessoal->setIdEndereco($_REQUEST['id_endereco']);
			$objPessoal->setDataInclusao($_REQUEST['data_inclusao']);
			$objPessoal->setFoto($_REQUEST['foto']);
			$objPessoal->setEmail($_REQUEST['email']);
			$objPessoal->setIdConsorcio($_REQUEST['id_consorcio']);
			$objPessoal->setIdBase($_REQUEST['id_base']);
			$objPessoal->setAltura($_REQUEST['altura']);
			$objPessoal->setPeso($_REQUEST['peso']);
			$objPessoal->setIdEtnia($_REQUEST['id_etnia']);
			$objPessoal->setIdRomaneio($_REQUEST['id_romaneio']);
			$objPessoal->setIdFormacao($_REQUEST['id_formacao']);
			$objPessoal->setDataHoraCdastro(Conexao::PrepararDataBD($_REQUEST['data_hora_cdastro']));
			$novoId = $objPessoal->Adicionar();
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
		$template = "ajax.pessoal.php";
		break;

	case "frm_atualizar_pessoal" :
		$pessoal = new Pessoal();
		$pessoal->setId($_REQUEST["app_codigo"]);
		$linha = $pessoal->Editar();
		$template = "tpl.frm.pessoal.php";
		break;

	case "atualizar_pessoal":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoal = new Pessoal($pdo);
			$objPessoal->setId($_REQUEST['id']);
			$objPessoal->setNome($_REQUEST['nome']);
			$objPessoal->setApelido($_REQUEST['apelido']);
			$objPessoal->setNomeMae($_REQUEST['nome_mae']);
			$objPessoal->setNomePai($_REQUEST['nome_pai']);
			$objPessoal->setDataNascimento($_REQUEST['data_nascimento']);
			$objPessoal->setNaturalidade($_REQUEST['naturalidade']);
			$objPessoal->setRg($_REQUEST['rg']);
			$objPessoal->setCpf($_REQUEST['cpf']);
			$objPessoal->setPis($_REQUEST['pis']);
			$objPessoal->setCnh($_REQUEST['cnh']);
			$objPessoal->setCategoriaCnh($_REQUEST['categoria_cnh']);
			$objPessoal->setValidadeCnh($_REQUEST['validade_cnh']);
			$objPessoal->setValidadeCve($_REQUEST['validade_cve']);
			$objPessoal->setGenero($_REQUEST['genero']);
			$objPessoal->setTipoSangue($_REQUEST['tipo_sangue']);
			$objPessoal->setIdFuncao($_REQUEST['id_funcao']);
			$objPessoal->setMatriculaFuncional($_REQUEST['matricula_funcional']);
			$objPessoal->setIdEndereco($_REQUEST['id_endereco']);
			$objPessoal->setDataInclusao($_REQUEST['data_inclusao']);
			$objPessoal->setFoto($_REQUEST['foto']);
			$objPessoal->setEmail($_REQUEST['email']);
			$objPessoal->setIdConsorcio($_REQUEST['id_consorcio']);
			$objPessoal->setIdBase($_REQUEST['id_base']);
			$objPessoal->setAltura($_REQUEST['altura']);
			$objPessoal->setPeso($_REQUEST['peso']);
			$objPessoal->setIdEtnia($_REQUEST['id_etnia']);
			$objPessoal->setIdRomaneio($_REQUEST['id_romaneio']);
			$objPessoal->setIdFormacao($_REQUEST['id_formacao']);
			$objPessoal->setDataHoraCdastro($_REQUEST['data_hora_cdastro']);
			$objPessoal->Modificar();
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
		$template = "ajax.pessoal.php";
		break;

	case "listar_pessoal":
		$template = "tpl.geral.pessoal.php";
		break;

	case "deletar_pessoal":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPessoal = new Pessoal($pdo);
			$objPessoal->Remover($_REQUEST['registros']);
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
		$template = "ajax.pessoal.php";
		break;

	case "ajax_listar_pessoal":
		$template = "tpl.lis.pessoal.php";
		break;

	case "pessoal_pdf":
		$template = "tpl.lis.pessoal.pdf.php";
		break;

	case "pessoal_xlsx":
		$template = "tpl.lis.pessoal.xlsx.php";
		break;

	case "pessoal_print":
		$template = "tpl.lis.pessoal.print.php";
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
			$_SESSION["configuracao_usuario"]["pessoal"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("pessoal");
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
		$template = "ajax.pessoal.php";
		break;
}
