<?php

switch($app_comando)
{
    case "frm_adicionar_produtos_sub_grupo":
        $template = "tpl.frm.produtos_sub_grupo.php";
        break;

    case "frm_modal_produtos_sub_grupo":
        if($_REQUEST["app_codigo"] != "") {
            $produtos_sub_grupo = new ProdutosSubGrupo();
            $produtos_sub_grupo->setId($_REQUEST["app_codigo"]);
            $linha = $produtos_sub_grupo->Editar();
        }		$template = "tpl.form.produtos_sub_grupo.php";
        break;

    case "adicionar_produtos_sub_grupo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosSubGrupo = new ProdutosSubGrupo($pdo);
            $objProdutosSubGrupo->setIdProdutoGrupo($_REQUEST['id_produto_grupo']);
            $objProdutosSubGrupo->setNome($_REQUEST['nome']);
            $novoId = $objProdutosSubGrupo->Adicionar();
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
        $template = "ajax.produtos_sub_grupo.php";
        break;

    case "frm_atualizar_produtos_sub_grupo" :
        $produtos_sub_grupo = new ProdutosSubGrupo();
        $produtos_sub_grupo->setId($_REQUEST["app_codigo"]);
        $linha = $produtos_sub_grupo->Editar();
        $template = "tpl.frm.produtos_sub_grupo.php";
        break;

    case "atualizar_produtos_sub_grupo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosSubGrupo = new ProdutosSubGrupo($pdo);
            $objProdutosSubGrupo->setId($_REQUEST['id']);
            $objProdutosSubGrupo->setIdProdutoGrupo($_REQUEST['id_produto_grupo']);
            $objProdutosSubGrupo->setNome($_REQUEST['nome']);
            $objProdutosSubGrupo->Modificar();
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
        $template = "ajax.produtos_sub_grupo.php";
        break;

    case "listar_produtos_sub_grupo":
        $template = "tpl.geral.produtos_sub_grupo.simples.php";
        break;

    case "listar_produtos_sub_grupo_autocomplete":
        $objprodutos_sub_grupo = new ProdutosSubGrupo();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objprodutos_sub_grupo->BuscarAutoComplete($busca));
        $template = "ajax.produtos_sub_grupo.php";
        break;
    case "listar_subgrupos_select":
        $objprodutos_sub_grupo = new ProdutosSubGrupo();
        echo json_encode($objprodutos_sub_grupo->ListarPorGrupo($_REQUEST['app_codigo']));
        $template = "ajax.produtos_sub_grupo.php";
        break;

    case "deletar_produtos_sub_grupo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosSubGrupo = new ProdutosSubGrupo($pdo);
            $objProdutosSubGrupo->Remover($_REQUEST['registros']);
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
        $template = "ajax.produtos_sub_grupo.php";
        break;

    case "ajax_listar_produtos_sub_grupo":
        $template = "tpl.lis.produtos_sub_grupo.php";
        break;

    case "produtos_sub_grupo_pdf":
        $template = "tpl.lis.produtos_sub_grupo.pdf.php";
        break;

    case "produtos_sub_grupo_xlsx":
        $template = "tpl.lis.produtos_sub_grupo.xlsx.php";
        break;

    case "produtos_sub_grupo_print":
        $template = "tpl.lis.produtos_sub_grupo.print.php";
        break;

}
