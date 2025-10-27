<?php

switch($app_comando)
{
	case "frm_adicionar_tipo_afastamento":
		$template = "tpl.frm.tipo_afastamento.php";
		break;

	case "frm_modal_tipo_afastamento":
if($_REQUEST["app_codigo"] != "") {
		$tipo_afastamento = new TipoAfastamento();
		$tipo_afastamento->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_afastamento->Editar();
}		$template = "tpl.form.tipo_afastamento.php";
		break;

	case "adicionar_tipo_afastamento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoAfastamento = new TipoAfastamento($pdo);
			$objTipoAfastamento->setNome($_REQUEST['nome']);
			$novoId = $objTipoAfastamento->Adicionar();
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
		$template = "ajax.tipo_afastamento.php";
		break;

	case "frm_atualizar_tipo_afastamento" :
		$tipo_afastamento = new TipoAfastamento();
		$tipo_afastamento->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_afastamento->Editar();
		$template = "tpl.frm.tipo_afastamento.php";
		break;

	case "atualizar_tipo_afastamento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoAfastamento = new TipoAfastamento($pdo);
			$objTipoAfastamento->setId($_REQUEST['id']);
			$objTipoAfastamento->setNome($_REQUEST['nome']);
			$objTipoAfastamento->Modificar();
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
		$template = "ajax.tipo_afastamento.php";
		break;

	case "listar_tipo_afastamento":
		$template = "tpl.geral.tipo_afastamento.php";
		break;

	case "listar_tipo_afastamento_autocomplete":
		$objtipo_afastamento = new TipoAfastamento();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objtipo_afastamento->BuscarAutoComplete($busca));
		$template = "ajax.tipo_afastamento.php";
		break;

	case "deletar_tipo_afastamento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoAfastamento = new TipoAfastamento($pdo);
			$objTipoAfastamento->Remover($_REQUEST['registros']);
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
		$template = "ajax.tipo_afastamento.php";
		break;

	case "ajax_listar_tipo_afastamento":
		$template = "tpl.lis.tipo_afastamento.php";
		break;

	case "tipo_afastamento_pdf":
		$template = "tpl.lis.tipo_afastamento.pdf.php";
		break;

	case "tipo_afastamento_xlsx":
		$template = "tpl.lis.tipo_afastamento.xlsx.php";
		break;

	case "tipo_afastamento_print":
		$template = "tpl.lis.tipo_afastamento.print.php";
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
			$_SESSION["configuracao_usuario"]["tipo_afastamento"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("tipo_afastamento");
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
		$template = "ajax.tipo_afastamento.php";
		break;
}
