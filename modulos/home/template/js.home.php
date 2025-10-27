<script>
    var loading = '<div class="text-center"> <span class="spinner-border text-primary" role="status"></span><br><span class="text-gray-800 fs-6 fw-semibold mt-5">Carregando...</span> </div>';

    $(document).ready(function (){
        ContadorDiario();
        <?php if($_SESSION['usuario']['id_usuario_tipo'] == 7) echo 'CarregarDespachadas();';?>
    });
    function ContadorDiario()
    {
        $.getJSON("index_xml.php?app_modulo=home&app_comando=contador_diario", function(result) {
            result = result || 0;
            $('#contador_confirmado').html(result[1] || 0);
            $('#contador_andamento').html(result[2] || 0);
            $('#contador_realizado').html(result[7] || 0);
            $('#contador_concluido').html(result[3] || 0);
        });
    }
    function CarregarDespachadas()
    {
        $('#div_ocorrencias_despachadas').html(loading);
        $('#div_ocorrencias_despachadas').load('index_xml.php?app_modulo=home&app_comando=listar_ocorrencias_dash');
    }
    function ModalListagemPaciente(id){
        $("#modal_listar_paciente").modal("show");
        $("#div_listar_paciente").load("index_xml.php?app_comando=listar_paciente&app_modulo=paciente&id_ocorrencia="+id);
    }


    function ModalListagemApoio(id){

        Modal = new SquallModal();
        Modal.titulo_modal = "Apoio";
        Modal.id_modal = 'modal_listar_apoio';
        Modal.id_conteudo_modal = 'div_listar_apoio';
        Modal.url = "index_xml.php?app_comando=listar_ocorrencias_apoio&app_modulo=ocorrencias_apoio&id_ocorrencia="+id;
        Modal.botao_salvar = '';
        Modal.tamanho_modal = 'mw-80vw';
        Modal.Gerar();

        // $("#modal_listar_apoio").modal("show");
        // $("#div_listar_apoio").load("index_xml.php?app_comando=listar_ocorrencias_apoio&app_modulo=ocorrencias_apoio&id_ocorrencia="+id);
    }
    function VeiculosAcidentes(id){
        Modal = new SquallModal();
        Modal.titulo_modal = "Veículos Acidentes";
        Modal.id_modal = 'modal_veiculos_acidentes';
        Modal.id_conteudo_modal = 'div_veiculos_acidentes';
        Modal.url = "index_xml.php?app_comando=listar_veiculos_acidentes&app_modulo=veiculos_acidentes&id_ocorrencia="+id;
        Modal.botao_salvar = '';
        Modal.tamanho_modal = 'mw-80vw';
        Modal.Gerar();
        //
        // $("#modal_veiculos_acidentes").modal("show");
        // $("#div_veiculos_acidentes").load("index_xml.php?app_comando=listar_veiculos_acidentes&app_modulo=veiculos_acidentes&id_ocorrencia="+id);
    }

</script>