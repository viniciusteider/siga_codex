<?php 
	include("modulos/ocorrencias_recursos/template/js.ocorrencias_recursos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorrencias Recursos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/ocorrencias_recursos/template/tpl.modal.ocorrencias_recursos.php");
$configModulo['titulo_card'] = "Listagem Ocorrencias Recursos";
$configModulo['id_card'] = "conteudo_ocorrencias_recursos";
echo $objApp->GerarCardContainer($configModulo);
