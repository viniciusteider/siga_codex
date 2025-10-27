<?php
switch($app_comando) {
    case "frm_relatorio_quantitativo_acidentes":
        $template = "tpl.geral.relatorio_quantitativo_acidentes.php";
        break;
    case "ajax_listar_relatorio_quantitativo_acidentes":
        $template = "tpl.lis.relatorio_quantitativo_acidentes.php";
        break;
    case "relatorio_quantitativo_acidentes_print":
        $template = "tpl.print.relatorio_quantitativo_acidentes.php";
        break;
    case "relatorio_quantitativo_acidentes_pdf":
        $template = "tpl.pdf.relatorio_quantitativo_acidentes.php";
        break;
    case "relatorio_quantitativo_acidentes_xlsx":
        $template = "tpl.xls.relatorio_quantitativo_acidentes.php";
        break;
}