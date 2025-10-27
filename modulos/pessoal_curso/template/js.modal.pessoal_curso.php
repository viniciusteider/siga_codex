<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        Squall.autoCompleteModal("#id_tipo_curso", 'index_xml.php?app_modulo=tipo_curso&app_comando=listar_tipo_curso_autocomplete',null,null,$('#modal_modulo_pessoal_curso'));
        Squall.autoCompleteModal("#id_instituicao_ensino", 'index_xml.php?app_modulo=instituicao_ensino&app_comando=listar_instituicao_ensino_autocomplete',null,null,$('#modal_modulo_pessoal_curso'));
        // Squall.autoComplete("#id_instituicao_ensino", 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
        $('#formato_curso').select2({dropdownParent: $('#modal_modulo_pessoal_curso')});
        var campos_datas = $("#data_inicio, #data_termino, #data_matricula");
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
    function ClickSalvarCurso()
    {
        var id = $('#id_curso').val();
        if(id != "")
            url = "index_xml.php?app_modulo=pessoal_curso&app_comando=atualizar_pessoal_curso&app_codigo";
        else
            url = "index_xml.php?app_modulo=pessoal_curso&app_comando=adicionar_pessoal_curso&app_codigo";

        ExecutarAcaoCursos(url);
    }
    function ExecutarAcaoCursos(url)
    {
        if (Squall.ValidateForm($("#frm_pessoal_curso"))) {
            $("#bt_modal_salvar_pessoal_curso").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post(url,
                $("#frm_pessoal_curso").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        Squall.ToastMsg('success',response["mensagem"]);
                        $('#modal_modulo_pessoal_curso').modal('hide');
                        $('#frm_pessoal_curso').each (function(){
                            this.reset();
                        });
                        AtualizarGridPessoalCurso();

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_pessoal_curso").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }
</script>
