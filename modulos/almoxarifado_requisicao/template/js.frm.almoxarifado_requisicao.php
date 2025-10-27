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
                url = "index_xml.php?app_modulo=almoxarifado_requisicao&app_comando=atualizar_almoxarifado_requisicao&app_codigo";
            }
            else
            {
                url = "index_xml.php?app_modulo=almoxarifado_requisicao&app_comando=adicionar_almoxarifado_requisicao&app_codigo";
            }

            ExecutarAcao(url);
        });
        Squall.GerarMascaras();
        Squall.autoComplete('#id_usuario', 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');

        var campos_datas = $("#data");
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

        $('#formulario_almoxarifado_entradas_itens').repeater({
            initEmpty: false,
            ready: function ()
            {
                Squall.autoComplete($('[data-kt-repeater="id_produto"]'), 'index_xml.php?app_modulo=produtos&app_comando=listar_produtos_autocomplete');
                $('[data-kt-repeater="data_hora_retorno"]').tempusDominus({
                    localization: {
                        locale: "pt-br",
                        startOfTheWeek: 1,
                        format: "dd/MM/yyyy"
                    },
                    display: {
                        icons: {
                            date: "ki-outline ki-calendar fs-1",
                            up: "ki-outline ki-up fs-1",
                            down: "ki-outline ki-down fs-1",
                            previous: "ki-outline ki-left fs-1",
                            next: "ki-outline ki-right fs-1",
                            today: "ki-outline ki-check fs-1",
                            clear: "ki-outline ki-trash fs-1",
                            close: "ki-outline ki-cross fs-1",
                        },
                        buttons: {
                            today: true,
                            clear: true,
                            close: true,
                        },
                    }
                });

            },
            show: function () {
                $(this).slideDown();
                Squall.autoCompleteModal($(this).find('[data-kt-repeater="id_produto"]'), 'index_xml.php?app_modulo=produtos&app_comando=listar_produtos_autocomplete');
                $(this).find('[data-kt-repeater="data_hora_retorno"]').tempusDominus({
                    localization: {
                        locale: "pt-br",
                        startOfTheWeek: 1,
                        format: "dd/MM/yyyy"
                    },
                    display: {
                        icons: {
                            date: "ki-outline ki-calendar fs-1",
                            up: "ki-outline ki-up fs-1",
                            down: "ki-outline ki-down fs-1",
                            previous: "ki-outline ki-left fs-1",
                            next: "ki-outline ki-right fs-1",
                            today: "ki-outline ki-check fs-1",
                            clear: "ki-outline ki-trash fs-1",
                            close: "ki-outline ki-cross fs-1",
                        },
                        buttons: {
                            today: true,
                            clear: true,
                            close: true,
                        },
                    }
                });
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: true
        });
        LiberarCampo();
    });

    function LiberarCampo()
    {
        var checked = $("input[name='sem_cadastro']:checked").length;
        if(checked > 0)
        {
            $('#nome').show().fadeIn(3000);
            $('#id_usuario').next(".select2-container").hide().fadeOut(3000);
            // $('#id_usuario').hide().fadeOut(3000);
        }
        else {
            $('#nome').hide().fadeOut(3000);
            // $('#id_usuario').show()
            $('#id_usuario').next(".select2-container").show().fadeIn(3000);

        }
    }

    function ExecutarAcao(url)
    {
        if($('#nome').val() != "")
            $('#id_usuario').removeAttr('data-validar');
        else
            $('#id_usuario').attr('data-validar',"select2");



        if (Squall.ValidateForm($("#frm_almoxarifado_requisicao"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_almoxarifado_requisicao").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=almoxarifado_requisicao&app_comando=listar_almoxarifado_requisicao",'600');

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
