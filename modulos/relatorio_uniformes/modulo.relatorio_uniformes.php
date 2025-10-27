<?php 
switch ($app_comando) { 
    case "frm_relatorio_uniformes":
        $template = "tpl.geral.relatorio_uniformes.php";
        break;
    case "resultado_relatorio_uniformes":
       $template = "tpl.lis.relatorio_uniformes.php";
        break;
    case "resultado_relatorio_uniformes_print":
        $template = "tpl.print.relatorio_uniformes.php";
        break;
    case "resultado_relatorio_uniformes_pdf":
        $template = "tpl.pdf.relatorio_uniformes.php";
        break;
    case "resultado_relatorio_uniformes_xls":
        $template = "tpl.xls.relatorio_uniformes.php";
        break;
}
