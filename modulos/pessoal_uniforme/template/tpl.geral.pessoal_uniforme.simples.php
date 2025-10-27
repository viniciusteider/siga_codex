<?php 
	include("modulos/pessoal_uniforme/template/js.pessoal_uniforme.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Uniformes";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/pessoal_uniforme/template/tpl.modal.pessoal_uniforme.php");
$configModulo['titulo_card'] = "Listagem Uniformes";
$configModulo['id_card'] = "conteudo_pessoal_uniforme";
echo $objApp->GerarCardContainer($configModulo);
