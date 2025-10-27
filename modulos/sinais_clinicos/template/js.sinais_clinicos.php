<?php
/**
* @author Squall Robert
* @copyright 2023
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
        
    		AtualizarGridSinaisClinicos({});
$("#busca").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridSinaisClinicos({busca:$("#busca").val()});
            return false;
        } else {
            return true;
        }
    });	});

	function AtualizarGridSinaisClinicos(obj)
	{
	
 var registros = $('#numero_registros').val();
$('#numero_registro_hidden').val(registros);
$('#pagina').val(obj.pagina);
$('#filtro').val(obj.filtro);
 $('#ordem').val(obj.ordem);
		$("#conteudo_sinais_clinicos").load("index_xml.php?app_modulo=sinais_clinicos&app_comando=ajax_listar_sinais_clinicos",$('#frm_sinais_clinicos_geral').serializeArray());
	}

	function AtualizarGridSimplesSinaisClinicos(obj)
	{
	
		var load = '<div class="d-flex justify-content-center">' +
    '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
    '         <span class="sr-only">Carregando...</span>' +
    '     </div>' +
    ' </div>';
		if(filtro == "" || filtro === undefined)  filtro = ""; 
		if(ordem == "" || ordem  === undefined)  ordem = "";

$('#conteudo_sinais_clinicos').html(load);
		var toPost = { 
			pagina: obj.pagina,
			numero_registros: obj.numero_registros,
			busca: obj.busca,
			filtro: obj.filtro,
			ordem: obj.ordem
		};

		$("#conteudo_sinais_clinicos").load("index_xml.php?app_modulo=sinais_clinicos&app_comando=ajax_listar_sinais_clinicos", toPost);
	}

	function ImprimirRelatorio()
	{
		if (Squall.ValidateForm($("#frm_sinais_clinicos"))) {
			var form = document.frm_sinais_clinicos_geral;
			form.action = "index_print.php?app_modulo=sinais_clinicos&app_comando=sinais_clinicos_print";
			form.target = "_blank";
			form.submit();
		}
	}

	function GerarPdf()
	{
		if (Squall.ValidateForm($("#frm_sinais_clinicos"))) {
			var form = document.frm_sinais_clinicos_geral;
			form.action = "index_file.php?app_modulo=sinais_clinicos&app_comando=sinais_clinicos_pdf";
			form.target = "_blank";
			form.submit();
		}
	}

	function GerarXml()
	{
		if (Squall.ValidateForm($("#frm_sinais_clinicos"))) {
			var form = document.frm_sinais_clinicos_geral;
			form.action = "index_file.php?app_modulo=sinais_clinicos&app_comando=sinais_clinicos_xlsx";
			form.target = "_blank";
			form.submit();
		}
	}

</script>
