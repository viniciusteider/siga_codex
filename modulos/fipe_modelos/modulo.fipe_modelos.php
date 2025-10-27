<?php

switch($app_comando)
{
    case "frm_adicionar_fipe_modelos":
        $template = "tpl.frm.fipe_modelos.php";
        break;

    case "frm_modal_fipe_modelos":
        if($_REQUEST["app_codigo"] != "") {
            $fipe_modelos = new FipeModelos();
            $fipe_modelos->setId($_REQUEST["app_codigo"]);
            $linha = $fipe_modelos->Editar();
        }		$template = "tpl.form.fipe_modelos.php";
        break;

    case "adicionar_fipe_modelos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeModelos = new FipeModelos($pdo);
            $objFipeModelos->setIdFipeMarcas($_REQUEST['id_fipe_marcas']);
            $objFipeModelos->setCodigoModelo($_REQUEST['codigo_modelo']);
            $objFipeModelos->setCodigoFipe($_REQUEST['codigo_fipe']);
            $objFipeModelos->setNome($_REQUEST['nome']);
            $novoId = $objFipeModelos->Adicionar();
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
        $template = "ajax.fipe_modelos.php";
        break;

    case "frm_atualizar_fipe_modelos" :
        $fipe_modelos = new FipeModelos();
        $fipe_modelos->setId($_REQUEST["app_codigo"]);
        $linha = $fipe_modelos->Editar();
        $template = "tpl.frm.fipe_modelos.php";
        break;

    case "atualizar_fipe_modelos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeModelos = new FipeModelos($pdo);
            $objFipeModelos->setId($_REQUEST['id']);
            $objFipeModelos->setIdFipeMarcas($_REQUEST['id_fipe_marcas']);
            $objFipeModelos->setCodigoModelo($_REQUEST['codigo_modelo']);
            $objFipeModelos->setCodigoFipe($_REQUEST['codigo_fipe']);
            $objFipeModelos->setNome($_REQUEST['nome']);
            $objFipeModelos->Modificar();
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
        $template = "ajax.fipe_modelos.php";
        break;

    case "listar_fipe_modelos":
        $template = "tpl.geral.fipe_modelos.php";
        break;

    case "listar_fipe_modelos_autocomplete":
        $objfipe_modelos = new FipeModelos();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objfipe_modelos->BuscarAutoComplete($busca,$_REQUEST['filtro']));
        $template = "ajax.fipe_modelos.php";
        break;

    case "deletar_fipe_modelos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeModelos = new FipeModelos($pdo);
            $objFipeModelos->Remover($_REQUEST['registros']);
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
        $template = "ajax.fipe_modelos.php";
        break;

    case "ajax_listar_fipe_modelos":
        $template = "tpl.lis.fipe_modelos.php";
        break;

    case "fipe_modelos_pdf":
        $template = "tpl.lis.fipe_modelos.pdf.php";
        break;

    case "fipe_modelos_xlsx":
        $template = "tpl.lis.fipe_modelos.xlsx.php";
        break;

    case "fipe_modelos_print":
        $template = "tpl.lis.fipe_modelos.print.php";
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
            $_SESSION["configuracao_usuario"]["fipe_modelos"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("fipe_modelos");
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
        $template = "ajax.fipe_modelos.php";
        break;
}
