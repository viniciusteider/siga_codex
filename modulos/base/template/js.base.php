<?php
/**
* @author Fernando Carmo
* @copyright 2016
*/
?>
<script type="text/javascript">
	$(function()
	{

    
        var startdate = moment().subtract(6, "M");
        var enddate = moment().add(6,"M");
        
         function cb(start, end) {
            $("#periodo").html(start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY"));
        }

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
    		AtualizarGridBase($("#pagina").val(),$("#busca").val(),$("#filtro").val(),$("#ordem").val());
	});

	function AtualizarGridBase(pagina,busca,filtro,ordem)
	{
	
 var registros = $('#numero_registros').val();
$('#numero_registro_hidden').val(registros);
$('#pagina').val(pagina);
$('#filtro').val(filtro);
 $('#ordem').val(ordem);
		$("#conteudo_base").load("index_xml.php?app_modulo=base&app_comando=ajax_listar_base",$('#frm_base').serializeArray());
	}

	function ImprimirRelatorio(form)
	{
		if (ValidarFormulario()) {
			form.action = "index_print.php?app_modulo=base&app_comando=base_print";
			form.target = "_blank";
			form.submit();
		}
	}

	function GerarPdf(form)
	{
		if (ValidarFormulario()) {
			form.action = "index_file.php?app_modulo=base&app_comando=base_pdf";
			form.target = "_blank";
			form.submit();
		}
	}

	function GerarXml(form)
	{
		if (ValidarFormulario()) {
			form.action = "index_file.php?app_modulo=base&app_comando=base_xlsx";
			form.target = "_blank";
			form.submit();
		}
	}

</script>
