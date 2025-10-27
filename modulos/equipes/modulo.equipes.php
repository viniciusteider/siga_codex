<?php

switch($app_comando)
{
    case "frm_adicionar_equipes":
        $template = "tpl.frm.equipes.php";
        break;

    case "frm_modal_equipes":
        if($_REQUEST["app_codigo"] != "") {
            $equipes = new Equipes();
            $equipes->setId($_REQUEST["app_codigo"]);
            $linha = $equipes->Editar();
        }		$template = "tpl.form.equipes.php";
        break;

    case "adicionar_equipes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEquipes = new Equipes($pdo);
            $objEquipes->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objEquipes->setIdCoordenador($_REQUEST['id_coordenador']);
            $objEquipes->setIdEscalaTipo($_REQUEST['id_escala_tipo']);
            $objEquipes->setNome($_REQUEST['nome']);
            $novoId = $objEquipes->Adicionar();
            if(is_array($_REQUEST['equipe_lista']) && count($_REQUEST['equipe_lista']))
            {
                $x = 1;
                foreach ($_REQUEST['equipe_lista'] as $item) {
                    $objEquipesEfetivo = new EquipesEfetivo($pdo);
                    $objEquipesEfetivo->setIdEquipe($novoId);
                    $objEquipesEfetivo->setIdEfetivo($item['id_efetivo']);
                    $objEquipesEfetivo->setOrdem($x);
                    $objEquipesEfetivo->Adicionar();
                    $x++;
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
        $template = "ajax.equipes.php";
        break;

    case "frm_atualizar_equipes" :
        $equipes = new Equipes();
        $equipes->setId($_REQUEST["app_codigo"]);
        $linha = $equipes->Editar();
        $template = "tpl.frm.equipes.php";
        break;

    case "atualizar_equipes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEquipes = new Equipes($pdo);
            $objEquipes->setId($_REQUEST['id']);
            $objEquipes->setIdCoordenador($_REQUEST['id_coordenador']);
            $objEquipes->setIdEscalaTipo($_REQUEST['id_escala_tipo']);
            $objEquipes->setNome($_REQUEST['nome']);
            $objEquipes->Modificar();

            if(is_array($_REQUEST['equipe_lista']) && count($_REQUEST['equipe_lista']))
            {
                $x = 1;
                $objEquipesEfetivo = new EquipesEfetivo($pdo);

                foreach ($_REQUEST['equipe_lista'] as $item) $ids_remove[] = $item['id_equipe_efetivo'];
                $ids_remove = array_filter($ids_remove);
                if(is_array($ids_remove) && count($ids_remove) > 0 )
                {
                    $objEquipesEfetivo->RemoverAll($ids_remove,$_REQUEST['id']);
                }

                foreach ($_REQUEST['equipe_lista'] as $item) {
                    $objEquipesEfetivo = new EquipesEfetivo($pdo);
                    $objEquipesEfetivo->setId($item['id_equipe_efetivo']);
                    $objEquipesEfetivo->setIdEquipe($_REQUEST['id']);
                    $objEquipesEfetivo->setIdEfetivo($item['id_efetivo']);
                    $objEquipesEfetivo->setOrdem($x);
                    if($item['id_equipe_efetivo'] == "")
                        $objEquipesEfetivo->Adicionar();
                    else
                        $objEquipesEfetivo->Modificar();
                    $x++;
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
        $template = "ajax.equipes.php";
        break;

    case "listar_equipes":
        $template = "tpl.geral.equipes.php";
        break;

    case "listar_equipes_autocomplete":
        $objequipes = new Equipes();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objequipes->BuscarAutoComplete($busca,$_SESSION['usuario']['id_grupo']));
        $template = "ajax.equipes.php";
        break;

    case "deletar_equipes":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objEquipes = new Equipes($pdo);
            $objEquipes->Remover($_REQUEST['registros']);
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
        $template = "ajax.equipes.php";
        break;

    case "ajax_listar_equipes":
        $template = "tpl.lis.equipes.php";
        break;

    case "equipes_pdf":
        $template = "tpl.lis.equipes.pdf.php";
        break;

    case "equipes_xlsx":
        $template = "tpl.lis.equipes.xlsx.php";
        break;

    case "equipes_print":
        $template = "tpl.lis.equipes.print.php";
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
            $_SESSION["configuracao_usuario"]["equipes"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("equipes");
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
        $template = "ajax.equipes.php";
        break;
}
