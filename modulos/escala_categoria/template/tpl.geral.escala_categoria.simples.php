<?php 
	include("modulos/escala_categoria/template/js.escala_categoria.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Escala Categoria";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/escala_categoria/template/tpl.modal.escala_categoria.php");
$configModulo['titulo_card'] = "Listagem Escala Categoria";
$configModulo['id_card'] = "conteudo_escala_categoria";
echo $objApp->GerarCardContainer($configModulo);
