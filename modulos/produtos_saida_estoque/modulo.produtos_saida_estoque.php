<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_saida_estoque":
		$template = "tpl.frm.produtos_saida_estoque.php";
		break;

	case "frm_modal_produtos_saida_estoque":
if($_REQUEST["app_codigo"] != "") {
		$produtos_saida_estoque = new ProdutosSaidaEstoque();
		$produtos_saida_estoque->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_saida_estoque->Editar();
}		$template = "tpl.form.produtos_saida_estoque.php";
		break;

	case "adicionar_produtos_saida_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosSaidaEstoque = new ProdutosSaidaEstoque($pdo);
			$objProdutosSaidaEstoque->setIdAgente($_REQUEST['id_agente']);
			$objProdutosSaidaEstoque->setIdSetor($_REQUEST['id_setor']);
			$objProdutosSaidaEstoque->setDataRetirada(Conexao::PrepararDataBD($_REQUEST['data_retirada'], $_SESSION['usuario']['timezone']));
			$objProdutosSaidaEstoque->setDataDevolucao(Conexao::PrepararDataBD($_REQUEST['data_devolucao'], $_SESSION['usuario']['timezone']));
			$objProdutosSaidaEstoque->setLocalUso($_REQUEST['local_uso']);
			$objProdutosSaidaEstoque->setFinalidade($_REQUEST['finalidade']);
			$objProdutosSaidaEstoque->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$novoId = $objProdutosSaidaEstoque->Adicionar();
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
		$template = "ajax.produtos_saida_estoque.php";
		break;

	case "frm_atualizar_produtos_saida_estoque" :
		$produtos_saida_estoque = new ProdutosSaidaEstoque();
		$produtos_saida_estoque->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_saida_estoque->Editar();
		$template = "tpl.frm.produtos_saida_estoque.php";
		break;

	case "atualizar_produtos_saida_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosSaidaEstoque = new ProdutosSaidaEstoque($pdo);
			$objProdutosSaidaEstoque->setId($_REQUEST['id']);
			$objProdutosSaidaEstoque->setIdAgente($_REQUEST['id_agente']);
			$objProdutosSaidaEstoque->setIdSetor($_REQUEST['id_setor']);
			$objProdutosSaidaEstoque->setDataRetirada(Conexao::PrepararDataBD($_REQUEST['data_retirada'], $_SESSION['usuario']['timezone']));
			$objProdutosSaidaEstoque->setDataDevolucao(Conexao::PrepararDataBD($_REQUEST['data_devolucao'], $_SESSION['usuario']['timezone']));
			$objProdutosSaidaEstoque->setLocalUso($_REQUEST['local_uso']);
			$objProdutosSaidaEstoque->setFinalidade($_REQUEST['finalidade']);
			$objProdutosSaidaEstoque->Modificar();
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
		$template = "ajax.produtos_saida_estoque.php";
		break;

	case "listar_produtos_saida_estoque":
		$template = "tpl.geral.produtos_saida_estoque.php";
		break;

	case "listar_produtos_saida_estoque_autocomplete":
		$objprodutos_saida_estoque = new ProdutosSaidaEstoque();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_saida_estoque->BuscarAutoComplete($busca));
		$template = "ajax.produtos_saida_estoque.php";
		break;

	case "deletar_produtos_saida_estoque":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosSaidaEstoque = new ProdutosSaidaEstoque($pdo);
			$objProdutosSaidaEstoque->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_saida_estoque.php";
		break;

	case "ajax_listar_produtos_saida_estoque":
		$template = "tpl.lis.produtos_saida_estoque.php";
		break;

	case "produtos_saida_estoque_pdf":
		$template = "tpl.lis.produtos_saida_estoque.pdf.php";
		break;

	case "produtos_saida_estoque_xlsx":
		$template = "tpl.lis.produtos_saida_estoque.xlsx.php";
		break;

	case "produtos_saida_estoque_print":
		$template = "tpl.lis.produtos_saida_estoque.print.php";
		break;

}
