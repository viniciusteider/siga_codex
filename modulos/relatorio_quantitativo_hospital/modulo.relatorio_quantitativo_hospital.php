<?php
switch($app_comando) {
    case "frm_relatorio_quantitativo_hospital":
        $template = "tpl.geral.relatorio_quantitativo_hospital.php";
        break;
    case "ajax_listar_relatorio_quantitativo_hospital":
        $template = "tpl.lis.relatorio_quantitativo_hospital.php";
        break;
    case "relatorio_quantitativo_hospital_print":
        $template = "tpl.print.relatorio_quantitativo_hospital.php";
        break;
    case "relatorio_quantitativo_hospital_pdf":
        $template = "tpl.pdf.relatorio_quantitativo_hospital.php";
        break;
    case "relatorio_quantitativo_hospital_xlsx":
        $template = "tpl.xls.relatorio_quantitativo_hospital.php";
        break;
}