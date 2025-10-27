<?php

switch($app_comando)
{
	case "frm_adicionar_usuario_efetivo":
		$template = "tpl.frm.usuario_efetivo.php";
		break;

	case "adicionar_usuario_efetivo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objUsuarioEfetivo = new UsuarioEfetivo($pdo);
			$objUsuarioEfetivo->setIdUsuario($_REQUEST['id_usuario']);
			$objUsuarioEfetivo->setApelido($_REQUEST['apelido']);
			$objUsuarioEfetivo->setNomeMae($_REQUEST['nome_mae']);
			$objUsuarioEfetivo->setNomePai($_REQUEST['nome_pai']);
			$objUsuarioEfetivo->setDataNascimento(Conexao::PrepararDataBD($_REQUEST['data_nascimento'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setNaturalidade($_REQUEST['naturalidade']);
			$objUsuarioEfetivo->setRg($_REQUEST['rg']);
			$objUsuarioEfetivo->setCpf($_REQUEST['cpf']);
			$objUsuarioEfetivo->setPis($_REQUEST['pis']);
			$objUsuarioEfetivo->setCnh($_REQUEST['cnh']);
			$objUsuarioEfetivo->setCategoriaCnh($_REQUEST['categoria_cnh']);
			$objUsuarioEfetivo->setValidadeCnh(Conexao::PrepararDataBD($_REQUEST['validade_cnh'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setValidadeCve(Conexao::PrepararDataBD($_REQUEST['validade_cve'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setGenero($_REQUEST['genero']);
			$objUsuarioEfetivo->setTipoSangue($_REQUEST['tipo_sangue']);
			$objUsuarioEfetivo->setIdFuncao($_REQUEST['id_funcao']);
			$objUsuarioEfetivo->setMatriculaFuncional($_REQUEST['matricula_funcional']);
			$objUsuarioEfetivo->setDataInclusao(Conexao::PrepararDataBD($_REQUEST['data_inclusao'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setIdConsorcio($_REQUEST['id_consorcio']);
			$objUsuarioEfetivo->setIdBase($_REQUEST['id_base']);
			$objUsuarioEfetivo->setAltura($_REQUEST['altura']);
			$objUsuarioEfetivo->setPeso($_REQUEST['peso']);
			$objUsuarioEfetivo->setIdEtnia($_REQUEST['id_etnia']);
			$objUsuarioEfetivo->setIdRomaneio($_REQUEST['id_romaneio']);
			$objUsuarioEfetivo->setIdFormacao($_REQUEST['id_formacao']);
			$novoId = $objUsuarioEfetivo->Adicionar();
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
		$template = "ajax.usuario_efetivo.php";
		break;

	case "frm_atualizar_usuario_efetivo" :
		$usuario_efetivo = new UsuarioEfetivo();
		$usuario_efetivo->setId($_REQUEST["app_codigo"]);
		$linha = $usuario_efetivo->Editar();
		$template = "tpl.frm.usuario_efetivo.php";
		break;

	case "atualizar_usuario_efetivo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objUsuarioEfetivo = new UsuarioEfetivo($pdo);
			$objUsuarioEfetivo->setId($_REQUEST['id']);
			$objUsuarioEfetivo->setIdUsuario($_REQUEST['id_usuario']);
			$objUsuarioEfetivo->setApelido($_REQUEST['apelido']);
			$objUsuarioEfetivo->setNomeMae($_REQUEST['nome_mae']);
			$objUsuarioEfetivo->setNomePai($_REQUEST['nome_pai']);
			$objUsuarioEfetivo->setDataNascimento(Conexao::PrepararDataBD($_REQUEST['data_nascimento'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setNaturalidade($_REQUEST['naturalidade']);
			$objUsuarioEfetivo->setRg($_REQUEST['rg']);
			$objUsuarioEfetivo->setCpf($_REQUEST['cpf']);
			$objUsuarioEfetivo->setPis($_REQUEST['pis']);
			$objUsuarioEfetivo->setCnh($_REQUEST['cnh']);
			$objUsuarioEfetivo->setCategoriaCnh($_REQUEST['categoria_cnh']);
			$objUsuarioEfetivo->setValidadeCnh(Conexao::PrepararDataBD($_REQUEST['validade_cnh'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setValidadeCve(Conexao::PrepararDataBD($_REQUEST['validade_cve'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setGenero($_REQUEST['genero']);
			$objUsuarioEfetivo->setTipoSangue($_REQUEST['tipo_sangue']);
			$objUsuarioEfetivo->setIdFuncao($_REQUEST['id_funcao']);
			$objUsuarioEfetivo->setMatriculaFuncional($_REQUEST['matricula_funcional']);
			$objUsuarioEfetivo->setDataInclusao(Conexao::PrepararDataBD($_REQUEST['data_inclusao'], $_SESSION['usuario']['timezone']));
			$objUsuarioEfetivo->setIdConsorcio($_REQUEST['id_consorcio']);
			$objUsuarioEfetivo->setIdBase($_REQUEST['id_base']);
			$objUsuarioEfetivo->setAltura($_REQUEST['altura']);
			$objUsuarioEfetivo->setPeso($_REQUEST['peso']);
			$objUsuarioEfetivo->setIdEtnia($_REQUEST['id_etnia']);
			$objUsuarioEfetivo->setIdRomaneio($_REQUEST['id_romaneio']);
			$objUsuarioEfetivo->setIdFormacao($_REQUEST['id_formacao']);
			$objUsuarioEfetivo->Modificar();
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
		$template = "ajax.usuario_efetivo.php";
		break;

	case "listar_usuario_efetivo":
		$template = "tpl.geral.usuario_efetivo.php";
		break;

	case "deletar_usuario_efetivo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objUsuarioEfetivo = new UsuarioEfetivo($pdo);
			$objUsuarioEfetivo->Remover($_REQUEST['registros']);
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
		$template = "ajax.usuario_efetivo.php";
		break;

	case "ajax_listar_usuario_efetivo":
		$template = "tpl.lis.usuario_efetivo.php";
		break;

	case "usuario_efetivo_pdf":
		$template = "tpl.lis.usuario_efetivo.pdf.php";
		break;

	case "usuario_efetivo_xlsx":
		$template = "tpl.lis.usuario_efetivo.xlsx.php";
		break;

	case "usuario_efetivo_print":
		$template = "tpl.lis.usuario_efetivo.print.php";
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
			$_SESSION["configuracao_usuario"]["usuario_efetivo"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("usuario_efetivo");
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
		$template = "ajax.usuario_efetivo.php";
		break;
}
