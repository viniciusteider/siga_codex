<?php
/**
 * @author Squall Robert
 * @copyright 2016
 */
?>
<script type="text/javascript">
    var startdate = moment().subtract(6, "M");
    var enddate = moment().add(6,"M");
    $(function()
    {
        $("#periodo").daterangepicker({
            startDate: startdate,
            endDate: enddate,
            timePicker: true,"timePicker24Hour": true,
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
            },
            ranges: {
                "Hoje": [moment(), moment()],
                "Ontem": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Últimos 7 dias": [moment().subtract(6, "days"), moment()],
                "Últimos 30 dias": [moment().subtract(29, "days"), moment()],
                "Este Mês": [moment().startOf("month"), moment().endOf("month")],
                "Último Mês": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            }
        }, cb);

        AtualizarGridRelatorio($("#pagina").val(),$("#busca").val(),$("#filtro").val(),$("#ordem").val());
        Squall.autoComplete('#id_base', 'index_xml.php?app_modulo=base&app_comando=listar_bases_auto_complete');
        $('#id_estado,#id_cidade,#id_evento,#id_subevento').select2();

    });
    function cb(start, end) {
        $("#periodo").html(start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY"));
    }

    function AtualizarGridRelatorio(pagina,busca,filtro,ordem)
    {

        var registros = $('#numero_registros').val();
        $('#numero_registro_hidden').val(registros);
        $('#pagina').val(pagina);
        $('#filtro').val(filtro);
        $('#ordem').val(ordem);
        $("#conteudo_relatorio").load("index_xml.php?app_modulo=relatorio_quantitativo_acidentes&app_comando=ajax_listar_relatorio_quantitativo_acidentes",$('#frm_relatorio_paciente').serializeArray());
    }

    function ImprimirRelatorio()
    {
        if (Squall.ValidateForm($("#frm_relatorio_paciente"))) {
            var form = document.frm_relatorio_paciente;
            form.action = "index_print.php?app_modulo=relatorio_quantitativo_acidentes&app_comando=relatorio_quantitativo_acidentes_print";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarPdf()
    {
        if (Squall.ValidateForm($("#frm_relatorio_paciente"))) {
            var form = document.frm_relatorio_paciente;
            form.action = "index_file.php?app_modulo=relatorio_quantitativo_acidentes&app_comando=relatorio_quantitativo_acidentes_pdf";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarXml()
    {
        if (Squall.ValidateForm($("#frm_relatorio_paciente"))) {
            var form = document.frm_relatorio_paciente;
            form.action = "index_file.php?app_modulo=relatorio_quantitativo_acidentes&app_comando=relatorio_quantitativo_acidentes_xlsx";
            form.target = "_blank";
            form.submit();
        }
    }

</script>
