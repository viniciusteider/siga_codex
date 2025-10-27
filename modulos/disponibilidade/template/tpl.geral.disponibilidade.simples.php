<?php 
	include("modulos/disponibilidade/template/js.disponibilidade.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Disponibilidade";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/disponibilidade/template/tpl.modal.disponibilidade.php");
$configModulo['titulo_card'] = "Listagem Disponibilidade";
$configModulo['id_card'] = "conteudo_disponibilidade";
echo $objApp->GerarCardContainer($configModulo);
