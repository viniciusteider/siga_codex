<?php 
	include("modulos/uniforme_tamanho/template/js.uniforme_tamanho.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Uniforme Tamanho";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/uniforme_tamanho/template/tpl.modal.uniforme_tamanho.php");
$configModulo['titulo_card'] = "Listagem Uniforme Tamanho";
$configModulo['id_card'] = "conteudo_uniforme_tamanho";
echo $objApp->GerarCardContainer($configModulo);
