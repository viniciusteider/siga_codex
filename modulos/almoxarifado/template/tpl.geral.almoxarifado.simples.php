<?php 
	include("modulos/almoxarifado/template/js.almoxarifado.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado/template/tpl.modal.almoxarifado.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado";
$configModulo['id_card'] = "conteudo_almoxarifado";
echo $objApp->GerarCardContainer($configModulo);
