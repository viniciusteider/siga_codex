<?php

switch($app_comando)
{
    case "frm_adicionar_ocorrencias_apoio":
        $template = "tpl.frm.ocorrencias_apoio.php";
        break;

    case "frm_modal_ocorrencias_apoio":
        if($_REQUEST["app_codigo"] != "") {
            $ocorrencias_apoio = new OcorrenciasApoio();
            $ocorrencias_apoio->setId($_REQUEST["app_codigo"]);
            $linha = $ocorrencias_apoio->Editar();
        }
        else
        {
            $linha['hora_pedido'] = date('d/m/Y H:i:s');
            $linha['despachante'] = $_SESSION['usuario']['nome'];
        }

        $template = "tpl.form.ocorrencias_apoio.php";
        break;

    case "adicionar_ocorrencias_apoio":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasApoio = new OcorrenciasApoio($pdo);
            $objOcorrenciasApoio->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objOcorrenciasApoio->setHoraPedido(Conexao::PrepararDataBD($_REQUEST['hora_pedido'], $_SESSION['usuario']['timezone']));
            $objOcorrenciasApoio->setIdOrgaoApoio($_REQUEST['id_orgao_apoio']);
            $objOcorrenciasApoio->setResponsavelApoio($_REQUEST['responsavel_apoio']);
            $objOcorrenciasApoio->setSolicitacao($_REQUEST['solicitacao']);
            $objOcorrenciasApoio->setTotalPessoas($_REQUEST['total_pessoas']);
            $objOcorrenciasApoio->setTotalVeiculos($_REQUEST['total_veiculos']);
            $objOcorrenciasApoio->setIdOcorrencias($_REQUEST['id_ocorrencias']);
            $objOcorrenciasApoio->setObsSv($_REQUEST['obs_sv']);
            $objOcorrenciasApoio->setDespachante($_SESSION['usuario']['id']);
            $novoId = $objOcorrenciasApoio->Adicionar();
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
        $template = "ajax.ocorrencias_apoio.php";
        break;

    case "frm_atualizar_ocorrencias_apoio" :
        $ocorrencias_apoio = new OcorrenciasApoio();
        $ocorrencias_apoio->setId($_REQUEST["app_codigo"]);
        $linha = $ocorrencias_apoio->Editar();
        $template = "tpl.frm.ocorrencias_apoio.php";
        break;

    case "atualizar_ocorrencias_apoio":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasApoio = new OcorrenciasApoio($pdo);
            $objOcorrenciasApoio->setId($_REQUEST['id_ocorrencia_apoio']);
            $objOcorrenciasApoio->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objOcorrenciasApoio->setHoraPedido(Conexao::PrepararDataBD($_REQUEST['hora_pedido'], $_SESSION['usuario']['timezone']));
            $objOcorrenciasApoio->setIdOrgaoApoio($_REQUEST['id_orgao_apoio']);
            $objOcorrenciasApoio->setResponsavelApoio($_REQUEST['responsavel_apoio']);
            $objOcorrenciasApoio->setSolicitacao($_REQUEST['solicitacao']);
            $objOcorrenciasApoio->setTotalPessoas($_REQUEST['total_pessoas']);
            $objOcorrenciasApoio->setTotalVeiculos($_REQUEST['total_veiculos']);
            $objOcorrenciasApoio->setIdOcorrencias($_REQUEST['id_ocorrencias']);
            $objOcorrenciasApoio->setObsSv($_REQUEST['obs_sv']);
            $objOcorrenciasApoio->Modificar();
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
        $template = "ajax.ocorrencias_apoio.php";
        break;

    case "listar_ocorrencias_apoio":
        $template = "tpl.geral.ocorrencias_apoio.php";
        break;

    case "listar_ocorrencias_apoio_autocomplete":
        $objocorrencias_apoio = new OcorrenciasApoio();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objocorrencias_apoio->BuscarAutoComplete($busca));
        $template = "ajax.ocorrencias_apoio.php";
        break;

    case "deletar_ocorrencias_apoio":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasApoio = new OcorrenciasApoio($pdo);
            $objOcorrenciasApoio->Remover($_REQUEST['registros']);
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
        $template = "ajax.ocorrencias_apoio.php";
        break;

    case "ajax_listar_ocorrencias_apoio":
        $template = "tpl.lis.ocorrencias_apoio.php";
        break;

    case "ocorrencias_apoio_pdf":
        $template = "tpl.lis.ocorrencias_apoio.pdf.php";
        break;

    case "ocorrencias_apoio_xlsx":
        $template = "tpl.lis.ocorrencias_apoio.xlsx.php";
        break;

    case "ocorrencias_apoio_print":
        $template = "tpl.lis.ocorrencias_apoio.print.php";
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
            $_SESSION["configuracao_usuario"]["ocorrencias_apoio"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("ocorrencias_apoio");
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
        $template = "ajax.ocorrencias_apoio.php";
        break;
}
