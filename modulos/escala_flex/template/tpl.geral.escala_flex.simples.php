<?php 
	include("modulos/escala_flex/template/js.escala_flex.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Mensal";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_flex/template/tpl.modal.escala_flex.php");
$configModulo['titulo_card'] = "Listagem Escala Mensal";
$configModulo['id_card'] = "conteudo_escala_flex";
echo $objApp->GerarCardContainer($configModulo);
