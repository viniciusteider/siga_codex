<?php 
	include("modulos/materiais_itens/template/js.materiais_itens.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Materiais Itens";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/materiais_itens/template/tpl.modal.materiais_itens.php");
$configModulo['titulo_card'] = "Listagem Materiais Itens";
$configModulo['id_card'] = "conteudo_materiais_itens";
echo $objApp->GerarCardContainer($configModulo);
