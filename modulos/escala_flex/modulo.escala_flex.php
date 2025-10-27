<?php

switch ($app_comando) {
    case "frm_adicionar_escala_flex":
        $template = "tpl.frm.escala_flex.php";
        break;
    case "frm_replicar_escala_flex":
        $template = "tpl.replicar.escala_flex.php";
        break;
    case "replicar_escala_flex":
        $template = "tpl.copia.escala_flex.php";
        break;

    case "frm_modal_escala_flex":
        if ($_REQUEST["app_codigo"] != "") {
            $escala_flex = new EscalaMensal();
            $escala_flex->setId($_REQUEST["app_codigo"]);
            $linha = $escala_flex->Editar();
        }
        $template = "tpl.form.escala_flex.php";
        break;

    case "adicionar_copia_escala_flex":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            if (is_array($_REQUEST['dias']) && count($_REQUEST['dias']) > 0) {
                foreach ($_REQUEST['dias'] as $dia) {
                    $objEscalaMensal = new EscalaMensal($pdo);
                    $objEscalaMensal->setIdUsuario($dia['id_usuario']);
                    $objEscalaMensal->setIdFuncao($dia['id_funcao']);
                    $objEscalaMensal->setIdLocal($dia['id_local']);
                    $objEscalaMensal->setIdEquipe($dia['id_equipe']);
                    $objEscalaMensal->setDataHoraEntrada(Conexao::PrepararDataBD($dia['data_hora_entrada'], $_SESSION['usuario']['timezone']));
                    $objEscalaMensal->setDataHoraSaida(Conexao::PrepararDataBD($dia['data_hora_saida'], $_SESSION['usuario']['timezone']));
                    $objEscalaMensal->Adicionar();
                }
            }
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
        $template = "ajax.escala_flex.php";
        break;
    case "adicionar_escala_flex":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            if (is_array($_REQUEST['id_local']) && count($_REQUEST['id_local']) > 0) {
                foreach ($_REQUEST['id_local'] as $local) {
                    if (!is_array($_REQUEST['id_efetivo_' . $local])) {
                        continue;
                    }
                    foreach ($_REQUEST['id_efetivo_' . $local] as $efetivo) {
                        $objEscalaMensal = new EscalaMensal($pdo);
                        $objEscalaMensal->setIdUsuario($efetivo);
                        $objEscalaMensal->setIdFuncao($_REQUEST['id_funcao_' . $local . '_' . $efetivo]);
                        $objEscalaMensal->setIdLocal($local);
                        $objEscalaMensal->setDataHoraEntrada(Conexao::PrepararDataBD($_REQUEST['data_hora_entrada_' . $local . '_' . $efetivo], $_SESSION['usuario']['timezone']));
                        $objEscalaMensal->setDataHoraSaida(Conexao::PrepararDataBD($_REQUEST['data_hora_saida_' . $local . '_' . $efetivo], $_SESSION['usuario']['timezone']));
                        $objEscalaMensal->Adicionar();
                    }
                }
            }


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
        $template = "ajax.escala_flex.php";
        break;

    case "frm_atualizar_escala_flex":
        $escala_flex = new EscalaMensal();
        $escala_flex->setId($_REQUEST["app_codigo"]);
        $linha = $escala_flex->Editar();
        $template = "tpl.frm.escala_flex.php";
        break;

    case "atualizar_escala_flex":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEscalaMensal = new EscalaMensal($pdo);
            $objEscalaMensal->setId($_REQUEST['id']);
            $objEscalaMensal->setIdUsuario($_REQUEST['id_usuario']);
            $objEscalaMensal->setIdFuncao($_REQUEST['id_funcao']);
            $objEscalaMensal->setIdLocal($_REQUEST['id_local']);
            $objEscalaMensal->setDataHoraEntrada(Conexao::PrepararDataBD($_REQUEST['data_hora_entrada'], $_SESSION['usuario']['timezone']));
            $objEscalaMensal->setDataHoraSaida(Conexao::PrepararDataBD($_REQUEST['data_hora_saida'], $_SESSION['usuario']['timezone']));
            $objEscalaMensal->Modificar();
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
        $template = "ajax.escala_flex.php";
        break;

    case "listar_escala_flex":
        $template = "tpl.geral.escala_flex.php";
        break;

    case "listar_escala_flex_autocomplete":
        $objescala_flex = new EscalaMensal();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objescala_flex->BuscarAutoComplete($busca));
        $template = "ajax.escala_flex.php";
        break;

    case "deletar_escala_flex":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEscalaMensal = new EscalaMensal($pdo);
            $objEscalaMensal->Remover($_REQUEST['registros']);
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
        $template = "ajax.escala_flex.php";
        break;

    case "ajax_listar_escala_flex":
        $template = "tpl.lis.escala_flex.php";
        break;

    case "escala_flex_pdf":
        $template = "tpl.lis.escala_flex.pdf.php";
        break;

    case "escala_flex_xlsx":
        $template = "tpl.lis.escala_flex.xlsx.php";
        break;

    case "escala_flex_print":
        $template = "tpl.lis.escala_flex.print.php";
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
            $_SESSION["configuracao_usuario"]["escala_flex"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("escala_flex");
            $usuarioConfiguracao->LimparConfiguracoes();
            foreach ($colunasSelecionadas as $nomeCampo => $idCampo) {
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
        $template = "ajax.escala_flex.php";
        break;
}
