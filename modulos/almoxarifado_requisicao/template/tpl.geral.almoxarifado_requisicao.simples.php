<?php 
	include("modulos/almoxarifado_requisicao/template/js.almoxarifado_requisicao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Requisicao";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_requisicao/template/tpl.modal.almoxarifado_requisicao.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Requisicao";
$configModulo['id_card'] = "conteudo_almoxarifado_requisicao";
echo $objApp->GerarCardContainer($configModulo);
