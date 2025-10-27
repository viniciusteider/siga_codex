<script>
    $(document).ready(function(){
        var campos_datas = $("#periodo");
        campos_datas.daterangepicker({
            showDropdowns: true,
            autoUpdateInput: false,
            "timePicker": true,
            "timePicker24Hour": true,
            minYear: 2023,
            dateLimit: {
                days: 31
            },
            autoApply:true,
            maxYear: parseInt(moment().format("YYYY"),12),
            ranges: {
                "Hoje": [moment(), moment()],
                "Ontem": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Últimos 7 dias": [moment().subtract(6, "days"), moment()],
                "Últimos 30 dias": [moment().subtract(30, "days"), moment()],
                "Este Mês": [moment().startOf("month"), moment().endOf("month")],
                "Último Mês": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            },
            locale: {
                format:'DD/MM/YYYY HH:mm:ss',
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
                "firstDay" : 0,
            }
        });
        campos_datas.on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm:ss') + " - " + picker.endDate.format('DD/MM/YYYY HH:mm:ss'));
        });
        campos_datas.on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        Squall.autoComplete('#id_base', 'index_xml.php?app_modulo=base&app_comando=listar_bases_auto_complete');
        $('#id_estado,#id_cidade,#id_evento,#id_subevento').select2();
    });
    function GerarRelatorio(pagina,busca,filtro,ordem) {
        if (Squall.ValidateForm($("#frm_relatorio_uniformes"))) {
            var registros = $('#numero_registros').val();
            $('#numero_registro_hidden').val(registros);
            $('#pagina').val(pagina);
            $('#filtro').val(filtro);
            $('#ordem').val(ordem);
            $("#conteudo_relatorio_uniformes").load("index_xml.php?app_modulo=relatorio_uniformes&app_comando=resultado_relatorio_uniformes", $('#frm_relatorio_uniformes').serializeArray());
        }
    }
    function Imprimir()
    {
        if (Squall.ValidateForm($("#frm_relatorio_uniformes"))) {
            var form = document.frm_relatorio_uniformes;
            form.action = "index_print.php?app_modulo=relatorio_uniformes&app_comando=resultado_relatorio_uniformes_print";
            form.target = "_blank";
            form.method = "post";
            form.submit();
        }
    }
    function Pdf()
    {
        if (Squall.ValidateForm($("#frm_relatorio_uniformes"))) {
            var form = document.frm_relatorio_uniformes;
            form.action = "index_file.php?app_modulo=relatorio_uniformes&app_comando=resultado_relatorio_uniformes_pdf";
            form.target = "_blank";
            form.method = "post";
            form.submit();
        }
    }
    function Xls()
    {
        if (Squall.ValidateForm($("#frm_relatorio_uniformes"))) {
            var form = document.frm_relatorio_uniformes;
            form.action = "index_file.php?app_modulo=relatorio_uniformes&app_comando=resultado_relatorio_uniformes_xls";
            form.target = "_blank";
            form.method = "post";
            form.submit();
        }
    }

</script>
