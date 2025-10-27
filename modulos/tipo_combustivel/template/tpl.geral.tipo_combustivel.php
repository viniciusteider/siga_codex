<?php 
	include("modulos/tipo_combustivel/template/js.tipo_combustivel.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Combustível";
echo $objApp->GerarBreadCrumb($configTitulo);
$configModulo['titulo_card'] = "Listagem Tipo Combustível";
$configModulo['id_card'] = "conteudo_tipo_combustivel";
echo $objApp->GerarCardContainer($configModulo);
