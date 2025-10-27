<?php
/**
 * @author Squall Robert
 * @copyright 2023
 */
?>
<script type="text/javascript">
    $(function()
    {
        AtualizarGridCliente($("#pagina").val(),$("#busca").val(),$("#filtro").val(),$("#ordem").val());
    });
    

    function AtualizarGridCliente(pagina,busca,filtro,ordem)
    {

        var load = '<div class="d-flex justify-content-center">' +
            '     <div class="spinner-grow" style="width: 3rem; height: 3rem;"  role="status">' +
            '         <span class="sr-only">Carregando...</span>' +
            '     </div>' +
            ' </div>';
        if(filtro == "" || filtro === undefined)  filtro = "";
        if(ordem == "" || ordem  === undefined)  ordem = "";

        $('#conteudo_cliente').html(load);
        var toPost = {
            pagina: pagina,
            busca: busca,
            filtro: filtro,
            ordem: ordem
        };

        $("#conteudo_cliente").load("index_xml.php?app_modulo=monitor&app_comando=ajax_listar_cliente_monitor", toPost);
    }



</script>
