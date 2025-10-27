<?php 
	include("modulos/almoxarifado_requisicao_itens/template/js.almoxarifado_requisicao_itens.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Almoxarifado Requisicao Itens";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/almoxarifado_requisicao_itens/template/tpl.modal.almoxarifado_requisicao_itens.php");
$configModulo['titulo_card'] = "Listagem Almoxarifado Requisicao Itens";
$configModulo['id_card'] = "conteudo_almoxarifado_requisicao_itens";
echo $objApp->GerarCardContainer($configModulo);
