<?php 
	include("modulos/produtos_cautela/template/js.produtos_cautela.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Cautela";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/produtos_cautela/template/tpl.modal.produtos_cautela.php");
$configModulo['titulo_card'] = "Listagem Produtos Cautela";
$configModulo['id_card'] = "conteudo_produtos_cautela";
echo $objApp->GerarCardContainer($configModulo);
