<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        Squall.autoCompleteModal("#id_tipo_dispensa", 'index_xml.php?app_modulo=tipo_dispensa&app_comando=listar_tipo_dispensa_autocomplete',null,null,$('#modal_modulo_pessoal_dispensas'));

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
                "daysOfWeek": [z
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
    function ClickSalvarDispensa()
    {
        var id = $('#id_dispensa').val();

        if(id != "")
            url = "index_xml.php?app_modulo=pessoal_dispensas&app_comando=atualizar_pessoal_dispensas&app_codigo";
        else
            url = "index_xml.php?app_modulo=pessoal_dispensas&app_comando=adicionar_pessoal_dispensas&app_codigo";

        ExecutarAcaoDispensa(url);
    }

    function ExecutarAcaoDispensa(url)
    {
        if (Squall.ValidateForm($("#frm_pessoal_dispensas"))) {
            $("#bt_modal_salvar_pessoal_dispensas").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_pessoal_dispensas").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_pessoal_dispensas').modal('hide');
                        $('#frm_pessoal_dispensas').each (function(){
                            this.reset();
                        });
                        AtualizarGridPessoalDispensas();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_pessoal_dispensas").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
