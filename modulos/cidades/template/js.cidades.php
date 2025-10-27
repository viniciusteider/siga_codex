<?php
/**
 * @author Fernando Carmo
 * @copyright 2016
 */
?>
<script type="text/javascript">
    $(function()
    {
        AtualizarGridCidades($('#pagina').val(),$('#busca').val(),$('#filtro').val(),$('#ordem').val());
    });

    function AtualizarGridCidades(pagina,busca,filtro,ordem)
    {
        var registros = $('#numero_registros').val();
        $('#numero_registro_hidden').val(registros);
        $('#pagina').val(pagina);
        $('#filtro').val(filtro);
        $('#ordem').val(ordem);
        $("#conteudo_cidades").load("index_xml.php?app_modulo=cidades&app_comando=ajax_listar_cidades",$('#frm_cidades').serializeArray());
    }

    function ImprimirRelatorio(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_print.php?app_modulo=cidades&app_comando=cidades_print";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarPdf(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_file.php?app_modulo=cidades&app_comando=cidades_pdf";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarXml(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_file.php?app_modulo=cidades&app_comando=cidades_xlsx";
            form.target = "_blank";
            form.submit();
        }
    }

</script>
