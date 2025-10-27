<?php 
	include("modulos/pupilas_sintomas/template/js.pupilas_sintomas.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Pupilas Sintomas";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/pupilas_sintomas/template/tpl.modal.pupilas_sintomas.php");
$configModulo['titulo_card'] = "Listagem Pupilas Sintomas";
$configModulo['id_card'] = "conteudo_pupilas_sintomas";
echo $objApp->GerarCardContainer($configModulo);
