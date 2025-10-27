<?php 
	include("modulos/medicos/template/js.medicos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Medicos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/medicos/template/tpl.modal.medicos.php");
$configModulo['titulo_card'] = "Listagem Medicos";
$configModulo['id_card'] = "conteudo_medicos";
echo $objApp->GerarCardContainer($configModulo);
