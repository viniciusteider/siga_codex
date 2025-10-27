<?php 
	include("modulos/escala_tipo/template/js.escala_tipo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipos de Escalas";
echo $objApp->GerarBreadCrumb($configTitulo);

$configModulo['titulo_card'] = "Listagem Tipos de Escalas";
$configModulo['id_card'] = "conteudo_escala_tipo";
echo $objApp->GerarCardContainer($configModulo);
