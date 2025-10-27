<?php

switch($app_comando)
{
	case "frm_adicionar_sinais_clinicos":
		$template = "tpl.frm.sinais_clinicos.php";
		break;

	case "frm_modal_sinais_clinicos":
if($_REQUEST["app_codigo"] != "") {
		$sinais_clinicos = new SinaisClinicos();
		$sinais_clinicos->setId($_REQUEST["app_codigo"]);
		$linha = $sinais_clinicos->Editar();
}		$template = "tpl.form.sinais_clinicos.php";
		break;

	case "adicionar_sinais_clinicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objSinaisClinicos = new SinaisClinicos($pdo);
			$objSinaisClinicos->setSinais($_REQUEST['sinais']);
			$novoId = $objSinaisClinicos->Adicionar();
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
		$template = "ajax.sinais_clinicos.php";
		break;

	case "frm_atualizar_sinais_clinicos" :
		$sinais_clinicos = new SinaisClinicos();
		$sinais_clinicos->setId($_REQUEST["app_codigo"]);
		$linha = $sinais_clinicos->Editar();
		$template = "tpl.frm.sinais_clinicos.php";
		break;

	case "atualizar_sinais_clinicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objSinaisClinicos = new SinaisClinicos($pdo);
			$objSinaisClinicos->setId($_REQUEST['id']);
			$objSinaisClinicos->setSinais($_REQUEST['sinais']);
			$objSinaisClinicos->Modificar();
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
		$template = "ajax.sinais_clinicos.php";
		break;

	case "listar_sinais_clinicos":
		$template = "tpl.geral.sinais_clinicos.php";
		break;

	case "listar_sinais_clinicos_autocomplete":
		$objsinais_clinicos = new SinaisClinicos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objsinais_clinicos->BuscarAutoComplete($busca));
		$template = "ajax.sinais_clinicos.php";
		break;

	case "deletar_sinais_clinicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objSinaisClinicos = new SinaisClinicos($pdo);
			$objSinaisClinicos->Remover($_REQUEST['registros']);
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
		$template = "ajax.sinais_clinicos.php";
		break;

	case "ajax_listar_sinais_clinicos":
		$template = "tpl.lis.sinais_clinicos.php";
		break;

	case "sinais_clinicos_pdf":
		$template = "tpl.lis.sinais_clinicos.pdf.php";
		break;

	case "sinais_clinicos_xlsx":
		$template = "tpl.lis.sinais_clinicos.xlsx.php";
		break;

	case "sinais_clinicos_print":
		$template = "tpl.lis.sinais_clinicos.print.php";
		break;

}
