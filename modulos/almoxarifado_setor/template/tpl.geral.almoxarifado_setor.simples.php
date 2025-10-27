<?php 
	include("modulos/almoxarifado_setor/template/js.almoxarifado_setor.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Setor";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_setor/template/tpl.modal.almoxarifado_setor.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Setor";
$configModulo['id_card'] = "conteudo_almoxarifado_setor";
echo $objApp->GerarCardContainer($configModulo);
