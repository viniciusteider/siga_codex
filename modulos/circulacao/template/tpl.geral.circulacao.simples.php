<?php 
	include("modulos/circulacao/template/js.circulacao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Circulacao";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/circulacao/template/tpl.modal.circulacao.php");
$configModulo['titulo_card'] = "Listagem Circulacao";
$configModulo['id_card'] = "conteudo_circulacao";
echo $objApp->GerarCardContainer($configModulo);
