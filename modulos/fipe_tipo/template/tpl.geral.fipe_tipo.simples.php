<?php 
	include("modulos/fipe_tipo/template/js.fipe_tipo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Fipe Tipo";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/fipe_tipo/template/tpl.modal.fipe_tipo.php");
$configModulo['titulo_card'] = "Listagem Fipe Tipo";
$configModulo['id_card'] = "conteudo_fipe_tipo";
echo $objApp->GerarCardContainer($configModulo);
