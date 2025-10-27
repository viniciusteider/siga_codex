<?php 
	include("modulos/unidade_medida/template/js.unidade_medida.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Unidade Medida";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/unidade_medida/template/tpl.modal.unidade_medida.php");
$configModulo['titulo_card'] = "Listagem Unidade Medida";
$configModulo['id_card'] = "conteudo_unidade_medida";
echo $objApp->GerarCardContainer($configModulo);
