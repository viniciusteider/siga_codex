<?php

switch($app_comando)
{
	case "frm_adicionar_paciente_sinais_clinicos":
		$template = "tpl.frm.paciente_sinais_clinicos.php";
		break;

	case "frm_modal_paciente_sinais_clinicos":
if($_REQUEST["app_codigo"] != "") {
		$paciente_sinais_clinicos = new PacienteSinaisClinicos();
		$paciente_sinais_clinicos->setId($_REQUEST["app_codigo"]);
		$linha = $paciente_sinais_clinicos->Editar();
}		$template = "tpl.form.paciente_sinais_clinicos.php";
		break;

	case "adicionar_paciente_sinais_clinicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPacienteSinaisClinicos = new PacienteSinaisClinicos($pdo);
			$objPacienteSinaisClinicos->setIdPaciente($_REQUEST['id_paciente']);
			$objPacienteSinaisClinicos->setIdSinaisClinicos($_REQUEST['id_sinais_clinicos']);
			$novoId = $objPacienteSinaisClinicos->Adicionar();
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
		$template = "ajax.paciente_sinais_clinicos.php";
		break;

	case "frm_atualizar_paciente_sinais_clinicos" :
		$paciente_sinais_clinicos = new PacienteSinaisClinicos();
		$paciente_sinais_clinicos->setId($_REQUEST["app_codigo"]);
		$linha = $paciente_sinais_clinicos->Editar();
		$template = "tpl.frm.paciente_sinais_clinicos.php";
		break;

	case "atualizar_paciente_sinais_clinicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPacienteSinaisClinicos = new PacienteSinaisClinicos($pdo);
			$objPacienteSinaisClinicos->setId($_REQUEST['id']);
			$objPacienteSinaisClinicos->setIdPaciente($_REQUEST['id_paciente']);
			$objPacienteSinaisClinicos->setIdSinaisClinicos($_REQUEST['id_sinais_clinicos']);
			$objPacienteSinaisClinicos->Modificar();
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
		$template = "ajax.paciente_sinais_clinicos.php";
		break;

	case "listar_paciente_sinais_clinicos":
		$template = "tpl.geral.paciente_sinais_clinicos.php";
		break;

	case "listar_paciente_sinais_clinicos_autocomplete":
		$objpaciente_sinais_clinicos = new PacienteSinaisClinicos();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objpaciente_sinais_clinicos->BuscarAutoComplete($busca));
		$template = "ajax.paciente_sinais_clinicos.php";
		break;

	case "deletar_paciente_sinais_clinicos":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objPacienteSinaisClinicos = new PacienteSinaisClinicos($pdo);
			$objPacienteSinaisClinicos->Remover($_REQUEST['registros']);
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
		$template = "ajax.paciente_sinais_clinicos.php";
		break;

	case "ajax_listar_paciente_sinais_clinicos":
		$template = "tpl.lis.paciente_sinais_clinicos.php";
		break;

	case "paciente_sinais_clinicos_pdf":
		$template = "tpl.lis.paciente_sinais_clinicos.pdf.php";
		break;

	case "paciente_sinais_clinicos_xlsx":
		$template = "tpl.lis.paciente_sinais_clinicos.xlsx.php";
		break;

	case "paciente_sinais_clinicos_print":
		$template = "tpl.lis.paciente_sinais_clinicos.print.php";
		break;

}
