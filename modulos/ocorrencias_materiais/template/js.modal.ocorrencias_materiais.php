<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {

        Squall.GerarMascaras();
        Squall.autoCompleteModal('#id_hospital', 'index_xml.php?app_modulo=hospital&app_comando=listar_hospital_autocomplete',null,null,$('#modal_modulo_ocorrencias_materiais'));

        $('#div_materiais_itens').repeater({
            initEmpty: false,
            ready: function ()
            {
                $('[data-kt-repeater="id_item"]').select2({dropdownParent: $('#modal_modulo_ocorrencias_materiais')});

            },
            show: function () {
                $(this).slideDown();
                $(this).find('[data-kt-repeater="id_item"]').select2({dropdownParent: $('#modal_modulo_ocorrencias_materiais')});

            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: false
        });
    });
   function ExecutarMateriais () {
       var id = $('#id_ocorrencia_material').val();
       var tipo = 1;

       if (id != "") {
           url = "index_xml.php?app_modulo=ocorrencias_materiais&app_comando=atualizar_ocorrencias_materiais&app_codigo&id_paciente="+id_paciente+"&id_ocorrencia="+id_ocorrencia;
       } else {
           url = "index_xml.php?app_modulo=ocorrencias_materiais&app_comando=adicionar_ocorrencias_materiais&app_codigo&id_paciente="+id_paciente+"&id_ocorrencia="+id_ocorrencia;
       }

       ExecutarAcaoModaAdicionar(url);
   }
    function ExecutarAcaoModaAdicionar(url)
    {
        if (Squall.ValidateForm($("#frm_ocorrencias_materiais"))) {
            $("#bt_modal_salvar_ocorrencias_materiais").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_ocorrencias_materiais").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_ocorrencias_materiais').modal('hide');
                        $('#frm_ocorrencias_materiais').each (function(){
                            this.reset();
                        });
                        AtualizarGridOcorrenciasMateriais();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_ocorrencias_materiais").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
