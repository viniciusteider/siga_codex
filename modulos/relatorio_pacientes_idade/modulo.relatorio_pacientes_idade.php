<?php
switch($app_comando) {
    case "frm_relatorio_pacientes_idade":
        $template = "tpl.geral.relatorio_pacientes_idade.php";
        break;
    case "ajax_listar_relatorio_pacientes_idade":
        $template = "tpl.lis.relatorio_pacientes_idade.php";
        break;
    case "relatorio_pacientes_idade_print":
        $template = "tpl.print.relatorio_pacientes_idade.php";
        break;
    case "relatorio_pacientes_idade_pdf":
        $template = "tpl.pdf.relatorio_pacientes_idade.php";
        break;
    case "relatorio_pacientes_idade_xlsx":
        $template = "tpl.xls.relatorio_pacientes_idade.php";
        break;
}