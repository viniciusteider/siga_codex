<?php
/**
 * @author Squall Robert
 * @copyright 2016
 */
?>
<script type="text/javascript">
    $(function()
    {
        AtualizarGridPessoalFerias($("#pagina").val(),$("#busca").val(),$("#filtro").val(),$("#ordem").val());
    });

    function AtualizarGridPessoalFerias(pagina,busca,filtro,ordem)
    {

        var load = '<div class="d-flex justify-content-center">' +
            '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
            '         <span class="sr-only">Carregando...</span>' +
            '     </div>' +
            ' </div>';
        if(filtro == "" || filtro === undefined)  filtro = "";
        if(ordem == "" || ordem  === undefined)  ordem = "";

        $('#conteudo_pessoal_ferias').html(load);
        var toPost = {
            pagina: pagina,
            busca: busca,
            filtro: filtro,
            ordem: ordem
        };

        $("#conteudo_pessoal_ferias").load("index_xml.php?app_modulo=pessoal_ferias&app_comando=ajax_listar_pessoal_ferias", toPost);
    }

    function ImprimirRelatorio(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_print.php?app_modulo=pessoal_ferias&app_comando=pessoal_ferias_print";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarPdf(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_file.php?app_modulo=pessoal_ferias&app_comando=pessoal_ferias_pdf";
            form.target = "_blank";
            form.submit();
        }
    }

    function GerarXml(form)
    {
        if (ValidarFormulario()) {
            form.action = "index_file.php?app_modulo=pessoal_ferias&app_comando=pessoal_ferias_xlsx";
            form.target = "_blank";
            form.submit();
        }
    }

</script>
