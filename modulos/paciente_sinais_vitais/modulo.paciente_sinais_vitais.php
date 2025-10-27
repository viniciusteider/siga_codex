<?php

switch($app_comando)
{
    case "frm_adicionar_paciente_sinais_vitais":
        $template = "tpl.frm.paciente_sinais_vitais.php";
        break;

    case "frm_modal_paciente_sinais_vitais":
        if($_REQUEST["app_codigo"] != "") {
            $paciente_sinais_vitais = new PacienteSinaisVitais();
            $paciente_sinais_vitais->setId($_REQUEST["app_codigo"]);
            $linha = $paciente_sinais_vitais->Editar();
        }		$template = "tpl.form.paciente_sinais_vitais.php";
        break;

    case "adicionar_paciente_sinais_vitais":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteSinaisVitais = new PacienteSinaisVitais($pdo);
            $objPacienteSinaisVitais->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteSinaisVitais->setHorario($_REQUEST['horario']);
            $objPacienteSinaisVitais->setPressaoArterialMinima($_REQUEST['pressao_arterial_minima']);
            $objPacienteSinaisVitais->setPressaoArterialMaxima($_REQUEST['pressao_arterial_maxima']);
            $objPacienteSinaisVitais->setFrequenciaCardiaca($_REQUEST['frequencia_cardiaca']);
            $objPacienteSinaisVitais->setFrequenciaRespiratoria($_REQUEST['frequencia_respiratoria']);
            $objPacienteSinaisVitais->setSaturacaoO2($_REQUEST['saturacao_o2']);
            $objPacienteSinaisVitais->setGlasgow($_REQUEST['glasgow']);
            $objPacienteSinaisVitais->setTemperatura($_REQUEST['temperatura']);
            $objPacienteSinaisVitais->setHgt($_REQUEST['hgt']);
            $objPacienteSinaisVitais->setEscalaTrauma($_REQUEST['escala_trauma']);
            $novoId = $objPacienteSinaisVitais->Adicionar();
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
        $template = "ajax.paciente_sinais_vitais.php";
        break;

    case "frm_atualizar_paciente_sinais_vitais" :
        $paciente_sinais_vitais = new PacienteSinaisVitais();
        $paciente_sinais_vitais->setId($_REQUEST["app_codigo"]);
        $linha = $paciente_sinais_vitais->Editar();
        $template = "tpl.frm.paciente_sinais_vitais.php";
        break;

    case "atualizar_paciente_sinais_vitais":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteSinaisVitais = new PacienteSinaisVitais($pdo);
            $objPacienteSinaisVitais->setId($_REQUEST['id']);
            $objPacienteSinaisVitais->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteSinaisVitais->setHorario($_REQUEST['horario']);
            $objPacienteSinaisVitais->setPressaoArterialMinima($_REQUEST['pressao_arterial_minima']);
            $objPacienteSinaisVitais->setPressaoArterialMaxima($_REQUEST['pressao_arterial_maxima']);
            $objPacienteSinaisVitais->setFrequenciaCardiaca($_REQUEST['frequencia_cardiaca']);
            $objPacienteSinaisVitais->setFrequenciaRespiratoria($_REQUEST['frequencia_respiratoria']);
            $objPacienteSinaisVitais->setSaturacaoO2($_REQUEST['saturacao_o2']);
            $objPacienteSinaisVitais->setGlasgow($_REQUEST['glasgow']);
            $objPacienteSinaisVitais->setTemperatura($_REQUEST['temperatura']);
            $objPacienteSinaisVitais->setHgt($_REQUEST['hgt']);
            $objPacienteSinaisVitais->setEscalaTrauma($_REQUEST['escala_trauma']);
            $objPacienteSinaisVitais->Modificar();
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
        $template = "ajax.paciente_sinais_vitais.php";
        break;

    case "listar_paciente_sinais_vitais":
        $template = "tpl.geral.paciente_sinais_vitais.php";
        break;

    case "listar_paciente_sinais_vitais_autocomplete":
        $objpaciente_sinais_vitais = new PacienteSinaisVitais();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpaciente_sinais_vitais->BuscarAutoComplete($busca));
        $template = "ajax.paciente_sinais_vitais.php";
        break;

    case "deletar_paciente_sinais_vitais":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteSinaisVitais = new PacienteSinaisVitais($pdo);
            $objPacienteSinaisVitais->Remover($_REQUEST['registros']);
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
        $template = "ajax.paciente_sinais_vitais.php";
        break;

    case "ajax_listar_paciente_sinais_vitais":
        $template = "tpl.lis.paciente_sinais_vitais.php";
        break;

    case "paciente_sinais_vitais_pdf":
        $template = "tpl.lis.paciente_sinais_vitais.pdf.php";
        break;

    case "paciente_sinais_vitais_xlsx":
        $template = "tpl.lis.paciente_sinais_vitais.xlsx.php";
        break;

    case "paciente_sinais_vitais_print":
        $template = "tpl.lis.paciente_sinais_vitais.print.php";
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
            $_SESSION["configuracao_usuario"]["paciente_sinais_vitais"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("paciente_sinais_vitais");
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
        $template = "ajax.paciente_sinais_vitais.php";
        break;
}
