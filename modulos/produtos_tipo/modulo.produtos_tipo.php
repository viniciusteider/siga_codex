<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_tipo":
		$template = "tpl.frm.produtos_tipo.php";
		break;

	case "frm_modal_produtos_tipo":
if($_REQUEST["app_codigo"] != "") {
		$produtos_tipo = new ProdutosTipo();
		$produtos_tipo->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_tipo->Editar();
}		$template = "tpl.form.produtos_tipo.php";
		break;

	case "adicionar_produtos_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosTipo = new ProdutosTipo($pdo);
			$objProdutosTipo->setNome($_REQUEST['nome']);
			$novoId = $objProdutosTipo->Adicionar();
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
		$template = "ajax.produtos_tipo.php";
		break;

	case "frm_atualizar_produtos_tipo" :
		$produtos_tipo = new ProdutosTipo();
		$produtos_tipo->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_tipo->Editar();
		$template = "tpl.frm.produtos_tipo.php";
		break;

	case "atualizar_produtos_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosTipo = new ProdutosTipo($pdo);
			$objProdutosTipo->setId($_REQUEST['id']);
			$objProdutosTipo->setNome($_REQUEST['nome']);
			$objProdutosTipo->Modificar();
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
		$template = "ajax.produtos_tipo.php";
		break;

	case "listar_produtos_tipo":
		$template = "tpl.geral.produtos_tipo.simples.php";
		break;

	case "listar_produtos_tipo_autocomplete":
		$objprodutos_tipo = new ProdutosTipo();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_tipo->BuscarAutoComplete($busca));
		$template = "ajax.produtos_tipo.php";
		break;

	case "deletar_produtos_tipo":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosTipo = new ProdutosTipo($pdo);
			$objProdutosTipo->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_tipo.php";
		break;

	case "ajax_listar_produtos_tipo":
		$template = "tpl.lis.produtos_tipo.php";
		break;

	case "produtos_tipo_pdf":
		$template = "tpl.lis.produtos_tipo.pdf.php";
		break;

	case "produtos_tipo_xlsx":
		$template = "tpl.lis.produtos_tipo.xlsx.php";
		break;

	case "produtos_tipo_print":
		$template = "tpl.lis.produtos_tipo.print.php";
		break;

}
