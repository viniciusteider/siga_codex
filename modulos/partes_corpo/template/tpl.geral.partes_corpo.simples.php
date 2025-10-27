<?php 
	include("modulos/partes_corpo/template/js.partes_corpo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Partes Corpo";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/partes_corpo/template/tpl.modal.partes_corpo.php");
$configModulo['titulo_card'] = "Listagem Partes Corpo";
$configModulo['id_card'] = "conteudo_partes_corpo";
echo $objApp->GerarCardContainer($configModulo);
