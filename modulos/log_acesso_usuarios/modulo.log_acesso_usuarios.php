<?

switch($app_comando)
{
	case "frm_adicionar_log_acesso_usuarios":
		$template = "tpl.frm.log_acesso_usuarios.php";
		break;

	case "adicionar_log_acesso_usuarios":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLogAcessoUsuarios = new LogAcessoUsuarios($pdo);
			$objLogAcessoUsuarios->setIdUsuario($_REQUEST['id_usuario']);
			$objLogAcessoUsuarios->setNomeUsuario($_REQUEST['nome_usuario']);
			$objLogAcessoUsuarios->setPagina($_REQUEST['pagina']);
			$objLogAcessoUsuarios->setIp($_REQUEST['ip']);
			$objLogAcessoUsuarios->setDados($_REQUEST['dados']);
			$objLogAcessoUsuarios->setDataHora($_REQUEST['data_hora']);
			$objLogAcessoUsuarios->setAplicativo($_REQUEST['aplicativo']);
			$novoId = $objLogAcessoUsuarios->Adicionar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO . " ". $e->getMessage();
			$msg["debug"] = $e->getMessage();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.log_acesso_usuarios.php";
		break;

	case "frm_atualizar_log_acesso_usuarios" :
		$log_acesso_usuarios = new LogAcessoUsuarios();
		$log_acesso_usuarios->setId($_REQUEST["app_codigo"]);
		$linha = $log_acesso_usuarios->Editar();
		$template = "tpl.frm.log_acesso_usuarios.php";
		break;

	case "atualizar_log_acesso_usuarios":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLogAcessoUsuarios = new LogAcessoUsuarios($pdo);
			$objLogAcessoUsuarios->setId($_REQUEST['id']);
			$objLogAcessoUsuarios->setIdUsuario($_REQUEST['id_usuario']);
			$objLogAcessoUsuarios->setNomeUsuario($_REQUEST['nome_usuario']);
			$objLogAcessoUsuarios->setPagina($_REQUEST['pagina']);
			$objLogAcessoUsuarios->setIp($_REQUEST['ip']);
			$objLogAcessoUsuarios->setDados($_REQUEST['dados']);
			$objLogAcessoUsuarios->setDataHora($_REQUEST['data_hora']);
			$objLogAcessoUsuarios->setAplicativo($_REQUEST['aplicativo']);
			$objLogAcessoUsuarios->Modificar();
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"] = $e->getMessage();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.log_acesso_usuarios.php";
		break;

	case "listar_log_acesso_usuarios":
		$template = "tpl.geral.log_acesso_usuarios.php";
		break;
    case "visualizar_log":
		$template = "tpl.viz.log_acesso_usuarios.php";
		break;

	case "deletar_log_acesso_usuarios":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objLogAcessoUsuarios = new LogAcessoUsuarios($pdo);
			$objLogAcessoUsuarios->Remover($_REQUEST['registros']);
			$msg["codigo"] = 0;
			$msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
			$pdo->commit();
		} catch (Exception $e) {
			$msg["codigo"] = 1;
			$msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO. " ". $e->getMessage();
			$msg["debug"] = $e->getMessage();
			$pdo->rollBack();
		}
		echo json_encode($msg);
		$template = "ajax.log_acesso_usuarios.php";
		break;

	case "ajax_listar_log_acesso_usuarios":
		$template = "tpl.lis.log_acesso_usuarios.php";
		break;

	case "log_acesso_usuarios_pdf":
		$template = "tpl.lis.log_acesso_usuarios.pdf.php";
		break;

	case "log_acesso_usuarios_xlsx":
		$template = "tpl.lis.log_acesso_usuarios.xlsx.php";
		break;

	case "log_acesso_usuarios_print":
		$template = "tpl.lis.log_acesso_usuarios.print.php";
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
			$_SESSION["configuracao_usuario"]["log_acesso_usuarios"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("log_acesso_usuarios");
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
		$template = "ajax.log_acesso_usuarios.php";
		break;
}
