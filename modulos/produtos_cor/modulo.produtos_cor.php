<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_cor":
		$template = "tpl.frm.produtos_cor.php";
		break;

	case "frm_modal_produtos_cor":
if($_REQUEST["app_codigo"] != "") {
		$produtos_cor = new ProdutosCor();
		$produtos_cor->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_cor->Editar();
}		$template = "tpl.form.produtos_cor.php";
		break;

	case "adicionar_produtos_cor":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosCor = new ProdutosCor($pdo);
			$objProdutosCor->setNome($_REQUEST['nome']);
			$objProdutosCor->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$novoId = $objProdutosCor->Adicionar();
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
		$template = "ajax.produtos_cor.php";
		break;

	case "frm_atualizar_produtos_cor" :
		$produtos_cor = new ProdutosCor();
		$produtos_cor->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_cor->Editar();
		$template = "tpl.frm.produtos_cor.php";
		break;

	case "atualizar_produtos_cor":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosCor = new ProdutosCor($pdo);
			$objProdutosCor->setId($_REQUEST['id']);
			$objProdutosCor->setNome($_REQUEST['nome']);
			$objProdutosCor->Modificar();
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
		$template = "ajax.produtos_cor.php";
		break;

	case "listar_produtos_cor":
		$template = "tpl.geral.produtos_cor.simples.php";
		break;

	case "listar_produtos_cor_autocomplete":
		$objprodutos_cor = new ProdutosCor();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_cor->BuscarAutoComplete($busca));
		$template = "ajax.produtos_cor.php";
		break;

	case "deletar_produtos_cor":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosCor = new ProdutosCor($pdo);
			$objProdutosCor->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_cor.php";
		break;

	case "ajax_listar_produtos_cor":
		$template = "tpl.lis.produtos_cor.php";
		break;

	case "produtos_cor_pdf":
		$template = "tpl.lis.produtos_cor.pdf.php";
		break;

	case "produtos_cor_xlsx":
		$template = "tpl.lis.produtos_cor.xlsx.php";
		break;

	case "produtos_cor_print":
		$template = "tpl.lis.produtos_cor.print.php";
		break;

}
