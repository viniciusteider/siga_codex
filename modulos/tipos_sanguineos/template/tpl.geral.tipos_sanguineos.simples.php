<?php 
	include("modulos/tipos_sanguineos/template/js.tipos_sanguineos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipos Sanguineos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/tipos_sanguineos/template/tpl.modal.tipos_sanguineos.php");
$configModulo['titulo_card'] = "Listagem Tipos Sanguineos";
$configModulo['id_card'] = "conteudo_tipos_sanguineos";
echo $objApp->GerarCardContainer($configModulo);
