<?php 
	include("modulos/estagio_parto/template/js.estagio_parto.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Estagio Parto";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/estagio_parto/template/tpl.modal.estagio_parto.php");
$configModulo['titulo_card'] = "Listagem Estagio Parto";
$configModulo['id_card'] = "conteudo_estagio_parto";
echo $objApp->GerarCardContainer($configModulo);
