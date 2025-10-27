<?php 
	include("modulos/fipe_anos/template/js.fipe_anos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Fipe Anos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/fipe_anos/template/tpl.modal.fipe_anos.php");
$configModulo['titulo_card'] = "Listagem Fipe Anos";
$configModulo['id_card'] = "conteudo_fipe_anos";
echo $objApp->GerarCardContainer($configModulo);
