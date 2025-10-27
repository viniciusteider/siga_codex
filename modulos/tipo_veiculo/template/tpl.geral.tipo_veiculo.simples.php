<?php 
	include("modulos/tipo_veiculo/template/js.tipo_veiculo.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Tipo Veiculo";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/tipo_veiculo/template/tpl.modal.tipo_veiculo.php");
$configModulo['titulo_card'] = "Listagem Tipo Veiculo";
$configModulo['id_card'] = "conteudo_tipo_veiculo";
echo $objApp->GerarCardContainer($configModulo);
