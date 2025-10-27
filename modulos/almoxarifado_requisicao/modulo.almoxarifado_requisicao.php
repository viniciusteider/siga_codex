<?php

switch($app_comando)
{
    case "frm_adicionar_almoxarifado_requisicao":
        $template = "tpl.frm.almoxarifado_requisicao.php";
        break;

    case "frm_modal_almoxarifado_requisicao":
        if($_REQUEST["app_codigo"] != "") {
            $almoxarifado_requisicao = new AlmoxarifadoRequisicao();
            $almoxarifado_requisicao->setId($_REQUEST["app_codigo"]);
            $linha = $almoxarifado_requisicao->Editar();
        }		$template = "tpl.form.almoxarifado_requisicao.php";
        break;

    case "adicionar_almoxarifado_requisicao":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objAlmoxarifadoRequisicao = new AlmoxarifadoRequisicao($pdo);
            $objAlmoxarifadoRequisicao->setIdUsuario($_REQUEST['id_usuario']);
            $objAlmoxarifadoRequisicao->setNome($_REQUEST['nome']);
            $objAlmoxarifadoRequisicao->setData(Conexao::PrepararDataBD($_REQUEST['data'], $_SESSION['usuario']['timezone']));
            $novoId = $objAlmoxarifadoRequisicao->Adicionar();

            if(count($_REQUEST['produtos'] ?? []) > 0)
            {
                foreach ($_REQUEST['produtos'] as $row)
                {
                    $objAlmoxarifadoRequisicaoItens = new AlmoxarifadoRequisicaoItens($pdo);
                    $objAlmoxarifadoRequisicaoItens->setIdRequisicao($novoId);
                    $objAlmoxarifadoRequisicaoItens->setIdProduto($row['id_produto']);
                    $objAlmoxarifadoRequisicaoItens->setQuantidade($row['quantidade']);
                    $objAlmoxarifadoRequisicaoItens->setDescricao($row['descricao']);
                    if($row['data_hora_retorno'] != "") $objAlmoxarifadoRequisicaoItens->setCautela(1);
                    $objAlmoxarifadoRequisicaoItens->setDataHoraRetorno(Conexao::PrepararDataBD($row['data_hora_retorno']. " 00:00:00", $_SESSION['usuario']['timezone']));
                    $objAlmoxarifadoRequisicaoItens->Adicionar();

                    $objProdutos = new Produtos($pdo);
                    $objProdutos->setId($row['id_produto']);
                    $objProdutos->BaixaEstoque($row['quantidade']);

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
        $template = "ajax.almoxarifado_requisicao.php";
        break;

    case "frm_atualizar_almoxarifado_requisicao" :
        $almoxarifado_requisicao = new AlmoxarifadoRequisicao();
        $almoxarifado_requisicao->setId($_REQUEST["app_codigo"]);
        $linha = $almoxarifado_requisicao->Editar();
        $template = "tpl.frm.almoxarifado_requisicao.php";
        break;

    case "atualizar_almoxarifado_requisicao":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objAlmoxarifadoRequisicao = new AlmoxarifadoRequisicao($pdo);
            $objAlmoxarifadoRequisicao->setId($_REQUEST['id']);
            $objAlmoxarifadoRequisicao->setIdUsuario($_REQUEST['id_usuario']);
            $objAlmoxarifadoRequisicao->setNome($_REQUEST['nome']);
            $objAlmoxarifadoRequisicao->setData(Conexao::PrepararDataBD($_REQUEST['data'], $_SESSION['usuario']['timezone']));
            $objAlmoxarifadoRequisicao->Modificar();


            if(count($_REQUEST['produtos'] ?? []) > 0)
            {
                foreach ($_REQUEST['produtos'] as $row)
                    $not_in[] = $row['id_item_produto'];
                if(count(array_filter($not_in) ?? []) > 0)
                {
                    $objAlmoxarifadoRequisicaoItens = new AlmoxarifadoRequisicaoItens($pdo);
                    $objAlmoxarifadoRequisicaoItens->setIdRequisicao($_REQUEST['id']);
                    $removidos = $objAlmoxarifadoRequisicaoItens->ListarRemovidos(array_filter($not_in));
                    if(count($removidos ?? []) > 0)
                    {
                        foreach ($removidos as $removido)
                        {
                            $objProdutos = new Produtos($pdo);
                            $objProdutos->setId($removido['id_produto']);
                            $objProdutos->setEstoqueAtual($removido['quantidade']);
                            $objProdutos->AdcicionarEstoque();
                        }
                    }
                    $objAlmoxarifadoRequisicaoItens->RemoverAll(array_filter($not_in));
                }
                foreach ($_REQUEST['produtos'] as $row)
                {
                    $objAlmoxarifadoRequisicaoItens = new AlmoxarifadoRequisicaoItens($pdo);
                    $objAlmoxarifadoRequisicaoItens->setId($row['id_item_produto']);
                    $item_anterior = $objAlmoxarifadoRequisicaoItens->Editar();
                    $objAlmoxarifadoRequisicaoItens->setIdRequisicao($_REQUEST['id']);
                    $objAlmoxarifadoRequisicaoItens->setIdProduto($row['id_produto']);
                    $objAlmoxarifadoRequisicaoItens->setQuantidade($row['quantidade']);
                    $objAlmoxarifadoRequisicaoItens->setDescricao($row['descricao']);
                    if($row['data_hora_retorno'] != "") $objAlmoxarifadoRequisicaoItens->setCautela(1);
                    $objAlmoxarifadoRequisicaoItens->setDataHoraRetorno(Conexao::PrepararDataBD($row['data_hora_retorno'] . " 00:00:00", $_SESSION['usuario']['timezone']));

                    if($row['id_item_produto'] != "")
                        $objAlmoxarifadoRequisicaoItens->Modificar();
                    else
                        $objAlmoxarifadoRequisicaoItens->Adicionar();

                    //BAIXA STOQUE
                    $objProdutos = new Produtos($pdo);
                    $objProdutos->setId($row['id_produto']);
                    $objProdutos->setEstoqueAtual($item_anterior['quantidade']);
                    $objProdutos->AtualizarEstoque($row['quantidade']);

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
        $template = "ajax.almoxarifado_requisicao.php";
        break;

    case "listar_almoxarifado_requisicao":
        $template = "tpl.geral.almoxarifado_requisicao.php";
        break;

    case "listar_almoxarifado_requisicao_autocomplete":
        $objalmoxarifado_requisicao = new AlmoxarifadoRequisicao();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objalmoxarifado_requisicao->BuscarAutoComplete($busca));
        $template = "ajax.almoxarifado_requisicao.php";
        break;

    case "deletar_almoxarifado_requisicao":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {

            $objAlmoxarifadoRequisicao = new AlmoxarifadoRequisicao($pdo);
            if(count($_REQUEST['registros'] ?? []) > 0)
            {
                foreach ($_REQUEST['registros'] as $reg)
                {
                    $objAlmoxarifadoRequisicaoItens = new AlmoxarifadoRequisicaoItens($pdo);
                    $objAlmoxarifadoRequisicaoItens->setIdRequisicao($_REQUEST['id']);
                    $removidos = $objAlmoxarifadoRequisicaoItens->ListarRemovidos(array_filter($_REQUEST['registros']));
                    if(count($removidos ?? []) > 0)
                    {
                        foreach ($removidos as $removido)
                        {
                            $objProdutos = new Produtos($pdo);
                            $objProdutos->setId($removido['id_produto']);
                            $objProdutos->setEstoqueAtual($removido['quantidade']);
                            $objProdutos->AdcicionarEstoque();
                        }
                    }
                }
            }
            $objAlmoxarifadoRequisicao->Remover($_REQUEST['registros']);
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
        $template = "ajax.almoxarifado_requisicao.php";
        break;

    case "ajax_listar_almoxarifado_requisicao":
        $template = "tpl.lis.almoxarifado_requisicao.php";
        break;

    case "almoxarifado_requisicao_pdf":
        $template = "tpl.lis.almoxarifado_requisicao.pdf.php";
        break;

    case "almoxarifado_requisicao_xlsx":
        $template = "tpl.lis.almoxarifado_requisicao.xlsx.php";
        break;

    case "almoxarifado_requisicao_print":
        $template = "tpl.lis.almoxarifado_requisicao.print.php";
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
            $_SESSION["configuracao_usuario"]["almoxarifado_requisicao"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("almoxarifado_requisicao");
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
        $template = "ajax.almoxarifado_requisicao.php";
        break;
}
