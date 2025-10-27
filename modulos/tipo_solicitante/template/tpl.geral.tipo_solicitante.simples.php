<?php 
	include("modulos/tipo_solicitante/template/js.tipo_solicitante.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Solicitante";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/tipo_solicitante/template/tpl.modal.tipo_solicitante.php");
$configModulo['titulo_card'] = "Listagem Tipo Solicitante";
$configModulo['id_card'] = "conteudo_tipo_solicitante";
echo $objApp->GerarCardContainer($configModulo);
