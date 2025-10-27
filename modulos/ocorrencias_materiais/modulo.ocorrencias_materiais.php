<?php

switch($app_comando)
{
    case "frm_adicionar_ocorrencias_materiais":
        $template = "tpl.frm.ocorrencias_materiais.php";
        break;

    case "frm_modal_ocorrencias_materiais":
        if($_REQUEST["app_codigo"] != "" && $_REQUEST["app_codigo"] != "undefined") {
            $ocorrencias_materiais = new OcorrenciasMateriais();
            $ocorrencias_materiais->setId($_REQUEST["app_codigo"]);
            $linha = $ocorrencias_materiais->Editar();
        }
        else
        {
            $objPaciente = new Paciente();
            $objPaciente->setId($_REQUEST['id_paciente']);
            $linha_paciente = $objPaciente->Editar();
            $linha['id_hospital'] = $linha_paciente['id_hospital'];


        }


        $template = "tpl.form.ocorrencias_materiais.php";
        break;

    case "adicionar_ocorrencias_materiais":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasMateriais = new OcorrenciasMateriais($pdo);
            $objOcorrenciasMateriais->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objOcorrenciasMateriais->setIdPaciente($_REQUEST['id_paciente']);
            $objOcorrenciasMateriais->setIdHospital($_REQUEST['id_hospital']);
            $objOcorrenciasMateriais->setIdResponsavel($_SESSION['usuario']['id']);
            $objOcorrenciasMateriais->setResponsavelHospital($_REQUEST['responsavel_hospital']);
            $novoId = $objOcorrenciasMateriais->Adicionar();
            if(count($_REQUEST['itens'] ?? []) > 0)
            {
                foreach ($_REQUEST['itens'] as $item)
                {
                    $objOcorrenciasMateriaisItens = new OcorrenciasMateriaisItens($pdo);
                    $objOcorrenciasMateriaisItens->setIdOcorenciaEntrega($novoId);
                    $objOcorrenciasMateriaisItens->setIdItem($item['id_item']);
                    $objOcorrenciasMateriaisItens->setQuantidade($item['quantidade']);
                    $objOcorrenciasMateriaisItens->Adicionar();
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
        $template = "ajax.ocorrencias_materiais.php";
        break;

    case "frm_atualizar_ocorrencias_materiais" :
        $ocorrencias_materiais = new OcorrenciasMateriais();
        $ocorrencias_materiais->setId($_REQUEST["app_codigo"]);
        $linha = $ocorrencias_materiais->Editar();
        $template = "tpl.frm.ocorrencias_materiais.php";
        break;

    case "atualizar_ocorrencias_materiais":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasMateriais = new OcorrenciasMateriais($pdo);
            $objOcorrenciasMateriais->setId($_REQUEST['id_ocorrencia_material']);
            $objOcorrenciasMateriais->setIdHospital($_REQUEST['id_hospital']);
            $objOcorrenciasMateriais->setResponsavelHospital($_REQUEST['responsavel_hospital']);
            $objOcorrenciasMateriais->Modificar();

            if(count($_REQUEST['itens'] ?? []) > 0)
            {
                $objOcorrenciasMateriaisItens = new OcorrenciasMateriaisItens($pdo);

                foreach ($_REQUEST['itens'] as $notin)
                    $registros[] = $notin['id_materiais_itens'];

                $notin = array_filter($registros);
                if(count($notin ?? []) > 0) $objOcorrenciasMateriaisItens->RemoverAll($notin);

                foreach ($_REQUEST['itens'] as $item)
                {
                    $objOcorrenciasMateriaisItens->setIdOcorenciaEntrega($novoId);
                    $objOcorrenciasMateriaisItens->setIdItem($item['id_item']);
                    $objOcorrenciasMateriaisItens->setIdOcorenciaEntrega($_REQUEST['id_ocorrencia_material']);
                    $objOcorrenciasMateriaisItens->setQuantidade($item['quantidade']);
                    if($item['id_materiais_itens'] != "")
                        $objOcorrenciasMateriaisItens->Modificar();
                    else
                        $objOcorrenciasMateriaisItens->Adicionar();

                }
            }

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
        $template = "ajax.ocorrencias_materiais.php";
        break;

    case "listar_ocorrencias_materiais":
        $template = "tpl.geral.ocorrencias_materiais.simples.php";
        break;

    case "listar_ocorrencias_materiais_autocomplete":
        $objocorrencias_materiais = new OcorrenciasMateriais();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objocorrencias_materiais->BuscarAutoComplete($busca));
        $template = "ajax.ocorrencias_materiais.php";
        break;

    case "deletar_ocorrencias_materiais":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasMateriais = new OcorrenciasMateriais($pdo);
            $objOcorrenciasMateriais->Remover($_REQUEST['registros']);
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
        $template = "ajax.ocorrencias_materiais.php";
        break;

    case "ajax_listar_ocorrencias_materiais":
        $template = "tpl.lis.ocorrencias_materiais.php";
        break;

    case "ocorrencias_materiais_pdf":
        $template = "tpl.lis.ocorrencias_materiais.pdf.php";
        break;

    case "ocorrencias_materiais_xlsx":
        $template = "tpl.lis.ocorrencias_materiais.xlsx.php";
        break;

    case "ocorrencias_materiais_print":
        $template = "tpl.lis.ocorrencias_materiais.print.php";
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
            $_SESSION["configuracao_usuario"]["ocorrencias_materiais"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("ocorrencias_materiais");
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
        $template = "ajax.ocorrencias_materiais.php";
        break;
}
