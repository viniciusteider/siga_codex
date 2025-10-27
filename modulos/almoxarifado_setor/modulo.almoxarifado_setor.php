<?php

switch($app_comando)
{
    case "frm_adicionar_almoxarifado_setor":
        $template = "tpl.frm.almoxarifado_setor.php";
        break;

    case "frm_modal_almoxarifado_setor":
        if($_REQUEST["app_codigo"] != "") {
            $almoxarifado_setor = new AlmoxarifadoSetor();
            $almoxarifado_setor->setId($_REQUEST["app_codigo"]);
            $linha = $almoxarifado_setor->Editar();
        }		$template = "tpl.form.almoxarifado_setor.php";
        break;

    case "adicionar_almoxarifado_setor":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objAlmoxarifadoSetor = new AlmoxarifadoSetor($pdo);
            $objAlmoxarifadoSetor->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
            $objAlmoxarifadoSetor->setNome($_REQUEST['nome']);
            $novoId = $objAlmoxarifadoSetor->Adicionar();
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
        $template = "ajax.almoxarifado_setor.php";
        break;

    case "frm_atualizar_almoxarifado_setor" :
        $almoxarifado_setor = new AlmoxarifadoSetor();
        $almoxarifado_setor->setId($_REQUEST["app_codigo"]);
        $linha = $almoxarifado_setor->Editar();
        $template = "tpl.frm.almoxarifado_setor.php";
        break;

    case "atualizar_almoxarifado_setor":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objAlmoxarifadoSetor = new AlmoxarifadoSetor($pdo);
            $objAlmoxarifadoSetor->setId($_REQUEST['id']);
            $objAlmoxarifadoSetor->setIdAlmoxarifado($_REQUEST['id_almoxarifado']);
            $objAlmoxarifadoSetor->setNome($_REQUEST['nome']);
            $objAlmoxarifadoSetor->Modificar();
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
        $template = "ajax.almoxarifado_setor.php";
        break;
    case "listar_setores_almoxarifado":
        $objAlmoxarifadoSetor = new AlmoxarifadoSetor();
        $rs = $objAlmoxarifadoSetor->ListarSetoresAmoxarifado($_REQUEST['app_codigo']);
        echo json_encode($rs);
        $template = "ajax.almoxarifado_setor.php";
        break;

    case "listar_almoxarifado_setor":
        $template = "tpl.geral.almoxarifado_setor.simples.php";
        break;

    case "listar_almoxarifado_setor_autocomplete":
        $objalmoxarifado_setor = new AlmoxarifadoSetor();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objalmoxarifado_setor->BuscarAutoComplete($busca));
        $template = "ajax.almoxarifado_setor.php";
        break;

    case "deletar_almoxarifado_setor":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objAlmoxarifadoSetor = new AlmoxarifadoSetor($pdo);
            $objAlmoxarifadoSetor->Remover($_REQUEST['registros']);
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
        $template = "ajax.almoxarifado_setor.php";
        break;

    case "ajax_listar_almoxarifado_setor":
        $template = "tpl.lis.almoxarifado_setor.php";
        break;

    case "almoxarifado_setor_pdf":
        $template = "tpl.lis.almoxarifado_setor.pdf.php";
        break;

    case "almoxarifado_setor_xlsx":
        $template = "tpl.lis.almoxarifado_setor.xlsx.php";
        break;

    case "almoxarifado_setor_print":
        $template = "tpl.lis.almoxarifado_setor.print.php";
        break;

    case "frm_configurar_listagem":
        $template = "configuracao_listagem.php";
        break;

    case "configurar_listagem":
        $usuarioConfiguracao = new UsuarioConfiguracao();
        foreach ($_POST as $checkbox => $idCampo) {
            if ($checkbox == "limite_colunas") {
                continue;
            }
            if (is_array($idCampo)) {
                if ($idCampo["valor"] == "") {
                    continue;
                } else {
                    $colunasSelecionadas[$checkbox] = ["id_campo" => $idCampo["id"], "valor_campo" => $idCampo["valor"]];
                }
            } else {
                $colunasSelecionadas[$checkbox] = $idCampo;
            }
        }
        $countColunasSelecionadas = count($colunasSelecionadas);
        if ($countColunasSelecionadas > 0) {
            if (($countColunasSelecionadas > $_REQUEST["limite_colunas"]) && $_REQUEST["limite_colunas"] != "0" && $_REQUEST["limite_colunas"] != "") {
                $msg["codigo"]   = 1;
                $msg["mensagem"] = TXT_LIMITE_COLUNAS_EXCEDIDO_RESOLUCAO;
                echo json_encode($msg);
                die();
            }
            $_SESSION["configuracao_usuario"]["almoxarifado_setor"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("almoxarifado_setor");
            $usuarioConfiguracao->LimparConfiguracoes();
            foreach ($colunasSelecionadas AS $nomeCampo => $idCampo) {
                if (is_array($idCampo)) {
                    $usuarioConfiguracao->setIdCampoModulo($idCampo["id_campo"]);
                    $usuarioConfiguracao->setValorCampo($idCampo["valor_campo"]);
                } else {
                    $usuarioConfiguracao->setIdCampoModulo($idCampo);
                }
                $resultado = $usuarioConfiguracao->AdicionarUsuarioConfiguracao();
                if (!$resultado) {
                    break;
                }
            }
            if ($resultado) {
                $msg["codigo"]   = 0;
                $msg["mensagem"] = "Sucesso ao executar operação";
            } else {
                $msg["codigo"]   = 1;
                $msg["mensagem"] = "Erro ao executar operação";
            }
        } else {
            $msg["codigo"]   = 1;
            $msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
        }
        echo json_encode($msg);
        $template = "ajax.almoxarifado_setor.php";
        break;
}
