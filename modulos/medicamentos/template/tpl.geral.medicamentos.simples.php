<?php 
	include("modulos/medicamentos/template/js.medicamentos.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Medicamentos";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/medicamentos/template/tpl.modal.medicamentos.php");
$configModulo['titulo_card'] = "Listagem Medicamentos";
$configModulo['id_card'] = "conteudo_medicamentos";
echo $objApp->GerarCardContainer($configModulo);
