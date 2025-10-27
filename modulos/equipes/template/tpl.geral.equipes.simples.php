<?php 
	include("modulos/equipes/template/js.equipes.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Equipes";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/equipes/template/tpl.modal.equipes.php");
$configModulo['titulo_card'] = "Listagem Equipes";
$configModulo['id_card'] = "conteudo_equipes";
echo $objApp->GerarCardContainer($configModulo);
