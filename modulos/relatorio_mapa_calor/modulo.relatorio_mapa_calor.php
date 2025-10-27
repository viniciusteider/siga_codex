<?php
switch($app_comando) {
    case "frm_relatorio_mapa_calor":
        $template = "tpl.geral.relatorio_mapa_calor.php";
        break;
    case "get_cidades":
        $template = "ajax.relatorio_mapa_calor.php";
        break;
    case "get_eventos":
        $template = "ajax.relatorio_mapa_calor.php";
        break;
    case "get_subeventos":
        $template = "ajax.relatorio_mapa_calor.php";
        break;
    case "get_ocorrencias":
        $template = "ajax.relatorio_mapa_calor.php";
        break;
    case "frame":
        $template = "tpl.geral.frame.php";
        break;
    case "listar_hospitais":
        $template = "ajax.relatorio_mapa_calor.php";
        break;
    case "listar_bases":
        $template = "ajax.relatorio_mapa_calor.php";
        break;
}