<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_revestimento":
		$template = "tpl.frm.produtos_revestimento.php";
		break;

	case "frm_modal_produtos_revestimento":
if($_REQUEST["app_codigo"] != "") {
		$produtos_revestimento = new ProdutosRevestimento();
		$produtos_revestimento->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_revestimento->Editar();
}		$template = "tpl.form.produtos_revestimento.php";
		break;

	case "adicionar_produtos_revestimento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosRevestimento = new ProdutosRevestimento($pdo);
			$objProdutosRevestimento->setNome($_REQUEST['nome']);
			$objProdutosRevestimento->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$objProdutosRevestimento->setObservacao($_REQUEST['observacao']);
			$novoId = $objProdutosRevestimento->Adicionar();
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
		$template = "ajax.produtos_revestimento.php";
		break;

	case "frm_atualizar_produtos_revestimento" :
		$produtos_revestimento = new ProdutosRevestimento();
		$produtos_revestimento->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_revestimento->Editar();
		$template = "tpl.frm.produtos_revestimento.php";
		break;

	case "atualizar_produtos_revestimento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosRevestimento = new ProdutosRevestimento($pdo);
			$objProdutosRevestimento->setId($_REQUEST['id']);
			$objProdutosRevestimento->setNome($_REQUEST['nome']);
			$objProdutosRevestimento->setObservacao($_REQUEST['observacao']);
			$objProdutosRevestimento->Modificar();
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
		$template = "ajax.produtos_revestimento.php";
		break;

	case "listar_produtos_revestimento":
		$template = "tpl.geral.produtos_revestimento.simples.php";
		break;

	case "listar_produtos_revestimento_autocomplete":
		$objprodutos_revestimento = new ProdutosRevestimento();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_revestimento->BuscarAutoComplete($busca));
		$template = "ajax.produtos_revestimento.php";
		break;

	case "deletar_produtos_revestimento":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosRevestimento = new ProdutosRevestimento($pdo);
			$objProdutosRevestimento->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_revestimento.php";
		break;

	case "ajax_listar_produtos_revestimento":
		$template = "tpl.lis.produtos_revestimento.php";
		break;

	case "produtos_revestimento_pdf":
		$template = "tpl.lis.produtos_revestimento.pdf.php";
		break;

	case "produtos_revestimento_xlsx":
		$template = "tpl.lis.produtos_revestimento.xlsx.php";
		break;

	case "produtos_revestimento_print":
		$template = "tpl.lis.produtos_revestimento.print.php";
		break;

}
