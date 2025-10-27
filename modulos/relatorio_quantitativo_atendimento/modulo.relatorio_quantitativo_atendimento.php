<?php
switch($app_comando) {
    case "frm_quantitativo_atendimento":
        $template = "tpl.geral.quantitativo_atendimento.php";
        break;
    case "ajax_listar_relatorio_quantitativo_atendimento":
        $template = "tpl.lis.relatorio_quantitativo_atendimento.php";
        break;
    case "relatorio_quantitativo_atendimento_print":
        $template = "tpl.print.relatorio_quantitativo_atendimento.php";
        break;
    case "relatorio_quantitativo_atendimento_pdf":
        $template = "tpl.pdf.relatorio_quantitativo_atendimento.php";
        break;
    case "relatorio_quantitativo_atendimento_xlsx":
        $template = "tpl.xls.relatorio_quantitativo_atendimento.php";
        break;
}