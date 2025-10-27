<?php 
	include("modulos/vias/template/js.vias.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Vias";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/vias/template/tpl.modal.vias.php");
$configModulo['titulo_card'] = "Listagem Vias";
$configModulo['id_card'] = "conteudo_vias";
echo $objApp->GerarCardContainer($configModulo);
