<?php

switch($app_comando)
{
    case "frm_adicionar_hospital_disponibilidade":
        $template = "tpl.frm.hospital_disponibilidade.php";
        break;

    case "frm_modal_hospital_disponibilidade":
        if($_REQUEST["app_codigo"] != "") {
            $hospital_disponibilidade = new HospitalDisponibilidade();
            $hospital_disponibilidade->setId($_REQUEST["app_codigo"]);
            $linha = $hospital_disponibilidade->Editar();
        }		$template = "tpl.form.hospital_disponibilidade.php";
        break;

    case "adicionar_hospital_disponibilidade":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objHospitalDisponibilidade = new HospitalDisponibilidade($pdo);
            $objHospitalDisponibilidade->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objHospitalDisponibilidade->setIdHospital($_REQUEST['id_hospital']);
            $objHospitalDisponibilidade->setComplexidade($_REQUEST['complexidade']);
            $objHospitalDisponibilidade->setTotalLeitos($_REQUEST['total_leitos']);
            $objHospitalDisponibilidade->setLeitosDisponiveis($_REQUEST['leitos_disponiveis']);
            $objHospitalDisponibilidade->setVagasUti($_REQUEST['vagas_uti']);
            $objHospitalDisponibilidade->setUtiDisponiveis($_REQUEST['uti_disponiveis']);
            $objHospitalDisponibilidade->setIdUsuarioAtualizacao($_SESSION["usuario"]["id"]);
            $novoId = $objHospitalDisponibilidade->Adicionar();
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
        $template = "ajax.hospital_disponibilidade.php";
        break;

    case "frm_atualizar_hospital_disponibilidade" :
        $hospital_disponibilidade = new HospitalDisponibilidade();
        $hospital_disponibilidade->setId($_REQUEST["app_codigo"]);
        $linha = $hospital_disponibilidade->Editar();
        $template = "tpl.frm.hospital_disponibilidade.php";
        break;

    case "atualizar_hospital_disponibilidade":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objHospitalDisponibilidade = new HospitalDisponibilidade($pdo);
            $objHospitalDisponibilidade->setId($_REQUEST['id']);
            $objHospitalDisponibilidade->setIdHospital($_REQUEST['id_hospital']);
            $objHospitalDisponibilidade->setComplexidade($_REQUEST['complexidade']);
            $objHospitalDisponibilidade->setTotalLeitos($_REQUEST['total_leitos']);
            $objHospitalDisponibilidade->setLeitosDisponiveis($_REQUEST['leitos_disponiveis']);
            $objHospitalDisponibilidade->setVagasUti($_REQUEST['vagas_uti']);
            $objHospitalDisponibilidade->setUtiDisponiveis($_REQUEST['uti_disponiveis']);
            $objHospitalDisponibilidade->setIdUsuarioAtualizacao($_SESSION["usuario"]["id"]);
            $objHospitalDisponibilidade->Modificar();
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
        $template = "ajax.hospital_disponibilidade.php";
        break;

    case "listar_hospital_disponibilidade":
        $template = "tpl.geral.hospital_disponibilidade.simples.php";
        break;

    case "listar_hospital_disponibilidade_autocomplete":
        $objhospital_disponibilidade = new HospitalDisponibilidade();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objhospital_disponibilidade->BuscarAutoComplete($busca));
        $template = "ajax.hospital_disponibilidade.php";
        break;

    case "deletar_hospital_disponibilidade":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objHospitalDisponibilidade = new HospitalDisponibilidade($pdo);
            $objHospitalDisponibilidade->Remover($_REQUEST['registros']);
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
        $template = "ajax.hospital_disponibilidade.php";
        break;

    case "ajax_listar_hospital_disponibilidade":
        $template = "tpl.lis.hospital_disponibilidade.php";
        break;

    case "hospital_disponibilidade_pdf":
        $template = "tpl.lis.hospital_disponibilidade.pdf.php";
        break;

    case "hospital_disponibilidade_xlsx":
        $template = "tpl.lis.hospital_disponibilidade.xlsx.php";
        break;

    case "hospital_disponibilidade_print":
        $template = "tpl.lis.hospital_disponibilidade.print.php";
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
            $_SESSION["configuracao_usuario"]["hospital_disponibilidade"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("hospital_disponibilidade");
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
        $template = "ajax.hospital_disponibilidade.php";
        break;
}
