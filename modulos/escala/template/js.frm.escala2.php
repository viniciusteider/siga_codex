<script type="text/javascript">

    /*
     * Executa o post do formulário
     * */
    $(document).ready(function () {
        $("#bt_salvar").click(function () {
            var checked = $(".check-dias:checked").length;
            if(checked > 0)
            {
                $('#id_escala_horarios').attr('data-validar',"select2");
                $('#modal_horarios').modal('show');
            }
            else
            {
                $('#id_escala_horarios').removeAttr('data-validar');
                ExecutarAcaoEscalas();
            }

        });
        Squall.autoComplete('#id_escala_horarios', 'index_xml.php?app_modulo=escala_horarios&app_comando=listar_escala_horarios_autocomplete');
        $('.slt2').select2();
        $('#tb_escala').dataTable(
            {
                "sPaginationType": "bootstrap", // full_numbers
                "iDisplayStart ": 10,
                "iDisplayLength": 10,
                "bPaginate": false, //hide pagination
                "bInfo": false, // hide showing entries
            }
        );
    });

    function ExecutarAcaoEscalas()
    {
        if (Squall.ValidateForm($("#frm_escala"))) {
            $("#bt_modal_salvar_escala_horarios").prop("disabled",true).html("<i class=\"fa fa-spin fa-spinner\"></i> Aguarde...").addClass("btn-warning");
            // ao clicar em salvar enviando dados por post via AJAX
            $.post("index_xml.php?app_modulo=escala&app_comando=atualizar_escala_mensal",
                $("#frm_escala").serialize(),
                // pegando resposta do retorno do post
                function (response)
                {
                    if (response["codigo"] == 0) {
                        $('#modal_horarios').modal('hide');
                        location.reload()
                        // Squ
                        // all.ToastMsg('success',response["mensagem"],"#index_xml.php?app_modulo=escala&app_comando=frm_adicionar_escala_mensal&app_codigo="+response["id"],'1500');

                    } else {
                        Squall.ToastMsg('warning',response["mensagem"]);
                    }
                    $("#bt_modal_salvar_escala_horarios").prop("disabled",false).html("<i class=\"fa fa-check\"></i> Salvar").removeClass("btn-warning");
                }
                , "json" // definindo retorno para o formato json
            );
        }
    }



    function ImprimirRelatorio(id)
    {
        var form = document.getElementById('frm_escala');
        // if (Squall.ValidateForm($("#frm_escala"))) {
            form.action = "index_print.php?app_modulo=escala&app_comando=escala_print&app_codigo="+id;
            form.target = "_blank";
            form.submit();
        // }
    }

    function GerarPdf(id)
    {
        var form = document.getElementById('frm_escala');
        if (Squall.ValidateForm($("#frm_escala"))) {
            form.action = "index_file.php?app_modulo=escala&app_comando=escala_pdf&app_codigo="+id;
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarXml(id)
    {
        var form = document.getElementById('frm_escala');
        if (Squall.ValidateForm($("#frm_escala"))) {
            form.action = "index_file.php?app_modulo=escala&app_comando=escala_xlsx&app_codigo="+id;
            form.target = "_blank";
            form.submit();
        }
    }

</script>
