<?php
/**
 * @author Fernando Carmo
 * @copyright 2016
 */
?>
<script type="text/javascript">
    $(function()
    {
        Squall.autoComplete('#usuario_filtro', 'index_xml.php?app_modulo=usuario&app_comando=popup_localizar_usuarios');
        var startdate = moment().startOf("month");
        var enddate = moment().endOf("month");

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

        //cb(start, end);

        $('[data-toggle="tooltip"]').tooltip();	$("#busca").keypress(function (e) {
        if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
            AtualizarGridLogAcessoUsuarios("", $("#busca").val());
            return false;
        } else {
            return true;
        }
    });
        AtualizarGridLogAcessoUsuarios('<?=$_REQUEST['pagina']?>','<?=$_REQUEST['busca']?>','<?=$_REQUEST['filtro']?>','<?=$_REQUEST['ordem']?>');
    });

    function AtualizarGridLogAcessoUsuarios(pagina,busca,filtro,ordem)
    {

        var registros = $('#numero_registros').val();
        var load = '<div class="d-flex justify-content-center">' +
            '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
            '         <span class="sr-only">Carregando...</span>' +
            '     </div>' +
            ' </div>';

        $('#conteudo_log_acesso_usuarios').html(load);

        $('#numero_registro_hidden').val(registros);
        $('#pagina').val(pagina);
        $('#filtro').val(filtro);
        $('#ordem').val(ordem);

        $("#conteudo_log_acesso_usuarios").load("index_xml.php?app_modulo=log_acesso_usuarios&app_comando=ajax_listar_log_acesso_usuarios",  $('#frm_log').serializeArray());
    }
    function AbrirLog(id)
    {
        $('#modal-log-acesso').modal('show');
        $("#conteudo_log").load("index_xml.php?app_modulo=log_acesso_usuarios&app_comando=visualizar_log&app_codigo="+id);
    }
    function ImprimirRelatorio(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_print.php?app_modulo=log_acesso_usuarios&app_comando=log_acesso_usuarios_print";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarPdf(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_file.php?app_modulo=log_acesso_usuarios&app_comando=log_acesso_usuarios_pdf";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarXml(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_file.php?app_modulo=log_acesso_usuarios&app_comando=log_acesso_usuarios_xlsx";
            form.target = "_blank";
            form.submit();
        }
    }

    function AbrirConfig()
    {
        BootstrapDialog.show({
            size:      BootstrapDialog.SIZE_SMALL,
            type:      BootstrapDialog.TYPE_DEFAULT,
            title:     "<div class='titulo_modal'><?=ROTULO_CONFIGURACOES?></div>",
            message:   $("<div></div>").load("index_xml.php?app_modulo=log_acesso_usuarios&app_comando=frm_configurar_listagem"),
            draggable: true,
            buttons:   [{
                label:    "<?=ROTULO_SALVAR?>",
                cssClass: "btn-lg btn-confirm",
                action:   function (dialogRef)
                {
                    SalvarConfiguracoes(dialogRef, "index_xml.php?app_modulo=log_acesso_usuarios&app_comando=configurar_listagem", AtualizarGridLogAcessoUsuarios)
                }
            }]
        });
    }
</script>
