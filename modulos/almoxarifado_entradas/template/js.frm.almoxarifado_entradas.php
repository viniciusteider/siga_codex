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
                url = "index_xml.php?app_modulo=almoxarifado_entradas&app_comando=atualizar_almoxarifado_entradas&app_codigo";
            }
            else
            {
                url = "index_xml.php?app_modulo=almoxarifado_entradas&app_comando=adicionar_almoxarifado_entradas&app_codigo";
            }

            ExecutarAcao(url);
        });
        Squall.GerarMascaras();
        Squall.autoComplete('#id_almoxarifado', 'index_xml.php?app_modulo=almoxarifado&app_comando=listar_almoxarifado_autocomplete');
        $('#id_setor').select2();
        var campos_datas = $("#data_emissao_nota_fiscal,#data_solicitacao,#data_recebimento");
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
                $('[data-kt-repeater="valor"]').maskMoney({showSymbol:false, decimal:",", thousands:"."});

            },
            show: function () {
                $(this).slideDown();
                Squall.autoCompleteModal($(this).find('[data-kt-repeater="id_produto"]'), 'index_xml.php?app_modulo=produtos&app_comando=listar_produtos_autocomplete');
                $(this).find('[data-kt-repeater="valor"]').maskMoney({showSymbol:false, decimal:",", thousands:"."});
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: true
        });

    });
    function ExecutarAcao(url)
    {
        if (Squall.ValidateForm($("#frm_almoxarifado_entradas"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_almoxarifado_entradas").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=almoxarifado_entradas&app_comando=listar_almoxarifado_entradas",'600');

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
