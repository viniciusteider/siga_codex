<?php 
	include("modulos/ocorrencias_apoio/template/js.ocorrencias_apoio.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorrencias Apoio";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/ocorrencias_apoio/template/tpl.modal.ocorrencias_apoio.php");
$configModulo['titulo_card'] = "Listagem Ocorrencias Apoio";
$configModulo['id_card'] = "conteudo_ocorrencias_apoio";
echo $objApp->GerarCardContainer($configModulo);
