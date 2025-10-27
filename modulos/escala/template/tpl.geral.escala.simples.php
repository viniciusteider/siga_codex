<?php 
	include("modulos/escala/template/js.escala.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala/template/tpl.modal.escala.php");
$configModulo['titulo_card'] = "Listagem Escala";
$configModulo['id_card'] = "conteudo_escala";
echo $objApp->GerarCardContainer($configModulo);
