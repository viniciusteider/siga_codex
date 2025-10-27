<?php 
	include("modulos/produtos_saida_estoque_itens/template/js.produtos_saida_estoque_itens.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Saida Estoque Itens";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/produtos_saida_estoque_itens/template/tpl.modal.produtos_saida_estoque_itens.php");
$configModulo['titulo_card'] = "Listagem Produtos Saida Estoque Itens";
$configModulo['id_card'] = "conteudo_produtos_saida_estoque_itens";
echo $objApp->GerarCardContainer($configModulo);
