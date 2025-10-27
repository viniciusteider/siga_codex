<script>
    var drawerElement,drawer;
    var drawerElement2,drawer2;
    var drawerElement3,drawer3;
    var loading = '<div class="text-center"> <span class="spinner-border text-primary" role="status"></span><br><span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span> </div>';

    $(document).ready(function (){
        drawerElement = document.querySelector("#modal_ocorrencia_direita");
        drawer = KTDrawer.getInstance(drawerElement);
        drawerElement2 = document.querySelector("#modal_ocorrencia_esquerda");
        drawer2 = KTDrawer.getInstance(drawerElement2);
        CarregarAbertas();
        CarregarDespachadas();
        CarregarReguladas();
        CarregarFinalizadas();

        drawer.on("kt.drawer.after.hidden", function() {
            UpdateListagens();
        });
        drawer2.on("kt.drawer.after.hidden", function() {
            UpdateListagens();
        });
        drawer.on("kt.drawer.hide", function() {
            ExecutarAcaoDespachoOcorrenciasDescricao(1);
        });
    });
    function UpdateListagens()
    {
        CarregarAbertas();
        CarregarDespachadas();
        CarregarReguladas();
        CarregarFinalizadas();
    }
    function UpdateListagem(app_comando)
    {
        switch(app_comando){
            case 'listar_ocorrencias_despachadas': CarregarDespachadas(); break;
            case 'listar_ocorrencias_reguladas': CarregarReguladas(); break;
            case 'listar_ocorrencias_finalizadas': CarregarFinalizadas(); break;
            case 'listar_ocorrencias_abertas': CarregarAbertas(); break;
        }
    }
    function CarregarAbertas()
    {
        $('#div_ocorrencias_disponiveis').html(loading);
        $('#div_ocorrencias_disponiveis').load('index_xml.php?app_modulo=ocorrencias&app_comando=listar_ocorrencias_abertas');
    }
    function CarregarReguladas()
    {
        $('#div_ocorrencias_reguladas').html(loading);
        $('#div_ocorrencias_reguladas').load('index_xml.php?app_modulo=ocorrencias&app_comando=listar_ocorrencias_reguladas');
    }
    function CarregarDespachadas()
    {
        $('#div_ocorrencias_despachadas').html(loading);
        $('#div_ocorrencias_despachadas').load('index_xml.php?app_modulo=ocorrencias&app_comando=listar_ocorrencias_despachadas');
    }
    function CarregarFinalizadas()
    {
        $('#div_ocorrencias_finalizadas').html(loading);
        $('#div_ocorrencias_finalizadas').load('index_xml.php?app_modulo=ocorrencias&app_comando=listar_ocorrencias_finalizadas');
    }
    function AbrirOcorrenciaAberta(id)
    {
        $('#div_ocorrencias_direita').html(loading);
        drawer.show();
        $('#div_ocorrencias_direita').load('index_xml.php?app_modulo=ocorrencias&app_comando=frm_regular_ocorrencia&app_codigo='+id);
    }
    function AbrirOcorrenciaDespachar(id)
    {
        $('#modal_despachar_ocorrencia').modal('show');
        $('#div_despachar_ocorrencia').html(loading);
        $('#div_despachar_ocorrencia').load('index_xml.php?app_modulo=ocorrencias&app_comando=frm_despachar_ocorrencia&app_codigo='+id);
    }
    function AtualizarOcorrencia(id)
    {
        $('#modal_atualizar_ocorrencia').modal('show');
        $('#div_atualizar_ocorrencia').html(loading);
        $('#div_atualizar_ocorrencia').load('index_xml.php?app_modulo=ocorrencias&app_comando=frm_atualizar_ocorrencia_modal&app_codigo='+id);
    }
    function AbrirOcorrenciaRegular(id)
    {
        $('#div_ocorrencias_esquerda').html(loading);
        drawer2.show();
        $('#div_ocorrencias_esquerda').load('index_xml.php?app_modulo=ocorrencias&app_comando=view_ocorrencia&app_codigo='+id);
    }
    // function ModalPaciente(){
    //     var id = $('#id').val();
    //     $("#modal_modulo_paciente").modal("show");
    //     $("#div_modal_paciente").load("index_xml.php?app_comando=frm_modal_paciente&app_modulo=paciente&app_codigo="+id);
    // }
    function ModalListagemPaciente(){
        var id = $('#id').val();
        $("#modal_listar_paciente").modal("show");
        $("#div_listar_paciente").load("index_xml.php?app_comando=listar_paciente&app_modulo=paciente&id_ocorrencia="+id);
    }
    function ModalListagemPaciente2(id){
        $("#modal_listar_paciente").modal("show");
        $("#div_listar_paciente").load("index_xml.php?app_comando=listar_paciente&app_modulo=paciente&id_ocorrencia="+id);
    }
    function ModalListagemApoio(id){
        $("#modal_listar_apoio").modal("show");
        $("#div_listar_apoio").load("index_xml.php?app_comando=listar_ocorrencias_apoio&app_modulo=ocorrencias_apoio&id_ocorrencia="+id);
    }
    function VeiculosAcidentes(id){
        $("#modal_veiculos_acidentes").modal("show");
        $("#div_veiculos_acidentes").load("index_xml.php?app_comando=listar_veiculos_acidentes&app_modulo=veiculos_acidentes&id_ocorrencia="+id);
    }
    function VisualizarOcorrencia(id)
    {
        drawer2.show();
        $('#div_ocorrencias_esquerda').html(loading);
        $('#div_ocorrencias_esquerda').load('index_xml.php?app_modulo=ocorrencias&app_comando=view_ocorrencia&app_codigo='+id);
    }
    function AtualizarPosicao(tipo,id)
    {
        $.post("index_xml.php?app_modulo=ocorrencias&app_comando=atualizar_posicao_ocorrencia&app_codigo",
            {
                tipo: tipo,
                id:id
            },
            // pegando resposta do retorno do post
            function (response)
            {
                if (response["codigo"] == 0) {
                    $('#modal_atualizar_ocorrencia').modal('hide');
                    Squall.ToastMsg('success','Sucesso ao executar operação');
                } else {
                    Squall.ToastMsg('warning',response["mensagem"]);
                }
            }
            , "json" // definindo retorno para o formato json
        );
    }
    function EditarHorarioDespacho(id,pos,id_despacho)
    {
        var toPost = {
            "id" : id,
            "pos" : pos,
            "id_despacho" : id_despacho
        }
        $('#modal_horarios_despacho').modal('show');
        $('#div_horarios_despacho').load('index_xml.php?app_modulo=ocorrencias&app_comando=frm_horario_despacho&app_codigo',toPost);
    }
    function ExecutarAcaoDespachoOcorrenciasDescricao(tipo)
    {
        if(tipo == 1)
            $('#descricao').removeClass('validar-obrigatorio');
        else
            $('#descricao').addClass('validar-obrigatorio');

        if (Squall.ValidateForm($("#frm_despacho_ocorrencia"))) {
            $("#bt_salvar_despacho").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> AGUARDE...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post("index_xml.php?app_modulo=ocorrencias&app_comando=regular_ocorrencia&app_codigo",
                $("#frm_despacho_ocorrencia").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success','Sucesso ao executar operação');
                        $('#descricao').val('');
                        AtualizarHistorico();
                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_salvar_despacho").prop("disabled",false).html("<i class=\"fa fa-check\"></i> SALVAR").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
    function ExecutarAcaoDespacharOcorrencia(url)
    {
        if (Squall.ValidateForm($("#form-recursos-disponiveis"))) {
            $("#bt_despahcar_ocorrencia_modal").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post('index_xml.php?app_modulo=ocorrencias_recursos&app_comando=adicionar_ocorrencias_recursos&app_codigo',
                $("#form-recursos-disponiveis").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_despachar_ocorrencia').modal('hide');
                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_despahcar_ocorrencia_modal").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Despachar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }

    // Conectar ao WebSocket
    let socket;
    
    function conectarWebSocket() {
        const groupId = '<?php echo $_SESSION["usuario"]["id_grupo"]; ?>';
        socket = new WebSocket(`ws://www.siga192.com.br:8080/?groupId=${groupId}`);

        socket.onopen = function(e) {
            console.log("Conexão estabelecida");
        };

        socket.onmessage = function(event) {
            receberMensagem(event.data);
        };

        socket.onclose = function(event) {
            if (event.wasClean) {
                console.log(`Conexão fechada limpa, código=${event.code} motivo=${event.reason}`);
            } else {
                console.log('Conexão morreu');
            }
        };

        socket.onerror = function(error) {
            console.log(`Erro ${error.message}`);
        };
    }

    function enviarMensagem(tipo, userId, data) {
        if (socket.readyState === WebSocket.OPEN) {
            const mensagem = JSON.stringify({
                type: tipo,
                userId: userId,
                data: data
            });
            socket.send(mensagem);
        } else {
            console.log("A conexão não está aberta.");
        }
    }

    function receberMensagem(mensagem) {
        const dados = JSON.parse(mensagem);
        console.log("Mensagem recebida:", dados);
        
        // Aqui você pode adicionar lógica para lidar com diferentes tipos de mensagens
        switch(dados.type) {
            case "requestSupport":
                Squall.ToastMsg('warning',"Viatura "+dados.data.prefixo+" solicitou auxílio da unidade "+dados.data.orgao_apoio + "<br /><button class='btn btn-primary' onclick=\"ModificarApoio("+dados.data.id_ocorrencia+", "+dados.data.id_ocorrencia_apoio+")\">Enviar auxílio</button>", '', 15000);
                break;
        }
    }

    function ModificarApoio(idOcorrencia, idOcorrenciaApoio) {
        ModalListagemApoio(idOcorrencia, idOcorrenciaApoio);
        setTimeout(function() {
            ModificarOcorrenciasApoio(idOcorrenciaApoio);
        }, 1000);
    }

    // Conectar ao WebSocket quando a página carregar
    $(document).ready(function() {
        conectarWebSocket();
    });
</script>