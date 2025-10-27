<?php

switch($app_comando)
{
    case "frm_adicionar_paciente_lesoes":
        $template = "tpl.frm.paciente_lesoes.php";
        break;

    case "frm_modal_paciente_lesoes":
        if($_REQUEST["app_codigo"] != "") {
            $paciente_lesoes = new PacienteLesoes();
            $paciente_lesoes->setId($_REQUEST["app_codigo"]);
            $linha = $paciente_lesoes->Editar();
        }		$template = "tpl.form.paciente_lesoes.php";
        break;

    case "adicionar_paciente_lesoes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteLesoes = new PacienteLesoes($pdo);
            $objPacienteLesoes->setIdParteCorpo($_REQUEST['id_parte_corpo']);
            $objPacienteLesoes->setIdLesao($_REQUEST['id_lesao']);
            $objPacienteLesoes->setIdPaciente($_REQUEST['id_paciente']);
            $novoId = $objPacienteLesoes->Adicionar();
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
        $template = "ajax.paciente_lesoes.php";
        break;

    case "frm_atualizar_paciente_lesoes" :
        $paciente_lesoes = new PacienteLesoes();
        $paciente_lesoes->setId($_REQUEST["app_codigo"]);
        $linha = $paciente_lesoes->Editar();
        $template = "tpl.frm.paciente_lesoes.php";
        break;

    case "atualizar_paciente_lesoes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteLesoes = new PacienteLesoes($pdo);
            $objPacienteLesoes->setId($_REQUEST['id']);
            $objPacienteLesoes->setIdParteCorpo($_REQUEST['id_parte_corpo']);
            $objPacienteLesoes->setIdLesao($_REQUEST['id_lesao']);
            $objPacienteLesoes->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteLesoes->Modificar();
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
        $template = "ajax.paciente_lesoes.php";
        break;

    case "listar_paciente_lesoes":
        $template = "tpl.geral.paciente_lesoes.php";
        break;

    case "listar_paciente_lesoes_autocomplete":
        $objpaciente_lesoes = new PacienteLesoes();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpaciente_lesoes->BuscarAutoComplete($busca));
        $template = "ajax.paciente_lesoes.php";
        break;

    case "deletar_paciente_lesoes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPacienteLesoes = new PacienteLesoes($pdo);
            $objPacienteLesoes->Remover($_REQUEST['registros']);
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
        $template = "ajax.paciente_lesoes.php";
        break;

    case "ajax_listar_paciente_lesoes":
        $template = "tpl.lis.paciente_lesoes.php";
        break;

    case "paciente_lesoes_pdf":
        $template = "tpl.lis.paciente_lesoes.pdf.php";
        break;

    case "paciente_lesoes_xlsx":
        $template = "tpl.lis.paciente_lesoes.xlsx.php";
        break;

    case "paciente_lesoes_print":
        $template = "tpl.lis.paciente_lesoes.print.php";
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
            $_SESSION["configuracao_usuario"]["paciente_lesoes"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("paciente_lesoes");
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
        $template = "ajax.paciente_lesoes.php";
        break;
}
