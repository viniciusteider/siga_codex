<?php 
	include("modulos/produtos_acautelados/template/js.produtos_acautelados.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Produtos Acautelados";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/produtos_acautelados/template/tpl.modal.produtos_acautelados.php");
$configModulo['titulo_card'] = "Listagem Produtos Acautelados";
$configModulo['id_card'] = "conteudo_produtos_acautelados";
echo $objApp->GerarCardContainer($configModulo);
