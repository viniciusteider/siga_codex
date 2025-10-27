<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_saida_estoque_itens":
		$template = "tpl.frm.produtos_saida_estoque_itens.php";
		break;

	case "frm_modal_produtos_saida_estoque_itens":
if($_REQUEST["app_codigo"] != "") {
		$produtos_saida_estoque_itens = new ProdutosSaidaEstoqueItens();
		$produtos_saida_estoque_itens->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_saida_estoque_itens->Editar();
}		$template = "tpl.form.produtos_saida_estoque_itens.php";
		break;

	case "adicionar_produtos_saida_estoque_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosSaidaEstoqueItens = new ProdutosSaidaEstoqueItens($pdo);
			$objProdutosSaidaEstoqueItens->setIdProduto($_REQUEST['id_produto']);
			$objProdutosSaidaEstoqueItens->setIdCautela($_REQUEST['id_cautela']);
			$objProdutosSaidaEstoqueItens->setQuantidade($_REQUEST['quantidade']);
			$objProdutosSaidaEstoqueItens->setIdModelo($_REQUEST['id_modelo']);
			$objProdutosSaidaEstoqueItens->setIdTamanho($_REQUEST['id_tamanho']);
			$objProdutosSaidaEstoqueItens->setIdCor($_REQUEST['id_cor']);
			$objProdutosSaidaEstoqueItens->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$novoId = $objProdutosSaidaEstoqueItens->Adicionar();
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
		$template = "ajax.produtos_saida_estoque_itens.php";
		break;

	case "frm_atualizar_produtos_saida_estoque_itens" :
		$produtos_saida_estoque_itens = new ProdutosSaidaEstoqueItens();
		$produtos_saida_estoque_itens->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_saida_estoque_itens->Editar();
		$template = "tpl.frm.produtos_saida_estoque_itens.php";
		break;

	case "atualizar_produtos_saida_estoque_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosSaidaEstoqueItens = new ProdutosSaidaEstoqueItens($pdo);
			$objProdutosSaidaEstoqueItens->setId($_REQUEST['id']);
			$objProdutosSaidaEstoqueItens->setIdProduto($_REQUEST['id_produto']);
			$objProdutosSaidaEstoqueItens->setIdCautela($_REQUEST['id_cautela']);
			$objProdutosSaidaEstoqueItens->setQuantidade($_REQUEST['quantidade']);
			$objProdutosSaidaEstoqueItens->setIdModelo($_REQUEST['id_modelo']);
			$objProdutosSaidaEstoqueItens->setIdTamanho($_REQUEST['id_tamanho']);
			$objProdutosSaidaEstoqueItens->setIdCor($_REQUEST['id_cor']);
			$objProdutosSaidaEstoqueItens->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objProdutosSaidaEstoqueItens->Modificar();
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
		$template = "ajax.produtos_saida_estoque_itens.php";
		break;

	case "listar_produtos_saida_estoque_itens":
		$template = "tpl.geral.produtos_saida_estoque_itens.php";
		break;

	case "listar_produtos_saida_estoque_itens_autocomplete":
		$objprodutos_saida_estoque_itens = new ProdutosSaidaEstoqueItens();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_saida_estoque_itens->BuscarAutoComplete($busca));
		$template = "ajax.produtos_saida_estoque_itens.php";
		break;

	case "deletar_produtos_saida_estoque_itens":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosSaidaEstoqueItens = new ProdutosSaidaEstoqueItens($pdo);
			$objProdutosSaidaEstoqueItens->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_saida_estoque_itens.php";
		break;

	case "ajax_listar_produtos_saida_estoque_itens":
		$template = "tpl.lis.produtos_saida_estoque_itens.php";
		break;

	case "produtos_saida_estoque_itens_pdf":
		$template = "tpl.lis.produtos_saida_estoque_itens.pdf.php";
		break;

	case "produtos_saida_estoque_itens_xlsx":
		$template = "tpl.lis.produtos_saida_estoque_itens.xlsx.php";
		break;

	case "produtos_saida_estoque_itens_print":
		$template = "tpl.lis.produtos_saida_estoque_itens.print.php";
		break;

}
