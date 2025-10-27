<?php

switch($app_comando)
{
    case "frm_adicionar_pessoal_uniforme":
        $template = "tpl.frm.pessoal_uniforme.php";
        break;

    case "frm_modal_pessoal_uniforme":
        if($_REQUEST["app_codigo"] != "") {
            $pessoal_uniforme = new PessoalUniforme();
            $pessoal_uniforme->setId($_REQUEST["app_codigo"]);
            $linha = $pessoal_uniforme->Editar();
        }
        $template = "tpl.form.pessoal_uniforme.php";
        break;

    case "adicionar_pessoal_uniforme":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPessoalUniforme = new PessoalUniforme($pdo);
            $objPessoalUniforme->setIdUsuario($_SESSION['USUARIO_EDIT']);
            $objPessoalUniforme->setIdPeca($_REQUEST['id_peca']);
            $objPessoalUniforme->setIdTamanho($_REQUEST['id_tamanho']);
            $objPessoalUniforme->setRespCasdastro($_SESSION['usuario']['id']);
            $novoId = $objPessoalUniforme->Adicionar();
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
        $template = "ajax.pessoal_uniforme.php";
        break;

    case "frm_atualizar_pessoal_uniforme" :
        $pessoal_uniforme = new PessoalUniforme();
        $pessoal_uniforme->setId($_REQUEST["app_codigo"]);
        $linha = $pessoal_uniforme->Editar();
        $template = "tpl.frm.pessoal_uniforme.php";
        break;

    case "atualizar_pessoal_uniforme":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPessoalUniforme = new PessoalUniforme($pdo);
            $objPessoalUniforme->setId($_REQUEST['id_uniforme']);
            $objPessoalUniforme->setIdUsuario($_SESSION['USUARIO_EDIT']);
            $objPessoalUniforme->setIdPeca($_REQUEST['id_peca']);
            $objPessoalUniforme->setIdTamanho($_REQUEST['id_tamanho']);
            $objPessoalUniforme->setRespCasdastro($_SESSION['usuario']['id']);
            $objPessoalUniforme->Modificar();
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
        $template = "ajax.pessoal_uniforme.php";
        break;

    case "listar_pessoal_uniforme":
        $template = "tpl.geral.pessoal_uniforme.php";
        break;

    case "listar_pessoal_uniforme_autocomplete":
        $objpessoal_uniforme = new PessoalUniforme();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpessoal_uniforme->BuscarAutoComplete($busca));
        $template = "ajax.pessoal_uniforme.php";
        break;

    case "deletar_pessoal_uniforme":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPessoalUniforme = new PessoalUniforme($pdo);
            $objPessoalUniforme->Remover($_REQUEST['registros']);
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
        $template = "ajax.pessoal_uniforme.php";
        break;

    case "ajax_listar_pessoal_uniforme":
        $template = "tpl.lis.pessoal_uniforme.php";
        break;

    case "pessoal_uniforme_pdf":
        $template = "tpl.lis.pessoal_uniforme.pdf.php";
        break;

    case "pessoal_uniforme_xlsx":
        $template = "tpl.lis.pessoal_uniforme.xlsx.php";
        break;

    case "pessoal_uniforme_print":
        $template = "tpl.lis.pessoal_uniforme.print.php";
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
            $_SESSION["configuracao_usuario"]["pessoal_uniforme"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("pessoal_uniforme");
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
        $template = "ajax.pessoal_uniforme.php";
        break;
}
