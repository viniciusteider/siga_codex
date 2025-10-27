<?php 
	include("modulos/tipo_obstetricia/template/js.tipo_obstetricia.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Obstetricia";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/tipo_obstetricia/template/tpl.modal.tipo_obstetricia.php");
$configModulo['titulo_card'] = "Listagem Tipo Obstetricia";
$configModulo['id_card'] = "conteudo_tipo_obstetricia";
echo $objApp->GerarCardContainer($configModulo);
