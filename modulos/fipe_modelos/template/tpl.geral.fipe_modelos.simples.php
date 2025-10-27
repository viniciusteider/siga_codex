<?php 
	include("modulos/fipe_modelos/template/js.fipe_modelos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Fipe Modelos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/fipe_modelos/template/tpl.modal.fipe_modelos.php");
$configModulo['titulo_card'] = "Listagem Fipe Modelos";
$configModulo['id_card'] = "conteudo_fipe_modelos";
echo $objApp->GerarCardContainer($configModulo);
