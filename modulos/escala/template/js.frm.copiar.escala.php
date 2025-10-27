<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {

        Squall.autoComplete('#id_equipe', 'index_xml.php?app_modulo=equipes&app_comando=listar_equipes_autocomplete');
        Mascaras();

        var campos_datas = $("#data_inicio, #data_fim");
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
    function ExecutarAcaoCopiarEscala()
    {
        if (Squall.ValidateForm($("#frm_copiar_escala"))) {
            $("#bt_modal_copiar_escala").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post('index_xml.php?app_modulo=escala&app_comando=copiar_escala&app_codigo',
                $("#frm_copiar_escala").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        $("#modal_copiar_escala").modal("hide");
                        Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=escala&app_comando=frm_adicionar_escala_mensal&app_codigo="+response["id"],'600');

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_copiar_escala").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
