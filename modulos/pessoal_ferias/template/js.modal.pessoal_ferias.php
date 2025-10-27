<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        var campos_datas = $("#data_inicio, #data_termino");
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
        Mascaras();
    });
    function ClickSalvarFerias()
    {
        var id = $('#id_ferias').val();

        if(id != "")
            url = "index_xml.php?app_modulo=pessoal_ferias&app_comando=atualizar_pessoal_ferias&app_codigo";
        else
            url = "index_xml.php?app_modulo=pessoal_ferias&app_comando=adicionar_pessoal_ferias&app_codigo";

        ExecutarAcaoFerias(url);
    }
    function ExecutarAcaoFerias(url)
    {
        if (Squall.ValidateForm($("#frm_pessoal_ferias"))) {
            $("#bt_modal_salvar_pessoal_ferias").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_pessoal_ferias").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_pessoal_ferias').modal('hide');
                        $('#frm_pessoal_ferias').each (function(){
                            this.reset();
                        });
                        AtualizarGridPessoalFerias();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_pessoal_ferias").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
