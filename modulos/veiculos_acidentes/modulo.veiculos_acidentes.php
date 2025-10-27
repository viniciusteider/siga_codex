<?php

switch($app_comando)
{
    case "frm_adicionar_veiculos_acidentes":
        $template = "tpl.frm.veiculos_acidentes.php";
        break;

    case "frm_modal_veiculos_acidentes":
        if($_REQUEST["app_codigo"] != "") {
            $veiculos_acidentes = new VeiculosAcidentes();
            $veiculos_acidentes->setId($_REQUEST["app_codigo"]);
            $linha = $veiculos_acidentes->Editar();
        }		$template = "tpl.form.veiculos_acidentes.php";
        break;

    case "adicionar_veiculos_acidentes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objVeiculosAcidentes = new VeiculosAcidentes($pdo);
            $objVeiculosAcidentes->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objVeiculosAcidentes->setIdTipoVeiculo($_REQUEST['id_tipo_veiculo']);
            $objVeiculosAcidentes->setCondutor($_REQUEST['condutor']);
            $objVeiculosAcidentes->setCnhCondutor($_REQUEST['cnh_condutor']);
            $objVeiculosAcidentes->setProprietario($_REQUEST['proprietario']);
            $objVeiculosAcidentes->setIdTipoDestruicao($_REQUEST['id_tipo_destruicao']);
            $objVeiculosAcidentes->setDestruicaoDescricao($_REQUEST['destruicao_descricao']);
            $objVeiculosAcidentes->setSeguradora($_REQUEST['seguradora']);
            $objVeiculosAcidentes->setCargaPerigosa($_REQUEST['carga_perigosa']);
            $objVeiculosAcidentes->setPlacaVeiculo($_REQUEST['placa_veiculo']);
            $objVeiculosAcidentes->setIdMarca($_REQUEST['id_marca']);
            $objVeiculosAcidentes->setIdModelo($_REQUEST['id_modelo']);
            $objVeiculosAcidentes->setIdAno($_REQUEST['id_ano']);
            $objVeiculosAcidentes->setCor($_REQUEST['cor']);
            $novoId = $objVeiculosAcidentes->Adicionar();
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
        $template = "ajax.veiculos_acidentes.php";
        break;

    case "frm_atualizar_veiculos_acidentes" :
        $veiculos_acidentes = new VeiculosAcidentes();
        $veiculos_acidentes->setId($_REQUEST["app_codigo"]);
        $linha = $veiculos_acidentes->Editar();
        $template = "tpl.frm.veiculos_acidentes.php";
        break;

    case "atualizar_veiculos_acidentes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objVeiculosAcidentes = new VeiculosAcidentes($pdo);
            $objVeiculosAcidentes->setId($_REQUEST['id_veiculo_acidentes']);
            $objVeiculosAcidentes->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objVeiculosAcidentes->setIdTipoVeiculo($_REQUEST['id_tipo_veiculo']);
            $objVeiculosAcidentes->setCondutor($_REQUEST['condutor']);
            $objVeiculosAcidentes->setCnhCondutor($_REQUEST['cnh_condutor']);
            $objVeiculosAcidentes->setProprietario($_REQUEST['proprietario']);
            $objVeiculosAcidentes->setIdTipoDestruicao($_REQUEST['id_tipo_destruicao']);
            $objVeiculosAcidentes->setDestruicaoDescricao($_REQUEST['destruicao_descricao']);
            $objVeiculosAcidentes->setSeguradora($_REQUEST['seguradora']);
            $objVeiculosAcidentes->setCargaPerigosa($_REQUEST['carga_perigosa']);
            $objVeiculosAcidentes->setPlacaVeiculo($_REQUEST['placa_veiculo']);
            $objVeiculosAcidentes->setIdMarca($_REQUEST['id_marca']);
            $objVeiculosAcidentes->setIdModelo($_REQUEST['id_modelo']);
            $objVeiculosAcidentes->setIdAno($_REQUEST['id_ano']);
            $objVeiculosAcidentes->setCor($_REQUEST['cor']);
            $objVeiculosAcidentes->Modificar();
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
        $template = "ajax.veiculos_acidentes.php";
        break;

    case "listar_veiculos_acidentes":
        $template = "tpl.geral.veiculos_acidentes.php";
        break;

    case "listar_veiculos_acidentes_autocomplete":
        $objveiculos_acidentes = new VeiculosAcidentes();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objveiculos_acidentes->BuscarAutoComplete($busca));
        $template = "ajax.veiculos_acidentes.php";
        break;

    case "deletar_veiculos_acidentes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objVeiculosAcidentes = new VeiculosAcidentes($pdo);
            $objVeiculosAcidentes->Remover($_REQUEST['registros']);
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
        $template = "ajax.veiculos_acidentes.php";
        break;

    case "ajax_listar_veiculos_acidentes":
        $template = "tpl.lis.veiculos_acidentes.php";
        break;

    case "veiculos_acidentes_pdf":
        $template = "tpl.lis.veiculos_acidentes.pdf.php";
        break;

    case "veiculos_acidentes_xlsx":
        $template = "tpl.lis.veiculos_acidentes.xlsx.php";
        break;

    case "veiculos_acidentes_print":
        $template = "tpl.lis.veiculos_acidentes.print.php";
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
            $_SESSION["configuracao_usuario"]["veiculos_acidentes"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("veiculos_acidentes");
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
        $template = "ajax.veiculos_acidentes.php";
        break;
}
