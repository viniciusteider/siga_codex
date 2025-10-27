<?php

switch($app_comando)
{
    case "frm_adicionar_medicamentos":
        $template = "tpl.frm.medicamentos.php";
        break;

    case "frm_modal_medicamentos":
        if($_REQUEST["app_codigo"] != "") {
            $medicamentos = new Medicamentos();
            $medicamentos->setId($_REQUEST["app_codigo"]);
            $linha = $medicamentos->Editar();
        }		$template = "tpl.form.medicamentos.php";
        break;

    case "adicionar_medicamentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objMedicamentos = new Medicamentos($pdo);
            $objMedicamentos->setNome($_REQUEST['nome']);
            $novoId = $objMedicamentos->Adicionar();
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
        $template = "ajax.medicamentos.php";
        break;

    case "frm_atualizar_medicamentos" :
        $medicamentos = new Medicamentos();
        $medicamentos->setId($_REQUEST["app_codigo"]);
        $linha = $medicamentos->Editar();
        $template = "tpl.frm.medicamentos.php";
        break;

    case "atualizar_medicamentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objMedicamentos = new Medicamentos($pdo);
            $objMedicamentos->setId($_REQUEST['id']);
            $objMedicamentos->setNome($_REQUEST['nome']);
            $objMedicamentos->Modificar();
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
        $template = "ajax.medicamentos.php";
        break;

    case "listar_medicamentos":
        $template = "tpl.geral.medicamentos.php";
        break;

    case "listar_medicamentos_autocomplete":
        $objmedicamentos = new Medicamentos();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objmedicamentos->BuscarAutoComplete($busca));
        $template = "ajax.medicamentos.php";
        break;

    case "deletar_medicamentos":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objMedicamentos = new Medicamentos($pdo);
            $objMedicamentos->Remover($_REQUEST['registros']);
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
        $template = "ajax.medicamentos.php";
        break;

    case "ajax_listar_medicamentos":
        $template = "tpl.lis.medicamentos.php";
        break;

    case "medicamentos_pdf":
        $template = "tpl.lis.medicamentos.pdf.php";
        break;

    case "medicamentos_xlsx":
        $template = "tpl.lis.medicamentos.xlsx.php";
        break;

    case "medicamentos_print":
        $template = "tpl.lis.medicamentos.print.php";
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
            $_SESSION["configuracao_usuario"]["medicamentos"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("medicamentos");
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
        $template = "ajax.medicamentos.php";
        break;
}
