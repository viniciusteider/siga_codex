<?php
switch($app_comando) {
    case "frm_relatorio_tempo_resposta":
        $template = "tpl.geral.relatorio_tempo_resposta.php";
        break;
    case "ajax_listar_relatorio_tempo_resposta":
        $template = "tpl.lis.relatorio_tempo_resposta.php";
        break;
    case "relatorio_tempo_resposta_print":
        $template = "tpl.print.relatorio_tempo_resposta.php";
        break;
    case "relatorio_tempo_resposta_pdf":
        $template = "tpl.pdf.relatorio_tempo_resposta.php";
        break;
    case "relatorio_tempo_resposta_xlsx":
        $template = "tpl.xls.relatorio_tempo_resposta.php";
        break;
}