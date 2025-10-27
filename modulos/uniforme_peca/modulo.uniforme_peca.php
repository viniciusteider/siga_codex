<?php

switch($app_comando)
{
	case "frm_adicionar_uniforme_peca":
		$template = "tpl.frm.uniforme_peca.php";
		break;

	case "frm_modal_uniforme_peca":
if($_REQUEST["app_codigo"] != "") {
		$uniforme_peca = new UniformePeca();
		$uniforme_peca->setId($_REQUEST["app_codigo"]);
		$linha = $uniforme_peca->Editar();
}		$template = "tpl.form.uniforme_peca.php";
		break;

	case "adicionar_uniforme_peca":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objUniformePeca = new UniformePeca($pdo);
			$objUniformePeca->setIdUniformeGrupo($_REQUEST['id_uniforme_grupo']);
			$objUniformePeca->setNome($_REQUEST['nome']);
			$novoId = $objUniformePeca->Adicionar();
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
		$template = "ajax.uniforme_peca.php";
		break;

	case "frm_atualizar_uniforme_peca" :
		$uniforme_peca = new UniformePeca();
		$uniforme_peca->setId($_REQUEST["app_codigo"]);
		$linha = $uniforme_peca->Editar();
		$template = "tpl.frm.uniforme_peca.php";
		break;

	case "atualizar_uniforme_peca":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objUniformePeca = new UniformePeca($pdo);
			$objUniformePeca->setId($_REQUEST['id']);
			$objUniformePeca->setIdUniformeGrupo($_REQUEST['id_uniforme_grupo']);
			$objUniformePeca->setNome($_REQUEST['nome']);
			$objUniformePeca->Modificar();
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
		$template = "ajax.uniforme_peca.php";
		break;

	case "listar_uniforme_peca":
		$template = "tpl.geral.uniforme_peca.php";
		break;

	case "listar_uniforme_peca_autocomplete":
		$objuniforme_peca = new UniformePeca();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objuniforme_peca->BuscarAutoComplete($busca));
		$template = "ajax.uniforme_peca.php";
		break;

	case "deletar_uniforme_peca":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objUniformePeca = new UniformePeca($pdo);
			$objUniformePeca->Remover($_REQUEST['registros']);
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
		$template = "ajax.uniforme_peca.php";
		break;

	case "ajax_listar_uniforme_peca":
		$template = "tpl.lis.uniforme_peca.php";
		break;

	case "uniforme_peca_pdf":
		$template = "tpl.lis.uniforme_peca.pdf.php";
		break;

	case "uniforme_peca_xlsx":
		$template = "tpl.lis.uniforme_peca.xlsx.php";
		break;

	case "uniforme_peca_print":
		$template = "tpl.lis.uniforme_peca.print.php";
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
			$_SESSION["configuracao_usuario"]["uniforme_peca"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("uniforme_peca");
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
		$template = "ajax.uniforme_peca.php";
		break;
}
