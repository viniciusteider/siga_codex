<?php 
	include("modulos/veiculos_acidentes/template/js.veiculos_acidentes.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Veiculos Acidentes";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/veiculos_acidentes/template/tpl.modal.veiculos_acidentes.php");
$configModulo['titulo_card'] = "Listagem Veiculos Acidentes";
$configModulo['id_card'] = "conteudo_veiculos_acidentes";
echo $objApp->GerarCardContainer($configModulo);
