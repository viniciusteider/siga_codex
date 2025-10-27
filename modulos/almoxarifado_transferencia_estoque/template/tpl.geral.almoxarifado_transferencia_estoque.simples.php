<?php 
	include("modulos/almoxarifado_transferencia_estoque/template/js.almoxarifado_transferencia_estoque.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Transferencia Estoque";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_transferencia_estoque/template/tpl.modal.almoxarifado_transferencia_estoque.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Transferencia Estoque";
$configModulo['id_card'] = "conteudo_almoxarifado_transferencia_estoque";
echo $objApp->GerarCardContainer($configModulo);
