<?php 
	include("modulos/fipe_marcas/template/js.fipe_marcas.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Fipe Marcas";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/fipe_marcas/template/tpl.modal.fipe_marcas.php");
$configModulo['titulo_card'] = "Listagem Fipe Marcas";
$configModulo['id_card'] = "conteudo_fipe_marcas";
echo $objApp->GerarCardContainer($configModulo);
