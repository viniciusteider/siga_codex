<?php

switch($app_comando)
{
    case "frm_adicionar_fipe_anos":
        $template = "tpl.frm.fipe_anos.php";
        break;

    case "frm_modal_fipe_anos":
        if($_REQUEST["app_codigo"] != "") {
            $fipe_anos = new FipeAnos();
            $fipe_anos->setId($_REQUEST["app_codigo"]);
            $linha = $fipe_anos->Editar();
        }		$template = "tpl.form.fipe_anos.php";
        break;

    case "adicionar_fipe_anos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeAnos = new FipeAnos($pdo);
            $objFipeAnos->setIdFipeModelos($_REQUEST['id_fipe_modelos']);
            $objFipeAnos->setNome($_REQUEST['nome']);
            $objFipeAnos->setAno($_REQUEST['ano']);
            $objFipeAnos->setCombustivel($_REQUEST['combustivel']);
            $objFipeAnos->setValor($_REQUEST['valor']);
            $objFipeAnos->setMesReferencia($_REQUEST['mes_referencia']);
            $novoId = $objFipeAnos->Adicionar();
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
        $template = "ajax.fipe_anos.php";
        break;

    case "frm_atualizar_fipe_anos" :
        $fipe_anos = new FipeAnos();
        $fipe_anos->setId($_REQUEST["app_codigo"]);
        $linha = $fipe_anos->Editar();
        $template = "tpl.frm.fipe_anos.php";
        break;

    case "atualizar_fipe_anos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeAnos = new FipeAnos($pdo);
            $objFipeAnos->setId($_REQUEST['id']);
            $objFipeAnos->setIdFipeModelos($_REQUEST['id_fipe_modelos']);
            $objFipeAnos->setNome($_REQUEST['nome']);
            $objFipeAnos->setAno($_REQUEST['ano']);
            $objFipeAnos->setCombustivel($_REQUEST['combustivel']);
            $objFipeAnos->setValor($_REQUEST['valor']);
            $objFipeAnos->setMesReferencia($_REQUEST['mes_referencia']);
            $objFipeAnos->Modificar();
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
        $template = "ajax.fipe_anos.php";
        break;

    case "listar_fipe_anos":
        $template = "tpl.geral.fipe_anos.php";
        break;

    case "listar_fipe_anos_autocomplete":
        $objfipe_anos = new FipeAnos();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objfipe_anos->BuscarAutoComplete($busca,$_REQUEST['filtro']));
        $template = "ajax.fipe_anos.php";
        break;

    case "deletar_fipe_anos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objFipeAnos = new FipeAnos($pdo);
            $objFipeAnos->Remover($_REQUEST['registros']);
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
        $template = "ajax.fipe_anos.php";
        break;

    case "ajax_listar_fipe_anos":
        $template = "tpl.lis.fipe_anos.php";
        break;

    case "fipe_anos_pdf":
        $template = "tpl.lis.fipe_anos.pdf.php";
        break;

    case "fipe_anos_xlsx":
        $template = "tpl.lis.fipe_anos.xlsx.php";
        break;

    case "fipe_anos_print":
        $template = "tpl.lis.fipe_anos.print.php";
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
            $_SESSION["configuracao_usuario"]["fipe_anos"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("fipe_anos");
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
        $template = "ajax.fipe_anos.php";
        break;
}
