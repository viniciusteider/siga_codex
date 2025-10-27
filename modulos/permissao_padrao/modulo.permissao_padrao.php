<?php

switch($app_comando)
{
	case "frm_adicionar_permissao_padrao":
		$template = "tpl.frm.permissao_padrao.php";
		break;

	case "adicionar_permissao_padrao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {

            if(is_array($_POST['acoes']))
            {
                $objPermissaoPadrao = new PermissaoPadrao($pdo);
                $objPermissaoPadrao->Remover();
                foreach ($_POST['acoes'] as $permissao) {
                    if ($permissao[0] == 'j') {
                        continue;
                    }
                    $objPermissaoPadrao = new PermissaoPadrao($pdo);
                    $objPermissaoPadrao->setIdAcao($permissao);
                    $objPermissaoPadrao->setPadrao(1);
                    $objPermissaoPadrao->Adicionar();

                }
            }
            $objPermissaoPadrao->RemoverALLGrupos();
            $objPermissaoPadrao->AdicionarTodosGrupos();

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
		$template = "ajax.permissao_padrao.php";
		break;

	case "frm_atualizar_permissao_padrao" :
		$permissao_padrao = new PermissaoPadrao();
		$permissao_padrao->setId($_REQUEST["app_codigo"]);
		$linha = $permissao_padrao->Editar();
		$template = "tpl.frm.permissao_padrao.php";
		break;

	case "atualizar_permissao_padrao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPermissaoPadrao = new PermissaoPadrao($pdo);
			$objPermissaoPadrao->setId($_REQUEST['id']);
			$objPermissaoPadrao->setIdAcao($_REQUEST['id_acao']);
			$objPermissaoPadrao->setPadrao($_REQUEST['padrao']);
			$objPermissaoPadrao->Modificar();
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
		$template = "ajax.permissao_padrao.php";
		break;

	case "listar_permissao_padrao":
		$template = "tpl.geral.permissao_padrao.php";
		break;

	case "deletar_permissao_padrao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPermissaoPadrao = new PermissaoPadrao($pdo);
			$objPermissaoPadrao->Remover($_REQUEST['registros']);
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
		$template = "ajax.permissao_padrao.php";
		break;

	case "ajax_listar_permissao_padrao":
		$template = "tpl.lis.permissao_padrao.php";
		break;

	case "permissao_padrao_pdf":
		$template = "tpl.lis.permissao_padrao.pdf.php";
		break;

	case "permissao_padrao_xlsx":
		$template = "tpl.lis.permissao_padrao.xlsx.php";
		break;

	case "permissao_padrao_print":
		$template = "tpl.lis.permissao_padrao.print.php";
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
			$_SESSION["configuracao_usuario"]["permissao_padrao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("permissao_padrao");
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
		$template = "ajax.permissao_padrao.php";
		break;
}
