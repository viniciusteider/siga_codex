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
                url = "index_xml.php?app_modulo=produtos&app_comando=atualizar_produtos&app_codigo";
            }
            else
            {
                url = "index_xml.php?app_modulo=produtos&app_comando=adicionar_produtos&app_codigo";
            }

            ExecutarAcao(url);
        });
        Squall.GerarMascaras();
        var foto = $('#foto').dropify();
        foto.on('dropify.afterClear', function(event, element){
            var id_produto = $('#id').val();
            $('#foto').removeAttr('data-default-file');
            $('#foto').attr('data-default-file',"");
            $.ajax({
                type: 'POST',
                url: 'index_xml.php?app_modulo=produtos&app_comando=remover_foto&tipo=1&id='+id_produto

            });
        });
        Squall.autoComplete('#id_fornecedor','index_xml.php?app_modulo=fornecedor&app_comando=listar_fornecedor_autocomplete');
        $('#id_produto_grupo,#id_produto_subgrupo,#id_tipo_produto,#id_fabricante,#id_cor,#id_unidade_medida,#id_marca,#id_modelo,#id_revestimento').select2();

        var campos_datas = $("#data_validade");
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
        if (Squall.ValidateForm($("#frm_produtos"))) {
            $("#bt_salvar").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $('#frm_produtos').ajaxSubmit
            (
                {
                    target:       '_blank',
                    beforeSubmit: function (formData)
                    {
                        var queryString = $.param(formData);
                        //$('.preloader').show();
                        return true;
                    },
                    success:   function (response)
                    {
                        if (response["codigo"] == 0) {
                            Squall.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=produtos&app_comando=listar_produtos",'600');

                        } else {
                            Squall.ToastMsg('warning',response["mensagem"]);
                        }
                        $("#bt_salvar").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
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
