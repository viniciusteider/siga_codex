<?php

switch($app_comando)
{
    case "frm_adicionar_unidade_medida":
        $template = "tpl.frm.unidade_medida.php";
        break;

    case "frm_modal_unidade_medida":
        if($_REQUEST["app_codigo"] != "") {
            $unidade_medida = new UnidadeMedida();
            $unidade_medida->setId($_REQUEST["app_codigo"]);
            $linha = $unidade_medida->Editar();
        }		$template = "tpl.form.unidade_medida.php";
        break;

    case "adicionar_unidade_medida":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objUnidadeMedida = new UnidadeMedida($pdo);
            $objUnidadeMedida->setNome($_REQUEST['nome']);
            $objUnidadeMedida->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $novoId = $objUnidadeMedida->Adicionar();
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
        $template = "ajax.unidade_medida.php";
        break;

    case "frm_atualizar_unidade_medida" :
        $unidade_medida = new UnidadeMedida();
        $unidade_medida->setId($_REQUEST["app_codigo"]);
        $linha = $unidade_medida->Editar();
        $template = "tpl.frm.unidade_medida.php";
        break;

    case "atualizar_unidade_medida":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objUnidadeMedida = new UnidadeMedida($pdo);
            $objUnidadeMedida->setId($_REQUEST['id']);
            $objUnidadeMedida->setNome($_REQUEST['nome']);
            $objUnidadeMedida->Modificar();
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
        $template = "ajax.unidade_medida.php";
        break;

    case "listar_unidade_medida":
        $template = "tpl.geral.unidade_medida.php";
        break;

    case "listar_unidade_medida_autocomplete":
        $objunidade_medida = new UnidadeMedida();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objunidade_medida->BuscarAutoComplete($busca));
        $template = "ajax.unidade_medida.php";
        break;

    case "deletar_unidade_medida":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objUnidadeMedida = new UnidadeMedida($pdo);
            $objUnidadeMedida->Remover($_REQUEST['registros']);
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
        $template = "ajax.unidade_medida.php";
        break;

    case "ajax_listar_unidade_medida":
        $template = "tpl.lis.unidade_medida.php";
        break;

    case "unidade_medida_pdf":
        $template = "tpl.lis.unidade_medida.pdf.php";
        break;

    case "unidade_medida_xlsx":
        $template = "tpl.lis.unidade_medida.xlsx.php";
        break;

    case "unidade_medida_print":
        $template = "tpl.lis.unidade_medida.print.php";
        break;

}
