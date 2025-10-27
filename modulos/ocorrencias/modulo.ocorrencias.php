<?php
require_once __DIR__ . "/../../api/src/Controllers/OccurrenceController.php";
require_once __DIR__ . "/../../api/src/Classes/Connection.php";

use App\Controllers\OccurrenceController;

switch ($app_comando) {
    case "listar_ocorrencias_abertas":
        $objOcorrencias = new Ocorrencias();
        $titulo = "Ocorrências Novas";
        $subtitulo = "Ocorrências abertas aguardando regulação médica";
        $parametros['id_ocorrencia_status'] = [1];


        $listar = $objOcorrencias->ListarOcorrenciasStatus($_SESSION['usuario']['id_grupo'], $parametros);

        $template = "tpl.status.ocorrencias.php";
        break;
    case "listar_ocorrencias_reguladas":
        $objOcorrencias = new Ocorrencias();


        $titulo = "Ocorrências a serem despachadas";
        $subtitulo = "Ocorrências pendentes de despacho no período";
        $parametros['id_ocorrencia_status'] = [2];

        $listar = $objOcorrencias->ListarOcorrenciasStatus($_SESSION['usuario']['id_grupo'], $parametros);

        $template = "tpl.status.ocorrencias.php";
        break;
    case "listar_ocorrencias_finalizadas":
        $objOcorrencias = new Ocorrencias();

        $titulo = "Ocorrências Concluidas";
        $subtitulo = "Ocorrências concluidas aguardando finalização";
        $parametros['id_ocorrencia_status'] = [3];
        $parametros['finalizada'] = true;

        $listar = $objOcorrencias->ListarOcorrenciasStatus($_SESSION['usuario']['id_grupo'], $parametros);

        $template = "tpl.status.ocorrencias.php";
        break;
    case "listar_ocorrencias_despachadas":
        $objOcorrencias = new Ocorrencias();
        $parametros['id_ocorrencia_status'] = [3];
        $titulo = "Ocorrências em atendimento";
        $subtitulo = "Ocorrências despachadas pelo Rádioperador";
        $parametros['finalizada'] = false;

        $listar = $objOcorrencias->ListarOcorrenciasStatus($_SESSION['usuario']['id_grupo'], $parametros);
        $template = "tpl.status.ocorrencias.php";
        break;
    case "view_ocorrencia":
        $objOcorrencias = new Ocorrencias();
        $objOcorrencias->setId($_REQUEST['app_codigo']);
        $linha = $objOcorrencias->View();


        $objOcoRecursos = new OcorrenciasRecursos();
        $objOcoRecursos->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_recursos = $objOcoRecursos->View();


        $objOcoApoio = new OcorrenciasApoio();
        $objOcoApoio->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_Apoio = $objOcoApoio->View();

        $objPacientes = new Paciente();
        $objPacientes->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_pacientes = $objPacientes->View();

        $template = "tpl.view.ocorrencia.php";
        break;
    case "frm_regular_ocorrencia":
        $objOcorrencias = new Ocorrencias();
        $objOcorrencias->setId($_REQUEST['app_codigo']);
        $linha = $objOcorrencias->View();
        $template = "tpl.regular.ocorrencia.php";
        break;
    case "frm_horario_despacho":
        $objOcorrencias = new OcorrenciasRecursos();
        $objOcorrencias->setId($_REQUEST['id']);
        $linha = $objOcorrencias->Editar();

        switch ($_REQUEST['pos']) {
            case "1":
                $horario = $linha['horario_saida_base'];
                break;
            case "2":
                $horario = $linha['horario_chegada_local'];
                break;
            case "3":
                $horario = $linha['horario_saida_local'];
                break;
            case "4":
                $horario = $linha['horario_chegada_hospital'];
                break;
            case "5":
                $horario = $linha['horario_saida_hospital'];
                break;
            case "6":
                $horario = $linha['horario_chegada_base'];
                break;
        }

        $template = "tpl.frm_horario_despacho.php";
        break;
    case "frm_despachar_ocorrencia":
        $objOcorrencias = new Ocorrencias();
        $objOcorrencias->setId($_REQUEST['app_codigo']);
        $linha = $objOcorrencias->View();
        $template = "tpl.despachar.ocorrencia.php";
        break;
    case "frm_atualizar_ocorrencia_modal":
        $objOcorrencias = new Ocorrencias();
        $objOcorrencias->setId($_REQUEST['app_codigo']);
        $linha = $objOcorrencias->View();
        $template = "tpl.atualizar.ocorrencia.php";
        break;
    case "alterar_horario_despacho":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasRecursos = new OcorrenciasRecursos($pdo);
            $objOcorrenciasRecursos->setId($_REQUEST['id']);
            switch ($_REQUEST['pos']) {
                case "1":
                    $objOcorrenciasRecursos->setHorarioSaidaBase(Conexao::PrepararDataBD($_REQUEST['horario_despacho_alterecao'], $_SESSION['usuario']['timezone']));
                    break;
                case "2":
                    $objOcorrenciasRecursos->setHorarioChegadaLocal(Conexao::PrepararDataBD($_REQUEST['horario_despacho_alterecao'], $_SESSION['usuario']['timezone']));
                    break;
                case "3":
                    $objOcorrenciasRecursos->setHorarioSaidaLocal(Conexao::PrepararDataBD($_REQUEST['horario_despacho_alterecao'], $_SESSION['usuario']['timezone']));
                    break;
                case "4":
                    $objOcorrenciasRecursos->setHorarioChegadaHospital(Conexao::PrepararDataBD($_REQUEST['horario_despacho_alterecao'], $_SESSION['usuario']['timezone']));
                    break;
                case "5":
                    $objOcorrenciasRecursos->setHorarioSaidaHospital(Conexao::PrepararDataBD($_REQUEST['horario_despacho_alterecao'], $_SESSION['usuario']['timezone']));
                    break;
                case "6":
                    $objOcorrenciasRecursos->setHorarioChegadaBase(Conexao::PrepararDataBD($_REQUEST['horario_despacho_alterecao'], $_SESSION['usuario']['timezone']));
                    break;
            }
            $linha = $objOcorrenciasRecursos->ModificarHorario();
            $msg["codigo"] = 0;
            $msg["id_despacho"] = $_REQUEST['id_despacho'];
            $msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
            $pdo->commit();
        } catch (Exception $e) {
            $msg["codigo"] = 1;
            $msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
            $msg["debug"]["error"] = $e->getMessage();
            $msg["debug"]["file"] = $e->getFile();
            $msg["debug"]["line"] = $e->getLine();
            $pdo->rollBack();
        }
    case "atualizar_posicao_ocorrencia":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrenciasRecursos = new OcorrenciasRecursos($pdo);
            $objOcorrenciasRecursos->setId($_REQUEST['id']);
            switch ($_REQUEST['tipo']) {
                case "1":
                    $objOcorrenciasRecursos->setHorarioSaidaBase($_REQUEST['id']);
                    break;
                case "2":
                    $objOcorrenciasRecursos->setHorarioChegadaLocal($_REQUEST['id']);
                    break;
                case "3":
                    $objOcorrenciasRecursos->setHorarioSaidaLocal($_REQUEST['id']);
                    break;
                case "4":
                    $objOcorrenciasRecursos->setHorarioChegadaHospital($_REQUEST['id']);
                    break;
                case "5":
                    $objOcorrenciasRecursos->setHorarioChegadaBase($_REQUEST['id']);
                    break;
                case "6":
                    $objOcorrenciasRecursos->setHorarioChegadaLocal($_REQUEST['id']);
                    $objOcorrenciasRecursos->setHorarioSaidaLocal($_REQUEST['id']);
                    $objOcorrenciasRecursos->setUltimoQta(1);
                    break;
                case "7":
                    $objOcorrenciasRecursos->setHorarioSaidaHospital($_REQUEST['id']);
                    break;
            }
            $linha = $objOcorrenciasRecursos->AtualizarLocalizacao();

            $webSocketHandler = new WebSocketHandler();


            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
            $pdo->commit();

            $occurrenceController = new OccurrenceController();
            $resourceId = $occurrenceController->getResourceByQthId($_REQUEST['id']);
            $actualOccurrence = $occurrenceController->getActualOccurrence(['id' => $resourceId, 'id_grupo' => $_SESSION['usuario']['id_grupo']], true);
            $webSocketHandler->enviarMensagem("updateOccurrence", $_SESSION['usuario']['id_grupo'], $resourceId, $actualOccurrence);
        } catch (Exception $e) {
            $msg["codigo"] = 1;
            $msg["mensagem"] = ($e->getCode() == 2) ? $e->getMessage() : "Erro ao Executar Operação";
            $msg["debug"]["error"] = $e->getMessage();
            $msg["debug"]["file"] = $e->getFile();
            $msg["debug"]["line"] = $e->getLine();
            $pdo->rollBack();
        }
        echo json_encode($msg);
        $template = "ajax.ocorrencias.php";
        break;

    case "regular_ocorrencia":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrencias = new Ocorrencias($pdo);
            $objOcorrencias->setId($_REQUEST['id']);
            $objOcorrencias->setIdEvento($_REQUEST['id_evento']);
            $objOcorrencias->setIdSubevento($_REQUEST['id_subevento']);

            $objOcorrencias->setIdOcorrenciaClassificacao($_REQUEST['id_ocorrencia_classificacao']);
            $objOcorrencias->setUsa($_REQUEST['usa']);
            $objOcorrencias->setUsb($_REQUEST['usb']);
            $objOcorrencias->setSiate($_REQUEST['siate']);
            $objOcorrencias->setVir($_REQUEST['vir']);
            if ($_REQUEST['regular'] == 1) {
                $objOcorrencias->setIdOcorrenciaStatus(($_REQUEST['cancelar'] == 1) ? 4 : 2);
                $objOcorrencias->setIdRegulador($_SESSION["usuario"]["id"]);
            }
            $objOcorrencias->Atualizar();

            if ($_REQUEST['descricao'] != "") {
                $objOcorenciasHistorico = new OcorenciasHistorico($pdo);
                $objOcorenciasHistorico->setIdOcorrencia($_REQUEST['id']);
                $objOcorenciasHistorico->setIdUsuario($_SESSION['usuario']['id']);
                $objOcorenciasHistorico->setDescricao($_REQUEST['descricao']);
                $novoId = $objOcorenciasHistorico->Adicionar();
            }


            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
        $template = "ajax.ocorrencias.php";
        break;
    case "despachar_ocorrencia":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrencias = new Ocorrencias($pdo);
            $objOcorrencias->setId($_REQUEST['id']);
            $objOcorrencias->setIdEvento($_REQUEST['id_evento']);
            $objOcorrencias->setIdSubevento($_REQUEST['id_subevento']);

            $objOcorrencias->setIdOcorrenciaClassificacao($_REQUEST['id_ocorrencia_classificacao']);
            $objOcorrencias->setUsa($_REQUEST['usa']);
            $objOcorrencias->setUsb($_REQUEST['usb']);
            $objOcorrencias->setSiate($_REQUEST['siate']);
            $objOcorrencias->setVir($_REQUEST['vir']);
            $objOcorrencias->setIdOcorrenciaStatus(($_REQUEST['cancelar'] == 1) ? 4 : 2);
            $objOcorrencias->setIdRegulador($_SESSION["usuario"]["id"]);
            $objOcorrencias->Atualizar();

            if ($_REQUEST['descricao'] != "") {
                $objOcorenciasHistorico = new OcorenciasHistorico($pdo);
                $objOcorenciasHistorico->setIdOcorrencia($_REQUEST['id']);
                $objOcorenciasHistorico->setIdUsuario($_SESSION['usuario']['id']);
                $objOcorenciasHistorico->setDescricao($_REQUEST['descricao']);
                $novoId = $objOcorenciasHistorico->Adicionar();
            }


            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
        $template = "ajax.ocorrencias.php";
        break;
    case "frm_adicionar_ocorrencias":
        $linha['data_hora'] = Conexao::DataHoraGMTDB();
        $linha['raio'] = 500;
        $template = "tpl.frm.ocorrencias.php";
        break;
    case "frm_adicionar_abertura":
        $linha['data_hora'] = Conexao::DataHoraGMTDB();
        $linha['raio'] = 500;
        $template = "tpl.frm.abertura.php";
        break;
    case "abertura_atendimento":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objLigacoes = new Ligacoes($pdo);
            $objLigacoes->setIdUsuario($_SESSION['usuario']['id']);
            $objLigacoes->setNumero($_REQUEST['telefone']);
            $objLigacoes->setTempo($_REQUEST['tempo']);
            $objLigacoes->setIdClassificacao($_REQUEST['id_classificacao']);
            $objLigacoes->setLatitude($_REQUEST['latitude']);
            $objLigacoes->setLongitude($_REQUEST['longitude']);
            $objLigacoes->setDescritivo($_REQUEST['descritivo']);
            $objLigacoes->Adicionar();

            // $objEndereco = new Endereco($pdo);
            // $objEndereco->setLogradouro($_REQUEST['endereco']);
            // $objEndereco->setNumero($_REQUEST['numero']);
            // $objEndereco->setComplemento($_REQUEST['complemento']);
            // $objEndereco->setBairro($_REQUEST['bairro']);
            // $objEndereco->setCidade($_REQUEST['cidade']);
            // $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            // $objEndereco->setEstado($_REQUEST['id_estado']);
            // $objEndereco->setCep($_REQUEST['cep']);
            // $objEndereco->setReferencia($_REQUEST['referencia']);
            // $objEndereco->setObservacao($_REQUEST['observacao']);
            // $objEndereco->setTelefone($_REQUEST['telefone']);
            // $objEndereco->setComercial($_REQUEST['comercial']);
            // $objEndereco->setCelular($_REQUEST['celular']);
            // $objEndereco->setEmail($_REQUEST['email']);
            // $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            // $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            // $objEndereco->setLatitude($_REQUEST['latitude']);
            // $objEndereco->setLongitude($_REQUEST['longitude']);
            // $idEndereco = $objEndereco->Adicionar();

            $objOcorrencias = new Ocorrencias($pdo);
            $objOcorrencias->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objOcorrencias->setDataHora(Conexao::PrepararDataBD($_REQUEST['data_hora'], $_SESSION['usuario']['timezone']));
            $objOcorrencias->setNome($_REQUEST['nome']);
            $objOcorrencias->setTelefone($_REQUEST['telefone']);
            $objOcorrencias->setNumeroOcorrencia($_REQUEST['numero_ocorrencia']);
            $objOcorrencias->setIdEndereco($idEndereco);
            $objOcorrencias->setDescritivo($_REQUEST['descritivo']);
            $objOcorrencias->setIdUsuario($_SESSION['usuario']['id']);
            $objOcorrencias->setIdRegulador($_REQUEST['id_regulador']);
            $objOcorrencias->setIdEvento($_REQUEST['id_evento']);
            $objOcorrencias->setIdSubevento($_REQUEST['id_subevento']);
            $objOcorrencias->setIdOcorrenciaStatus(1);
            $objOcorrencias->setIdOcorrenciaClassificacao($_REQUEST['id_ocorrencia_classificacao']);
            $objOcorrencias->setIdTipoSolicitante($_REQUEST['id_solicitante']);
            $objOcorrencias->setRaio($_REQUEST['raio']);
            $objOcorrencias->setLogradouro($_REQUEST['endereco']);
            $objOcorrencias->setNumero($_REQUEST['numero']);
            $objOcorrencias->setCidade($_REQUEST['cidade']);
            $objOcorrencias->setBairro($_REQUEST['bairro']);
            $objOcorrencias->setEstado($_REQUEST['estado']);
            $objOcorrencias->setIdCidade($_REQUEST['id_cidade']);
            $objOcorrencias->setIdEstado($_REQUEST['id_estado']);
            $objOcorrencias->setEnderecoCompleto($_REQUEST['logradouro']);
            $objOcorrencias->setComplemento($_REQUEST['complemento']);
            $objOcorrencias->setLatitude($_REQUEST['latitude']);
            $objOcorrencias->setLongitude($_REQUEST['longitude']);
            $novoId = $objOcorrencias->Adicionar();
            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
        $template = "ajax.ocorrencias.php";
        break;
    case "dashboard_ocorrencias":
        $linha['data_hora'] = Conexao::DataHoraGMTDB();
        $linha['raio'] = 500;
        $template = "tpl.dash.ocorrencias.php";
        break;

    case "adicionar_ocorrencias":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {


            // $objEndereco = new Endereco($pdo);
            // $objEndereco->setLogradouro($_REQUEST['logradouro']);
            // $objEndereco->setNumero($_REQUEST['numero']);
            // $objEndereco->setComplemento($_REQUEST['complemento']);
            // $objEndereco->setBairro($_REQUEST['bairro']);
            // $objEndereco->setCidade($_REQUEST['cidade']);
            // $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            // $objEndereco->setEstado($_REQUEST['estado']);
            // $objEndereco->setCep($_REQUEST['cep']);
            // $objEndereco->setReferencia($_REQUEST['referencia']);
            // $objEndereco->setObservacao($_REQUEST['observacao']);
            // $objEndereco->setTelefone($_REQUEST['telefone']);
            // $objEndereco->setComercial($_REQUEST['comercial']);
            // $objEndereco->setCelular($_REQUEST['celular']);
            // $objEndereco->setEmail($_REQUEST['email']);
            // $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            // $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            // $objEndereco->setLatitude($_REQUEST['latitude']);
            // $objEndereco->setLongitude($_REQUEST['longitude']);
            // $idEndereco = $objEndereco->Adicionar();

            $objOcorrencias = new Ocorrencias($pdo);
            $objOcorrencias->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objOcorrencias->setDataHora(Conexao::PrepararDataBD($_REQUEST['data_hora'], $_SESSION['usuario']['timezone']));
            $objOcorrencias->setNome($_REQUEST['nome']);
            $objOcorrencias->setTelefone($_REQUEST['telefone']);
            $objOcorrencias->setNumeroOcorrencia($_REQUEST['numero_ocorrencia']);
            $objOcorrencias->setIdEndereco($idEndereco);
            $objOcorrencias->setDescritivo($_REQUEST['descritivo']);
            $objOcorrencias->setIdUsuario($_REQUEST['id_usuario']);
            $objOcorrencias->setIdRegulador($_REQUEST['id_regulador']);
            $objOcorrencias->setIdEvento($_REQUEST['id_evento']);
            $objOcorrencias->setIdSubevento($_REQUEST['id_subevento']);
            $objOcorrencias->setIdOcorrenciaStatus($_REQUEST['id_ocorrencia_status']);
            $objOcorrencias->setIdOcorrenciaClassificacao($_REQUEST['id_ocorrencia_classificacao']);
            $objOcorrencias->setIdTipoSolicitante($_REQUEST['id_tipo_solicitante']);
            $objOcorrencias->setRaio($_REQUEST['raio']);
            $objOcorrencias->setUsa($_REQUEST['usa']);
            $objOcorrencias->setUsb($_REQUEST['usb']);
            $objOcorrencias->setSiate($_REQUEST['siate']);
            $objOcorrencias->setVir($_REQUEST['vir']);
            $objOcorrencias->setLogradouro($_REQUEST['endereco']);
            $objOcorrencias->setEnderecoCompleto($_REQUEST['endereco_completo']);
            $objOcorrencias->setNumero($_REQUEST['numero']);
            $objOcorrencias->setComplemento($_REQUEST['complemento']);
            $objOcorrencias->setBairro($_REQUEST['bairro']);
            $objOcorrencias->setCidade($_REQUEST['cidade']);
            $objOcorrencias->setLatitude($_REQUEST['latitude']);
            $objOcorrencias->setLongitude($_REQUEST['longitude']);
            $novoId = $objOcorrencias->Adicionar();
            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_ADICIONAR;
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
        $template = "ajax.ocorrencias.php";
        break;

    case "frm_atualizar_ocorrencias":
        $ocorrencias = new Ocorrencias();
        $ocorrencias->setId($_REQUEST["app_codigo"]);
        $linha = $ocorrencias->Editar();
        //		Conexao::pr($linha);
        $template = "tpl.frm.ocorrencias.php";
        break;

    case "atualizar_ocorrencias":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            // $objEndereco = new Endereco($pdo);
            // $objEndereco->setId($_POST['id_endereco']);
            // $objEndereco->setLogradouro($_REQUEST['logradouro']);
            // $objEndereco->setNumero($_REQUEST['numero']);
            // $objEndereco->setComplemento($_REQUEST['complemento']);
            // $objEndereco->setBairro($_REQUEST['bairro']);
            // $objEndereco->setCidade($_REQUEST['cidade']);
            // $objEndereco->setIdCidade($_REQUEST['id_cidade']);
            // $objEndereco->setEstado($_REQUEST['estado']);
            // $objEndereco->setCep($_REQUEST['cep']);
            // $objEndereco->setReferencia($_REQUEST['referencia']);
            // $objEndereco->setObservacao($_REQUEST['observacao']);
            // $objEndereco->setTelefone($_REQUEST['telefone']);
            // $objEndereco->setComercial($_REQUEST['comercial']);
            // $objEndereco->setCelular($_REQUEST['celular']);
            // $objEndereco->setEmail($_REQUEST['email']);
            // $objEndereco->setEmailMkt($_REQUEST['email_mkt']);
            // $objEndereco->setEmailMkt2($_REQUEST['email_mkt2']);
            // $objEndereco->setLatitude($_REQUEST['latitude']);
            // $objEndereco->setLongitude($_REQUEST['longitude']);
            // $idEndereco = $objEndereco->Modificar();

            $objOcorrencias = new Ocorrencias($pdo);
            $objOcorrencias->setId($_REQUEST['id']);
            $objOcorrencias->setDataHora(Conexao::PrepararDataBD($_REQUEST['data_hora'], $_SESSION['usuario']['timezone']));
            $objOcorrencias->setNome($_REQUEST['nome']);
            $objOcorrencias->setTelefone($_REQUEST['telefone']);
            $objOcorrencias->setNumeroOcorrencia($_REQUEST['numero_ocorrencia']);
            $objOcorrencias->setIdEndereco($_REQUEST['id_endereco']);
            $objOcorrencias->setDescritivo($_REQUEST['descritivo']);
            $objOcorrencias->setIdUsuario($_REQUEST['id_usuario']);
            $objOcorrencias->setIdRegulador($_REQUEST['id_regulador']);
            $objOcorrencias->setIdEvento($_REQUEST['id_evento']);
            $objOcorrencias->setIdSubevento($_REQUEST['id_subevento']);
            $objOcorrencias->setIdOcorrenciaStatus($_REQUEST['id_ocorrencia_status']);
            $objOcorrencias->setIdOcorrenciaClassificacao($_REQUEST['id_ocorrencia_classificacao']);
            $objOcorrencias->setIdTipoSolicitante($_REQUEST['id_tipo_solicitante']);
            $objOcorrencias->setRaio($_REQUEST['raio']);
            $objOcorrencias->setUsa($_REQUEST['usa']);
            $objOcorrencias->setUsb($_REQUEST['usb']);
            $objOcorrencias->setSiate($_REQUEST['siate']);
            $objOcorrencias->setVir($_REQUEST['vir']);
            $objOcorrencias->setLogradouro($_REQUEST['endereco']);
            $objOcorrencias->setEnderecoCompleto($_REQUEST['logradouro']);
            $objOcorrencias->setNumero($_REQUEST['numero']);
            $objOcorrencias->setCidade($_REQUEST['cidade']);
            $objOcorrencias->setBairro($_REQUEST['bairro']);
            $objOcorrencias->setComplemento($_REQUEST['complemento']);
            $objOcorrencias->setLatitude($_REQUEST['latitude']);
            $objOcorrencias->setLongitude($_REQUEST['longitude']);
            $objOcorrencias->Modificar();
            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_MODIFICAR;
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
        $template = "ajax.ocorrencias.php";
        break;

    case "listar_ocorrencias":
        $template = "tpl.geral.ocorrencias.php";
        break;
    case "listar_ocorrencias_historico":
        $template = "tpl.historico.ocorrencias.php";
        break;

    case "deletar_ocorrencias":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objOcorrencias = new Ocorrencias($pdo);
            $objOcorrencias->Remover($_REQUEST['registros']);
            $msg["codigo"] = 0;
            $msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
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
        $template = "ajax.ocorrencias.php";
        break;

    case "ajax_listar_ocorrencias":
        $template = "tpl.lis.ocorrencias.php";
        break;

    case "ocorrencias_pdf":
        $template = "tpl.lis.ocorrencias.pdf.php";
        break;

    case "ocorrencias_xlsx":
        $template = "tpl.lis.ocorrencias.xlsx.php";
        break;

    case "ocorrencias_print":
        $objOcorrencias = new Ocorrencias();
        $objOcorrencias->setId($_REQUEST['app_codigo']);
        $linha = $objOcorrencias->View();

        $objOcoRecursos = new OcorrenciasRecursos();
        $objOcoRecursos->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_recursos = $objOcoRecursos->View();


        $objPacientes = new Paciente();
        $objPacientes->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_pacientes = $objPacientes->View();


        $objOcoApoio = new OcorrenciasApoio();
        $objOcoApoio->setIdOcorrencia($_REQUEST['app_codigo']);
        $linha_Apoio = $objOcoApoio->View();


        //include_once("classes/phpqrcode/qrlib.php");
        //QRcode::png("http://siga.segeagle.com.br/", "upload/qrcode/".$_REQUEST['app_codigo'].'qr.png');

        $template = "tpl.boletim.ocorrencias.php";
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
            $_SESSION["configuracao_usuario"]["ocorrencias"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("ocorrencias");
            $usuarioConfiguracao->LimparConfiguracoes();
            foreach ($colunasSelecionadas as $nomeCampo => $idCampo) {
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
                $msg["mensagem"] = TXT_ALERT_SUCESSO_OPERACAO;
            } else {
                $msg["codigo"]   = 1;
                $msg["mensagem"] = TXT_ALERT_ERRO_OPERACAO;
            }
        } else {
            $msg["codigo"]   = 1;
            $msg["mensagem"] = TXT_ALERT_SELECIONAR_COLUNAS;
        }
        echo json_encode($msg);
        $template = "ajax.ocorrencias.php";
        break;
}
