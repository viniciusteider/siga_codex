<?php 
	include("modulos/orgao_apoio/template/js.orgao_apoio.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Orgao Apoio";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/orgao_apoio/template/tpl.modal.orgao_apoio.php");
$configModulo['titulo_card'] = "Listagem Orgao Apoio";
$configModulo['id_card'] = "conteudo_orgao_apoio";
echo $objApp->GerarCardContainer($configModulo);
