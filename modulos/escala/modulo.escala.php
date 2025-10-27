<?php

switch($app_comando)
{
    case "frm_adicionar_escala":
        $template = "tpl.frm.escala.php";
        break;
    case "frm_copiar_escala":
        $escala = new Escala();
        $escala->setId($_REQUEST["app_codigo"]);
        $linha = $escala->Editar();
        $template = "tpl.frm.copiar.escala.php";
        break;
    case "copiar_escala":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $escala = new Escala($pdo);
            $escala->setId($_REQUEST["id"]);
            $linha = $escala->Editar();

            $objEscala = new Escala($pdo);
            $objEscala->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objEscala->setIdEquipe($linha['id_equipe']);
            $objEscala->setNome($_REQUEST['nome']);
            $objEscala->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
            $objEscala->setDataFim(Conexao::PrepararDataBD($_REQUEST['data_fim'], $_SESSION['usuario']['timezone']));
            $novoId = $objEscala->Adicionar();

            $objEscalaEquipe = new EscalaEquipe($pdo);
            $lista_equipe = $objEscalaEquipe->ListarEquipeEscala($_REQUEST["id"]);

            if(is_array($lista_equipe) && count($lista_equipe) > 0)
            {
                foreach ($lista_equipe as $item) {
                    $objEscalaEquipe = new EscalaEquipe($pdo);
                    $objEscalaEquipe->setIdEscala($novoId);
                    $objEscalaEquipe->setIdEfetivo($item['id_efetivo']);
                    $objEscalaEquipe->setIdFuncao($item['id_funcao']);
                    $objEscalaEquipe->setIdLocal($item['id_local']);
                    $objEscalaEquipe->Adicionar();
                }
            }
            $msg["codigo"] = 0;
            $msg["id"] = $novoId;
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
        $template = "ajax.escala.php";
        break;
    case "atualizar_escala_mensal":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            if(is_array($_REQUEST['id_usuario']) && count($_REQUEST['id_usuario']) > 0)
            {
                foreach ($_REQUEST['id_usuario'] as $id_usuario)
                {
                    $objEscalaEquipe = new EscalaEquipe($pdo);
                    $objEscalaEquipe->setIdEscala($_REQUEST['id']);
                    $objEscalaEquipe->setIdEfetivo($id_usuario);
                    $objEscalaEquipe->setIdFuncao($_REQUEST['id_funcao'][$id_usuario]);
                    $objEscalaEquipe->setIdLocal($_REQUEST['id_local'][$id_usuario]);
                    $novoId = $objEscalaEquipe->Adicionar();

                    $id_escala_equipe = ($_REQUEST['id_escala_equipe'][$id_usuario] == "" ) ? $novoId : $_REQUEST['id_escala_equipe'][$id_usuario] ;
                    if(is_array($_REQUEST['dias'][$id_usuario]) && count($_REQUEST['dias'][$id_usuario]) > 0)
                    {
                        foreach ($_REQUEST['dias'][$id_usuario] as  $dia)
                        {
                            $objEscalaHorarios = new EscalaHorarios($pdo);
                            $objEscalaHorarios->setId($_REQUEST['id_escala_horarios']);
                            $horas =$objEscalaHorarios->Editar();
                            $objEscalaEquipeHorarios = new EscalaEquipeHorarios($pdo);
                            $objEscalaEquipeHorarios->setIdEscalaEquipe($id_escala_equipe);
                            $objEscalaEquipeHorarios->setIdEscalaHorarios($_REQUEST['id_escala_horarios']);
                            $objEscalaEquipeHorarios->setData(Conexao::PrepararDataBD($dia, $_SESSION['usuario']['timezone']));
                            $objEscalaEquipeHorarios->setHoraInicio($horas['hora_inicio']);
                            $objEscalaEquipeHorarios->setHoraFim($horas['hora_fim']);
                            $objEscalaEquipeHorarios->Adicionar();
                        }
                    }

                }
            }
            $msg["codigo"] = 0;
            $msg["id"] = $_REQUEST['id'];
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
        $template = "ajax.escala.php";
        break;
    case "frm_adicionar_escala_mensal":
        $escala = new Escala();
        $escala->setId($_REQUEST["app_codigo"]);
        $linha = $escala->Editar();

        $template = "tpl.frm.escala2.php";
        break;

    case "frm_modal_escala":
        if($_REQUEST["app_codigo"] != "") {
            $escala = new Escala();
            $escala->setId($_REQUEST["app_codigo"]);
            $linha = $escala->Editar();
        }		$template = "tpl.form.escala.php";
        break;

    case "adicionar_escala":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEscala = new Escala($pdo);
            $objEscala->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objEscala->setIdEquipe($_REQUEST['id_equipe']);
            $objEscala->setNome($_REQUEST['nome']);
            $objEscala->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
            $objEscala->setDataFim(Conexao::PrepararDataBD($_REQUEST['data_fim'], $_SESSION['usuario']['timezone']));
            $novoId = $objEscala->Adicionar();
            $msg["codigo"] = 0;
            $msg["id"] = $novoId;
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
        $template = "ajax.escala.php";
        break;

    case "frm_atualizar_escala" :
        $escala = new Escala();
        $escala->setId($_REQUEST["app_codigo"]);
        $linha = $escala->Editar();
        $template = "tpl.frm.escala.php";
        break;

    case "atualizar_escala":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEscala = new Escala($pdo);
            $objEscala->setId($_REQUEST['id']);
            $objEscala->setIdEquipe($_REQUEST['id_equipe']);
            $objEscala->setNome($_REQUEST['nome']);
            $objEscala->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
            $objEscala->setDataFim(Conexao::PrepararDataBD($_REQUEST['data_fim'], $_SESSION['usuario']['timezone']));
            $objEscala->Modificar();
            $msg["codigo"] = 0;
            $msg["id"] = $_REQUEST['id'];
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
        $template = "ajax.escala.php";
        break;

    case "listar_escala":
        $template = "tpl.geral.escala.php";
        break;

    case "listar_escala_autocomplete":
        $objescala = new Escala();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objescala->BuscarAutoComplete($busca));
        $template = "ajax.escala.php";
        break;

    case "deletar_escala":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEscala = new Escala($pdo);
            $objEscala->Remover($_REQUEST['registros']);
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
        $template = "ajax.escala.php";
        break;

    case "ajax_listar_escala":
        $template = "tpl.lis.escala.php";
        break;

    case "escala_pdf":
        $escala = new Escala();
        $escala->setId($_REQUEST["app_codigo"]);
        $linha = $escala->Editar();
        $template = "tpl.lis.escala.pdf.php";
        break;

    case "escala_xlsx":
        $escala = new Escala();
        $escala->setId($_REQUEST["app_codigo"]);
        $linha = $escala->Editar();
        $template = "tpl.lis.escala.xlsx.php";
        break;

    case "escala_print":
        $escala = new Escala();
        $escala->setId($_REQUEST["app_codigo"]);
        $linha = $escala->Editar();
        $template = "tpl.lis.escala.print.php";
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
            $_SESSION["configuracao_usuario"]["escala"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("escala");
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
        $template = "ajax.escala.php";
        break;
}
