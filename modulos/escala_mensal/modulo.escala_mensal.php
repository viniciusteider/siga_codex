<?php

switch($app_comando)
{
    case "frm_adicionar_escala_mensal":
        $template = "tpl.frm.escala_mensal.php";
        break;
    case "frm_replicar_escala_mensal":
        $template = "tpl.replicar.escala_mensal.php";
        break;
    case "replicar_escala_mensal":
        $template = "tpl.copia.escala_mensal.php";
        break;

    case "frm_modal_escala_mensal":
        if($_REQUEST["app_codigo"] != "") {
            $escala_mensal = new EscalaMensal();
            $escala_mensal->setId($_REQUEST["app_codigo"]);
            $linha = $escala_mensal->Editar();
        }		$template = "tpl.form.escala_mensal.php";
        break;

    case "adicionar_copia_escala_mensal":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            if(is_array($_REQUEST['dias']) && count($_REQUEST['dias']) > 0)
            {
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
        $template = "ajax.escala_mensal.php";
        break;
    case "adicionar_escala_mensal":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            if(is_array($_REQUEST['dias']) && count($_REQUEST['dias']) > 0)
            {
                foreach ($_REQUEST['dias'] as $dia) {
                    $objEquipe = new Equipes();
                    $equipe = $objEquipe->ListarEquipeEfetivo($dia['id_equipe']);
                    if(is_array($equipe) && count($equipe) > 0)
                    {
                        foreach ($equipe as $item) {
                            $objEscalaMensal = new EscalaMensal($pdo);
                            $objEscalaMensal->setIdUsuario($item['id_efetivo']);
                            $objEscalaMensal->setIdFuncao($item['id_funcao']);
                            $objEscalaMensal->setIdLocal($dia['id_local']);
                            $objEscalaMensal->setIdEquipe($dia['id_equipe']);
                            $objEscalaMensal->setDataHoraEntrada(Conexao::PrepararDataBD($dia['data_hora_entrada'], $_SESSION['usuario']['timezone']));
                            $objEscalaMensal->setDataHoraSaida(Conexao::PrepararDataBD($dia['data_hora_saida'], $_SESSION['usuario']['timezone']));
                            $objEscalaMensal->Adicionar();
                        }
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
        $template = "ajax.escala_mensal.php";
        break;

    case "frm_atualizar_escala_mensal" :
        $escala_mensal = new EscalaMensal();
        $escala_mensal->setId($_REQUEST["app_codigo"]);
        $linha = $escala_mensal->Editar();
        $template = "tpl.frm.escala_mensal.php";
        break;

    case "atualizar_escala_mensal":
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
        $template = "ajax.escala_mensal.php";
        break;

    case "listar_escala_mensal":
        $template = "tpl.geral.escala_mensal.php";
        break;

    case "listar_escala_mensal_autocomplete":
        $objescala_mensal = new EscalaMensal();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objescala_mensal->BuscarAutoComplete($busca));
        $template = "ajax.escala_mensal.php";
        break;

    case "deletar_escala_mensal":
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
        $template = "ajax.escala_mensal.php";
        break;

    case "ajax_listar_escala_mensal":
        $template = "tpl.lis.escala_mensal.php";
        break;

    case "escala_mensal_pdf":
        $template = "tpl.lis.escala_mensal.pdf.php";
        break;

    case "escala_mensal_xlsx":
        $template = "tpl.lis.escala_mensal.xlsx.php";
        break;

    case "escala_mensal_print":
        $template = "tpl.lis.escala_mensal.print.php";
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
            $_SESSION["configuracao_usuario"]["escala_mensal"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("escala_mensal");
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
        $template = "ajax.escala_mensal.php";
        break;
}
