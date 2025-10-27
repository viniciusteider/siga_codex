<?php

switch($app_comando)
{
    case "frm_adicionar_paciente_medicamentos":
        $template = "tpl.frm.paciente_medicamentos.php";
        break;

    case "frm_modal_paciente_medicamentos":
        if($_REQUEST["app_codigo"] != "") {
            $paciente_medicamentos = new PacienteMedicamentos();
            $paciente_medicamentos->setId($_REQUEST["app_codigo"]);
            $linha = $paciente_medicamentos->Editar();
        }		$template = "tpl.form.paciente_medicamentos.php";
        break;

    case "adicionar_paciente_medicamentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteMedicamentos = new PacienteMedicamentos($pdo);
            $objPacienteMedicamentos->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteMedicamentos->setIdMedicamento($_REQUEST['id_medicamento']);
            $objPacienteMedicamentos->setIdVia($_REQUEST['id_via']);
            $objPacienteMedicamentos->setIdEfetivo($_REQUEST['id_efetivo']);
            $objPacienteMedicamentos->setHorario(Conexao::PrepararDataBD($_REQUEST['horario'], $_SESSION['usuario']['timezone']));
            $objPacienteMedicamentos->setDose($_REQUEST['dose']);
            $novoId = $objPacienteMedicamentos->Adicionar();
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
        $template = "ajax.paciente_medicamentos.php";
        break;

    case "frm_atualizar_paciente_medicamentos" :
        $paciente_medicamentos = new PacienteMedicamentos();
        $paciente_medicamentos->setId($_REQUEST["app_codigo"]);
        $linha = $paciente_medicamentos->Editar();
        $template = "tpl.frm.paciente_medicamentos.php";
        break;

    case "atualizar_paciente_medicamentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteMedicamentos = new PacienteMedicamentos($pdo);
            $objPacienteMedicamentos->setId($_REQUEST['id']);
            $objPacienteMedicamentos->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteMedicamentos->setIdMedicamento($_REQUEST['id_medicamento']);
            $objPacienteMedicamentos->setIdVia($_REQUEST['id_via']);
            $objPacienteMedicamentos->setIdEfetivo($_REQUEST['id_efetivo']);
            $objPacienteMedicamentos->setHorario(Conexao::PrepararDataBD($_REQUEST['horario'], $_SESSION['usuario']['timezone']));
            $objPacienteMedicamentos->setDose($_REQUEST['dose']);
            $objPacienteMedicamentos->Modificar();
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
        $template = "ajax.paciente_medicamentos.php";
        break;

    case "listar_paciente_medicamentos":
        $template = "tpl.geral.paciente_medicamentos.php";
        break;

    case "listar_paciente_medicamentos_autocomplete":
        $objpaciente_medicamentos = new PacienteMedicamentos();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpaciente_medicamentos->BuscarAutoComplete($busca));
        $template = "ajax.paciente_medicamentos.php";
        break;

    case "deletar_paciente_medicamentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteMedicamentos = new PacienteMedicamentos($pdo);
            $objPacienteMedicamentos->Remover($_REQUEST['registros']);
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
        $template = "ajax.paciente_medicamentos.php";
        break;

    case "ajax_listar_paciente_medicamentos":
        $template = "tpl.lis.paciente_medicamentos.php";
        break;

    case "paciente_medicamentos_pdf":
        $template = "tpl.lis.paciente_medicamentos.pdf.php";
        break;

    case "paciente_medicamentos_xlsx":
        $template = "tpl.lis.paciente_medicamentos.xlsx.php";
        break;

    case "paciente_medicamentos_print":
        $template = "tpl.lis.paciente_medicamentos.print.php";
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
            $_SESSION["configuracao_usuario"]["paciente_medicamentos"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("paciente_medicamentos");
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
        $template = "ajax.paciente_medicamentos.php";
        break;
}
