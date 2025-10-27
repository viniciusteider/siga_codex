<?

switch($app_comando)
{
	case "frm_adicionar_map_usuario_acao":
		$template = "tpl.frm.map_usuario_acao.php";
		break;

	case "adicionar_map_usuario_acao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objMapUsuarioAcao = new MapUsuarioAcao($pdo);
			$objMapUsuarioAcao->setIdUsuario($_REQUEST['id_usuario']);
			$objMapUsuarioAcao->setIdAcao($_REQUEST['id_acao']);
			$novoId = $objMapUsuarioAcao->Adicionar();
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
		$template = "ajax.map_usuario_acao.php";
		break;

	case "frm_atualizar_map_usuario_acao" :
		$map_usuario_acao = new MapUsuarioAcao();
		$map_usuario_acao->setId($_REQUEST["app_codigo"]);
		$linha = $map_usuario_acao->Editar();
		$template = "tpl.frm.map_usuario_acao.php";
		break;

	case "atualizar_map_usuario_acao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objMapUsuarioAcao = new MapUsuarioAcao($pdo);
			$objMapUsuarioAcao->setId($_REQUEST['id']);
			$objMapUsuarioAcao->setIdUsuario($_REQUEST['id_usuario']);
			$objMapUsuarioAcao->setIdAcao($_REQUEST['id_acao']);
			$objMapUsuarioAcao->Modificar();
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
		$template = "ajax.map_usuario_acao.php";
		break;

	case "listar_map_usuario_acao":
		$template = "tpl.geral.map_usuario_acao.php";
		break;

	case "deletar_map_usuario_acao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objMapUsuarioAcao = new MapUsuarioAcao($pdo);
			$objMapUsuarioAcao->Remover($_REQUEST['registros']);
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
		$template = "ajax.map_usuario_acao.php";
		break;

	case "ajax_listar_map_usuario_acao":
		$template = "tpl.lis.map_usuario_acao.php";
		break;

	case "map_usuario_acao_pdf":
		$template = "tpl.lis.map_usuario_acao.pdf.php";
		break;

	case "map_usuario_acao_xlsx":
		$template = "tpl.lis.map_usuario_acao.xlsx.php";
		break;

	case "map_usuario_acao_print":
		$template = "tpl.lis.map_usuario_acao.print.php";
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
			$_SESSION["configuracao_usuario"]["map_usuario_acao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("map_usuario_acao");
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
		$template = "ajax.map_usuario_acao.php";
		break;
}
