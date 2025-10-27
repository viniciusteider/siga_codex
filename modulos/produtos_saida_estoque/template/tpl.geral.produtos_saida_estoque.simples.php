<?php 
	include("modulos/produtos_saida_estoque/template/js.produtos_saida_estoque.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Saida Estoque";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/produtos_saida_estoque/template/tpl.modal.produtos_saida_estoque.php");
$configModulo['titulo_card'] = "Listagem Produtos Saida Estoque";
$configModulo['id_card'] = "conteudo_produtos_saida_estoque";
echo $objApp->GerarCardContainer($configModulo);
