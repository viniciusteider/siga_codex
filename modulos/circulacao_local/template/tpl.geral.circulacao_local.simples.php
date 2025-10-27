<?php 
	include("modulos/circulacao_local/template/js.circulacao_local.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Circulacao Local";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/circulacao_local/template/tpl.modal.circulacao_local.php");
$configModulo['titulo_card'] = "Listagem Circulacao Local";
$configModulo['id_card'] = "conteudo_circulacao_local";
echo $objApp->GerarCardContainer($configModulo);
