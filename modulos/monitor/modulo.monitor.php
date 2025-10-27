<?php
switch($app_comando) {
    case "monitor":
        $template = "tpl.geral_monitor.php";
        break;
    case "listar_ocorrencias":
        $template = "tpl.lis.ocorrencias.php";
        break;
    case "listar_hospitais":
        $template = "tpl.lis.hospitais.php";
        break;
    case "get_viatura":
        $template = "tpl.get.viatura.php";
        break;
}