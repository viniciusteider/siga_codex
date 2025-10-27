<?php

switch($app_comando)
{
	case "frm_adicionar_tipo_punicao":
		$template = "tpl.frm.tipo_punicao.php";
		break;

	case "frm_modal_tipo_punicao":
if($_REQUEST["app_codigo"] != "") {
		$tipo_punicao = new TipoPunicao();
		$tipo_punicao->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_punicao->Editar();
}		$template = "tpl.form.tipo_punicao.php";
		break;

	case "adicionar_tipo_punicao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoPunicao = new TipoPunicao($pdo);
			$objTipoPunicao->setNome($_REQUEST['nome']);
			$novoId = $objTipoPunicao->Adicionar();
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
		$template = "ajax.tipo_punicao.php";
		break;

	case "frm_atualizar_tipo_punicao" :
		$tipo_punicao = new TipoPunicao();
		$tipo_punicao->setId($_REQUEST["app_codigo"]);
		$linha = $tipo_punicao->Editar();
		$template = "tpl.frm.tipo_punicao.php";
		break;

	case "atualizar_tipo_punicao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoPunicao = new TipoPunicao($pdo);
			$objTipoPunicao->setId($_REQUEST['id']);
			$objTipoPunicao->setNome($_REQUEST['nome']);
			$objTipoPunicao->Modificar();
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
		$template = "ajax.tipo_punicao.php";
		break;

	case "listar_tipo_punicao":
		$template = "tpl.geral.tipo_punicao.php";
		break;

	case "listar_tipo_punicao_autocomplete":
		$objtipo_punicao = new TipoPunicao();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objtipo_punicao->BuscarAutoComplete($busca));
		$template = "ajax.tipo_punicao.php";
		break;

	case "deletar_tipo_punicao":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objTipoPunicao = new TipoPunicao($pdo);
			$objTipoPunicao->Remover($_REQUEST['registros']);
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
		$template = "ajax.tipo_punicao.php";
		break;

	case "ajax_listar_tipo_punicao":
		$template = "tpl.lis.tipo_punicao.php";
		break;

	case "tipo_punicao_pdf":
		$template = "tpl.lis.tipo_punicao.pdf.php";
		break;

	case "tipo_punicao_xlsx":
		$template = "tpl.lis.tipo_punicao.xlsx.php";
		break;

	case "tipo_punicao_print":
		$template = "tpl.lis.tipo_punicao.print.php";
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
			$_SESSION["configuracao_usuario"]["tipo_punicao"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("tipo_punicao");
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
		$template = "ajax.tipo_punicao.php";
		break;
}
