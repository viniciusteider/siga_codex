<?php

switch($app_comando)
{
    case "frm_adicionar_fabricante":
        $template = "tpl.frm.fabricante.php";
        break;

    case "frm_modal_fabricante":
        if($_REQUEST["app_codigo"] != "") {
            $fabricante = new Fabricante();
            $fabricante->setId($_REQUEST["app_codigo"]);
            $linha = $fabricante->Editar();
        }		$template = "tpl.form.fabricante.php";
        break;

    case "adicionar_fabricante":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFabricante = new Fabricante($pdo);
            $objFabricante->setNome($_REQUEST['nome']);
            $objFabricante->setCnpj($_REQUEST['cnpj']);
            $objFabricante->setContatosTecnicos($_REQUEST['contatos_tecnicos']);
            $objFabricante->setContatosComerciais($_REQUEST['contatos_comerciais']);
            $objFabricante->setObservacoes($_REQUEST['observacoes']);
            $objFabricante->setLiberado($_REQUEST['liberado']);
            $novoId = $objFabricante->Adicionar();
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
        $template = "ajax.fabricante.php";
        break;

    case "frm_atualizar_fabricante" :
        $fabricante = new Fabricante();
        $fabricante->setId($_REQUEST["app_codigo"]);
        $linha = $fabricante->Editar();
        $template = "tpl.frm.fabricante.php";
        break;

    case "atualizar_fabricante":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFabricante = new Fabricante($pdo);
            $objFabricante->setId($_REQUEST['id']);
            $objFabricante->setNome($_REQUEST['nome']);
            $objFabricante->setCnpj($_REQUEST['cnpj']);
            $objFabricante->setContatosTecnicos($_REQUEST['contatos_tecnicos']);
            $objFabricante->setContatosComerciais($_REQUEST['contatos_comerciais']);
            $objFabricante->setObservacoes($_REQUEST['observacoes']);
            $objFabricante->setLiberado($_REQUEST['liberado']);
            $objFabricante->Modificar();
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
        $template = "ajax.fabricante.php";
        break;

    case "listar_fabricante":
        $template = "tpl.geral.fabricante.php";
        break;

    case "listar_fabricante_autocomplete":
        $objfabricante = new Fabricante();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objfabricante->BuscarAutoComplete($busca));
        $template = "ajax.fabricante.php";
        break;

    case "deletar_fabricante":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFabricante = new Fabricante($pdo);
            $objFabricante->Remover($_REQUEST['registros']);
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
        $template = "ajax.fabricante.php";
        break;

    case "ajax_listar_fabricante":
        $template = "tpl.lis.fabricante.php";
        break;

    case "fabricante_pdf":
        $template = "tpl.lis.fabricante.pdf.php";
        break;

    case "fabricante_xlsx":
        $template = "tpl.lis.fabricante.xlsx.php";
        break;

    case "fabricante_print":
        $template = "tpl.lis.fabricante.print.php";
        break;

}
