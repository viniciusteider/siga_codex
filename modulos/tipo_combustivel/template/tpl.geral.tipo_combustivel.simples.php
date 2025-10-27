<?php 
	include("modulos/tipo_combustivel/template/js.tipo_combustivel.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Combustivel";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/tipo_combustivel/template/tpl.modal.tipo_combustivel.php");
$configModulo['titulo_card'] = "Listagem Tipo Combustivel";
$configModulo['id_card'] = "conteudo_tipo_combustivel";
echo $objApp->GerarCardContainer($configModulo);
