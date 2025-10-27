<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_tamanho":
		$template = "tpl.frm.produtos_tamanho.php";
		break;

	case "frm_modal_produtos_tamanho":
if($_REQUEST["app_codigo"] != "") {
		$produtos_tamanho = new ProdutosTamanho();
		$produtos_tamanho->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_tamanho->Editar();
}		$template = "tpl.form.produtos_tamanho.php";
		break;

	case "adicionar_produtos_tamanho":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosTamanho = new ProdutosTamanho($pdo);
			$objProdutosTamanho->setNome($_REQUEST['nome']);
			$novoId = $objProdutosTamanho->Adicionar();
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
		$template = "ajax.produtos_tamanho.php";
		break;

	case "frm_atualizar_produtos_tamanho" :
		$produtos_tamanho = new ProdutosTamanho();
		$produtos_tamanho->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_tamanho->Editar();
		$template = "tpl.frm.produtos_tamanho.php";
		break;

	case "atualizar_produtos_tamanho":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosTamanho = new ProdutosTamanho($pdo);
			$objProdutosTamanho->setId($_REQUEST['id']);
			$objProdutosTamanho->setNome($_REQUEST['nome']);
			$objProdutosTamanho->Modificar();
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
		$template = "ajax.produtos_tamanho.php";
		break;

	case "listar_produtos_tamanho":
		$template = "tpl.geral.produtos_tamanho.simples.php";
		break;

	case "listar_produtos_tamanho_autocomplete":
		$objprodutos_tamanho = new ProdutosTamanho();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_tamanho->BuscarAutoComplete($busca));
		$template = "ajax.produtos_tamanho.php";
		break;

	case "deletar_produtos_tamanho":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosTamanho = new ProdutosTamanho($pdo);
			$objProdutosTamanho->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_tamanho.php";
		break;

	case "ajax_listar_produtos_tamanho":
		$template = "tpl.lis.produtos_tamanho.php";
		break;

	case "produtos_tamanho_pdf":
		$template = "tpl.lis.produtos_tamanho.pdf.php";
		break;

	case "produtos_tamanho_xlsx":
		$template = "tpl.lis.produtos_tamanho.xlsx.php";
		break;

	case "produtos_tamanho_print":
		$template = "tpl.lis.produtos_tamanho.print.php";
		break;

}
