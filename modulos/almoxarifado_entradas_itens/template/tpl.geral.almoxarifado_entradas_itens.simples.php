<?php 
	include("modulos/almoxarifado_entradas_itens/template/js.almoxarifado_entradas_itens.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Entradas Itens";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_entradas_itens/template/tpl.modal.almoxarifado_entradas_itens.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Entradas Itens";
$configModulo['id_card'] = "conteudo_almoxarifado_entradas_itens";
echo $objApp->GerarCardContainer($configModulo);
