<?php 
	include("modulos/uniforme_grupo_tamanho/template/js.uniforme_grupo_tamanho.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Uniforme Grupo Tamanho";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/uniforme_grupo_tamanho/template/tpl.modal.uniforme_grupo_tamanho.php");
$configModulo['titulo_card'] = "Listagem Uniforme Grupo Tamanho";
$configModulo['id_card'] = "conteudo_uniforme_grupo_tamanho";
echo $objApp->GerarCardContainer($configModulo);
