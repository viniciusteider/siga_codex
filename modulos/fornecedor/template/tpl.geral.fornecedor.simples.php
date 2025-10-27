<?php 
	include("modulos/fornecedor/template/js.fornecedor.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Fornecedor";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/fornecedor/template/tpl.modal.fornecedor.php");
$configModulo['titulo_card'] = "Listagem Fornecedor";
$configModulo['id_card'] = "conteudo_fornecedor";
echo $objApp->GerarCardContainer($configModulo);
