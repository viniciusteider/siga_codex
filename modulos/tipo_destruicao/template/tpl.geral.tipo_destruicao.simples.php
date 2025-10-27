<?php 
	include("modulos/tipo_destruicao/template/js.tipo_destruicao.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Destruicao";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/tipo_destruicao/template/tpl.modal.tipo_destruicao.php");
$configModulo['titulo_card'] = "Listagem Tipo Destruicao";
$configModulo['id_card'] = "conteudo_tipo_destruicao";
echo $objApp->GerarCardContainer($configModulo);
