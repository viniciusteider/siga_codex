<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_acautelados":
		$template = "tpl.frm.produtos_acautelados.php";
		break;

	case "frm_modal_produtos_acautelados":
if($_REQUEST["app_codigo"] != "") {
		$produtos_acautelados = new ProdutosAcautelados();
		$produtos_acautelados->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_acautelados->Editar();
}		$template = "tpl.form.produtos_acautelados.php";
		break;

	case "adicionar_produtos_acautelados":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosAcautelados = new ProdutosAcautelados($pdo);
			$objProdutosAcautelados->setIdProduto($_REQUEST['id_produto']);
			$objProdutosAcautelados->setIdCautela($_REQUEST['id_cautela']);
			$objProdutosAcautelados->setQuantidade($_REQUEST['quantidade']);
			$objProdutosAcautelados->setIdModelo($_REQUEST['id_modelo']);
			$objProdutosAcautelados->setIdTamanho($_REQUEST['id_tamanho']);
			$objProdutosAcautelados->setIdCor($_REQUEST['id_cor']);
			$objProdutosAcautelados->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$novoId = $objProdutosAcautelados->Adicionar();
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
		$template = "ajax.produtos_acautelados.php";
		break;

	case "frm_atualizar_produtos_acautelados" :
		$produtos_acautelados = new ProdutosAcautelados();
		$produtos_acautelados->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_acautelados->Editar();
		$template = "tpl.frm.produtos_acautelados.php";
		break;

	case "atualizar_produtos_acautelados":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosAcautelados = new ProdutosAcautelados($pdo);
			$objProdutosAcautelados->setId($_REQUEST['id']);
			$objProdutosAcautelados->setIdProduto($_REQUEST['id_produto']);
			$objProdutosAcautelados->setIdCautela($_REQUEST['id_cautela']);
			$objProdutosAcautelados->setQuantidade($_REQUEST['quantidade']);
			$objProdutosAcautelados->setIdModelo($_REQUEST['id_modelo']);
			$objProdutosAcautelados->setIdTamanho($_REQUEST['id_tamanho']);
			$objProdutosAcautelados->setIdCor($_REQUEST['id_cor']);
			$objProdutosAcautelados->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
			$objProdutosAcautelados->Modificar();
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
		$template = "ajax.produtos_acautelados.php";
		break;

	case "listar_produtos_acautelados":
		$template = "tpl.geral.produtos_acautelados.php";
		break;

	case "listar_produtos_acautelados_autocomplete":
		$objprodutos_acautelados = new ProdutosAcautelados();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_acautelados->BuscarAutoComplete($busca));
		$template = "ajax.produtos_acautelados.php";
		break;

	case "deletar_produtos_acautelados":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosAcautelados = new ProdutosAcautelados($pdo);
			$objProdutosAcautelados->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_acautelados.php";
		break;

	case "ajax_listar_produtos_acautelados":
		$template = "tpl.lis.produtos_acautelados.php";
		break;

	case "produtos_acautelados_pdf":
		$template = "tpl.lis.produtos_acautelados.pdf.php";
		break;

	case "produtos_acautelados_xlsx":
		$template = "tpl.lis.produtos_acautelados.xlsx.php";
		break;

	case "produtos_acautelados_print":
		$template = "tpl.lis.produtos_acautelados.print.php";
		break;

}
