<?php

switch($app_comando)
{
    case "frm_adicionar_fipe_tipo":
        $template = "tpl.frm.fipe_tipo.php";
        break;

    case "frm_modal_fipe_tipo":
        if($_REQUEST["app_codigo"] != "") {
            $fipe_tipo = new FipeTipo();
            $fipe_tipo->setId($_REQUEST["app_codigo"]);
            $linha = $fipe_tipo->Editar();
        }		$template = "tpl.form.fipe_tipo.php";
        break;

    case "adicionar_fipe_tipo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeTipo = new FipeTipo($pdo);
            $objFipeTipo->setNome($_REQUEST['nome']);
            $objFipeTipo->setNomeUrl($_REQUEST['nome_url']);
            $novoId = $objFipeTipo->Adicionar();
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
        $template = "ajax.fipe_tipo.php";
        break;

    case "frm_atualizar_fipe_tipo" :
        $fipe_tipo = new FipeTipo();
        $fipe_tipo->setId($_REQUEST["app_codigo"]);
        $linha = $fipe_tipo->Editar();
        $template = "tpl.frm.fipe_tipo.php";
        break;

    case "atualizar_fipe_tipo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeTipo = new FipeTipo($pdo);
            $objFipeTipo->setId($_REQUEST['id']);
            $objFipeTipo->setNome($_REQUEST['nome']);
            $objFipeTipo->setNomeUrl($_REQUEST['nome_url']);
            $objFipeTipo->Modificar();
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
        $template = "ajax.fipe_tipo.php";
        break;

    case "listar_fipe_tipo":
        $template = "tpl.geral.fipe_tipo.php";
        break;

    case "listar_fipe_tipo_autocomplete":
        $objfipe_tipo = new FipeTipo();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objfipe_tipo->BuscarAutoComplete($busca));
        $template = "ajax.fipe_tipo.php";
        break;

    case "deletar_fipe_tipo":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeTipo = new FipeTipo($pdo);
            $objFipeTipo->Remover($_REQUEST['registros']);
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
        $template = "ajax.fipe_tipo.php";
        break;

    case "ajax_listar_fipe_tipo":
        $template = "tpl.lis.fipe_tipo.php";
        break;

    case "fipe_tipo_pdf":
        $template = "tpl.lis.fipe_tipo.pdf.php";
        break;

    case "fipe_tipo_xlsx":
        $template = "tpl.lis.fipe_tipo.xlsx.php";
        break;

    case "fipe_tipo_print":
        $template = "tpl.lis.fipe_tipo.print.php";
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
            $_SESSION["configuracao_usuario"]["fipe_tipo"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("fipe_tipo");
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
        $template = "ajax.fipe_tipo.php";
        break;
}
