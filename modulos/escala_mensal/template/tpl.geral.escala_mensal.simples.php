<?php 
	include("modulos/escala_mensal/template/js.escala_mensal.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Mensal";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_mensal/template/tpl.modal.escala_mensal.php");
$configModulo['titulo_card'] = "Listagem Escala Mensal";
$configModulo['id_card'] = "conteudo_escala_mensal";
echo $objApp->GerarCardContainer($configModulo);
