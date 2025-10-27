<?php 
	include("modulos/produtos/template/js.produtos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/produtos/template/tpl.modal.produtos.php");
$configModulo['titulo_card'] = "Listagem Produtos";
$configModulo['id_card'] = "conteudo_produtos";
echo $objApp->GerarCardContainer($configModulo);
