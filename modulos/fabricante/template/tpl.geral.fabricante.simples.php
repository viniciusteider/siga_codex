<?php 
	include("modulos/fabricante/template/js.fabricante.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Fabricante";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/fabricante/template/tpl.modal.fabricante.php");
$configModulo['titulo_card'] = "Listagem Fabricante";
$configModulo['id_card'] = "conteudo_fabricante";
echo $objApp->GerarCardContainer($configModulo);
