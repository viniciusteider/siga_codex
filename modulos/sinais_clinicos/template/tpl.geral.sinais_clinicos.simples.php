<?php 
	include("modulos/sinais_clinicos/template/js.sinais_clinicos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Sinais Clinicos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/sinais_clinicos/template/tpl.modal.sinais_clinicos.php");
$configModulo['titulo_card'] = "Listagem Sinais Clinicos";
$configModulo['id_card'] = "conteudo_sinais_clinicos";
echo $objApp->GerarCardContainer($configModulo);
