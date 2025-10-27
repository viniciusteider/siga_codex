<?php

switch($app_comando)
{
    case "frm_adicionar_classificacao_ligacao":
        $template = "tpl.frm.classificacao_ligacao.php";
        break;

    case "frm_modal_classificacao_ligacao":
        if($_REQUEST["app_codigo"] != "") {
            $classificacao_ligacao = new ClassificacaoLigacao();
            $classificacao_ligacao->setId($_REQUEST["app_codigo"]);
            $linha = $classificacao_ligacao->Editar();
        }		$template = "tpl.form.classificacao_ligacao.php";
        break;

    case "adicionar_classificacao_ligacao":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objClassificacaoLigacao = new ClassificacaoLigacao($pdo);
            $objClassificacaoLigacao->setNome($_REQUEST['nome']);
            $novoId = $objClassificacaoLigacao->Adicionar();
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
        $template = "ajax.classificacao_ligacao.php";
        break;

    case "frm_atualizar_classificacao_ligacao" :
        $classificacao_ligacao = new ClassificacaoLigacao();
        $classificacao_ligacao->setId($_REQUEST["app_codigo"]);
        $linha = $classificacao_ligacao->Editar();
        $template = "tpl.frm.classificacao_ligacao.php";
        break;

    case "atualizar_classificacao_ligacao":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objClassificacaoLigacao = new ClassificacaoLigacao($pdo);
            $objClassificacaoLigacao->setId($_REQUEST['id']);
            $objClassificacaoLigacao->setNome($_REQUEST['nome']);
            $objClassificacaoLigacao->Modificar();
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
        $template = "ajax.classificacao_ligacao.php";
        break;

    case "listar_classificacao_ligacao":
        $template = "tpl.geral.classificacao_ligacao.simples.php";
        break;

    case "listar_classificacao_ligacao_autocomplete":
        $objclassificacao_ligacao = new ClassificacaoLigacao();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objclassificacao_ligacao->BuscarAutoComplete($busca));
        $template = "ajax.classificacao_ligacao.php";
        break;

    case "deletar_classificacao_ligacao":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objClassificacaoLigacao = new ClassificacaoLigacao($pdo);
            $objClassificacaoLigacao->Remover($_REQUEST['registros']);
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
        $template = "ajax.classificacao_ligacao.php";
        break;

    case "ajax_listar_classificacao_ligacao":
        $template = "tpl.lis.classificacao_ligacao.php";
        break;

    case "classificacao_ligacao_pdf":
        $template = "tpl.lis.classificacao_ligacao.pdf.php";
        break;

    case "classificacao_ligacao_xlsx":
        $template = "tpl.lis.classificacao_ligacao.xlsx.php";
        break;

    case "classificacao_ligacao_print":
        $template = "tpl.lis.classificacao_ligacao.print.php";
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
            $_SESSION["configuracao_usuario"]["classificacao_ligacao"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("classificacao_ligacao");
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
        $template = "ajax.classificacao_ligacao.php";
        break;
}
