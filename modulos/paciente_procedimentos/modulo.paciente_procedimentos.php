<?php

switch($app_comando)
{
    case "frm_adicionar_paciente_procedimentos":
        $template = "tpl.frm.paciente_procedimentos.php";
        break;

    case "frm_modal_paciente_procedimentos":
        if($_REQUEST["app_codigo"] != "") {
            $paciente_procedimentos = new PacienteProcedimentos();
            $paciente_procedimentos->setId($_REQUEST["app_codigo"]);
            $linha = $paciente_procedimentos->Editar();
        }		$template = "tpl.form.paciente_procedimentos.php";
        break;

    case "adicionar_paciente_procedimentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteProcedimentos = new PacienteProcedimentos($pdo);
            $objPacienteProcedimentos->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteProcedimentos->setIdProcedimento($_REQUEST['id_procedimento']);
            $novoId = $objPacienteProcedimentos->Adicionar();
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
        $template = "ajax.paciente_procedimentos.php";
        break;

    case "frm_atualizar_paciente_procedimentos" :
        $paciente_procedimentos = new PacienteProcedimentos();
        $paciente_procedimentos->setId($_REQUEST["app_codigo"]);
        $linha = $paciente_procedimentos->Editar();
        $template = "tpl.frm.paciente_procedimentos.php";
        break;

    case "atualizar_paciente_procedimentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteProcedimentos = new PacienteProcedimentos($pdo);
            $objPacienteProcedimentos->setId($_REQUEST['id']);
            $objPacienteProcedimentos->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteProcedimentos->setIdProcedimento($_REQUEST['id_procedimento']);
            $objPacienteProcedimentos->Modificar();
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
        $template = "ajax.paciente_procedimentos.php";
        break;

    case "listar_paciente_procedimentos":
        $template = "tpl.geral.paciente_procedimentos.php";
        break;

    case "listar_paciente_procedimentos_autocomplete":
        $objpaciente_procedimentos = new PacienteProcedimentos();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpaciente_procedimentos->BuscarAutoComplete($busca));
        $template = "ajax.paciente_procedimentos.php";
        break;

    case "deletar_paciente_procedimentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteProcedimentos = new PacienteProcedimentos($pdo);
            $objPacienteProcedimentos->Remover($_REQUEST['registros']);
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
        $template = "ajax.paciente_procedimentos.php";
        break;

    case "ajax_listar_paciente_procedimentos":
        $template = "tpl.lis.paciente_procedimentos.php";
        break;

    case "paciente_procedimentos_pdf":
        $template = "tpl.lis.paciente_procedimentos.pdf.php";
        break;

    case "paciente_procedimentos_xlsx":
        $template = "tpl.lis.paciente_procedimentos.xlsx.php";
        break;

    case "paciente_procedimentos_print":
        $template = "tpl.lis.paciente_procedimentos.print.php";
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
            $_SESSION["configuracao_usuario"]["paciente_procedimentos"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("paciente_procedimentos");
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
        $template = "ajax.paciente_procedimentos.php";
        break;
}
