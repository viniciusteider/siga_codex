<?php

switch($app_comando)
{
    case "frm_adicionar_paciente":
        $template = "tpl.frm.paciente.php";
        break;
    case "view_encaminhamento":
        $template = "tpl.lis.view_encaminhamentos.php";
        break;

    case "frm_modal_paciente":
        if($_REQUEST["app_codigo"] != "") {
            $paciente = new Paciente();
            $paciente->setId($_REQUEST["app_codigo"]);
            $linha = $paciente->Editar();
        }		$template = "tpl.frm.tab.paciente.php";
        break;

    case "adicionar_paciente":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {

            //SET DOS PARAMETROS DO ENDEREÇO
            

            $objPaciente = new Paciente($pdo);
            $objPaciente->setIdGrupo($_SESSION["usuario"]["id_grupo"]);
            $objPaciente->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objPaciente->setIdTipoObstetricia($_REQUEST['id_tipo_obstetricia']);
            $objPaciente->setIdRespiracao($_REQUEST['id_respiracao']);
            $objPaciente->setIdViasAereas($_REQUEST['id_vias_aereas']);
            $objPaciente->setIdPupilas($_REQUEST['id_pupilas']);
            $objPaciente->setIdHospital($_REQUEST['id_hospital']);
            $objPaciente->setIdEtnia($_REQUEST['id_etnia']);
            $objPaciente->setTipoEncaminhamento($_REQUEST['tipo_encaminhamento']);
            $objPaciente->setNome($_REQUEST['nome']);
            $objPaciente->setIdade($_REQUEST['idade']);
            $objPaciente->setSexo($_REQUEST['sexo']);
            $objPaciente->setRg($_REQUEST['rg']);
            $objPaciente->setCpf($_REQUEST['cpf']);
            $objPaciente->setIdadeGestacional($_REQUEST['idade_gestacional']);
            $objPaciente->setBcf($_REQUEST['bcf']);
            $objPaciente->setApgar1($_REQUEST['apgar_1']);
            $objPaciente->setApgar5($_REQUEST['apgar_5']);
            $objPaciente->setRecusaAtendimento($_REQUEST['recusa_atendimento']);
            $objPaciente->setRecusaTransporte($_REQUEST['recusa_transporte']);
            $objPaciente->setProfissional($_REQUEST['profissional']);
            $objPaciente->setDataRecebimento(Conexao::PrepararDataBD($_REQUEST['data_recebimento'], $_SESSION['usuario']['timezone']));
            $objPaciente->setIdUsuario($_SESSION['usuario']['id']);
            $objPaciente->setIdSituacao($_REQUEST['id_situacao']);

            $objPaciente->setLogradouro($_REQUEST['logradouro']);
            $objPaciente->setNumero($_REQUEST['numero']);
            $objPaciente->setComplemento($_REQUEST['complemento']);
            $objPaciente->setBairro($_REQUEST['bairro']);
            $objPaciente->setCidade($_REQUEST['cidade']);
            $objPaciente->setIdCidade($_REQUEST['id_cidade']);
            $objPaciente->setEstado($_REQUEST['estado']);
            $objPaciente->setIdEstado($_REQUEST['id_estado']);
            $objPaciente->setEnderecoCompleto($_REQUEST['endereco_completo']);
            $objPaciente->setLatitude($_REQUEST['latitude']);
            $objPaciente->setLongitude($_REQUEST['longitude']);

            $objPaciente->setTelefone($_REQUEST['telefone']);
            $objPaciente->setComercial($_REQUEST['comercial']);
            $objPaciente->setCelular($_REQUEST['celular']);

            $objPaciente->setObservacao($_REQUEST['observacao']);

            $novoId = $objPaciente->Adicionar();

            if(is_array($_REQUEST['sinais']) && count($_REQUEST['sinais']) > 0)
            {
                foreach($_REQUEST['sinais'] as $sinais){
                    if($sinais['horario'] == "") continue;
                    $objPacienteSinaisVitais = new PacienteSinaisVitais($pdo);
                    $objPacienteSinaisVitais->setIdPaciente($novoId);
                    $objPacienteSinaisVitais->setHorario($sinais['horario']);
                    $objPacienteSinaisVitais->setPressaoArterialMinima($sinais['pressao_arterial_minima']);
                    $objPacienteSinaisVitais->setPressaoArterialMaxima($sinais['pressao_arterial_maxima']);
                    $objPacienteSinaisVitais->setFrequenciaCardiaca($sinais['frequencia_cardiaca']);
                    $objPacienteSinaisVitais->setFrequenciaRespiratoria($sinais['frequencia_respiratoria']);
                    $objPacienteSinaisVitais->setSaturacaoO2($sinais['saturacao_o2']);
                    $objPacienteSinaisVitais->setGlasgow($sinais['glasgow']);
                    $objPacienteSinaisVitais->setTemperatura($sinais['temperatura']);
                    $objPacienteSinaisVitais->setHgt($sinais['hgt']);
                    $objPacienteSinaisVitais->setEscalaTrauma($sinais['escala_trauma']);
                    $objPacienteSinaisVitais->Adicionar();
                }
            }

            if(is_array($_REQUEST['medicamentos']) && count($_REQUEST['medicamentos']) > 0)
            {
                foreach($_REQUEST['medicamentos'] as $medicamentos){
                    if($medicamentos['id_medicamento'] == "") continue;
                    $objPacienteMedicamentos = new PacienteMedicamentos($pdo);
                    $objPacienteMedicamentos->setIdPaciente($novoId);
                    $objPacienteMedicamentos->setIdMedicamento($medicamentos['id_medicamento']);
                    $objPacienteMedicamentos->setIdVia($medicamentos['id_via']);
                    $objPacienteMedicamentos->setIdEfetivo($medicamentos['id_efetivo']);
                    $objPacienteMedicamentos->setHorario(Conexao::PrepararDataBD($medicamentos['data_medicamento'] . " " .$medicamentos['horario_medicamento'], $_SESSION['usuario']['timezone']));
                    $objPacienteMedicamentos->setDose($medicamentos['dose']);
                    $objPacienteMedicamentos->setUnidadeMedida($medicamentos['unidade_medida_id']);
                    $objPacienteMedicamentos->Adicionar();
                }
            }

            if(count($_REQUEST['sinais_clinicos'] ?? []) > 0)
            {
                foreach ($_REQUEST['sinais_clinicos'] as $sinais_clinico) {
                    $objPacienteSinaisClinicos = new PacienteSinaisClinicos($pdo);
                    $objPacienteSinaisClinicos->setIdPaciente($novoId);
                    $objPacienteSinaisClinicos->setIdSinaisClinicos($sinais_clinico);
                    $objPacienteSinaisClinicos->Adicionar();
                }
            }

            if(is_array($_REQUEST['circulacao']) && count($_REQUEST['circulacao']) > 0)
            {
                foreach ($_REQUEST['circulacao'] as $item) {
                    $objPacienteCirculacao = new PacienteCirculacao($pdo);
                    $objPacienteCirculacao->setIdPaciente($novoId);
                    $objPacienteCirculacao->setIdCirculacao($item);
                    $objPacienteCirculacao->Adicionar();
                }
            }

            if(is_array($_REQUEST['lesoes']) && count($_REQUEST['lesoes']) > 0)
            {
                foreach ($_REQUEST['lesoes'] as $index => $item) {
                    $objPacienteLesoes = new PacienteLesoes($pdo);
                    $objPacienteLesoes->setIdParteCorpo($index);
                    $objPacienteLesoes->setIdLesao($item);
                    $objPacienteLesoes->setIdPaciente($novoId);
                    $objPacienteLesoes->Adicionar();
                }
            }

            if(is_array($_REQUEST['id_procedimentos']) && count($_REQUEST['id_procedimentos']) > 0)
            {
                foreach ($_REQUEST['id_procedimentos'] as  $item) {
                    $objPacienteProcedimentos = new PacienteProcedimentos($pdo);
                    $objPacienteProcedimentos->setIdPaciente($novoId);
                    $objPacienteProcedimentos->setIdProcedimento($item);
                    $objPacienteProcedimentos->Adicionar();
                }
            }
//            Conexao::pr($_REQUEST['pupilas_sintomas']);
            if(is_array($_REQUEST['pupilas_sintomas']) && count($_REQUEST['pupilas_sintomas']) > 0)
            {
                foreach ($_REQUEST['pupilas_sintomas'] as $index =>  $item) {
                    $objPacientePupilas = new PacientePupilas($pdo);
                    $objPacientePupilas->setIdPaciente($novoId);
                    $objPacientePupilas->setIdPupilasSintomas($index);
                    $objPacientePupilas->setDireita($item['direita']);
                    $objPacientePupilas->setEsquerda($item['esquerda']);
                    $objPacientePupilas->Adicionar();
                }
            }

            if(is_array($_REQUEST['obstetricia']) && count($_REQUEST['obstetricia']) > 0)
            {
                foreach ($_REQUEST['obstetricia'] as  $item) {
                    $objPacienteSinaisClinicosObstetricia = new PacienteSinaisClinicosObstetricia($pdo);
                    $objPacienteSinaisClinicosObstetricia->setIdPaciente($novoId);
                    $objPacienteSinaisClinicosObstetricia->setIdSinaisClinicosObstetrica($item);
                    $objPacienteSinaisClinicosObstetricia->Adicionar();
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
        $template = "ajax.paciente.php";
        break;

    case "frm_atualizar_paciente" :
        $paciente = new Paciente();
        $paciente->setId($_REQUEST["app_codigo"]);
        $linha = $paciente->Editar();
        $template = "tpl.frm.paciente.php";
        break;

    case "atualizar_paciente":
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
            // $objEndereco->Modificar();

            $objPaciente = new Paciente($pdo);
            $objPaciente->setId($_REQUEST['id_paciente']);
            $objPaciente->setIdOcorrencia($_REQUEST['id_ocorrencia']);
            $objPaciente->setIdTipoObstetricia($_REQUEST['id_tipo_obstetricia']);
            $objPaciente->setIdRespiracao($_REQUEST['id_respiracao']);
            $objPaciente->setIdViasAereas($_REQUEST['id_vias_aereas']);
            $objPaciente->setIdPupilas($_REQUEST['id_pupilas']);
            $objPaciente->setIdHospital($_REQUEST['id_hospital']);
            $objPaciente->setIdEtnia($_REQUEST['id_etnia']);
            $objPaciente->setTipoEncaminhamento($_REQUEST['tipo_encaminhamento']);
            $objPaciente->setNome($_REQUEST['nome']);
            $objPaciente->setIdade($_REQUEST['idade']);
            $objPaciente->setSexo($_REQUEST['sexo']);
            $objPaciente->setIdEndereco($_REQUEST['id_endereco']);
            $objPaciente->setRg($_REQUEST['rg']);
            $objPaciente->setCpf($_REQUEST['cpf']);
            $objPaciente->setIdadeGestacional($_REQUEST['idade_gestacional']);
            $objPaciente->setBcf($_REQUEST['bcf']);
            $objPaciente->setApgar1($_REQUEST['apgar_1']);
            $objPaciente->setApgar5($_REQUEST['apgar_5']);
            $objPaciente->setRecusaAtendimento($_REQUEST['recusa_atendimento']);
            $objPaciente->setRecusaTransporte($_REQUEST['recusa_transporte']);
            $objPaciente->setProfissional($_REQUEST['profissional']);
            $objPaciente->setDataRecebimento(Conexao::PrepararDataBD($_REQUEST['data_recebimento'], $_SESSION['usuario']['timezone']));
            $objPaciente->setIdUsuario($_REQUEST['id_usuario']);
            $objPaciente->setIdSituacao($_REQUEST['id_situacao']);
            
            $objPaciente->setLogradouro($_REQUEST['logradouro']);
            $objPaciente->setNumero($_REQUEST['numero']);
            $objPaciente->setComplemento($_REQUEST['complemento']);
            $objPaciente->setBairro($_REQUEST['bairro']);
            $objPaciente->setCidade($_REQUEST['cidade']);
            $objPaciente->setIdCidade($_REQUEST['id_cidade']);
            $objPaciente->setEstado($_REQUEST['estado']);
            $objPaciente->setIdEstado($_REQUEST['id_estado']);
            $objPaciente->setEnderecoCompleto($_REQUEST['endereco_completo']);
            $objPaciente->setLatitude($_REQUEST['latitude']);
            $objPaciente->setLongitude($_REQUEST['longitude']);

            $objPaciente->setTelefone($_REQUEST['telefone']);
            $objPaciente->setComercial($_REQUEST['comercial']);
            $objPaciente->setCelular($_REQUEST['celular']);

            $objPaciente->setObservacao($_REQUEST['observacao']);

            $objPaciente->Modificar();

            $objPacienteSinaisClinicos = new PacienteSinaisClinicos($pdo);
            $objPacienteSinaisClinicos->setIdPaciente($_REQUEST['id_paciente']);
            $objPacienteSinaisClinicos->RemoverAll();

            if(count($_REQUEST['sinais_clinicos'] ?? []) > 0)
            {
                foreach ($_REQUEST['sinais_clinicos'] as $sinais_clinico) {

                    $objPacienteSinaisClinicos->setIdSinaisClinicos($sinais_clinico);
                    $objPacienteSinaisClinicos->Adicionar();
                }
            }



            if(is_array($_REQUEST['circulacao']) && count($_REQUEST['circulacao']) > 0)
            {
                $objPacienteCirculacao = new PacienteCirculacao($pdo);
                $objPacienteCirculacao->RemoverAllPaciente($_REQUEST['id_paciente']);
                foreach ($_REQUEST['circulacao'] as $item) {

                    $objPacienteCirculacao->setIdPaciente($_REQUEST['id_paciente']);
                    $objPacienteCirculacao->setIdCirculacao($item);
                    $objPacienteCirculacao->Adicionar();
                }
            }

            if(is_array($_REQUEST['lesoes']) && count($_REQUEST['lesoes']) > 0)
            {
                $objPacienteLesoes = new PacienteLesoes($pdo);
                $objPacienteLesoes->RemoverAllPaciente($_REQUEST['id_paciente']);
                foreach ($_REQUEST['lesoes'] as $index => $item) {
                    foreach ($item as $parte)
                    {
                        $objPacienteLesoes->setIdParteCorpo($parte);
                        $objPacienteLesoes->setIdLesao($index);
                        $objPacienteLesoes->setIdPaciente($_REQUEST['id_paciente']);
                        $objPacienteLesoes->Adicionar();
                    }

                }
            }

            if(is_array($_REQUEST['id_procedimentos']) && count($_REQUEST['id_procedimentos']) > 0)
            {
                $objPacienteProcedimentos = new PacienteProcedimentos($pdo);
                $objPacienteProcedimentos->RemoverAllPaciente($_REQUEST['id_paciente']);
                foreach ($_REQUEST['id_procedimentos'] as  $item) {

                    $objPacienteProcedimentos->setIdPaciente($_REQUEST['id_paciente']);
                    $objPacienteProcedimentos->setIdProcedimento($item);
                    $objPacienteProcedimentos->Adicionar();
                }
            }
//            Conexao::pr($_REQUEST['pupilas_sintomas']);
            if(is_array($_REQUEST['pupilas_sintomas']) && count($_REQUEST['pupilas_sintomas']) > 0)
            {
                $objPacientePupilas = new PacientePupilas($pdo);
                $objPacientePupilas->RemoverAllPaciente($_REQUEST['id_paciente']);
                foreach ($_REQUEST['pupilas_sintomas'] as $index =>  $item) {
                    $objPacientePupilas->setIdPaciente($_REQUEST['id_paciente']);
                    $objPacientePupilas->setIdPupilasSintomas($index);
                    $objPacientePupilas->setDireita($item['direita']);
                    $objPacientePupilas->setEsquerda($item['esquerda']);
                    $objPacientePupilas->Adicionar();
                }
            }

            if(is_array($_REQUEST['obstetricia']) && count($_REQUEST['obstetricia']) > 0)
            {
                $objPacienteSinaisClinicosObstetricia = new PacienteSinaisClinicosObstetricia($pdo);
                $objPacienteSinaisClinicosObstetricia->RemoverAllPaciente($_REQUEST['id_paciente']);
                foreach ($_REQUEST['obstetricia'] as  $item) {
                    $objPacienteSinaisClinicosObstetricia->setIdPaciente($_REQUEST['id_paciente']);
                    $objPacienteSinaisClinicosObstetricia->setIdSinaisClinicosObstetrica($item);
                    $objPacienteSinaisClinicosObstetricia->Adicionar();
                }
            }
            if(is_array($_REQUEST['sinais']) && count($_REQUEST['sinais']) > 0)
            {
                $objPacienteSinaisVitais = new PacienteSinaisVitais($pdo);
                $objPacienteSinaisVitais->setIdPaciente($_REQUEST['id_paciente']);

                foreach ($_REQUEST['sinais'] as $item) $ids_remove[] = $item['id_paciente_sinais'];
                $ids_remove = array_filter($ids_remove);
                if(is_array($ids_remove) && count($ids_remove) > 0)
                    $objPacienteSinaisVitais->RemoverNotIn($ids_remove,$_REQUEST['id_paciente']);

                foreach($_REQUEST['sinais'] as $sinais){
                    if($sinais['horario'] == "") continue;
                    $objPacienteSinaisVitais->setId($sinais['id_paciente_sinais']);
                    $objPacienteSinaisVitais->setHorario($sinais['horario']);
                    $objPacienteSinaisVitais->setPressaoArterialMinima($sinais['pressao_arterial_minima']);
                    $objPacienteSinaisVitais->setPressaoArterialMaxima($sinais['pressao_arterial_maxima']);
                    $objPacienteSinaisVitais->setFrequenciaCardiaca($sinais['frequencia_cardiaca']);
                    $objPacienteSinaisVitais->setFrequenciaRespiratoria($sinais['frequencia_respiratoria']);
                    $objPacienteSinaisVitais->setSaturacaoO2($sinais['saturacao_o2']);
                    $objPacienteSinaisVitais->setGlasgow($sinais['glasgow']);
                    $objPacienteSinaisVitais->setTemperatura($sinais['temperatura']);
                    $objPacienteSinaisVitais->setHgt($sinais['hgt']);
                    $objPacienteSinaisVitais->setEscalaTrauma($sinais['escala_trauma']);
                    $objPacienteSinaisVitais->setAberturaOcular($sinais['abertura_ocular_id']);
                    $objPacienteSinaisVitais->setRespostaVerbal($sinais['resposta_verbal_id']);
                    $objPacienteSinaisVitais->setRespostaMotora($sinais['resposta_motora_id']);
                    if($sinais['id_paciente_sinais'] != "")
                        $objPacienteSinaisVitais->Modificar();
                    else
                        $objPacienteSinaisVitais->Adicionar();
                }
            }
            if(is_array($_REQUEST['medicamentos']) && count($_REQUEST['medicamentos']) > 0)
            {
                $objPacienteMedicamentos = new PacienteMedicamentos($pdo);
                $objPacienteMedicamentos->setIdPaciente($_REQUEST['id_paciente']);

                foreach ($_REQUEST['medicamentos'] as $item) $ids_remove2[] = $item['id_paciente_medicamento'];
                $ids_remove2 = array_filter($ids_remove2);
                if(is_array($ids_remove2) && count($ids_remove2) > 0)
                    $objPacienteMedicamentos->RemoverNotIn($ids_remove2,$_REQUEST['id_paciente']);

                foreach($_REQUEST['medicamentos'] as $medicamentos){
                    if($medicamentos['id_medicamento'] == "") continue;
                    $objPacienteMedicamentos->setId($medicamentos['id_paciente_medicamento']);
                    $objPacienteMedicamentos->setIdMedicamento($medicamentos['id_medicamento']);
                    $objPacienteMedicamentos->setIdVia($medicamentos['id_via']);
                    $objPacienteMedicamentos->setIdEfetivo($medicamentos['id_efetivo']);
                    $objPacienteMedicamentos->setHorario(Conexao::PrepararDataBD($medicamentos['data_medicamento'] . " " .$medicamentos['horario_medicamento'], $_SESSION['usuario']['timezone']));
                    $objPacienteMedicamentos->setDose($medicamentos['dose']);
                    $objPacienteMedicamentos->setUnidadeMedida($medicamentos['unidade_medida_id']);
                    if($medicamentos['id_paciente_medicamento'] != "")
                        $objPacienteMedicamentos->Modificar();
                    else
                        $objPacienteMedicamentos->Adicionar();
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
        $template = "ajax.paciente.php";
        break;

    case "listar_paciente":
        $template = "tpl.geral.paciente.php";
        break;

    case "listar_paciente_autocomplete":
        $objpaciente = new Paciente();
        $busca = $_REQUEST['term'] ?: $_REQUEST['buscar'] ?: $_REQUEST['busca'];
        echo json_encode($objpaciente->BuscarAutoComplete($busca));
        $template = "ajax.paciente.php";
        break;

    case "deletar_paciente":
        $pdo = new Conexao();
        $pdo->beginTransaction();
        try {
            $objPaciente = new Paciente($pdo);
            $objPaciente->Remover($_REQUEST['registros']);
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
        $template = "ajax.paciente.php";
        break;

    case "ajax_listar_paciente":
        $template = "tpl.lis.paciente.php";
        break;

    case "paciente_pdf":
        $template = "tpl.prontuario.php";
        break;

    case "paciente_xlsx":
        $template = "tpl.lis.paciente.xlsx.php";
        break;

    case "paciente_print":
        $template = "tpl.lis.paciente.print.php";
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
            $_SESSION["configuracao_usuario"]["paciente"] = $colunasSelecionadas;
            $usuarioConfiguracao->setIdUsuario($_SESSION["usuario"]["id"]);
            $usuarioConfiguracao->setDirModulo("paciente");
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
        $template = "ajax.paciente.php";
        break;
}
