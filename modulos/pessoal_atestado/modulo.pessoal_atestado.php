<?php

switch($app_comando)
{
    case "frm_adicionar_pessoal_atestado":
        $template = "tpl.frm.pessoal_atestado.php";
        break;

    case "frm_modal_pessoal_atestado":
        if($_REQUEST["app_codigo"] != "") {
            $pessoal_atestado = new PessoalAtestado();
            $pessoal_atestado->setId($_REQUEST["app_codigo"]);
            $linha = $pessoal_atestado->Editar();
        }		$template = "tpl.form.pessoal_atestado.php";
        break;

    case "adicionar_pessoal_atestado":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPessoalAtestado = new PessoalAtestado($pdo);
            $objPessoalAtestado->setIdUsuario($_SESSION['USUARIO_EDIT']);
            $objPessoalAtestado->setIdCid($_REQUEST['id_cid']);
            $objPessoalAtestado->setIdTipoAfastamento($_REQUEST['id_tipo_afastamento']);
            $objPessoalAtestado->setIdMedico($_REQUEST['id_medico']);
            $objPessoalAtestado->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
            $objPessoalAtestado->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
            $objPessoalAtestado->setTextoHomologacao($_REQUEST['texto_homologacao']);

            Conexao::pr($objPessoalAtestado);
            $novoId = $objPessoalAtestado->Adicionar();
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
        $template = "ajax.pessoal_atestado.php";
        break;

    case "frm_atualizar_pessoal_atestado" :
        $pessoal_atestado = new PessoalAtestado();
        $pessoal_atestado->setId($_REQUEST["app_codigo"]);
        $linha = $pessoal_atestado->Editar();
        $template = "tpl.frm.pessoal_atestado.php";
        break;

    case "atualizar_pessoal_atestado":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPessoalAtestado = new PessoalAtestado($pdo);
            $objPessoalAtestado->setId($_REQUEST['id_atestado']);
            $objPessoalAtestado->setIdUsuario($_SESSION['USUARIO_EDIT']);
            $objPessoalAtestado->setIdCid($_REQUEST['id_cid']);
            $objPessoalAtestado->setIdTipoAfastamento($_REQUEST['id_tipo_afastamento']);
            $objPessoalAtestado->setIdMedico($_REQUEST['id_medico']);
            $objPessoalAtestado->setDataInicio(Conexao::PrepararDataBD($_REQUEST['data_inicio'], $_SESSION['usuario']['timezone']));
            $objPessoalAtestado->setDataTermino(Conexao::PrepararDataBD($_REQUEST['data_termino'], $_SESSION['usuario']['timezone']));
            $objPessoalAtestado->setTextoHomologacao($_REQUEST['texto_homologacao']);
            $objPessoalAtestado->Modificar();
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
        $template = "ajax.pessoal_atestado.php";
        break;

    case "listar_pessoal_atestado":
        $template = "tpl.geral.pessoal_atestado.php";
        break;

    case "listar_pessoal_atestado_autocomplete":
        $objpessoal_atestado = new PessoalAtestado();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpessoal_atestado->BuscarAutoComplete($busca));
        $template = "ajax.pessoal_atestado.php";
        break;

    case "deletar_pessoal_atestado":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPessoalAtestado = new PessoalAtestado($pdo);
            $objPessoalAtestado->Remover($_REQUEST['registros']);
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
        $template = "ajax.pessoal_atestado.php";
        break;

    case "ajax_listar_pessoal_atestado":
        $template = "tpl.lis.pessoal_atestado.php";
        break;

    case "pessoal_atestado_pdf":
        $template = "tpl.lis.pessoal_atestado.pdf.php";
        break;

    case "pessoal_atestado_xlsx":
        $template = "tpl.lis.pessoal_atestado.xlsx.php";
        break;

    case "pessoal_atestado_print":
        $template = "tpl.lis.pessoal_atestado.print.php";
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
            $_SESSION["configuracao_usuario"]["pessoal_atestado"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("pessoal_atestado");
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
        $template = "ajax.pessoal_atestado.php";
        break;
}
