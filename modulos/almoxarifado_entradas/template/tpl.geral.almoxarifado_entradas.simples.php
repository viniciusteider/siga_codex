<?php 
	include("modulos/almoxarifado_entradas/template/js.almoxarifado_entradas.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Entradas";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_entradas/template/tpl.modal.almoxarifado_entradas.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Entradas";
$configModulo['id_card'] = "conteudo_almoxarifado_entradas";
echo $objApp->GerarCardContainer($configModulo);
