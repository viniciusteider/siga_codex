<?php 
	include("modulos/ocorencias_historico/template/js.ocorencias_historico.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ocorencias Historico";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/ocorencias_historico/template/tpl.modal.ocorencias_historico.php");
$configModulo['titulo_card'] = "Listagem Ocorencias Historico";
$configModulo['id_card'] = "conteudo_ocorencias_historico";
echo $objApp->GerarCardContainer($configModulo);
