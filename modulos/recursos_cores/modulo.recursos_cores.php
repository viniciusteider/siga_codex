<?php

switch($app_comando)
{
	case "frm_adicionar_recursos_cores":
		$template = "tpl.frm.recursos_cores.php";
		break;

	case "frm_modal_recursos_cores":
if($_REQUEST["app_codigo"] != "") {
		$recursos_cores = new RecursosCores();
		$recursos_cores->setId($_REQUEST["app_codigo"]);
		$linha = $recursos_cores->Editar();
}		$template = "tpl.form.recursos_cores.php";
		break;

	case "adicionar_recursos_cores":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRecursosCores = new RecursosCores($pdo);
			$objRecursosCores->setNome($_REQUEST['nome']);
			$novoId = $objRecursosCores->Adicionar();
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
		$template = "ajax.recursos_cores.php";
		break;

	case "frm_atualizar_recursos_cores" :
		$recursos_cores = new RecursosCores();
		$recursos_cores->setId($_REQUEST["app_codigo"]);
		$linha = $recursos_cores->Editar();
		$template = "tpl.frm.recursos_cores.php";
		break;

	case "atualizar_recursos_cores":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRecursosCores = new RecursosCores($pdo);
			$objRecursosCores->setId($_REQUEST['id']);
			$objRecursosCores->setNome($_REQUEST['nome']);
			$objRecursosCores->Modificar();
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
		$template = "ajax.recursos_cores.php";
		break;

	case "listar_recursos_cores":
		$template = "tpl.geral.recursos_cores.php";
		break;

	case "listar_recursos_cores_autocomplete":
		$objrecursos_cores = new RecursosCores();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objrecursos_cores->BuscarAutoComplete($busca));
		$template = "ajax.recursos_cores.php";
		break;

	case "deletar_recursos_cores":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objRecursosCores = new RecursosCores($pdo);
			$objRecursosCores->Remover($_REQUEST['registros']);
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
		$template = "ajax.recursos_cores.php";
		break;

	case "ajax_listar_recursos_cores":
		$template = "tpl.lis.recursos_cores.php";
		break;

	case "recursos_cores_pdf":
		$template = "tpl.lis.recursos_cores.pdf.php";
		break;

	case "recursos_cores_xlsx":
		$template = "tpl.lis.recursos_cores.xlsx.php";
		break;

	case "recursos_cores_print":
		$template = "tpl.lis.recursos_cores.print.php";
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
			$_SESSION["configuracao_usuario"]["recursos_cores"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("recursos_cores");
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
		$template = "ajax.recursos_cores.php";
		break;
}
