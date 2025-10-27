<?php 
	include("modulos/almoxarifado_compartimento/template/js.almoxarifado_compartimento.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Compartimento";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_compartimento/template/tpl.modal.almoxarifado_compartimento.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Compartimento";
$configModulo['id_card'] = "conteudo_almoxarifado_compartimento";
echo $objApp->GerarCardContainer($configModulo);
