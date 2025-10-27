<?php 
	include("modulos/almoxarifado_controle_estoque/template/js.almoxarifado_controle_estoque.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Controle Estoque";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_controle_estoque/template/tpl.modal.almoxarifado_controle_estoque.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Controle Estoque";
$configModulo['id_card'] = "conteudo_almoxarifado_controle_estoque";
echo $objApp->GerarCardContainer($configModulo);
