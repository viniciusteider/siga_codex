<?php

switch($app_comando)
{
	case "frm_adicionar_produtos_cautela":
		$template = "tpl.frm.produtos_cautela.php";
		break;

	case "frm_modal_produtos_cautela":
if($_REQUEST["app_codigo"] != "") {
		$produtos_cautela = new ProdutosCautela();
		$produtos_cautela->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_cautela->Editar();
}		$template = "tpl.form.produtos_cautela.php";
		break;

	case "adicionar_produtos_cautela":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosCautela = new ProdutosCautela($pdo);
			$objProdutosCautela->setIdAgente($_REQUEST['id_agente']);
			$objProdutosCautela->setIdSetor($_REQUEST['id_setor']);
			$objProdutosCautela->setDataRetirada(Conexao::PrepararDataBD($_REQUEST['data_retirada'], $_SESSION['usuario']['timezone']));
			$objProdutosCautela->setDataDevolucao(Conexao::PrepararDataBD($_REQUEST['data_devolucao'], $_SESSION['usuario']['timezone']));
			$objProdutosCautela->setLocalUso($_REQUEST['local_uso']);
			$objProdutosCautela->setFinalidade($_REQUEST['finalidade']);
			$objProdutosCautela->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
			$novoId = $objProdutosCautela->Adicionar();
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
		$template = "ajax.produtos_cautela.php";
		break;

	case "frm_atualizar_produtos_cautela" :
		$produtos_cautela = new ProdutosCautela();
		$produtos_cautela->setId($_REQUEST["app_codigo"]);
		$linha = $produtos_cautela->Editar();
		$template = "tpl.frm.produtos_cautela.php";
		break;

	case "atualizar_produtos_cautela":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosCautela = new ProdutosCautela($pdo);
			$objProdutosCautela->setId($_REQUEST['id']);
			$objProdutosCautela->setIdAgente($_REQUEST['id_agente']);
			$objProdutosCautela->setIdSetor($_REQUEST['id_setor']);
			$objProdutosCautela->setDataRetirada(Conexao::PrepararDataBD($_REQUEST['data_retirada'], $_SESSION['usuario']['timezone']));
			$objProdutosCautela->setDataDevolucao(Conexao::PrepararDataBD($_REQUEST['data_devolucao'], $_SESSION['usuario']['timezone']));
			$objProdutosCautela->setLocalUso($_REQUEST['local_uso']);
			$objProdutosCautela->setFinalidade($_REQUEST['finalidade']);
			$objProdutosCautela->Modificar();
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
		$template = "ajax.produtos_cautela.php";
		break;

	case "listar_produtos_cautela":
		$template = "tpl.geral.produtos_cautela.php";
		break;

	case "listar_produtos_cautela_autocomplete":
		$objprodutos_cautela = new ProdutosCautela();
		 $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
		echo json_encode($objprodutos_cautela->BuscarAutoComplete($busca));
		$template = "ajax.produtos_cautela.php";
		break;

	case "deletar_produtos_cautela":
		$pdo = new Conexao();
		$pdo->beginTransaction();
		try {
			$objProdutosCautela = new ProdutosCautela($pdo);
			$objProdutosCautela->Remover($_REQUEST['registros']);
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
		$template = "ajax.produtos_cautela.php";
		break;

	case "ajax_listar_produtos_cautela":
		$template = "tpl.lis.produtos_cautela.php";
		break;

	case "produtos_cautela_pdf":
		$template = "tpl.lis.produtos_cautela.pdf.php";
		break;

	case "produtos_cautela_xlsx":
		$template = "tpl.lis.produtos_cautela.xlsx.php";
		break;

	case "produtos_cautela_print":
		$template = "tpl.lis.produtos_cautela.print.php";
		break;

}
