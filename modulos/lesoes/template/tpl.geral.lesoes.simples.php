<?php 
	include("modulos/lesoes/template/js.lesoes.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Lesoes";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/lesoes/template/tpl.modal.lesoes.php");
$configModulo['titulo_card'] = "Listagem Lesoes";
$configModulo['id_card'] = "conteudo_lesoes";
echo $objApp->GerarCardContainer($configModulo);
