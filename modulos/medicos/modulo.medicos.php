<?php

switch($app_comando)
{
	case "frm_adicionar_medicos":
		$template = "tpl.frm.medicos.php";
		break;

	case "frm_modal_medicos":
if($_REQUEST["app_codigo"] != "") {
		$medicos = new Medicos();
		$medicos->setId($_REQUEST["app_codigo"]);
		$linha = $medicos->Editar();
}		$template = "tpl.form.medicos.php";
		break;

	case "adicionar_medicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objMedicos = new Medicos($pdo);
			$objMedicos->setCrm($_REQUEST['crm']);
			$objMedicos->setNome($_REQUEST['nome']);
			$objMedicos->setTipoInscricao($_REQUEST['tipo_inscricao']);
			$objMedicos->setSituacaoInscricao($_REQUEST['situacao_inscricao']);
			$objMedicos->setEspecialidade($_REQUEST['especialidade']);
			$objMedicos->setCroCrm($_REQUEST['cro_crm']);
			$objMedicos->setUF($_REQUEST['UF']);
			$novoId = $objMedicos->Adicionar();
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
		$template = "ajax.medicos.php";
		break;

	case "frm_atualizar_medicos" :
		$medicos = new Medicos();
		$medicos->setId($_REQUEST["app_codigo"]);
		$linha = $medicos->Editar();
		$template = "tpl.frm.medicos.php";
		break;

	case "atualizar_medicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objMedicos = new Medicos($pdo);
			$objMedicos->setId($_REQUEST['id']);
			$objMedicos->setCrm($_REQUEST['crm']);
			$objMedicos->setNome($_REQUEST['nome']);
			$objMedicos->setTipoInscricao($_REQUEST['tipo_inscricao']);
			$objMedicos->setSituacaoInscricao($_REQUEST['situacao_inscricao']);
			$objMedicos->setEspecialidade($_REQUEST['especialidade']);
			$objMedicos->setCroCrm($_REQUEST['cro_crm']);
			$objMedicos->setUF($_REQUEST['UF']);
			$objMedicos->Modificar();
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
		$template = "ajax.medicos.php";
		break;

	case "listar_medicos":
		$template = "tpl.geral.medicos.php";
		break;

	case "listar_medicos_autocomplete":
		$objmedicos = new Medicos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objmedicos->BuscarAutoComplete($busca));
		$template = "ajax.medicos.php";
		break;

	case "deletar_medicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objMedicos = new Medicos($pdo);
			$objMedicos->Remover($_REQUEST['registros']);
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
		$template = "ajax.medicos.php";
		break;

	case "ajax_listar_medicos":
		$template = "tpl.lis.medicos.php";
		break;

	case "medicos_pdf":
		$template = "tpl.lis.medicos.pdf.php";
		break;

	case "medicos_xlsx":
		$template = "tpl.lis.medicos.xlsx.php";
		break;

	case "medicos_print":
		$template = "tpl.lis.medicos.print.php";
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
			$_SESSION["configuracao_usuario"]["medicos"] = $colunasSelecionadas;
			$usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
			$usuarioConfiguracao->setDirModulo("medicos");
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
		$template = "ajax.medicos.php";
		break;
}
