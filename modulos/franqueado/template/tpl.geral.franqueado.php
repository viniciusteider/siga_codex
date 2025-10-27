<?php
include("modulos/franqueado/template/js.franqueado.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Segurança";
$configTitulo['titulo_modulo'] = "Corporações";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Corporações";
$configModulo['id_card'] = "conteudo_franqueado";
echo $objApp->GerarCardContainer($configModulo);
