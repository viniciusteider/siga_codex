<?php

switch($app_comando)
{
	case "frm_adicionar_escala_locais":
		$template = "tpl.frm.escala_locais.php";
		break;

	case "frm_modal_escala_locais":
if($_REQUEST["app_codigo"] != "") {
		$escala_locais = new EscalaLocais();
		$escala_locais->setId($_REQUEST["app_codigo"]);
		$linha = $escala_locais->Editar();
}		$template = "tpl.form.escala_locais.php";
		break;

	case "adicionar_escala_locais":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaLocais = new EscalaLocais($pdo);
			$objEscalaLocais->setNome($_REQUEST['nome']);
            $objEscalaLocais->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$novoId = $objEscalaLocais->Adicionar();
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
		$template = "ajax.escala_locais.php";
		break;

	case "frm_atualizar_escala_locais" :
		$escala_locais = new EscalaLocais();
		$escala_locais->setId($_REQUEST["app_codigo"]);
		$linha = $escala_locais->Editar();
		$template = "tpl.frm.escala_locais.php";
		break;

	case "atualizar_escala_locais":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaLocais = new EscalaLocais($pdo);
			$objEscalaLocais->setId($_REQUEST['id']);
			$objEscalaLocais->setNome($_REQUEST['nome']);
			$objEscalaLocais->Modificar();
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
		$template = "ajax.escala_locais.php";
		break;

	case "listar_escala_locais":
		$template = "tpl.geral.escala_locais.simples.php";
		break;

	case "listar_escala_locais_autocomplete":
		$objescala_locais = new EscalaLocais();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objescala_locais->BuscarAutoComplete($busca));
		$template = "ajax.escala_locais.php";
		break;

	case "deletar_escala_locais":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objEscalaLocais = new EscalaLocais($pdo);
			$objEscalaLocais->Remover($_REQUEST['registros']);
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
		$template = "ajax.escala_locais.php";
		break;

	case "ajax_listar_escala_locais":
		$template = "tpl.lis.escala_locais.php";
		break;

	case "escala_locais_pdf":
		$template = "tpl.lis.escala_locais.pdf.php";
		break;

	case "escala_locais_xlsx":
		$template = "tpl.lis.escala_locais.xlsx.php";
		break;

	case "escala_locais_print":
		$template = "tpl.lis.escala_locais.print.php";
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
			$_SESSION["configuracao_usuario"]["escala_locais"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("escala_locais");
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
		$template = "ajax.escala_locais.php";
		break;
}
