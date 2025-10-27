<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_modelo":
		$template = "tpl.frm.produtos_modelo.php";
		break;

	case "frm_modal_produtos_modelo":
if($_REQUEST["app_codigo"] != "") {
		$produtos_modelo = new ProdutosModelo();
		$produtos_modelo->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_modelo->Editar();
}		$template = "tpl.form.produtos_modelo.php";
		break;

	case "adicionar_produtos_modelo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosModelo = new ProdutosModelo($pdo);
			$objProdutosModelo->setIdProdutoMarca($_REQUEST['id_produto_marca']);
			$objProdutosModelo->setNome($_REQUEST['nome']);
			$novoId = $objProdutosModelo->Adicionar();
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
		$template = "ajax.produtos_modelo.php";
		break;

	case "frm_atualizar_produtos_modelo" :
		$produtos_modelo = new ProdutosModelo();
		$produtos_modelo->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_modelo->Editar();
		$template = "tpl.frm.produtos_modelo.php";
		break;

	case "atualizar_produtos_modelo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosModelo = new ProdutosModelo($pdo);
			$objProdutosModelo->setId($_REQUEST['id']);
			$objProdutosModelo->setIdProdutoMarca($_REQUEST['id_produto_marca']);
			$objProdutosModelo->setNome($_REQUEST['nome']);
			$objProdutosModelo->Modificar();
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
		$template = "ajax.produtos_modelo.php";
		break;

	case "listar_produtos_modelo":
		$template = "tpl.geral.produtos_modelo.simples.php";
		break;

	case "listar_produtos_modelo_autocomplete":
		$objprodutos_modelo = new ProdutosModelo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_modelo->BuscarAutoComplete($busca));
		$template = "ajax.produtos_modelo.php";
		break;

	case "deletar_produtos_modelo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosModelo = new ProdutosModelo($pdo);
			$objProdutosModelo->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_modelo.php";
		break;

	case "ajax_listar_produtos_modelo":
		$template = "tpl.lis.produtos_modelo.php";
		break;

	case "produtos_modelo_pdf":
		$template = "tpl.lis.produtos_modelo.pdf.php";
		break;

	case "produtos_modelo_xlsx":
		$template = "tpl.lis.produtos_modelo.xlsx.php";
		break;

	case "produtos_modelo_print":
		$template = "tpl.lis.produtos_modelo.print.php";
		break;

}
