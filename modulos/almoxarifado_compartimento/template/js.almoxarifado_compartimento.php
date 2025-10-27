<?php
/**
* @author Squall Robert
* @copyright 2016
*/
?>
<script type="text/javascript">
	$(function()
	{

    
       var campos_datas = $("#periodo");
        campos_datas.daterangepicker({
            showDropdowns: true,
            autoUpdateInput: false,
            minYear: 2020,
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
            $(this).val(picker.startDate.format('DD/MM/YYYY') + " - " + picker.endDate.format('DD/MM/YYYY'));
        });

        campos_datas.on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    	$("#busca").keypress(function (e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridAlmoxarifadoCompartimento(0,$("#busca").val());
			return false;
		} else {
			return true;
		}
	});
		AtualizarGridAlmoxarifadoCompartimento($("#pagina").val(),$("#busca").val(),$("#filtro").val(),$("#ordem").val());
	});

	function AtualizarGridAlmoxarifadoCompartimento(pagina,busca,filtro,ordem)
	{
	
 var registros = $('#numero_registros').val();
$('#numero_registro_hidden').val(registros);
$('#pagina').val(pagina);
$('#filtro').val(filtro);
 $('#ordem').val(ordem);
		$("#conteudo_almoxarifado_compartimento").load("index_xml.php?app_modulo=almoxarifado_compartimento&app_comando=ajax_listar_almoxarifado_compartimento",$('#frm_almoxarifado_compartimento_geral').serializeArray());
	}

	function AtualizarGridSimplesAlmoxarifadoCompartimento(pagina,busca,filtro,ordem)
	{
	
		var load = '<div class="d-flex justify-content-center">' +
    '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
    '         <span class="sr-only">Carregando...</span>' +
    '     </div>' +
    ' </div>';
		if(filtro == "" || filtro === undefined)  filtro = ""; 
		if(ordem == "" || ordem  === undefined)  ordem = "";

$('#conteudo_almoxarifado_compartimento').html(load);
		var toPost = { 
			pagina: pagina,
			busca: busca,
			filtro: filtro,
			ordem: ordem
		};

		$("#conteudo_almoxarifado_compartimento").load("index_xml.php?app_modulo=almoxarifado_compartimento&app_comando=ajax_listar_almoxarifado_compartimento", toPost);
	}

	function ImprimirRelatorio()
	{
		if (Squall.ValidateForm($("#frm_almoxarifado_compartimento"))) {
			var form = document.frm_almoxarifado_compartimento_geral;
			form.action = "index_print.php?app_modulo=almoxarifado_compartimento&app_comando=almoxarifado_compartimento_print";
			form.target = "_blank";
			form.submit();
		}
	}

	function GerarPdf()
	{
		if (Squall.ValidateForm($("#frm_almoxarifado_compartimento"))) {
			var form = document.frm_almoxarifado_compartimento_geral;
			form.action = "index_file.php?app_modulo=almoxarifado_compartimento&app_comando=almoxarifado_compartimento_pdf";
			form.target = "_blank";
			form.submit();
		}
	}

	function GerarXml()
	{
		if (Squall.ValidateForm($("#frm_almoxarifado_compartimento"))) {
			var form = document.frm_almoxarifado_compartimento_geral;
			form.action = "index_file.php?app_modulo=almoxarifado_compartimento&app_comando=almoxarifado_compartimento_xlsx";
			form.target = "_blank";
			form.submit();
		}
	}

</script>
