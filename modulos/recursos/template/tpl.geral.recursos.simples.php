<?php 
	include("modulos/recursos/template/js.recursos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Recursos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/recursos/template/tpl.modal.recursos.php");
$configModulo['titulo_card'] = "Listagem Recursos";
$configModulo['id_card'] = "conteudo_recursos";
echo $objApp->GerarCardContainer($configModulo);
