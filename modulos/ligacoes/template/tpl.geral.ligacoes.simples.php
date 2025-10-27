<?php 
	include("modulos/ligacoes/template/js.ligacoes.php");
$objApp = new App();
$configTitulo['titulo_agrupamento_modulo'] = "Configurações";
$configTitulo['titulo_modulo'] = "Ligacoes";
echo $objApp->GerarBreadCrumb($configTitulo);
	include("modulos/ligacoes/template/tpl.modal.ligacoes.php");
$configModulo['titulo_card'] = "Listagem Ligacoes";
$configModulo['id_card'] = "conteudo_ligacoes";
echo $objApp->GerarCardContainer($configModulo);
