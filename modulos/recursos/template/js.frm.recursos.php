<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $("#bt_salvar").click(function () {
            var id = $('#id').val();
            var tipo = 1;

            if(id != "")
            {
                url = "index_xml.php?app_modulo=recursos&app_comando=atualizar_recursos&app_codigo";
            }
            else
            {
                url = "index_xml.php?app_modulo=recursos&app_comando=adicionar_recursos&app_codigo";
            }

            ExecutarAcao(url);
        });

        KTImageInput.createInstances();
        Mascaras();
        $('#id_tipo_recurso,#id_funcao,#id_marca,#id_modelo,#id_cor,#id_tipo_combustivel,#ufplaca,#disponibilidade').select2({language: "pt-BR"});
        Squall.autoComplete('#id_base', 'index_xml.php?app_modulo=base&app_comando=listar_bases_auto_complete');
        var campos_datas = $("#data_carga,#data_baixa,#data_final_garantia");
        campos_datas.daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            minYear: 1900,
            autoApply:true,
            maxYear: parseInt(moment().format("YYYY"),12),
            locale: {
                "format": 'DD/MM/YYYY',
                "separator": ' - ',
                "applyLabel": 'Confirmar',
                "cancelLabel": 'Cancelar',
                "daysOfWeek": [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sab"
                ],
                "monthNames": [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez"
                ],
                "firstDay" : 0
            }
        });
        campos_datas.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });

        campos_datas.on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });
    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_recursos"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX

            $('#frm_recursos').ajaxSubmit
            (
                {
                    target:       '_blank',
                    beforeSubmit: function (formData)
                    {
                        var queryString = $.param(formData);
                        //$('.preloader').show();
                        return true;
                    },
                    success:   function (msg)
                    {
                        if (msg["codigo"] == 0) {
                            Squall.ToastMsg('success',msg["mensagem"],"#index_xml.php?app_modulo=recursos&app_comando=listar_recursos",'600');
                            // window.location ='#index_xml.php?app_modulo=usuario&app_comando=listar_usuario';

                        } else {
                            Squall.ToastMsg('warning',msg["mensagem"]);
                        }
                        $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> SALVAR").removeClass("btn-warning");
                    },
                    url:          url,
                    resetForm:    false,
                    type:         'post',
                    dataType:     'json'
                }
            );
        }
    }
</script>
