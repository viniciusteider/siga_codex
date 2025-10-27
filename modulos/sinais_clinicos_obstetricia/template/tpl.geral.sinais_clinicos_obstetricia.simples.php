<?php 
	include("modulos/sinais_clinicos_obstetricia/template/js.sinais_clinicos_obstetricia.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Sinais Clinicos Obstetricia";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/sinais_clinicos_obstetricia/template/tpl.modal.sinais_clinicos_obstetricia.php");
$configModulo['titulo_card'] = "Listagem Sinais Clinicos Obstetricia";
$configModulo['id_card'] = "conteudo_sinais_clinicos_obstetricia";
echo $objApp->GerarCardContainer($configModulo);
