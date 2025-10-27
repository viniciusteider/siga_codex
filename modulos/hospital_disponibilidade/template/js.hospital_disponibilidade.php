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
                AtualizarGridHospitalDisponibilidade(0,$("#busca").val());
                return false;
            } else {
                return true;
            }
        });
        AtualizarGridHospitalDisponibilidade($("#pagina").val(),$("#busca").val(),$("#filtro").val(),$("#ordem").val());
    });

    function AtualizarGridHospitalDisponibilidade2(pagina,busca,filtro,ordem)
    {

        var registros = $('#numero_registros').val();
        $('#numero_registro_hidden').val(registros);
        $('#pagina').val(pagina);
        $('#filtro').val(filtro);
        $('#ordem').val(ordem);
        $("#conteudo_hospital_disponibilidade").load("index_xml.php?app_modulo=hospital_disponibilidade&app_comando=ajax_listar_hospital_disponibilidade",$('#frm_hospital_disponibilidade_geral').serializeArray());
    }

    function AtualizarGridHospitalDisponibilidade(pagina,busca,filtro,ordem)
    {

        var load = '<div class="d-flex justify-content-center">' +
            '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
            '         <span class="sr-only">Carregando...</span>' +
            '     </div>' +
            ' </div>';
        if(filtro == "" || filtro === undefined)  filtro = "";
        if(ordem == "" || ordem  === undefined)  ordem = "";

        $('#conteudo_hospital_disponibilidade').html(load);
        var toPost = {
            pagina: pagina,
            busca: busca,
            filtro: filtro,
            ordem: ordem
        };

        $("#conteudo_hospital_disponibilidade").load("index_xml.php?app_modulo=hospital_disponibilidade&app_comando=ajax_listar_hospital_disponibilidade", toPost);
    }

    function ImprimirRelatorio()
    {
        if (Squall.ValidateForm($("#frm_hospital_disponibilidade"))) {
            var form = document.frm_hospital_disponibilidade_geral;
            form.action = "index_print.php?app_modulo=hospital_disponibilidade&app_comando=hospital_disponibilidade_print";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarPdf()
    {
        if (Squall.ValidateForm($("#frm_hospital_disponibilidade"))) {
            var form = document.frm_hospital_disponibilidade_geral;
            form.action = "index_file.php?app_modulo=hospital_disponibilidade&app_comando=hospital_disponibilidade_pdf";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarXml()
    {
        if (Squall.ValidateForm($("#frm_hospital_disponibilidade"))) {
            var form = document.frm_hospital_disponibilidade_geral;
            form.action = "index_file.php?app_modulo=hospital_disponibilidade&app_comando=hospital_disponibilidade_xlsx";
            form.target = "_blank";
            form.submit();
        }
    }

</script>
