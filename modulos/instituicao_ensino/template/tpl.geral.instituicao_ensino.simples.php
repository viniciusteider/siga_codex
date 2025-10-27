<?php 
	include("modulos/instituicao_ensino/template/js.instituicao_ensino.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Instituicao Ensino";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/instituicao_ensino/template/tpl.modal.instituicao_ensino.php");
$configModulo['titulo_card'] = "Listagem Instituicao Ensino";
$configModulo['id_card'] = "conteudo_instituicao_ensino";
echo $objApp->GerarCardContainer($configModulo);
