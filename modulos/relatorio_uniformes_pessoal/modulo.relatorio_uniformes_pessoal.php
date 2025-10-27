<?php 
switch ($app_comando) { 
    case "frm_relatorio_uniformes_pessoal":
        $template = "tpl.geral.relatorio_uniformes_pessoal.php";
        break;
    case "resultado_relatorio_uniformes_pessoal":
       $template = "tpl.lis.relatorio_uniformes_pessoal.php";
        break;
    case "resultado_relatorio_uniformes_pessoal_print":
        $template = "tpl.print.relatorio_uniformes_pessoal.php";
        break;
    case "resultado_relatorio_uniformes_pessoal_pdf":
        $template = "tpl.pdf.relatorio_uniformes_pessoal.php";
        break;
    case "resultado_relatorio_uniformes_pessoal_xls":
        $template = "tpl.xls.relatorio_uniformes_pessoal.php";
        break;
}
