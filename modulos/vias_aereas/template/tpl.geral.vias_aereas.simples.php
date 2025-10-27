<?php 
	include("modulos/vias_aereas/template/js.vias_aereas.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Vias Aereas";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/vias_aereas/template/tpl.modal.vias_aereas.php");
$configModulo['titulo_card'] = "Listagem Vias Aereas";
$configModulo['id_card'] = "conteudo_vias_aereas";
echo $objApp->GerarCardContainer($configModulo);
