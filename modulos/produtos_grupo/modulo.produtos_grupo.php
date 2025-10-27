<?php

switch($app_comando)
{
    case "frm_adicionar_produtos_grupo":
        $template = "tpl.frm.produtos_grupo.php";
        break;

    case "frm_modal_produtos_grupo":
        if($_REQUEST["app_codigo"] != "") {
            $produtos_grupo = new ProdutosGrupo();
            $produtos_grupo->setId($_REQUEST["app_codigo"]);
            $linha = $produtos_grupo->Editar();
        }		$template = "tpl.form.produtos_grupo.php";
        break;

    case "adicionar_produtos_grupo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosGrupo = new ProdutosGrupo($pdo);
            $objProdutosGrupo->setNome($_REQUEST['nome']);
            $objProdutosGrupo->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $novoId = $objProdutosGrupo->Adicionar();
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
        $template = "ajax.produtos_grupo.php";
        break;

    case "frm_atualizar_produtos_grupo" :
        $produtos_grupo = new ProdutosGrupo();
        $produtos_grupo->setId($_REQUEST["app_codigo"]);
        $linha = $produtos_grupo->Editar();
        $template = "tpl.frm.produtos_grupo.php";
        break;

    case "atualizar_produtos_grupo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosGrupo = new ProdutosGrupo($pdo);
            $objProdutosGrupo->setId($_REQUEST['id']);
            $objProdutosGrupo->setNome($_REQUEST['nome']);
            $objProdutosGrupo->Modificar();
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
        $template = "ajax.produtos_grupo.php";
        break;

    case "listar_produtos_grupo":
        $template = "tpl.geral.produtos_grupo.simples.php";
        break;

    case "listar_produtos_grupo_autocomplete":
        $objprodutos_grupo = new ProdutosGrupo();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objprodutos_grupo->BuscarAutoComplete($busca));
        $template = "ajax.produtos_grupo.php";
        break;

    case "deletar_produtos_grupo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objProdutosGrupo = new ProdutosGrupo($pdo);
            $objProdutosGrupo->Remover($_REQUEST['registros']);
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
        $template = "ajax.produtos_grupo.php";
        break;

    case "ajax_listar_produtos_grupo":
        $template = "tpl.lis.produtos_grupo.php";
        break;

    case "produtos_grupo_pdf":
        $template = "tpl.lis.produtos_grupo.pdf.php";
        break;

    case "produtos_grupo_xlsx":
        $template = "tpl.lis.produtos_grupo.xlsx.php";
        break;

    case "produtos_grupo_print":
        $template = "tpl.lis.produtos_grupo.print.php";
        break;

}
