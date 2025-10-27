<?php

switch($app_comando)
{
    case "frm_adicionar_produtos_marca":
        $template = "tpl.frm.produtos_marca.php";
        break;

    case "frm_modal_produtos_marca":
        if($_REQUEST["app_codigo"] != "") {
            $produtos_marca = new ProdutosMarca();
            $produtos_marca->setId($_REQUEST["app_codigo"]);
            $linha = $produtos_marca->Editar();
        }		$template = "tpl.form.produtos_marca.php";
        break;

    case "adicionar_produtos_marca":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosMarca = new ProdutosMarca($pdo);
            $objProdutosMarca->setNome($_REQUEST['nome']);
            $novoId = $objProdutosMarca->Adicionar();
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
        $template = "ajax.produtos_marca.php";
        break;

    case "frm_atualizar_produtos_marca" :
        $produtos_marca = new ProdutosMarca();
        $produtos_marca->setId($_REQUEST["app_codigo"]);
        $linha = $produtos_marca->Editar();
        $template = "tpl.frm.produtos_marca.php";
        break;

    case "atualizar_produtos_marca":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosMarca = new ProdutosMarca($pdo);
            $objProdutosMarca->setId($_REQUEST['id']);
            $objProdutosMarca->setNome($_REQUEST['nome']);
            $objProdutosMarca->Modificar();
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
        $template = "ajax.produtos_marca.php";
        break;

    case "listar_produtos_marca":
        $template = "tpl.geral.produtos_marca.simples.php";
        break;

    case "listar_produtos_marca_autocomplete":
        $objprodutos_marca = new ProdutosMarca();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objprodutos_marca->BuscarAutoComplete($busca));
        $template = "ajax.produtos_marca.php";
        break;

    case "deletar_produtos_marca":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosMarca = new ProdutosMarca($pdo);
            $objProdutosMarca->Remover($_REQUEST['registros']);
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
        $template = "ajax.produtos_marca.php";
        break;

    case "ajax_listar_produtos_marca":
        $template = "tpl.lis.produtos_marca.php";
        break;

    case "produtos_marca_pdf":
        $template = "tpl.lis.produtos_marca.pdf.php";
        break;

    case "produtos_marca_xlsx":
        $template = "tpl.lis.produtos_marca.xlsx.php";
        break;

    case "produtos_marca_print":
        $template = "tpl.lis.produtos_marca.print.php";
        break;

}
