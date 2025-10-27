<?php 
	include("modulos/escala_tipo/template/js.escala_tipo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Tipo";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_tipo/template/tpl.modal.escala_tipo.php");
$configModulo['titulo_card'] = "Listagem Escala Tipo";
$configModulo['id_card'] = "conteudo_escala_tipo";
echo $objApp->GerarCardContainer($configModulo);
