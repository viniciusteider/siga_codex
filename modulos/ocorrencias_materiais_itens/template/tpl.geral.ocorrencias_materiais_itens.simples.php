<?php 
	include("modulos/ocorrencias_materiais_itens/template/js.ocorrencias_materiais_itens.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorrencias Materiais Itens";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/ocorrencias_materiais_itens/template/tpl.modal.ocorrencias_materiais_itens.php");
$configModulo['titulo_card'] = "Listagem Ocorrencias Materiais Itens";
$configModulo['id_card'] = "conteudo_ocorrencias_materiais_itens";
echo $objApp->GerarCardContainer($configModulo);
